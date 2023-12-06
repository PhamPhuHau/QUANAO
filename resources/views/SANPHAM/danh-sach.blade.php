@extends('ADMIN/index')
@section('content')


<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Danh sách</h6>
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
                            @foreach($san_Pham as $SanPham)
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
                                    <td>{{ $SanPham->trang_thai}}</td>

                                    <td><a class="btn btn-outline-dark" href="{{ route('san-pham.chi-tiet-san-pham',['id'=>$SanPham->id]) }}">Chi tiết</a>
                                    <button class="btn btn-outline-primary" onclick="them({{ $SanPham->id }}, '{{ $SanPham->ten }}')">Cập nhật</button>
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
                        {{ $san_Pham->links() }}
                        </div>
                            </div>

                        </div>
                        
                      
                      
                    </div>
                  
                </div>
</div>

<div id="sua"></div>
@endsection
@section('js')
    <script>
        function them(id,ten){
            $('#sua').html(` 
            <div class="col-xl-3 from-cap-nhat">
                <h4>SỬA SẢN PHẨM</h4>
                <h6>ID: `+id+`</h6>
                <div style="display: flex; align-items: center;">
                    <lable for="ten">tên:</lable> 
                    <input  name="ten" id="inputTen" type="text" class="form-control text-dark" value="`+ten+`" placeholder="Nhập tên sản phẩm" > 
                </div> 
                <button onclick="XuLySua(${id},document.getElementById('inputTen').value)"> thuc hien </button> 
            </div>`);                  
       }

       function XuLySua(id, ten) {
            $.ajax({
                method: "POST",
                url: "{{ route('san-pham.sua') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "ten": ten
                },
                success: function(response) {
                    if (response.success) {
                        alert('Sửa thành công');

                        // Cập nhật nội dung trang mà không cần tải lại trang
                        // Ví dụ: nếu có thông tin cập nhật từ server, bạn có thể sử dụng nó để cập nhật nội dung

                        // Tìm thẻ tr chứa thông tin sản phẩm cần cập nhật
                        var trElement = $("tr[data-id='" + id + "']");
                        
                        // Cập nhật các ô thông tin sản phẩm
                        trElement.find('.ten-san-pham').text(ten);

                    } else {
                        alert('Sửa thất bại: ' + response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert(error.responseJSON.message);
                }
    });
}

    </script>
@endsection
@section('chon')
    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
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
                        <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
					<a href="{{ Route('don-hang.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-cloud me-2"></i>ĐƠN HÀNG</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
@endsection
