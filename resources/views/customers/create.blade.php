@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-2">
            <a class="btn btn-secondary" href="{{ route('customers.index') }}"><=Quay lại</a>
        </div>  
        <div class="col-8">
            <h1 align="center">Thêm thông tin khách hàng</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table border="1" style="width:100%">
                        <tr>
                            <th>Tên:</th>
                            <td>
                                <input type="text" name="name">
                            </td>
                        </tr>
                        <tr>
                            <th> Ảnh:</th>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <th>Giới tính:</th>
                            <td>
                                <input type="radio" name="gender" value="1" checked>Nam
                                <input type="radio" name="gender" value="0">Nữ</th>
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>
                                <input type="text" name="email">
                            </td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td>
                                <input type="text" name="phone">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button class="btn btn-primary">Thêm thông tin</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>
@endsection

    
    