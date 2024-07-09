<?php

namespace App\Http\Controllers;

use App\Exports\HistoryTransactionExport;
use App\Models\HistoryTransaction;
use App\Http\Requests\StoreHistoryTransactionRequest;
use App\Http\Requests\UpdateHistoryTransactionRequest;
use Maatwebsite\Excel\Facades\Excel;

class HistoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.historyTransaction.index', [
            'histories' => HistoryTransaction::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistoryTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoryTransaction $historyTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryTransaction $historyTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoryTransactionRequest $request, HistoryTransaction $historyTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryTransaction $historyTransaction)
    {
        //
    }

    public function export()
    {
        return Excel::download(new HistoryTransactionExport, 'history_transactions.xlsx');
    }
}
