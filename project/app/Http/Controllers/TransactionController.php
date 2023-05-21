<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customer;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
            'Customer',
            'Date',
            'Discount',
            'Total',
            'Actions'
        ];
        
        // $btnEdit = '<a href=":route" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        //                 <i class="fa fa-lg fa-fw fa-pen"></i>
        //             </a>';
        $btnDelete = '<form action=":route" method="POST">
            '.csrf_field().'
        <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>
        </form>';
        $btnDetails = '<a href=":route" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $data = [];
        foreach (Transaction::all() as $transaction) {
            $data[] = [
                $transaction->id,
                $transaction->customer,
                $transaction->date,
                $transaction->discount,
                $transaction->total(),
                // str_replace(":route", route("transactions.edit", ['transaction' => $transaction->id]), $btnEdit).
                str_replace(":route", route("transactions.show", ['transaction' => $transaction->id]), $btnDetails).
                str_replace(":route", route("transactions.destroy", ['transaction' => $transaction->id]), $btnDelete),
            ];
        }
        $config = [
            'data' => $data,
        ];
        return view('transaction.index', compact('heads', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = [];
        foreach (Customer::all() as $customer) {
            $customers[$customer->id] = $customer->name;
        }
        $exchangerates = [];
        foreach (ExchangeRate::all() as $exchangerate) {
            $exchangerates[$exchangerate->id] = $exchangerate->currency;
        }
        return view('transaction.create', compact('customers', 'exchangerates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $exchangerate = ExchangeRate::findOrFail($request->exchangerate_id);

        DB::beginTransaction();
        $transaction = new Transaction();
        $transaction->customer = $customer->name;
        $transaction->discount = $customer->membership->discount;
        $transaction->date = $request->date;
        if (!$transaction->save()) {
            DB::rollback();
            return redirect()->back()->withErrors('failed to save transaction')->withInput();
        }

        $detail = new TransactionDetail();
        $detail->transaction_id = $transaction->id;
        $detail->currency = $exchangerate->currency;
        $detail->rate = $exchangerate->sell;
        $detail->quantity = $request->quantity;
        if (!$detail->save()) {
            DB::rollback();
            return redirect()->back()->withErrors('failed to save transaction detail')->withInput();
        }

        DB::commit();

        return to_route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return to_route('transactions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        return to_route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return to_route('transactions.index');
    }

    public function report(Request $request)
    {
        $year = $request->query('year', date("Y"));
        $month = $request->query('month', date("n"));

        $years = [];
        $current_year = idate("Y");
        for ($i=$current_year-100; $i <= $current_year; $i++) { 
            $years[$i] = $i;
        }

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $time = mktime(0, 0, 0, $i);
            $months[date('n', $time)] =  date('F', $time);
        }

        $currencies = [];
        foreach (DB::select("SELECT currency FROM exchange_rates GROUP BY currency") as $currency) {
            $currencies[$currency->currency] = $currency->currency;
        }

        $currency = $request->query('currency', reset($currencies));

        $sql = "SELECT DATE_FORMAT(`transactions`.`date`, '%d-%m-%Y') AS transaction_date, currency, COUNT(`transactions`.id) AS transaction_count, SUM(rate*quantity) as total FROM `transaction_details` JOIN `transactions` ON `transactions`.`id` = `transaction_details`.`transaction_id` AND YEAR(`transactions`.`date`) = ? AND MONTH(`transactions`.`date`) = ? WHERE currency = ? GROUP BY currency, transaction_date ORDER BY transaction_date, currency;";

        $labels = [];
        $data = [];
        foreach (DB::select($sql, [$year, $month, $currency]) as $report) {
            array_push($labels, $report->transaction_date);
            array_push($data, $report->total);
        }

        $sql = "SELECT SUM(d.rate*d.quantity) - SUM(discount) AS profit FROM transactions t JOIN transaction_details d ON d.transaction_id = t.id;";

        $profit = DB::scalar($sql);

        return view('transaction.report', compact('years', 'year', 'months', 'month', 'currencies', 'currency','labels', 'data', 'profit'));
    }
}
