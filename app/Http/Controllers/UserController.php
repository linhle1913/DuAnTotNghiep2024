<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Metadata\Uses;

class UserController extends Controller
{
    const VIEW_PATH = "admin.user.";
    public function index()
    {
        $title = "Danh sách tài khoản";
        // Lấy từ khóa tìm kiếm, cột sắp xếp và thứ tự sắp xếp từ request
        $search = request()->get('search', '');
        $sortBy = request()->get('sort_by', 'id');  // Mặc định sắp xếp theo 'id'
        $sortOrder = request()->get('sort_order', 'asc');  // Mặc định thứ tự sắp xếp 'asc'

        // Truy vấn danh sách sinh viên với chức năng tìm kiếm
        $data = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(5);  // Điều chỉnh số lượng trang tùy theo nhu cầu

        // Truyền biến search, sortBy, và sortOrder vào view để giữ trạng thái
        return view(self::VIEW_PATH . __FUNCTION__, compact('data', 'search', 'sortBy', 'sortOrder', 'title'));
    }
}
