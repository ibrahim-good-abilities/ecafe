<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
 
class IndexController extends Controller {
     
    //For Index Page
    public function index(){
        return view('index');
    }
}
?>