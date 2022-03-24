<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\order;

class OrderController extends Controller
{

    //order
    public function  GetOrder()
    {
        $data['orders']=order::where('state',2)->orderby('id','desc')->paginate(2);

        return view("backend.order.order",$data);
    }

    public function  GetProcessed()
    {
        $data['orders']=order::where('state',1)->orderby('id','desc')->paginate(2);
        return view("backend.order.processed",$data);
    }
    public function  GetDetailOrder($id_order)
    {
        $data['order']=order::find($id_order);
        return view("backend.order.detailorder",$data);
    }
    function paid($id_order){
        $order=order::find($id_order);
        $order->state=1;
        $order->save();
        return redirect('admin/order/processed');
    }
}
