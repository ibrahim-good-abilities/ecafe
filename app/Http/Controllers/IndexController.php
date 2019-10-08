<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{

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
    public function cashier()
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
        return view('cashier')
        ->with('categories',$categories)
        ->with('item_groups',$item_groups);
    }

}
?>
