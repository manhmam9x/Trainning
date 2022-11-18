@extends('layouts.main')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Welcome to Manh Mam</h3>
                    </div>

                    @if ($errors->all())
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Thất Bại !</h4>
                               Tài Khoản Của Bạn Chưa Được Kích Hoạt Để Sử Dụng Dịch Vụ Này.
                            </div>
                        </div>
                    @else()
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Thông Báo!</h4>
                            Đăng Nhập Thành Công. Chào mừng bạn đến với Manh Mam
                        </div>
                    @endif
                    <!-- /.box-header -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection
