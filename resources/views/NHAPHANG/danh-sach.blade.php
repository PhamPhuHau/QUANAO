@extends('ADMIN/index')
@section('content')
<form action="{{ route('SAN-PHAM.xl-nhap-hang') }}" method="post">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">NHẬP HÀNG</h6>
                
            </div>
            <div class="table-responsive">
                <h2>NHÀ CUNG CẤP</h2>
                <select style="width: 30%" name='nha_cung_cap'>

                    <option></option>
                    @foreach($nha_Cung_Cap as $Nha_Cung_Cap)
                    <option value='{{$Nha_Cung_Cap->id}}'>{{ $Nha_Cung_Cap->ten }}</option>
                    @endforeach
                </select>
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
                            <td style="width: 25%;"><input name="ten[]" type="text"></td>
                            <td style="width: 25%;"><input name="so_Luong[]" type="number" ></td>
                            <td style="width: 25%;"><input name="gia_Nhap[]" type="number" ></td>
                            <td style="width: 25%;"><input name="gia_Ban[]" type="number" ></td>
                            <td style="width: 25%;">
                                <select name="loai[]">
                                    <option></option>
                                    @foreach($loai as $Loai)
                                    <option value="{{ $Loai->id }}">{{ $Loai->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 25%;">
                                <select name="mau[]">
                                    <option></option>
                                    @foreach($mau as $Mau)
                                    <option value="{{ $Mau->id }}">{{ $Mau->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 25%;">
                                <select name="size[]">
                                    <option></option>
                                    @foreach($size as $Size)
                                    <option value="{{ $Size->id }}">{{ $Size->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 25%;"><textarea rows="4" cols="50" name="Thong_Tin[]"></textarea></td>
                            <td><button onclick="removeRow(this)">xoá</button></td></tbody>
                            
                            
                        </tr>
                        
                    </tbody>
                    
                    
                </table>
                
            </div>
            <td><a class="btn btn-sm btn-primary" style="margin: 15px 0 0 0;"onclick="add()"    >THÊM HÀNG</a></td>
            <td><button class="btn btn-sm btn-primary" style="margin: 15px 0 0 0;" type="submit">LƯU</button></td>
        </div>
                    
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
       function add() {
            $('table').append(
                '<tbody> <td style="width: 25%;"><input name="ten[]" type="text">' +
                '</td><td style="width: 25%;"><input name="so_Luong[]" type="number" ></td>'+
                '<td style="width: 25%;"><input name="gia_Nhap[]" type="number" ></td>'+
                '<td style="width: 25%;"><input name="gia_Ban[]" type="number" ></td>'+
                '<td style="width: 25%;"> <select name="loai[]"><option></option>@foreach($loai as $Loai)<option value="{{ $Loai->id }}">{{ $Loai->ten }}</option>@endforeach</select></td>'+
                '<td style="width: 25%;"> <select name="mau[]"><option></option>@foreach($mau as $Mau)<option value="{{ $Mau->id }}">{{ $Mau->ten }}</option>@endforeach</select></td>'+
                '<td style="width: 25%;"> <select name="size[]"><option></option>@foreach($size as $Size)<option value="{{ $Size->id }}">{{ $Size->ten }}</option>@endforeach</select></td>'+
                '<td style="width: 25%;"><textarea rows="4" cols="50" name="Thong_Tin[]"></textarea></td>'+
                '<td><button onclick="removeRow(this)">xoá</button></td></tbody>'
            );
        }

        function removeRow(button) {
            $(button).parent().parent().remove();
        }
    </script>

@endsection
@section('chon')
                    <a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>                  
                    <a href="{{ Route('SAN-PHAM.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('LOAI.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('MAU.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('SIZE.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('SAN-PHAM.nhap-hang') }}" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                    <a href="#" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
@endsection


@if(session('thong_bao'))
    <script>alert("{{ session('thong_bao') }}")</script>
@endif
