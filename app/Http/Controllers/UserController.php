<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view("user.index");
    }

    public function orders(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->paginate(12);
        return view('user.orders',compact('orders'));
    }

    public function order_details($order_id){
        $order = Order::where('user_id',Auth::user()->id)->findOrFail($order_id);
        $orderItems = OrderItem::where('order_id',$order_id)->orderBy('id')->paginate(12);
        return view('user.order-details',compact('order','orderItems'));
    }

    public function cancel_order(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->status = 'cancelled';
        $order->cancelled_date = Carbon::now();
        $order->save();

        return back()->with('status','Order has been cancelled');
    }
}
