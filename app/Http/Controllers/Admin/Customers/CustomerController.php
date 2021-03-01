<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.pages.customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.customers.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer['name'] = $request->name;
        $customer['company'] = $request->company;
        $customer['email'] = $request->email;
        $customer['phone'] = $request->phone;
        $customer['phone_company'] = $request->phone_company;
        $customer['street'] = $request->street;
        $customer['postal_code'] = $request->postal_code;
        $customer['function'] = $request->function;
        $customer['state'] = $request->state;
        $customer['city'] = $request->city;
        $customer['country'] = $request->country;
        Customer::create($customer);

        return redirect('admin/customer');
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
        $customer = Customer::find($id);
        return view('admin.pages.customers.form',compact('customer'));
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
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->phone_company = $request->phone_company;
        $customer->street = $request->street;
        $customer->postal_code = $request->postal_code;
        $customer->function = $request->function;
        $customer->state = $request->state;
        $customer->city = $request->city;
        $customer->country = $request->country;
        $customer->update();

        return redirect('admin/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        
        $customer->delete();

        return redirect('admin/customer');
    }
}