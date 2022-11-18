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
            <li class="active">Thêm Người Dùng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <div class="box box-primary">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-warning"></i> Thông Báo !</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm Thông Tin Người Dùng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Chọn quyền</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">--Chọn--</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Manager</option>
                                        <option value="3">Member</option>
                                        <option value="4">Khác</option>
                                    </select>
                                    @if($errors->has('role_id'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px"><i class="fa fa-info"></i>{{ $errors->first('role_id') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ và Tên</label>
                                    <input  type="text" class="form-control" id="name" name="name" placeholder="Nhập Họ và Tên">
                                    @if($errors->has('name'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px"><i class="fa fa-info"></i>{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input  type="email" class="form-control" id="email" name="email" placeholder="Nhập Email">
                                    @if($errors->has('email'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i class="fa fa-info"></i>{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật Khẩu</label>
                                    <input   type="password" class="form-control" id="password1" name="password1" placeholder="Nhập Mật Khẩu">
                                    @if($errors->has('password1'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i class="fa fa-info"></i>{{ $errors->first('password1') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật Khẩu</label>
                                    <input   type="password" class="form-control" id="password2" name="password2" placeholder="Xác Nhận Mật Khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Ảnh</label>
                                    <input type="file" id="avatar" name="avatar">
                                    @if($errors->has('avatar'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i class="fa fa-info"></i>{{ $errors->first('avatar') }}</label>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="is_active" id="is_active" type="checkbox" value="1"> Kích hoạt tài khoản
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
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
