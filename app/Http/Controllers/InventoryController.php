<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
 
class InventoryController extends Controller {
     
    //For Index Page
    public function index(){
        return view('inventory-sheet');
    }
}
?>