<?php

namespace App\Http\Controllers;

use App\Infrastructure\Eloquent\Category\Category;
use App\Infrastructure\Eloquent\Order\Order;
use App\Infrastructure\Eloquent\Order\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Order::OrderBy('created_at', 'desc')->paginate(15);
        return view('orders.index', ['items' => $items]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = checkValidate(['customer_name' => 'required','order_details'=>'required|array|min:1'],['order_details.required'=>"Please select at least one product"]);
        if ($validator)
            return back()->withErrors($validator->errors())->withInput();
        $order = $this->saveOrder($request);
        if ($order)
            $this->saveOrderDeails($order, $request);
        return redirect()->route('orders.index')->with('success','Save successfully');
    }
    public function saveOrder(Request $request)
    {
        $data = $request->only('customer_name');
        try {
            $item = Order::findOrNew($request->order_id);
            fillData($item, $data);
            $item->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
        return $item;
    }
    public function saveOrderDeails(Order $order, Request $request): void
    {
        $data = collect($request->order_details);
        //check order details are deleted and update
        if ($order->orderDetails()->count()) {
            $items = $data->filter(function ($item1) {
                return !is_null($item1['id']);
            })->values();
            $order->orderDetails()->whereNotIn('id', $items->pluck('id')->toArray())->delete(); //remove when not found
            foreach ($items as $key => $value) {
                $item = OrderDetail::find($value['id']);
                $item->update($value);
            }
        }
        $items = $data->filter(function ($item1) {
            return is_null($item1['id']);
        })->values()->toArray();
        array_walk($items, function (&$a) {
            unset($a['id']);
        });
        $new_items = [];
        foreach ($items as $key => $value)
            $new_items[] = new OrderDetail($value);
        $order->orderDetails()->saveMany($new_items);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order = null)
    {
        $item = $order;
        $order_details = [];
        if (is_null($order))
            $item = new Order();
        else {
            if ($order->orderDetails()->count())
                $order_details = $order->orderDetails->toArray();
        }
        $categories = Category::all();
        return view('orders.edit', [
            'item' => $item, 'categories' => $categories, 'order_details' => $order_details
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order = null)
    {
        if (!is_null($order))
            $order->delete();
        return redirect()->back()->with('success', 'Remove successfully');
    }
    public function show(Order $order = null)
    {
        return view('orders.show',['item'=>$order]);
    }
}
