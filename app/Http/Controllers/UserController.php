<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->paginate(15); // phân trang

        return view('user.index', [
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:100',
            'name' => 'required|max:255',
            'password1' => 'required|min:6',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',

        ],[
            'email.required' => 'Bạn cần nhập email',
            'email.unique' => 'Email này đã tồn tại tài khoản',
            'name.required' => 'Bạn cần nhập tên',
            'password1.required' => 'Bạn cần nhập mật khẩu',
            'password1.min' => 'Mật khẩu phải tối thiểu 6 kí tự',
            'avatar.image' => 'File ảnh phải có định dạng jpeg,png,jpg,gif,svg',
        ]);

        // Kiểm tra mật khẩu có trùng khớp k
        $pwd1 = $request->input('password1');
        $pwd2 = $request->input('password2');

        if ($pwd1 == $pwd2) {
            $password = $pwd1;
        } else {
            return Redirect::back()->withErrors(['msg' => 'Mật khẩu không trùng khớp']);
        }

        // Kiểm tra hàm có trống hay k
        $is_active = 0; //default
        if ($request->has('is_active')){
            $is_active = $request->input('is_active');
        }

        // Kiểm tra có ảnh hay k
        $avatar = '';
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $path_upload = 'upload/user/';
            $request->file('avatar')->move($path_upload, $filename);
            $avatar = $path_upload.$filename;
        }

        $user = new User();
        $user->role_id = $request->input('role_id');
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = bcrypt($password);
        $user->is_active = $is_active;
        $user->avatar = $avatar;
        $user->save();

        //Gửi mail xác nhận
        Mail::send('mail.create', compact('user'), function ($email) use ($user){
            $email->subject('Đăng Ký Thành Công');
            $email->to($user->email, $user->name);
        });

        return redirect()->route('admin.user.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit',[
            'users' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'name' => 'required|max:255',
            'password1' => 'min:6',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',

        ],[
            'email.required' => 'Bạn cần nhập email',
            'name.required' => 'Bạn cần nhập tên',
            'password1.min' => 'Mật khẩu phải tối thiểu 6 kí tự',
            'avatar.image' => 'File ảnh phải có định dạng jpeg,png,jpg,gif,svg',
        ]);

        $role_id = $request->input('role_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        //kiem tra hàm có trống hay k
        $is_active = 0; //default
        if ($request->has('is_active')){
            $is_active = $request->input('is_active');
        }

        $user = User::find($id);
        $user->role_id = $role_id;
        $user->name = $name;
        $user->email = $email;
        $user->is_active = $is_active;


        $user->save(); // lưu vào cơ sở dữ liệu



        // Kiểm tra mật khẩu có trùng khớp k
        $pwd1 = $request->input('password1');
        $pwd2 = $request->input('password2');

        if ($pwd1 == $pwd2) {
            $password = $pwd1;
        } else {
            return Redirect::back()->withErrors(['msg' => 'Mật khẩu không trùng khớp']);
        }

        // Kiểm tra hàm có trống hay k
        $is_active = 0; //default
        if ($request->has('is_active')){
            $is_active = $request->input('is_active');
        }

        $user = User::find($id);
        $user->role_id = $request->input('role_id');
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->is_active = $is_active;

        // Kiểm tra mật khẩu có được thay đổi k
        if(!empty($password)){
            $user->password = bcrypt($password);
        }

        // Kiểm tra ảnh có được thay đổi k
        if($request->hasFile('avatar')){
            //get file
            $file = $request->file('avatar');
            // get name
            $filename = $file->getClientOriginalName(); //lấy tên gốc của ảnh
            // đường dần upload
            $path_upload = 'upload/user/';
            // upload file
            $request->file('avatar')->move($path_upload, $filename);
            //gán dữ liệu ảnh theo đường dẫn và tên
            $avatar = $path_upload.$filename;
            $user->avatar = $avatar;
        }

        $user->save();

        //Gửi mail xác nhận
        Mail::send('mail.update', compact('user'), function ($email) use ($user){
            $email->subject('Cập Nhật Thành Công');
            $email->to($user->email, $user->name);
        });

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $is_Delete = User::destroy($id); // true or fail

        if($is_Delete){
            return response()->json(['success' => 1, 'message' => 'Thành công']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Thất bại']);
        }
    }
}
