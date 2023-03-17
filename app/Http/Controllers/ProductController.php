<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Models\Products;
class ProductController extends Controller
{
    public function showAll()
    {
        $products= DB::table('products')
        ->join('categorys', 'products.idloai', '=', 'categorys.id')
        ->select('products.*', 'categorys.tenloai')
        ->get();    
        return response()->json($products);
    }
    //trả về các danh mục và thương hiệu
    public function create()
    {
        $categorys= DB::table('categorys')
        ->select(
            "id as value",
            "tenloai as label"
        )
        ->get();  
        
        $brands=DB::table('brands')
        ->select(
            "id as value",
            "tenThuongHieu as label"
        )
        ->get();

        return response()->json([$categorys,$brands]);
    }

    public function store(Request $request)
    {
        // Validate and store the blog post...
        $validated = $request->validate([
            'tensp' => 'required',
            'soluong' => 'required',   //unique dl của trường là duy nhất unique tên ràng buộc,
                                            //admins tên bảng trong csdl muốn ktra, sdt cột trong csdl
            
            'giaban' => 'required', 
            'gianhap' => 'required',
            'idloai' => 'required',
            'idThuongHieu' => 'required',

        ],
        //xác định lại thông báo ràng buộc của validation bằng tiếng việt
        [ 
            'tensp.required'=>'Nhập tên sản phẩm',
            
            'soluong.required'=>'Nhập số lượng sản phẩm',
           
            'giaban.required'=>'Giá bán không được bỏ trống',
            'gianhap.required'=>'Giá nhập không được bỏ trống',
           
            'idloai.required'=>'Chọn loại sản phẩm',
            'idThuongHieu.required'=>'Chọn thương hiệu',

        ]); 
       
       \DB::table(products)->insert($request);
 
       
    }
    
}
