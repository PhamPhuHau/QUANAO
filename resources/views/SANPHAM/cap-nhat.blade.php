@extends('ADMIN/index')
@section('content')


<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">CẬP NHẬT SẢN PHẨM</h6>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">HÌNH</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    <th scope="col">GIÁ NHẬP</th>
                                    <th scope="col">GIÁ BÁN</th>
                                    <th scope="col">SỐ LƯỢNG</th>
                                    <th scope="col">TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td><img src="bootstrap-admin-template-free.jpg" width="auto" height="50px" alt=""></td>
                                    <td style="width: 25%;"><input type="text"></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    
                                    
                                    
                                </tr>
                                
                            </tbody>
                            
                        </table>
                        
                    </div>
                    <td><a class="btn btn-sm btn-primary" style="margin: 15px 0 0 0;" href="#">CẬP NHẬT</a></td>
                </div>
</div>

@endsection
@section('chon')
                    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    
                    
                    <a href="{{ Route('SAN-PHAM.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('LOAI.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('MAU.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('SIZE.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>

                    <a href="{{ Route('SAN-PHAM.nhap-hang') }}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection