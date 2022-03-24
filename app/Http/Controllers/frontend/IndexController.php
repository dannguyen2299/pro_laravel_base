<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\{product,category};

class IndexController extends Controller
{

    function GetIndex()
    {
        $data['prd_new']=product::orderby('id','desc')->where('img','<>','no-img.jpg')->take(8)->get();
        $data['prd_nb']=product::where('featured',1)->where('img','<>','no-img.jpg')->take(4)->get();
     return view('frontend.index',$data);
    }

    function Getabout()
    {
     return view('frontend.about');
    }

   function GetContact()
   {
    return view("frontend.contact");
   }
   function GetPrdCate($slug_cate){
        $data['products']=category::where('slug',$slug_cate)->first()->prd()->paginate(6);
        $data['categorys']=category::all();
        return view('frontend.product.shop',$data);
    }
    function GetFilter(request $r){

        $data['categorys']=category::all();

        $data['products']=product::whereBetween('price',[$r->start,$r->end])->paginate(6);
        return view('frontend.product.shop',$data);
    }

}
