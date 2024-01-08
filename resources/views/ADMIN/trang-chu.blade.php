@extends('ADMIN/index')
@section('content')

<div class="container-fluid pt-4 px-4 trangchu">
    <div class="navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        
        <div class="row">
            <div class="col-sm-4 doanhThuTren">
                <h3>Thành viên</h3>
                <h1>{{$khachHang->count()}}</h1>
            </div>
            <div class="col-sm-4 doanhThuTren">
                <h3>Sản phẩm</h3>
                <h1>{{ $demSanPham->count()}}</h1>
            </div>
            <div class="col-sm-4 doanhThuTren">
                <h3>Nhập hàng</h3>
                <h1>{{$nhapHang}} </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 doanhThuGiua">
                <h1>Đơn hàng</h1>
                <canvas id="SoDoDonHang" width="400" height="400" aria-label="Hello ARIA World" role="img"></canvas>
            </div>
            <div class="col-sm-6 doanhThuGiua">
                <h1>Doanh Thu 3 Tháng</h1>
                <canvas id="SoDoCot" width="400" height="400" aria-label="Column Chart" role="img"></canvas>
            </div>
        </div>
        
        <div class="doanhThuDuoi">
        <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="mb-0">Các sản phẩm mới</h1>
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

                                </tr>
                            </thead>
                            @foreach($sanPham as $SanPham)
                            <tbody>
                            <tr data-id="{{ $SanPham->id }}">
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->


                                    <td>
                                        @if($SanPham->hinh_anh->isNotEmpty())
                                        <?php $hinhAnhMinId = $SanPham->hinh_anh->min('id'); ?>
                                        <?php $hinhAnhMin = $SanPham->hinh_anh->where('id', $hinhAnhMinId)->first();?>
                                        <img src="{{ asset($hinhAnhMin->url) }}" width="100%" height="50px" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $SanPham->id }}</td>

                                    <!-- ... Các cột thông tin sản phẩm ... -->
                                    <td class="ten-san-pham">{{ $SanPham->ten }}</td>
                                    <!-- ... Các cột khác ... -->
                                    <td>{{ $SanPham->gia_nhap }}</td>
                                    <td>{{ $SanPham->gia_ban }}</td>
                                    <td>{{ $SanPham->so_luong }}</td>


                                    <td><a class="btn btn-outline-dark" href="{{ route('san-pham.chi-tiet-san-pham',['id'=>$SanPham->id]) }}">Chi tiết</a>
                                    <a class="btn btn-outline-primary" onclick="them({{ $SanPham->id }}, '{{ $SanPham->ten }}')">Cập nhật</a>
                                    <a class="btn btn-outline-danger" href="{{ route('san-pham.xoa',['id'=>$SanPham->id]) }}">Xóa</a>

                                    </td>

                                </tr>

                            </tbody>
                            @endforeach

                        </table>
                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div class="col-sm-2">
                            <div class="phantrang">

                        </div>
                            </div>

                        </div>



                    </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    // Biểu đồ tròn
    let ChoXacNhan = 0;
    let DaXacNhan = 0;
    let DangVanChuyen = 0;
    let DaNhanHang = 0;
    let DaHuy = 0;

    // Biểu đồ cột
    let ThangNay = 0;
    let ThangTruoc = 0;
    let HaiThangTruoc = 0;

    @foreach($HoaDon as $HoaDon)
        @switch($HoaDon->trang_thai)
            @case(1)
                ChoXacNhan++;
                @break;
            @case(2)
                DaXacNhan++;
                @break;
            @case(3)
                DangVanChuyen++;
                @break;
            @case(4)
                DaNhanHang++;
                @break;
            @case(0)
                DaHuy++;
                @break;
            @default
                // Default case
        @endswitch

        @if($HoaDon->created_at->month == $thangHienTai)
            ThangNay += {{ $HoaDon->tong_tien }};
        @endif

        @if($HoaDon->created_at->month == $thangTruoc)
            ThangTruoc += {{ $HoaDon->tong_tien }};
        @endif

        @if($HoaDon->created_at->month == $haiThangTruoc)
            HaiThangTruoc += {{ $HoaDon->tong_tien }};
        @endif
    @endforeach

    //-------------------------SƠ ĐỒ TRÒN---------------------------
    let labelsPolar = ['Chờ xác nhận','đã xác nhận', 'Đang vận chuyển' , 'Đã nhận hàng', 'Đã huỷ'];
    let itemDataPolar = [ChoXacNhan , DaXacNhan, DangVanChuyen, DaNhanHang,DaHuy];

    const dataPolar = {
        labels: labelsPolar,
        datasets: [{
            label: 'bản dử liệu',
            data: itemDataPolar,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(54, 162, 235)',  // Thêm màu mới
                'rgb(255, 159, 64)'
            ]
        }]
    };

    const configPolar = {
        type: 'polarArea',
        data: dataPolar,
        options: {
            responsive: false, // Ngăn chặn biểu đồ tự động thay đổi kích thước
            maintainAspectRatio: false, // Bảo toàn tỷ lệ khía cạnh
            width: 400, // Kích thước chiều rộng
            height: 400 // Kích thước chiều cao
        }
    };

    const chartPolar = new Chart(
        document.getElementById('SoDoDonHang'),
        configPolar
    );


    //----------------------------SƠ ĐỒ CỘT----------------------------------
    let labelsBar = ['Hai tháng trước', 'Tháng trước', 'Tháng này'];
    let itemDataBar = [HaiThangTruoc, ThangTruoc, ThangNay];

    const dataBar = {
        labels: labelsBar,
        datasets: [{
            label: 'Doanh thu thang',
            data: itemDataBar,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
            ]
        }]
    };

    const configBar = {
        type: 'bar',
        data: dataBar,
        options: {
            responsive: false,
            maintainAspectRatio: false,
            width: 400,
            height: 400
        }
    };

    const chartBar = new Chart(
        document.getElementById('SoDoCot'),
        configBar
    );
</script>

@endsection

@section('chon')
                    <a href="/" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>



                    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
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
                    </div>
                    <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
					<a href="{{ Route('don-hang.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-cloud me-2"></i>ĐƠN HÀNG</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>


@endsection
