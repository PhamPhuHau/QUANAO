@extends('ADMIN/index')
@section('content')

<!-- đây là danh sách khách hàng -->
<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">TÀI KHOẢN KHÁCH HÀNG</h6>
                        <div class="hien-danh-dach">
                       <a type="button" href="{{ route('tai-khoan.danh-sach-khoa') }}">danh sách khoá</a>
</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th>AVATAR</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    <th>EMAIL</th>
                                    <th>SỐ ĐIỆN THOẠI</th>
                                    <th>ĐỊA CHỈ</th>
                                </tr>
                            </thead>
                            @foreach($khachHang as $KhachHang)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td></td>
                                    <td>{{ $KhachHang->id }}</td>
                                    
                                    <td>{{ $KhachHang->ho_ten }}</td>
                                    <td>{{ $KhachHang->email }}</td>    
                                    <td>{{ $KhachHang->so_dien_thoai }}</td>
                                    <td>{{ $KhachHang->dia_chi }}</td>
                                    
                                    <td><a class="btn btn-outline-danger" href="{{ route('tai-khoan.khoa',['id'=>$KhachHang->id]) }}">Khoá</a></td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div class="col-sm-2">
                            <div class="phantrang">
                        {{ $khachHang->links() }}
                        </div>
                            </div>

                        </div>
                    </div>
                </div>
</div>


<!-- đây là danh sách quản lý -->



<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">TÀI KHOẢN QUẢN LÝ</h6>
                        <div class="hien-danh-dach">
                        <a href="{{ route('tai-khoan.them') }}" type="button" class="btn btn-sm btn-outline-secondary">Thêm mới</a>
</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                   
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN ĐĂNG NHẬP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($quanLy as $QuanLy)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                   
                                    <td>{{ $QuanLy->id }}</td>
                                    <td>{{ $QuanLy->ten_dang_nhap }}</td>
                                   
                                    
                                    <td><a class="btn btn-outline-primary" href="{{ route('tai-khoan.cap-nhat',['id'=>$QuanLy->id]) }}">Cập nhật mật khẩu</a>
                                        <a class="btn btn-outline-danger" href="{{ route('tai-khoan.xoa',['id'=>$QuanLy->id]) }}">xoá</a></td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div class="col-sm-2">
                            <div class="phantrang">
                        {{ $quanLy->links() }}
                        </div>
                            </div>

                        </div>
                    </div>
                </div>
</div>
@endsection
@section('chon')
    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
                            <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
                            <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LUỌNG</a>
                        </div>
                        <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
					<a href="{{ Route('don-hang.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-cloud me-2"></i>ĐƠN HÀNG</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
@endsection

