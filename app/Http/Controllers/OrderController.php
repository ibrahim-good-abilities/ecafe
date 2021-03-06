<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Order_line;
use App\Item;
use App\Coupon;
use App\Notification;
use App\Events\NewNotification;
use App\Log;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = DB::table('orders')
        ->select('orders.id','orders.status','orders.created_at','orders.updated_at','orders.discount','orders.notes','customers.customer_name','coupons.name',DB::raw('sum(order_line.quantity * order_line.price) as subtotal'))
        ->join('order_line','orders.id','=','order_line.order_id')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->leftJoin('coupons','coupons.id','=','orders.coupon_id')
        ->groupBy('orders.id','orders.status','orders.created_at','orders.updated_at','orders.notes','customer_name','orders.discount','coupons.name')
        ->get();
        return view('orders.index')
        ->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = ['order'=>[],'coupon'=>[]];
        $coupon = null;
        $coupon_code = request('coupon_code');
        if($coupon_code){
            $coupon = Coupon::where('code','=',$coupon_code)->first();
            if(!$coupon)
            {
                $response['coupon']['error'] = __('Coupon code doesn\'t exist.');
                return response()->json($response);
            }elseif($coupon->status!='active') {
                $response['coupon']['error'] = __('Coupon code is no longer valid.');
                return response()->json($response);
            }
        }

        $order = new Order();
        $order->discount =0;
        $order->table_number=request('table_number');
        //$order->customer_id =request('customer_id');
        $order->notes = request('notes');
        $order->status ='pending';
        $order->save();
        new NewNotification('parista','new-order',['message'=>__('You have a new order').' #'.$order->id,'order_id'=>$order->id]);
        $response['order']['id'] = $order->id;
        $response['order']['status'] = __('Pending');
        $response['order']['success'] = __('We have successfully received your order.');
        $items = request('items');
        $order_total = 0;
        foreach($items as $item){
            $itemObj = Item::find($item['product_id']);
            $order->items()->attach([$item['product_id']=>['quantity'=>$item['quantity'],'cost'=>0,'price'=>$itemObj->price,'notes'=>$item['feedback'] ]]);
            $order_total += $itemObj->price * $item['quantity'];
        }

        if ($coupon) {
            $response['coupon']['code'] = $coupon->code;
            $order->coupon_id=$coupon->id;
            if($coupon->type =="fixed"){
                if($coupon->value > $order_total ){
                    $order->discount = $order_total;
                }else{
                    $order->discount = $coupon->value;
                }
                $order->save();
                $response['coupon']['discount'] = $order->discount ;
            }else{
                $coupon_dicount = $order_total * ($coupon->value/100);
                if($coupon_dicount > $order_total ){
                    $order->discount = round($order_total,2);
                }else{
                    $order->discount = round($coupon_dicount,2);
                }
                $order->save();
                $response['coupon']['discount'] = $order->discount;
            }

            $coupon->status = 'used';
            $coupon->save();
        }

        $log = new Log();
        $log->order_id  = $order->id;
        $log->description = "Order Created At " . $order->created_at;
        $log->save();
        return response()->json($response);

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
    public function edit($id ,$notification_id = false)
    {
        if($notification_id ){
            $notification = Notification::find($notification_id);
            $notification->status=true;
            $notification->save();
        }

        $order = DB::table('orders')
        ->select('orders.*','customers.customer_name','coupons.name')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->leftJoin('coupons','coupons.id','=','orders.coupon_id')
        ->where('orders.id', $id)
        ->first();

        $items = DB::table('items')
        ->select('items.name','order_line.price','order_line.quantity')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $id)
        ->get();

         $log = Log::where('order_id', $order->id)
        ->orderBy('id','desc')
        ->get();
        return view('orders.edit')->with('order',$order )->with('items',$items )->with('logs',$log);
    }
    public function editStatus($id)
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
        return view('orders.parista-edit')->with('order',$order )->with('items',$items );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $order = Order::find($id);
        $response = ['order'=>[],'coupon'=>[]];
        $old_coupon = Coupon::find($order->coupon_id);
        $coupon = null;
        if($old_coupon){
            $old_coupon->status = 'active';
            $old_coupon->save();
            $order->coupon_id = null;
        }
        $coupon_code = request('coupon_code');
        if($coupon_code){
            $coupon = Coupon::where('code','=',$coupon_code)->first();
            if(!$coupon)
            {
                $response['coupon']['error'] = __('Coupon code doesn\'t exist.');
                return response()->json($response);
            }elseif($coupon->status!='active') {
                $response['coupon']['error'] = __('Coupon code is no longer valid.');
                return response()->json($response);
            }
        }

        $order->discount = 0;
        $order->table_number=request('table_number');
        //$order->customer_id =request('customer_id');
        $order->notes = request('notes');
        $order->status ='pending';
        $order->save();
        new NewNotification('parista','new-order',['message'=>__('Order has been updated').' #'.$order->id,'order_id'=>$order->id]);
        $response['order']['id'] = $order->id;
        $response['order']['status'] = __('Pending');
        $response['order']['success'] = __('We have successfully updated your order.');
        $items = request('items');
        $order_total = 0;
        Order_line::where('order_id', $order->id)->delete();
        //TODO: only remove pending items
        foreach($items as $item){
            $itemObj = Item::find($item['product_id']);
            $order->items()->attach([$item['product_id']=>['quantity'=>$item['quantity'],'cost'=>0,'price'=>$itemObj->price]]);
            $order_total += $itemObj->price * $item['quantity'];
        }

        if ($coupon) {
            $response['coupon']['code'] = $coupon->code;
            $order->coupon_id=$coupon->id;
            if($coupon->type =="fixed"){
                if($coupon->value > $order_total ){
                    $order->discount = $order_total;
                }else{
                    $order->discount = $coupon->value;
                }
                $order->save();
                $response['coupon']['discount'] = $order->discount ;
            }else{
                $coupon_dicount = $order_total * ($coupon->value/100);
                if($coupon_dicount > $order_total ){
                    $order->discount = round($order_total,2);
                }else{
                    $order->discount = round($coupon_dicount,2);
                }
                $order->save();
                $response['coupon']['discount'] = $order->discount;
            }

            $coupon->status = 'used';
            $coupon->save();
        }

        $log = new Log();
        $log->order_id = $order->id;
        $log->description = "Order Updated At " . $order->created_at;
        $log->save();

        return response()->json($response);
    }

    public function updateStatus(Request $request ,$id)
    {
        $request->validate([
                'status'  =>'required'
            ]);
        $order = Order::find($id);
        $order->status=request('status');
        $order->touch();
        if($order->status == "done"){
            Order_line::where('order_id', $id)
            ->update(['status' => 'done']);
            new NewNotification('cashier','order-status',['message'=>__('You got new check please reload the page'),'order_id'=>$order->id]);
        }
        if($order->status != "paid" && $order->status != "pending"){
            new NewNotification('customer_'.$id,'order-status',['message'=>__('Your order is '.ucfirst($order->status)),'status'=>__(ucfirst($order->status)),'order_id'=>$order->id]);
            new NewNotification('captain','order-status',['message'=>__('Order status changed to '.ucfirst($order->status)),'status'=>__(ucfirst($order->status)),'order_id'=>$order->id]);
        }

        $order->save();
        $log = new Log();
        $log->order_id = $order->id;
        $log->description = "Order Done at " . $order->updated_at;
        $log->save();


        if ($request->has('ajax')) {
            return response()->json(['status' => 'success']);
        }
        else{
            return redirect()->back()->with('success', __('Order  status update successfully'));
        }


    }
    public function updateOrderLineStatus(Request $request ,$id)
    {
        $request->validate([
            'status'  =>'required'
        ]);
        $order_line = Order_line::find($id);
        $order_line->status = request('status');
        $order=Order::find($order_line->order_id);
        $order->touch();

        new NewNotification('customer_'.$order_line->order_id,'item-status',['message'=>__('Your item is '.ucfirst($order_line->status )),'status'=>__(ucfirst($order_line->status)),'order_id'=>$order_line->order_id, 'item_id'=>$order_line->id]);
        new NewNotification('captain','item-status',['message'=>__('Your item is '.ucfirst($order_line->status )),'status'=>__(ucfirst($order_line->status)),'order_id'=>$order_line->order_id, 'item_id'=>$order_line->id]);
        $order_line->save();



        return response()->json(['status' => 'success']);
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



        return redirect()->back()->with('success',__('Order deleted succefully'));

    }


    public function parista($notification_id =false)
    {
        if($notification_id ){
            $notification = Notification::find($notification_id);
            $notification->status=true;
            $notification->save();
        }
       $orders = Order::where('status','=','pending')->get();



        return view('parista.index')->with('orders',$orders);

    }

    public static function getOrderItems($id) {
        $items = DB::table('items')
        ->select('order_line.id','items.name','items.price','order_line.status','order_line.quantity','order_line.notes as note')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $id)
        ->get();
        return $items;
    }
    public function orderPaid(Request $request)
    {

        $request->validate([
            'order_id'=>'required'
        ]);

        $order_id =request('order_id');

        $order = Order::find($order_id);
        $order->status='paid';
        $order->save();

       $order = DB::table('orders')
        ->select('orders.*','customers.customer_name')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->where('orders.id', $order_id)
        ->first();

        $items = DB::table('items')
        ->select('items.name','items.id','order_line.price','order_line.quantity')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $order_id)
        ->get();
        // $items=$items->toArray();

        return response()->json(['order' => $order,'items'=>$items]);

    }


    public function sendNewNotification(Request $request)
    {


        $target = request('target');
        $sender = request('sender');
        //channel
        //event
        //params []
        new NewNotification($target,'call-action',['message'=>$sender.'  '.__('Call You')]);

        return response()->json(['success'=> true]);

    }
}

