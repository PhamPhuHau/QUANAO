@extends('ADMIN/index')
@section('content')
<form method="POST" action="{{route('loai.xl-cap-nhat',['id'=>$loai->id])}}">
		@csrf
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div  class="card">
				<div class="card-header border-bottom">
					<h4 class="mb-0">Cập nhật</h4>
				</div>
				<div class="card-body p-0 create-project-main">
					<div class="row p-5 border-bottom">
						<div class="col-sm-12 col-md-12 col-xl-3">
							<div class="form-group">
								<label for="color-name" class="form-label text-muted">Tên loại:</label>
								<div class="input-group">
									<input id="color-name" name="ten" type="text" class="form-control text-dark" placeholder="Nhập tên màu" value="{{$loai->ten}}">

								</div>
							</div>
						</div>




					<div class="row p-5">
						<div class="btn-list text-end">
							<a class="btn btn-outline-danger"href ="{{route('loai.danh-sach')}}">

								Cancel
</a>
							<button class="btn btn-outline-success">
								<i class="fe fe-check-circle"></i>
								Save
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
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
                            
                        </div>
                    </div>    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection
