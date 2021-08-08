@extends('layout.app')

@section('content')
<div>
    <a class="btn btn-primary" href="{{ route('customers.create') }}">Thêm thông tin khách hàng</a>
    <h1 align="center">Danh sách khách hàng</h1>
    
    <form action="" method="get">
        Tìm kiếm <input type="text" name="search" value="{{ $search }}"><button>Search</button>
    </form>

    <table border="1" style="width:100%; margin-top:10px">
        <tr align="center">
            <th>Tên</th>
            <th>Ảnh đại diện</th>
            <th>Email</th>
            <th>Giới tính</th>
            <th>Số điện thoại</th>
            <th>Sửa</th>
        </tr>
        @foreach ($listCustomer as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td width="25%">
                    <img src="{{ asset('images/' . $customer->image_path) }}"
                    class="img-thumbnail">
                </td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->gender == 1 ? "Nam" : "Nữ"}}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('customers.edit', $customer->id) }}">Sửa</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        <ul class="pagination">
            {{ $listCustomer->appends([
                'search' => $search
            ])->links() }}
        </ul>
    </div>
</div>
@endsection