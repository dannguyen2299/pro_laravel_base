<?php

namespace App\Http\Controllers\backend;
use App\user;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use Illuminate\Http\Request;
// use Illuminate\Hashing\BcryptHasher;

class userController extends Controller
{

    function  GetListUser()
    {
        $data['users']=user::paginate(3);
        return view("backend.user.listuser",$data);
    }


    function  GetAddUser()
    {
        return view("backend.user.adduser");
    }
    function  PostAddUser(AddUserRequest $r)
    {
        $user= new user;
        $user->email=$r->email;
        $user->password=bcrypt($r->password);
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Đã thêm thành công');

    }

    function  GetEditUser($id_user)
    {
        $data['user']=user::find($id_user);
        $data['users']=user::all()->toArray();
        return view("backend.user.edituser",$data);
    }
    function  PostEditUser (EditUserRequest $r,$id_user)
    {
        $user=user::find($id_user);
        $user->full=$r->full;
        if($r->password!=""){
            $user->password=bcrypt($r->password);
        }
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('admin/user')->with('thongbao','Đã sửa thành công');
    }
    function DelUser($id_user){
        $user= user::find($id_user);
        user::destroy($id_user);
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }
}
