<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =Category::all();
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.add-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'category_name'=>'required',
            'img'          =>'required|image|mimes:jpeg,png'
         ]);

        $category = new Category();
        $category->category_name = request('category_name');
        $image = $request->file('img');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/categories/');
        $image->move($destinationPath, $name_img);
        $category->src = '/images/categories/'.$name_img;
        $category->update(['image' => $name_img]);
        $category->save();
        return redirect()->route('edit_category',$category->id)->with('success','Item created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'category_name'=>'required',
         ]);
         $category = Category::find($id);
         $category->category_name = request('category_name');
         if($request->hasFile('image')){
                $image = $request->file('image');
                $name_img = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/categories/');
                $image->move($destinationPath, $name_img);
                $category->src = '/images/categories/'.$name_img;
                $category->update(['image' => $name_img]);
         }
         $category->save();

        return redirect()->back()->with('success','Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success','category detelted successfully');
    }
}
