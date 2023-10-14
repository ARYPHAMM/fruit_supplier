<?php

namespace App\Http\Controllers;

use App\Infrastructure\Eloquent\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::query()->orderBy('created_at', 'desc')->paginate(15);
        return view('categories.index', ['items' => $items]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = checkValidate(['name' => 'required', []]);
        if ($validator)
            return back()->withErrors($validator->errors());
        $item = Category::findOrNew($request->id);
        $data = $request->only('name');
        DB::beginTransaction();
        try {
            fillData($item, $data);
            $item->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Error');
        }
        return redirect()->route('categories.index')->with('success', 'Save successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category = null)
    {
        $item = $category;
        if (is_null($category))
            $item = new Category();
        return view('categories.edit', ['item' => $item]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category = null)
    {
        if (!is_null($category))
            $category->delete();
        return redirect()->back()->with('success', 'Remove successfully');
    }
}
