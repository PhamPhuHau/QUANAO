@extends('ADMIN/index')
@section('content')

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

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
                                    <th scope="col">TÊN</th>
                                    <th scope="col">LOẠI</th>
                                    <th scope="col">MÀU</th>
                                    <th scope="col">SIZE</th>
                                    
                                </tr>
                            </thead>
                           @foreach($CT_San_Pham as $chi_tiet_san_pham)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                   <td>
                                        {{ $chi_tiet_san_pham->id }}
                                    </td>
                                    <td>
                                        {{$chi_tiet_san_pham->san_pham->ten}}
                                    </td>
                                    <td>
                                        {{ $chi_tiet_san_pham->Loai->ten }}
                                    </td>
                                    <td>
                                        {{ $chi_tiet_san_pham->Mau->ten }}
                                    </td>
                                    <td>
                                        {{ $chi_tiet_san_pham->Size->ten }}
                                    </td>

<<<<<<< Updated upstream
                                    
                                    
                                  
                                    <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
=======



                                    <td><a class="btn btn-outline-primary" href="">Cập nhật</a></td>
>>>>>>> Stashed changes
                                </tr>
                                
                            </tbody>
                           

                            @endforeach
                        </table>

                        @foreach($HinhAnh as $item)
                                <img src="{{ asset($item->url) }}"  class="AnhSP"/>
                                
                            @endforeach



                            <form method="POST"  enctype="multipart/form-data" action="">
                                @csrf
<<<<<<< Updated upstream
                                <input type="file" name="HinhAnh[]" multiple require="true"><br>
                                <button type="submit">LƯU</button>
=======

                                <td >

                                <input class="form-control" type="file" name="HinhAnh[]" multiple required="true"  ><br>
                                </td>

                                </td>

                                <td>
                                    <button type="submit" class="btn btn-outline-success" >LƯU</button>
                                </td>

>>>>>>> Stashed changes
                            </form>

                    </div>
                </div>
</div>

@endsection
@section('chon')
    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ Route('SAN-PHAM.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
    <a href="{{ Route('LOAI.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
    <a href="{{ Route('MAU.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
    <a href="{{ Route('SIZE.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ Route('SAN-PHAM.nhap-hang') }}" class="dropdown-item">MỚI</a>
                            <a href="{{ Route('SAN-PHAM.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
                            
                        </div>
                    </div>    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection