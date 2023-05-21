<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExchangeRateRequest;
use App\Http\Requests\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;

class ExchangeRateController extends Controller
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
            'Currency',
            'Sell',
            'Buy',
            'Date',
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
        foreach (ExchangeRate::all() as $exchangerate) {
            $data[] = [
                $exchangerate->id,
                $exchangerate->currency,
                $exchangerate->sell,
                $exchangerate->buy,
                $exchangerate->date,
                str_replace(":route", route("exchangerates.edit", ['exchangerate' => $exchangerate->id]), $btnEdit).
                str_replace(":route", route("exchangerates.show", ['exchangerate' => $exchangerate->id]), $btnDetails).
                str_replace(":route", route("exchangerates.destroy", ['exchangerate' => $exchangerate->id]), $btnDelete),
            ];
        }
        $config = [
            'data' => $data,
        ];
        return view('exchangerate.index', compact('heads', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exchangerate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExchangeRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExchangeRateRequest $request)
    {
        $exchangerate = new ExchangeRate();
        $exchangerate->currency = $request->currency;
        $exchangerate->sell = $request->sell;
        $exchangerate->buy = $request->buy;
        $exchangerate->date = $request->date;
        $exchangerate->save();
        return to_route('exchangerates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRate $exchangerate)
    {
        return view('exchangerate.show', compact('exchangerate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeRate $exchangerate)
    {
        return view('exchangerate.edit', compact('exchangerate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExchangeRateRequest  $request
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExchangeRateRequest $request, ExchangeRate $exchangerate)
    {
        $exchangerate->currency = $request->currency;
        $exchangerate->sell = $request->sell;
        $exchangerate->buy = $request->buy;
        $exchangerate->date = $request->date;
        $exchangerate->save();
        return to_route('exchangerates.show', ['exchangerate' => $exchangerate->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRate $exchangerate)
    {
        $exchangerate->delete();
        return to_route('exchangerates.index');
    }
}
