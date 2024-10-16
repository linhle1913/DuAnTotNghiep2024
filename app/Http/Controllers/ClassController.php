<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    const VIEW_PATH = 'admin.class.';

    public function index(Request $request)
    {
        $title = 'Danh sách lớp học';
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'id');  // Mặc định là sắp xếp theo 'id'
        $sortOrder = $request->input('sort_order', 'asc');  // Mặc định là 'asc' (tăng dần)

        // Truy vấn dữ liệu với tìm kiếm và sắp xếp sau khi tìm kiếm
        $data = ClassModel::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy($sortBy, $sortOrder)  // Sắp xếp kết quả đã tìm kiếm theo cột và thứ tự
            ->paginate(5);

        return view(self::VIEW_PATH . __FUNCTION__, compact('data', 'search', 'sortBy', 'sortOrder', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm lớp mới';
        return view(self::VIEW_PATH . __FUNCTION__, compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        $data = $request->except('_token');

        // Kiểm tra lớp học đã tồn tại chưa
        $checkClass = ClassModel::where("name", $data["name"])->first();

        if ($checkClass) {
            // Nếu trùng tên, redirect về trang tạo và gửi thông báo lỗi
            return redirect()->route('admin.class.create')->with('error', 'Tên lớp đã tồn tại.');
        }

        // Nếu không trùng, lưu dữ liệu
        ClassModel::create($data);

        return redirect()->route('admin.class.index')->with('success', 'Lớp đã được thêm thành công.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = ClassModel::query()->findOrFail($id);
        $title = 'Thông tin lớp';
        return view(self::VIEW_PATH . __FUNCTION__, compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = ClassModel::query()->findOrFail($id);
        $title = 'Chỉnh sửa thông tin lớp';
        return view(self::VIEW_PATH . __FUNCTION__, compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, string $id)
    {
        $model = ClassModel::findOrFail($id);
        $data = $request->except('_token');

        // Kiểm tra lớp học đã tồn tại chưa
        $checkClass = ClassModel::where("name", $data["name"])->where("id", "!=", $id)->first();

        if ($checkClass) {
            // Nếu trùng tên, redirect về trang tạo và gửi thông báo lỗi
            return redirect()->route('admin.class.create')->with('error', 'Tên lớp đã tồn tại.');
        }
        $model->update($data);

        return redirect()->route('admin.class.index')->with('success', 'Thông tin lớp đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class = ClassModel::find($id); // Tìm lớp theo ID

        // Kiểm tra xem lớp có sinh viên nào không
        if ($class->students()->count() > 0) {
            return redirect()->back()->with('error', 'Không thể xóa lớp ' . $class->name . ' vì vẫn còn sinh viên thuộc lớp này.');
        }

        // Nếu không có sinh viên nào, tiến hành xóa
        $class->delete();

        return redirect()->route('admin.class.index')->with('success', 'Xóa lớp ' . $class->name . ' thành công.');
    }
}
