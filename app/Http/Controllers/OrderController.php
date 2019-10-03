<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Item;
use App\Coupon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $orders = DB::table('orders')
        ->select('orders.id','orders.status','orders.created_at','orders.discount','customers.customer_name','coupons.name',DB::raw('sum(order_line.quantity * order_line.price) as subtotal'))
        ->join('order_line','orders.id','=','order_line.order_id')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->leftJoin('coupons','coupons.id','=','orders.coupon_id')
        ->groupBy('orders.id','orders.status','orders.created_at','customer_name','orders.discount','coupons.name')
        ->get();
        return view('orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $order = new Order();
        $order->discount =0;
        $order->customer_id =request('customer_id ');
        $order->status ='Pending';
        $order->save();
        $items = request('items');
        $order_total = 0;
        foreach($items as $item){
            $itemObj = Item::find($item['product_id']);
            $order->items()->attach([$item['product_id']=>['quantity'=>$item['quantity'],'cost'=>$itemObj->cost,'price'=>$itemObj->price]]);
            $order_total += $itemObj->price * $item['quantity'];
        }
        
        $coupon_code = request('coupon_code');
        $coupon = Coupon::where('code','=',$coupon_code)->first();
        if(!$coupon)
        {
            //
        }
        elseif ($coupon->status=='active') {
            $order->coupon_id=$coupon->id;
            if($coupon->type =="fixed"){
                if($coupon->value > $order_total ){
                    $order->discount = $order_total;
                }else{
                    $order->discount = $coupon->value;
                }
                $order->save();
            }else{
                $coupon_dicount = $order_total * ($coupon->value/100);
                if($coupon_dicount > $order_total ){
                    $order->discount = $order_total;
                }else{
                    $order->discount = $coupon_dicount;
                }
                $order->save();
            }
        }
        else
        {
            //
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        
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
        $order = DB::table('orders')
        ->select('orders.*','customers.customer_name')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->where('orders.id', $id)
        ->first();

        $items = DB::table('items')
        ->select('items.name','order_line.price','order_line.quantity')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $id)
        ->get();
        return view('orders.edit')->with('order',$order )->with('items',$items );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('success','Order deleted succefully');
        
    }
    public function parista()
    {
        $orders = DB::table('orders')
        ->select('orders.id','orders.status','orders.created_at','customers.customer_name',DB::raw('sum(order_line.quantity * order_line.price) as total'))
        ->join('order_line','orders.id','=','order_line.order_id')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->groupBy('orders.id','orders.status','orders.created_at','customer_name')
        ->get();
        return view('orders.parista')->with('orders',$orders);
    
    }

}

