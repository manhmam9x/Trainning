@extends('layouts.main')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Quản Lý Người Dùng
            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-success">
                <i class="fa fa-list-alt" style="margin-right: 5px"></i>Danh sách
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
            <li><a href="#">QL Người Dùng</a></li>
            <li class="active">Cập nhật Người Dùng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật Thông Tin Người Dùng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.user.update', ['user' => $users->id]) }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Chọn quyền</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">--Chọn--</option>
                                        <option value="1" {{ ($users->role_id == 1) ? 'selected' : '' }} >Admin</option>
                                        <option value="2" {{ ($users->role_id == 2) ? 'selected' : '' }} >Manager</option>
                                        <option value="3" {{ ($users->role_id == 3) ? 'selected' : '' }} >Member</option>
                                        <option value="4" {{ ($users->role_id == 4) ? 'selected' : '' }} >Khác</option>
                                    </select>
                                    @if($errors->has('role_id'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px"><i class="fa fa-info"></i>{{ $errors->first('role_id') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và Tên</label>
                                    <input value="{{ $users->name }}" type="text" class="form-control" id="name" name="name" placeholder="Nhập Họ và Tên">
                                    @if($errors->has('name'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px"><i class="fa fa-info"></i>{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input value="{{ $users->email }}" type="email" class="form-control" id="email" name="email" placeholder="Nhập Email">
                                    @if($errors->has('email'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i class="fa fa-info"></i>{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" style="color: red">Mật Khẩu Mới *</label>
                                    <input   type="password" class="form-control" id="password" name="password" placeholder="Nhập Mật Khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" style="color: red">Xác Nhận Mật Khẩu Mới *</label>
                                    <input   type="password" class="form-control" id="password" name="password" placeholder="Nhập Mật Khẩu">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input {{ ($users->is_active == 1) ? 'checked' : '' }} name="is_active" id="is_active" type="checkbox" value="1"> Kích hoạt tài khoản
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile" style="color: #0b97c4">Chọn Ảnh Mới</label>
                                    <input type="file" id="avatar" name="avatar">
                                    <img src="{{ asset($users->avatar) }}" style="width: 380px; height: 300px; margin-top: 10px">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
@endsection
