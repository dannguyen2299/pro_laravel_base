<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{CategoryRequest,EditCategoryRequest};
use Illuminate\Http\Request;
use App\models\category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
     //category
    function  GetCategory()
     {
        $data['categorys']=category::all()->toArray();
         return view("backend.category.category",$data);
     }
    function  PostCategory(CategoryRequest $r)
     {

        if(GetLevel(category::all()->toArray(),$r->parent,1)>2)
        {
            return redirect()->back()->with('error','Giao dien khong cho phep');
        }
        $cate=new category;
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name);
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công:'.$r->name);
     }
    function  GetEditCategory($id_category)
     {
         $data['cate']=category::find($id_category);
         $data['categorys']=category::all()->toArray();
         return view("backend.category.editcategory",$data);
     }
     function  PostEditCategory(EditCategoryRequest $r,$id_category)
     {
        if(GetLevel(category::all()->toArray(),$r->parent,1)>2)
        {
            return redirect()->back()->with('error','Giao dien khong cho phep');
        }
        $cate=category::find($id_category);
        $cate->name=$r->name;
        $cate->slug=Str::slug($r->name);
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');

     }
     function DelCategory($id_category){
        $cate= category::find($id_category);
        category::where('parent',$id_category)->update(['parent'=>$cate->parent]);
        category::destroy($id_category);
        return redirect()->back()->with('thongbao','Đã xóa danh mục');

     }
}
