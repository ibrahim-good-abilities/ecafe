<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
 
class InventoryController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    //For Index Page
    public function index(){
        return view('inventory-sheet');
    }
}
?>