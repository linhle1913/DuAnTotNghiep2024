<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    const VIEW_PATH = 'admin.student.';
    public function index(Request $request)
    {
        $title = 'Danh sách sinh viên';
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
    
        // Truy vấn dữ liệu với relationship 'class'
        $data = Student::with('class:id,name')  // Lấy thông tin lớp học kèm theo
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('tel', 'like', "%{$search}%")
                        ->orWhere('gender', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhereHas('class', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");  // Tìm kiếm theo tên lớp
                        });
                });
            })
            ->orderBy($sortBy, $sortOrder)  // Sắp xếp kết quả theo cột và thứ tự chỉ định
            ->paginate(5);
        return view(self::VIEW_PATH . __FUNCTION__, compact('data', 'search', 'sortBy', 'sortOrder', 'title'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm sinh viên mới';
        $dataClass = ClassModel::get();
        return view(self::VIEW_PATH . __FUNCTION__, compact('title', "dataClass"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->store('upload/student', 'public');
        } else {
            $fileName = null;
        }
        $data['image'] = $fileName;

        Student::create($data);

        return redirect()->route('admin.student.index')->with('success', 'Sinh viên đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Student::with('class:id,name')->findOrFail($id);
        $title = 'Thông tin sinh viên';
        return view(self::VIEW_PATH . __FUNCTION__, compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Student::query()->findOrFail($id);
        $title = 'Chỉnh sửa thông tin sinh viên';
        $dataClass = ClassModel::get();
        return view(self::VIEW_PATH . __FUNCTION__, compact('model', 'title', "dataClass"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $model = Student::findOrFail($id);
        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('upload/student', 'public');
        } else {
            $data['image'] = $model->image;
        }

        $oldImage = $model->image;
        $model->update($data);

        if ($oldImage && $oldImage != $data['image'] && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.student.index')->with('success', 'Thông tin sinh viên đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Student::query()->findOrFail($id);
        $currentImage = $model->image;

        $model->delete();

        if ($currentImage && Storage::disk('public')->exists($currentImage)) {
            Storage::disk('public')->delete($currentImage);
        }

        return redirect()->route('admin.student.index')->with('success', 'Sinh viên đã được xóa.');
    }
}
