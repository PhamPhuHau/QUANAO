@extends('ADMIN/index')
@section('content')
<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="{{ route('LOAI.them') }}" type="button" class="btn btn-sm btn-outline-secondary">Thêm mới</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    
                                </tr>
                            </thead>
                            @foreach($loai as $Loai)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td style="width: 25%;">{{ $Loai->id }}</td>
                                    
                                    <td>{{ $Loai->ten }}</td>
                                    
                                    <td><a class="btn btn-outline-primary" href="{{ route('LOAI.cap-nhat', ['id'=>$Loai->id]) }}">Cập nhật</a>
                                    <a class="btn btn-outline-danger" href="{{ route('LOAI.xoa', ['id'=>$Loai->id]) }}">Xóa</a></td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
</div>

@endsection
@section('chon')
    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ Route('SAN-PHAM.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
    <a href="{{ Route('LOAI.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
    <a href="{{ Route('MAU.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
    <a href="{{ Route('SIZE.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
    <a href="{{ Route('SAN-PHAM.nhap-hang') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection