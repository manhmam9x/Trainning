@extends('layouts.main')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Quản Lý Bài Viết
            <a href="{{ route('admin.article.index') }}" class="btn btn-outline-success">
                <i class="fa fa-list-alt" style="margin-right: 5px"></i>Danh sách
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
            <li><a href="#">QL Bài Viết</a></li>
            <li class="active">Thêm Bài Viết</li>
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
                        <h3 class="box-title">Thêm Thông Tin Bài Viết</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action=" {{ route('admin.article.store')}} " method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu Đề</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Nhập tiêu đề">
                                    @if($errors->has('title'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i
                                                class="fa fa-info"></i>{{ $errors->first('title') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Tác giả</label>
                                    <select class="form-control" id="user_id" name="user_id" style="width: 250px">
                                        @foreach($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Hình Ảnh</label>
                                    <input type="file" id="image" name="image">
                                    @if($errors->has('image'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i
                                                class="fa fa-info"></i>{{ $errors->first('image') }}</label>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input value="1" name="is_active" id="is_active" type="checkbox"> Hiển thị
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Sơ Lược</label>
                                    <textarea class="form-control" rows="5" id="summary" name="summary" placeholder="Nhập nội dung"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nội Dung</label>
                                    <textarea class="form-control" rows="10" id="description" name="description" placeholder="Nhập nội dung"></textarea>
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

