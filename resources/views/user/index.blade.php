@extends('layouts.main')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Quản Lý Người Dùng
            <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success">
                <i class="fa fa-plus-circle" style="margin-right: 5px"></i>Thêm
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
            <li><a href="#">QL Người dùng</a></li>
            <li class="active">Danh Sách Người dùng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh Sách Người Dùng</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Họ và Tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Cấp</th>
                                <th>Cập Nhật Cuối</th>
                                <th style="width: 180px; text-align: center">Chức Năng</th>
                            </tr>
                            @foreach($users as $key => $item)
                                <tr class="item-{{ $item->id }}">
                                    <td> {{ $key + 1 }} </td>
                                    <td>
                                        @if ($item->avatar)
                                            <img src="{{ asset($item->avatar) }}" style="width: 110px; height: 60px" />
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if($item->role_id == 1)
                                            Admin
                                        @elseif ($item->role_id == 2)
                                            Manager
                                        @elseif($item->role_id == 3)
                                            Member
                                        @elseif ($item->role_id == 4)
                                            Khác
                                        @else
                                            Chưa cấp quyền
                                        @endif
                                    </td>
                                    <td>{{ $item->is_active == 1 ? 'Kích hoạt' : 'Chưa Kích Hoạt'}}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
                                    <td>
                                        <a href="" class="btn btn-info" style="width: 50px">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.user.edit', ['user' => $item->id]) }}" class="btn btn-success" style="width: 50px">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a data-id="{{ $item->id }}" class="btn btn-primary btn-delete" style="width: 50px">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="box-header">
                            <div class="box-tools"; style=" margin-right: 5px">
                                <div style="margin-top: -21px">{{ $users->links() }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

@section('js_delete')
    <script type="text/javascript">
        $(document).ready(function(){
            // Thiết lập csrf chống giả mạo
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-delete').on('click',function () {

                let id = $(this).data('id');

                let result = confirm("Bạn có chắc chắn muốn xóa ?");

                if(result){ // nếu nhấn == oke , sẽ send request ajax
                    $.ajax({
                        url: '/admin/user/'+id,
                        type: 'DELETE',
                        data: {
                            // dữ liệu truyền sang nếu có
                             name: 'dung'
                        },

                        dataType:"json",
                        success: function (res) {
                            // PHP : user->name
                            // JS : res.name

                            if(res.success != 'underfined' && res.success == 1){ // xóa thành công
                                $('.item-' +id).remove();
                            }
                        },
                        error: function (e) { // lỗi nếu có
                            console.log(e);
                        }
                    });
                }
            });
        });
    </script>
@endsection
