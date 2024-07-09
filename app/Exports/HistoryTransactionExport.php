<?php

namespace App\Exports;

use App\Models\HistoryTransaction;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryTransactionExport implements FromCollection, WithHeadings
{
    /**
     * @return array
     */
    public function collection()
    {
        $histories = HistoryTransaction::all();
        return $histories->map(function ($history) {
            return [
                $history->id,
                $history->name,
                $history->price,
                $history->amount,
                $history->product->name,
                $history->transaction->nama_kasir,
                $history->created_at,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Amount',
            'Product Name',
            'Kasir Name',
            'Created_at',
            // Add more column names here as per your table structure
        ];
    }

    /**
     * @return array
     */
    public function map($historyTransaction): array
    {
        return [
            $historyTransaction->id,
            $historyTransaction->name,
            $historyTransaction->price,
            $historyTransaction->amount,
            $historyTransaction->nama_kasir,
            $historyTransaction->created_at->format('Y-m-d'),
            // Map more fields here as per your table structure
        ];
    }
}
