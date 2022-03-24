<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{product,category};

class ProductController extends Controller
{

    function GetDetail($slug_prd)
    {
        // echo $slug_prd
        $data['prd']=product::where('slug',$slug_prd)->first();
        $data['prd_new']=product::orderby('id','desc')->where('img','<>','no-img.jpg')->take(4)->get();

    return view('frontend.product.detail',$data);
    }
    function GetShop()
    {
    $data['products']=product::where('img','<>','no-img.jpg')->paginate(6);
    $data['categorys']=category::all();
    return view('frontend.product.shop',$data);
    }
}
