<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $listCustomer = CustomerModel::where('name', 'like', "%$search%")
            ->orwhere('phone', 'like', "%$search%")->paginate(3);
        return view(
            'customers.index',
            compact($listCustomer),
            [
                'search' => $search,
                'listCustomer' => $listCustomer
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:255',
                'email' => 'required',
                'phone' => 'required|integer',
                'image' => 'require|mimes:jpg,pnd,jpeg|max:2048',
            ],

            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min ký tự',
                'max' => ':attribute Không được lớn hơn :max ký tự',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'name' => 'Tên',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'image' => 'Ảnh'
            ]
        );
        if ($validate->fails()) {
            return View('customers.create')->withErrors($validate);
        }

        $name = $request->get('name');
        $email = $request->get('email');
        $gender = $request->get('gender');
        $phone = $request->get('phone');
        $image = $request->file('image');
        $newImageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $newImageName);

        $customer = new CustomerModel();
        $customer->name = $name;
        $customer->email = $email;
        $customer->gender = $gender;
        $customer->phone = $phone;
        $customer->image_path = $newImageName;
        $customer->save();
        return Redirect::route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = CustomerModel::find($id);

        return view('customers.edit', compact($customer), [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = CustomerModel::find($id);
        $image_name = $request->hidden_image; //ảnh cũ
        $image = $request->file('image'); // ảnh mới
        if ($image != '') {
        
            $image_name = time() . '.' . $image->getClientOriginalExtension(); //đổi tên ảnh
            $request->image->move(public_path('images'), $image_name); //lưu ảnh
        } else {
           
        }
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->gender = $request->get('gender');
        $customer->phone = $request->get('phone');
        $customer->image_path = $image_name;
        $customer->save();
        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
