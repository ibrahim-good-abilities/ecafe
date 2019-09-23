<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class IndexController extends Controller
{

    //For Index Page
    public function index()
    {
        return view('index');
    }

}
?>
