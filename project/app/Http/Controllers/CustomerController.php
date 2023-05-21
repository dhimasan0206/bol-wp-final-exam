<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\Membership;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = [
            'ID',
            'Name',
            'Address',
            'Membership',
            'Actions'
        ];
        
        $btnEdit = '<a href=":route" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>';
        $btnDelete = '<form action=":route" method="POST">
            '.csrf_field().'
        <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>
        </form>';
        $btnDetails = '<a href=":route" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $data = [];
        foreach (Customer::all() as $customer) {
            $data[] = [
                $customer->id,
                $customer->name,
                $customer->address,
                $customer->membership->name,
                str_replace(":route", route("customers.edit", ['customer' => $customer->id]), $btnEdit).
                str_replace(":route", route("customers.show", ['customer' => $customer->id]), $btnDetails).
                str_replace(":route", route("customers.destroy", ['customer' => $customer->id]), $btnDelete),
            ];
        }
        $config = [
            'data' => $data,
        ];
        return view('customer.index', compact('heads', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $memberships = [];
        foreach (Membership::all() as $membership) {
            $memberships[$membership->id] = $membership->name;
        }
        return view('customer.create', compact('memberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->membership_id = $request->membership_id;
        $customer->save();
        return to_route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $memberships = [];
        foreach (Membership::all() as $membership) {
            $memberships[$membership->id] = $membership->name;
        }
        return view('customer.edit', compact('customer', 'memberships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->membership_id = $request->membership_id;
        $customer->save();
        return to_route('customers.show', ['customer' => $customer->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return to_route('customers.index');
    }
}
