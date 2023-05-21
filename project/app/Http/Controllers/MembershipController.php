<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Membership;

class MembershipController extends Controller
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
            'Discount',
            'Minimum Profit',
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
        foreach (Membership::all() as $membership) {
            $data[] = [
                $membership->id,
                $membership->name,
                $membership->discount,
                $membership->minimum_profit,
                str_replace(":route", route("memberships.edit", ['membership' => $membership->id]), $btnEdit).
                str_replace(":route", route("memberships.show", ['membership' => $membership->id]), $btnDetails).
                str_replace(":route", route("memberships.destroy", ['membership' => $membership->id]), $btnDelete),
            ];
        }
        $config = [
            'data' => $data,
        ];
        return view('membership.index', compact('heads', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembershipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $membership = new Membership();
        $membership->name = $request->name;
        $membership->discount = $request->discount;
        $membership->minimum_profit = $request->minimum_profit;
        $membership->save();
        return to_route('memberships.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        return view('membership.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        return view('membership.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembershipRequest  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership->name = $request->name;
        $membership->discount = $request->discount;
        $membership->minimum_profit = $request->minimum_profit;
        $membership->save();
        return to_route('memberships.show', ['membership' => $membership->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();
        return to_route('memberships.index');
    }
}
