<?php

namespace App\Http\Controllers;

use App\Infrastructure\Eloquent\Category\Category;
use App\Infrastructure\Eloquent\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::OrderBy('created_at', 'desc')->paginate(15);
        return view('products.index', ['items' => $items]);
    }
    public function indexJson(){
        $items = Product::query()->search()->with('category')->get();
        return apiOk($items);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = checkValidate(['name' => 'required', 'unit' => ['required', Rule::in(Product::defaultUnits())], 'price' => 'required|between:0,99.99|not_in:0', 'category_id' => 'required|exists:categories,id'], []);
        if ($validator)
            return back()->withErrors($validator->errors())->withInput();
        $item = Product::findOrNew($request->id);
        $data = $request->only('name', 'unit', 'price', 'category_id');
        DB::beginTransaction();
        try {
            fillData($item, $data);
            $item->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Error');
        }
        return redirect()->route('products.index')->with('success', 'Save successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product = null)
    {
        $item = $product;
        if (is_null($product))
            $item = new Product();
        $categories = Category::all();
        $units = Product::defaultUnits();
        return view('products.edit', ['item' => $item, 'categories' => $categories, 'units' => $units]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!is_null($product))
            $product->delete();
        return redirect()->back()->with('success', 'Remove successfully');
    }
}
