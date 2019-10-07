<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Category;
use App\PackingUnit;
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
        ->select('items.*','categories.category_name')->where('available_stock','>','0')->get();

        return view('stock.available')->with('items', $result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('category_name','id')->get();
        $packing_units = PackingUnit::select('name','id')->get();
        return view('items.add-item')->with('categories_name',$categories)->with('packing_units',$packing_units);
    }

    public function createMenuItem()
    {
        $categories = Category::select('category_name','id')->get();
        return view('the_menu.add-menu-item')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$request->validate([
            'Item_Name'     =>'required',
            'category'      =>'required',
            'packing_unit'  =>'required',
            'alert'         =>'required',
            'price'         =>'required',
            'cost'          =>'required',
            'quantity'      =>'required',
            'image'         =>'required|image|mimes:jpeg,png'
        ]);

        $Item = new Item();
        $Item->name = request('Item_Name');
        $Item->alert_number=request('alert');
        $Item->price = request('price');
        $Item->packing_unit_id = request('packing_unit');
        $Item->cost=request('cost');
        $Item->main_stock=request('quantity');
        $Item->available_stock=0.0;
        $Item->category_id=request('category');
        $image = $request->file('image');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/items/');
        $image->move($destinationPath, $name_img);
        $Item->src = '/images/items/'.$name_img;
        $Item->update(['image' => $name_img]);

        $Item->save();
        //
        return redirect()->route('item_edit',['main',$Item->id])->with('success','Item created successfully!');
        //return route('item_edit');
    }

    public function storeMenuItem(Request $request)
    {
        $validator=$request->validate([
            'item_name'     =>'required',
            'category'      =>'required',
            'price'         =>'required',
            'image'         =>'required|image|mimes:jpeg,png'
        ]);

        $item = new Item();
        $item->name = request('item_name');
        $item->alert_number=request('alert');
        $item->price = request('price');
        $item->category_id=request('category');
        $item->is_menu=true;
        $image = $request->file('image');
        $name_img = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/items/');
        $image->move($destinationPath, $name_img);
        $item->src = '/images/items/'.$name_img;
        $item->update(['image' => $name_img]);
        $item->save();
        return redirect()->route('menu_edit',$item->id)->with('success','Item created successfully!');
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
    public function edit($type,$id)
    {
        $categories = Category::select('category_name','id')->get();
        $packing_units = PackingUnit::select('name','id')->get();
        $item = Item::find($id);
        return view('items.edit')->with('item',$item)->with('categories_name',$categories)->with('packing_units',$packing_units)->with('type',$type);

    }
    public function menuEdit($id)
    {
        $categories = Category::select('category_name','id')->get();
        $item = Item::find($id);
        return view('the_menu.edit')->with('item',$item)->with('categories_name',$categories);

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

         $request->validate([
            'Item_Name'     =>'required',
            'category'      =>'required',
            'packing_unit'  =>'required',
            'alert'         =>'required',
            'price'         =>'required',
            'cost'          =>'required',
        ]);


        $Item = Item::find($id);

        $Item->name = request('Item_Name');
        $Item->alert_number=request('alert');
        $Item->price = request('price');
        $Item->cost=request('cost');
        $Item->category_id=request('category');
        $Item->packing_unit_id = request('packing_unit');
        $Item->main_stock=request('quantity');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name_img = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/items/');
            $image->move($destinationPath, $name_img);
            $Item->src = '/images/items/'.$name_img;
            $Item->update(['image' => $name_img]);
        }
        $Item->save();
        return redirect()->back()->with('success', 'item update successfully');
    }

    public function Menuupdate(Request $request, $id)
    {

         $request->validate([
            'item_name'     =>'required',
            'category'      =>'required',
            'price'         =>'required',
        ]);


        $item = Item::find($id);

        $item->name = request('Item_Name');
        $item->price = request('price');
        $item->category_id=request('category');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name_img = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/items/');
            $image->move($destinationPath, $name_img);
            $item->src = '/images/items/'.$name_img;
            $item->update(['image' => $name_img]);
        }
        $Item->save();
        return redirect()->back()->with('success', 'Item update successfully');
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
        $item =Item::find($id);
        $item->delete();
        return redirect()->back()->with('success', 'item deleted successfully');


    }
    public function stock()
    {
       
        $result = DB::table('items')->join('categories','categories.id','=','category_id')
        ->select('items.*','categories.category_name')->where('main_stock','>','0')->get();

       return view('stock.main')->with('items',$result);

    }
    
    public function menu()
    {
       
        $result = DB::table('items')->join('categories','categories.id','=','category_id')
        ->select('items.*','categories.category_name')->where('is_menu','=','1')->get();

       return view('the_menu.items')->with('items',$result);

    }

    public function transferMainStock(Request $request){
        $validator=$request->validate([
            'item_id'     =>'required',
            'quantity'     =>'required',
        ]);
        
        $item_id = request('item_id');
        $quantity = request('quantity');
        $item =Item::find($item_id);
        if($item->main_stock >= $quantity){
            $main_stock_new_quantity = $item->main_stock - $quantity;
            $available_stock_new_quantity = $item->available_stock + $quantity;
            $item->main_stock = $main_stock_new_quantity;
            $item->available_stock = $available_stock_new_quantity;
            $item->save();
            return redirect()->back()->with('success', 'Quantity transfered successfully.');
        }else{
            return redirect()->back()->with('error', 'The selected quantity exceeds quantity available in stock.');
        }

    }


    public function mainStockOperations(Request $request){
        $validatedData = $request->validate([
            'item_id' => 'required',
            'quantity' => 'required',
            'operation' => 'required',
        ]);
        
        $item_id = request('item_id');
        $quantity = request('quantity');
        $operation = request('operation');
        $item =Item::find($item_id);
        if($operation == 1){
            $item->main_stock = $item->main_stock + $quantity;
            $item->save();
            return redirect()->back()->with('success', 'Quantity added successfully.');
        }elseif($operation == 2){
            if($item->main_stock >= $quantity){
                $item->main_stock = $item->main_stock - $quantity;
                $item->save();
                return redirect()->back()->with('success', 'Quantity reduced successfully.');
            }else{
                return redirect()->back()->with('error', 'The selected quantity exceeds quantity available in stock.');
            }

        }else{
            return redirect()->back()->with('error', 'The selected operation is not valid.');
        }

    }
    
    public function transferAvailableStock(Request $request){
        $validator=$request->validate([
            'item_id'     =>'required',
            'quantity'     =>'required',
        ]);
        
        $item_id = request('item_id');
        $quantity = request('quantity');
        $item =Item::find($item_id);
        if($item->available_stock >= $quantity){
            $available_stock_new_quantity = $item->available_stock - $quantity;
            $main_stock_new_quantity = $item->main_stock + $quantity;
            $item->available_stock = $available_stock_new_quantity;
            $item->main_stock = $main_stock_new_quantity;
            $item->save();
            return redirect()->back()->with('success', 'Quantity transfered successfully.');
        }else{
            return redirect()->back()->with('error', 'The selected quantity exceeds quantity available in stock.');
        }

    }
    
    public function availableStockOperations(Request $request){
        $validatedData = $request->validate([
            'item_id' => 'required',
            'quantity' => 'required',
            'operation' => 'required',
        ]);
        
        $item_id = request('item_id');
        $quantity = request('quantity');
        $operation = request('operation');
        $item =Item::find($item_id);
        if($operation == 1){
            $item->available_stock = $item->available_stock + $quantity;
            $item->save();
            return redirect()->back()->with('success', 'Quantity added successfully.');
        }elseif($operation == 2){
            if($item->available_stock >= $quantity){
                $item->available_stock = $item->available_stock - $quantity;
                $item->save();
                return redirect()->back()->with('success', 'Quantity reduced successfully.');
            }else{
                return redirect()->back()->with('error', 'The selected quantity exceeds quantity available in stock.');
            }

        }else{
            return redirect()->back()->with('error', 'The selected operation is not valid.');
        }

    }

  
    
}
