<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Category;
use App\Product;
use App\Order;
class DashboardController extends Controller
{
 public function index(){

$categories = Category::all();
$products = Product::all();
$clients = Client::all();
$users = User::whereRoleIs('admin');
$sales_data = Order::select(
   DB::raw('YEAR(created_at) as year'),
   DB::raw('MONTH(created_at) as month'),
   DB::raw('SUM(total_price) as sum')
   
)->groupBy('month')->get();

   return view('dashboard.index',compact('categories','products','clients','users','sales_data'));

 }
}
