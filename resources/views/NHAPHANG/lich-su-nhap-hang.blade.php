@extends('ADMIN/index')
@section('content')

<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">ID</th>
                                    <th scope="col">TỔNG TIỀN</th>
                                    <th scope="col">NHÀ CUNG CẤP</th>
                                    <th scope="col">NGÀY NHẬP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($nhap_Hang as $nhap_hang)
                            <tbody>
                                <td style="width: 25%;">{{ $nhap_hang->id }}</td>
                                <td style="width: 25%;">{{ $nhap_hang->tong_tien }}</td>
                                <td style="width: 25%;">{{ $nhap_hang->nha_cung_cap->ten }}</td>
                                <td style="width: 25%;">{{ $nhap_hang->created_at }}</td>
                                <td><a class="btn btn-sm btn-primary" href="{{ route('san-pham.lich-su-chi-tiet-nhap-hang',['id'=>$nhap_hang->id]) }}">Detail</a></td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    {{ $nhap_Hang->links() }}
                </div>
</div>

@endsection
@section('chon')
    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
                            <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
                            <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LUỌNG</a>
                        </div>
                        <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>

@endsection