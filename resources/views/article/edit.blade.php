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
            <li class="active">Cập Nhật Bài Viết</li>
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
                        <h3 class="box-title">Cập Nhật Thông Tin Bài Viết</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action=" {{ route('admin.article.update',['article' => $articles->id])}} "
                          method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu Đề</label>
                                    <input value="{{ $articles->title }}" type="text" class="form-control" id="title"
                                           name="title" placeholder="Nhập tiêu đề">
                                    @if($errors->has('title'))
                                        <label class="text-red" style="font-weight: 600; font-size: 15px">&ensp;<i
                                                class="fa fa-info"></i>{{ $errors->first('title') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Tác Giả</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="">Chưa Xác Định</option>
                                        @foreach($users as $item)
                                            <option
                                                {{ $articles->user_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sơ Lược</label>
                                    <textarea class="form-control" rows="5" id="summary" name="summary"
                                              placeholder="">{{ $articles->summary }}</textarea>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input {{ $articles->is_active == 1 ? 'checked' : '' }} value="1"
                                               name="is_active" id="is_active" type="checkbox"> Hiển thị
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile" style="color: #0b97c4">Chọn Ảnh Mới</label>
                                    <input type="file" id="image" name="image">
                                    <img src="{{ asset($articles->image) }}"
                                         style="width: 350px; height: 250px; margin-top: 10px">
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nội Dung</label>
                                    <textarea class="form-control" rows="10" id="description" name="description"
                                              placeholder="Nhập Mô tả">{{ $articles->description }}</textarea>
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

@section('js_ckeditor')
    <script type="text/javascript">
        var _ckeditor = CKEDITOR.replace('description');
        _ckeditor.config.height = 500;

    </script>
@endsection
