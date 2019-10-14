<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //For Index Page
    public function index()
    {
        $categories = DB::table('categories')
        ->join('items','items.category_id','=','categories.id')
        ->select('categories.*')
        ->where('items.is_menu','=',1)
        ->distinct()
        ->get();
        $items =DB::table('items')
        ->where('is_menu','=',1)
        ->get();
        $item_groups = [];
        foreach($items as $item):
            if (array_key_exists($item->category_id,$item_groups)):
                $item_groups[$item->category_id][] = $item;
            else:
                $item_groups[$item->category_id] = [];
                $item_groups[$item->category_id][] = $item;
            endif;
        endforeach;
        return view('index')
        ->with('categories',$categories)
        ->with('item_groups',$item_groups);
    }
    public function welcome()
    {

        $categories = DB::table('categories')
        ->join('items','items.category_id','=','categories.id')
        ->select('categories.*')
        ->where('items.is_menu','=',1)
        ->distinct()
        ->get();
        $items =DB::table('items')
        ->where('is_menu','=',1)
        ->get();
        $item_groups = [];
        foreach($items as $item):
            if (array_key_exists($item->category_id,$item_groups)):
                $item_groups[$item->category_id][] = $item;
            else:
                $item_groups[$item->category_id] = [];
                $item_groups[$item->category_id][] = $item;
            endif;
        endforeach;
        return view('welcome-index')
        ->with('categories',$categories)
        ->with('item_groups',$item_groups);
    }
    public function captain()
    {

        $categories = DB::table('categories')
        ->join('items','items.category_id','=','categories.id')
        ->select('categories.*')
        ->where('items.is_menu','=',1)
        ->distinct()
        ->get();

        $items =DB::table('items')
        ->where('is_menu','=',1)
        ->get();

        $orders = DB::table('orders')
        ->select('orders.id','orders.table_number')
        ->where('orders.status','!=','paid')
        ->get();

        $item_groups = [];
        foreach($items as $item):
            if (array_key_exists($item->category_id,$item_groups)):
                $item_groups[$item->category_id][] = $item;
            else:
                $item_groups[$item->category_id] = [];
                $item_groups[$item->category_id][] = $item;
            endif;
        endforeach;
        return view('captain.captain')
        ->with('categories',$categories)
        ->with('item_groups',$item_groups)
        ->with('orders',$orders);
    }

    public function captainOrder($order_id)
    {
        $order = DB::table('orders')
        ->select('orders.*','customers.customer_name')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->where('orders.id', $order_id)
        ->first();

        $items = DB::table('items')
        ->select('items.name','order_line.price','order_line.quantity','order_line.status','order_line.id')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $order_id)
        ->get();


        $orders = DB::table('orders')
        ->select('orders.id','orders.table_number')
        ->where('orders.status','!=','paid')
        ->get();


        return view('captain.view-order')
        ->with('order', $order)
        ->with('items', $items)
        ->with('orders',$orders);
    }

    public function captainEditOrder($order_id)
    {
        $order = DB::table('orders')
        ->select('orders.*','coupons.code','customers.customer_name')
        ->leftJoin('customers','customers.id','=','orders.customer_id')
        ->leftJoin('coupons','orders.coupon_id','=','coupons.id')
        ->where('orders.id', $order_id)
        ->first();

        $items =DB::table('items')
        ->where('is_menu','=',1)
        ->get();

        $order_items = DB::table('items')
        ->select('items.id as product_id','items.name','order_line.price','order_line.quantity','order_line.status','order_line.id')
        ->join('order_line','items.id','=','order_line.item_id')
        ->where('order_line.order_id', $order_id)
        ->get();


        $orders = DB::table('orders')
        ->select('orders.id','orders.table_number')
        ->where('orders.status','!=','paid')
        ->get();

        $categories = DB::table('categories')
        ->join('items','items.category_id','=','categories.id')
        ->select('categories.*')
        ->where('items.is_menu','=',1)
        ->distinct()
        ->get();

        $item_groups = [];
        foreach($items as $item):
            if (array_key_exists($item->category_id,$item_groups)):
                $item_groups[$item->category_id][] = $item;
            else:
                $item_groups[$item->category_id] = [];
                $item_groups[$item->category_id][] = $item;
            endif;
        endforeach;

        return view('captain.captain')
        ->with('categories',$categories)
        ->with('item_groups',$item_groups)
        ->with('orders',$orders)
        ->with('order', $order)
        ->with('items', $order_items);
    }

    public function cashier()
    {

        $orders = DB::table('orders')
        ->select('orders.id','orders.status','orders.table_number','orders.discount','orders.notes',DB::raw('sum(order_line.quantity * order_line.price) as subtotal'))
        ->join('order_line','orders.id','=','order_line.order_id')
        ->groupBy('orders.id','orders.status','orders.table_number','orders.discount','orders.notes')
        ->where('orders.status','=','done')
        ->get();

        return view('cashier')
        ->with('orders',$orders);
    }

}
?>
