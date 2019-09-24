<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Category;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = Item::all();
        //
        $result = DB::table('items')->join('categories','categories.id','=','category_id')
        ->select('items.*','categories.category_name')->get();

        return view('items.index')->with('items', $result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('items.add-item');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vaidator=$request->validate([
            'Item_Name'     =>'required',
            'Item_unit'     =>'required',
            'category'      =>'required',
            'alert'         =>'required',
            'price'         =>'required',
            'cost'          =>'required',
            'category'      =>'required',
            'image'         =>'required|image|mimes:jpeg,png'
        ]);

        $Item = new Item();
        //$Item->   Category()->category_name;
        $Item->name = request('Item_Name');
        $Item->unit =request('Item_unit');
        $Item->alert_number=request('alert');
        $Item->price = request('price');
        $Item->cost=request('cost');
        $Item->has_stock= request('has_stock');
        $Item->category_id=request('category');
        $image = $request->file('image');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/items/');
        $image->move($destinationPath, $name_img);
        $Item->src = '/images/items/'.$name_img;
        $Item->update(['image' => $name_img]);

        $Item->save();
        return redirect()->back()->with('success','Item created successfully!');
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
        $item = Item::find($id);

        return view('items.edit')->with('item',$item);

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

        $vaidator = $request->validate([
            'Item_Name'     =>'required',
            'Item_unit'     =>'required',
            'category'      =>'required',
            'alert'         =>'required',
            'price'         =>'required',
            'cost'          =>'required',
            'category'      =>'required',
            'image'         =>'required|image|mimes:jpeg,png'
        ]);
            //dd($id);
        $Item = Item::find($id);
       // dd($Item);
        $Item->name = request('Item_Name');
        $Item->unit =request('Item_unit');
        $Item->alert_number=request('alert');
        $Item->price = request('price');
        $Item->cost=request('cost');
        $Item->has_stock= request('has_stock');
        $Item->category_id=request('category');
        $image = $request->file('image');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/items/');
        $image->move($destinationPath, $name_img);
        $Item->src = '/images/items/'.$name_img;
        $Item->update(['image' => $name_img]);

        $Item->save();
        return redirect()->back()->with('success', 'item update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
