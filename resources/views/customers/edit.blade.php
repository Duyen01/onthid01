@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-2">
            <a class="btn btn-secondary" href="{{ route('customers.index') }}"><=Quay lại</a>
        </div>
        <div class="col-8">
            <h1 align="center">Thêm thông tin khách hàng</h1>
            <div>
                <form action="{{ route('customers.update', $customer->id) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <table border="1" style="width:100%">
                        <tr>
                            <th>Tên:</th>
                            <td>
                                <input type="text" name="name" value="{{ $customer->name }}">
                            </td>
                        </tr>
                        <tr>
                            <th> Ảnh:</th>
                            <td>
                                <img src="{{ asset('images/' . $customer->image_path) }}"
                                class="img-thumbnail" width="300">
                                <input type="file" name="image">
                                <input type="hidden" name="hidden_image" value="{{ $customer->image_path }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Giới tính:</th>
                            <td>
                                <input type="radio" name="gender" value="1" @if ($customer->gender==1) checked @endif>Nam
                                <input type="radio" name="gender" value="0" @if ($customer->gender==0) checked @endif>Nữ</th>
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>
                                <input type="text" name="email" value="{{ $customer->email }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td>
                                <input type="text" name="phone" value="{{ $customer->phone }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button class="btn btn-primary">Cập nhật thông tin</button>
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

    
    