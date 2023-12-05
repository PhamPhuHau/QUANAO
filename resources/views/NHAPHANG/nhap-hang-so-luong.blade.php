@extends('ADMIN/index')
@section('content')
<form action="{{ route('san-pham.xu-ly-them-so-luong') }}" method="post">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">NHẬP HÀNG SỐ LƯỢNG</h6>

            </div>
            <div class="table-responsive">
                
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                            <th scope="col">TÊN</th>
                            <th scope="col">SỐ LƯỢNG</th>
                            <th scope="col">GIÁ NHẬP</th>
                            <th scope="col">GIÁ BÁN </th>
                            <th scope="col">LOẠI</th>
                            <th scope="col">MÀU</th>
                            <th scope="col">SIZE</th>
                            <th scope="col">THÔNG TIN</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                            <td style="width: 25%;" ><select name="san_Pham" id="tenSanPham" onchange="thongTinLoai(this.value)">
                                <option></option>
                                @foreach($danhSachSanPham as $sanPham)
                                    <option value="{{ $sanPham->id  }}">{{ $sanPham->ten }}</option>
                                @endforeach
                            </select></td>
                            <td style="width: 25%;"><input name="so_Luong" type="number" ></td>
                            <td style="width: 25%;"><input name="gia_Nhap" type="number" ></td>
                            <td style="width: 25%;"><input name="gia_Ban" type="number" ></td>
                            <td style="width: 25%;">
                                <select id="loaiSanPham" name="loai" class="loai" onchange="thongTinMau(document.getElementById('tenSanPham').value,this.value)">
                                    
                                   
                                </select>
                            </td>
                            <td style="width: 25%;">
                            <select class="mau" name="mau" onchange="thongTinSize(document.getElementById('tenSanPham').value, this.value)">
                                   
                                    
                                </select>
                            </td>
                            <td style="width: 25%;">
                                <select class="size" name="size">
                                    
                                   
                                </select>
                            </td>
                            <td style="width: 25%;"><textarea rows="4" cols="50" name="thong_Tin"></textarea></td>


                        </tr>

                    </tbody>


                </table>
            <div class="thongtin"></div>
            </div>
            <td><a class="btn btn-outline-primary" style="margin: 15px 0 0 0;"    >THÊM HÀNG</a></td>
            <td><button class="btn btn-outline-success" style="margin: 15px 0 0 0;" type="submit">LƯU</button></td>
        </div>

    </div>
</form>

    <script>
        function thongTinLoai(id) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-loai') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
            },
        }).done(function(response) {
            $('.loai').html('<option></option>');
            console.log(response);
            if (response.success && response.data.length > 0) {              
                response.data.forEach(function(item) {
                    $('.loai').append(`<option value="${item.loai.id}">${item.loai.ten}</option>`);
                });
            } else {
                console.log("Không có thông tin về loại");
            }
        });
    }




    function thongTinMau(sanPham,loai) {
        
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-mau') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "sanPham": sanPham,
                "loai": loai
            },
        }).done(function(response) {
            $('.mau').html('<option></option>');
           
            if (response.success && response.data.length > 0) {              
                response.data.forEach(function(item) {
                    $('.mau').append(`<option value="${item.mau.id}">${item.mau.ten}</option>`);
                });
            } else {
                console.log("Không có thông tin về loại");
            }
        });
    }


    function thongTinSize(sanPham, mau) {
      
    $.ajax({
        method: "GET",
        url: "{{ route('san-pham.lay-thong-tin-san-pham-size') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "sanPham": sanPham,
            "mau": mau
        },
    }).done(function(response) {
        console.log(response);
        // Xóa nội dung trong phần tử có class "size"
        $('.size').html('');
        console.log("asjd");
        if (response.success && response.data.length > 0) {
            // Lặp qua mảng JSON
            response.data.forEach(function(item) {
                // Thêm option vào select với class "size"
                $('.size').append(`<option value="${item.size.id}">${item.size.ten}</option>`);
            });
        } else {
            console.log("Không có thông tin về size");
        }
    });
}

</script>


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
                    </div>                    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection


@if(session('thong_bao'))
    <script>alert("{{ session('thong_bao') }}")</script>
@endif
