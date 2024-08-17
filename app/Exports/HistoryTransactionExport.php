<?php

namespace App\Exports;

use App\Models\HistoryTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HistoryTransactionExport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        // Get all transactions and group them by the created_at date
        $transactions = HistoryTransaction::all()->groupBy(function ($transaction) {
            return Carbon::parse($transaction->created_at)->format('Y-m-d');
        });

        // For each group, create a new sheet
        foreach ($transactions as $date => $historyTransactions) {
            $sheets[] = new HistoryTransactionPerDaySheet($historyTransactions, $date);
        }

        return $sheets;
    }
}
