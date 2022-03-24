<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest};
use Illuminate\Http\Request;
use App\models\{product,category};
use Illuminate\Support\Str;
class ProductController extends Controller
{
      //product
    function  GetListProduct()
    {
        $data['products']=product::paginate(4);
        return view("backend.product.listproduct",$data);
    }
    function  GetAddProduct()
    {
        $data['categorys']=category::all()->toArray();
        return view("backend.product.addproduct",$data);
    }
      function  PostAddProduct(AddProductRequest $r)
    {
        $prd=new product;
        $prd->code=$r->code  ;
        $prd->name=$r->name  ;
        $prd->slug= Str::slug($r->slug) ;
        $prd->price= $r->price ;
        $prd->featured= $r->featured ;
        $prd->state= $r->state ;
        $prd->info= $r->info ;
        $prd->code= $r->code ;
        $prd->describe=  $r->describe;
        $prd->category_id= $r->category ;

        if($r->hasFile('img')){
            $file=$r->img;
            $file_name=str::slug($r->name).'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img=$file_name;
        }else
        {
            $prd->img='no-img.jpg';
        }

        $prd->save();
        return redirect ('admin/product')->with('thongbao','Đã thêm sản phẩm thành công');
    }
    function  GetEditProduct($id_product)
    {
        $data['categorys']=category::all()->toArray();
        $data['product']=product::find($id_product);
        return view("backend.product.editproduct",$data);
    }
    function  PostEditProduct(EditProductRequest $r,$id_product)
    {
        $prd=product::find($id_product);
        $prd->code=$r->code  ;
        $prd->name=$r->name  ;
        $prd->slug= Str::slug($r->slug) ;
        $prd->price= $r->price ;
        $prd->featured= $r->featured ;
        $prd->state= $r->state ;
        $prd->info= $r->info ;
        $prd->code= $r->code ;
        $prd->describe=  $r->describe;
        $prd->category_id= $r->category ;

        if($r->hasFile('img'))
        {
            if($prd->img!='no-img.jpg')
            {
                unlink('backend/img/'.$prd->img);
            }

            $file=$r->img;
            $file_name=str_slug($r->name).'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img=$file_name;
        }

        $prd->category_id=$r->category;
        $prd->save();
      return redirect()->back()->with('thongbao','Đã sửa Thành Công!');
    }
    function DelProduct($id_product){
        product::destroy($id_product);
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }
}
