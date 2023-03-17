<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Models\User;
class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }
    public function getAllUser()
    {
        return User::get();
    }
    public function getAdmin()
    {
        $admins= DB::table('admins')
        ->join('roles', 'admins.idquyen', '=', 'roles.id')
        ->select('admins.*', 'roles.tenquyen')
        ->get();    
        return response()->json($admins);
    }
    // lấy tên các quyền trong bảng roles
    //id as value 
    //tên quyền as lable -> lấy giạ trị của cột tên quyền hiển thị lên lable chọn của form tạo tài khoản mới ở phần
    //chọn vai trò
    public function create()
    {
        $role= DB::table('roles')
        ->select(
            "id as value",
            "tenquyen as label"

        )
        ->get();    
        return response()->json($role);
    }

    //tạo validation
    public function store(Request $request)
    {
        // Validate and store the blog post...
        $validated = $request->validate([
            'hoten' => 'required',
            'sdt' => 'required|unique:admins,sdt',   //unique dl của trường là duy nhất unique tên ràng buộc,
                                            //admins tên bảng trong csdl muốn ktra, sdt cột trong csdl
            'email' => 'required|email|unique:admins,email',
            'username' => 'required|unique:admins,username', 
            'password' => 'required|confirmed',
            'idquyen' => 'required',
           
        ],
        //xác định lại thông báo ràng buộc của validation bằng tiếng việt
        [ 
            'hoten.required'=>'Nhập họ tên',
            
            'sdt.required'=>'Nhập số điện thoại',
            'sdt.unique'=>'Số điện thoại đã tồn tại',

            'email.required'=>'Nhập email',
            'email.unique'=>'Email đã tồn tại',
            'email.email'=>'Email không hợp lệ',

            'username.required'=>'Nhập username',
            'username.unique'=>'Username đã tồn tại',

            'password.required'=>'Nhập password',
            'password.confirmed'=>'Xác nhận mật khẩu và mật khẩu không khớp',

            'idquyen.required'=>'Vai trò không được bỏ trống',
        ]); 
        
//Cách 1 thêm dl vào csdl
        // \DB::table('admins')->insert([
        //     "hoten" => $request["hoten"],
        //     "username" => $request["username"],
        //     "sdt" => $request["sdt"],
        //     "email" => $request["email"],
        //     "idquyen" => $request["idquyen"],
        //     "password" => \Hash::make($request["password"])       //hash mã hóa mật khẩu
        // ]);

//cách 2 thêm dl vò csdl

            $user = $request->expect(["password","password_confirmation"]);
            $user["password"] = \Hash::make($request["password"]) ;

            \DB::table(admins)->insert($user);
 
       
    }

    
}
