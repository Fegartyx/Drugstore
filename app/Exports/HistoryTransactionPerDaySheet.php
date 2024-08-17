<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryTransactionPerDaySheet implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $historyTransactions;
    protected $date;

    public function __construct(Collection $historyTransactions, string $date)
    {
        $this->historyTransactions = $historyTransactions;
        $this->date = $date;
    }

    public function collection()
    {
        return $this->historyTransactions->map(function ($history) {
            return [
                $history->created_at,
                $history->name,
                $history->price,
                $history->product->name,
                $history->transaction->nama_kasir,
                $history->amount,
            ];
        });
    }

    public function columnFormats(): array
    {
        return [
            'C' => '[$Rp ]#,##0.00_-',
        ];
    }

    public function headings(): array
    {
        return [
            'Date Created',
            'Name',
            'Price',
            'Product Name',
            'Kasir Name',
            'Amount',
        ];
    }

    /**
     * @return array
     */
    public function map($historyTransaction): array
    {
        return [
            $historyTransaction->created_at->format('yy-mm-dd'),
            $historyTransaction->name,
            $historyTransaction->price,
            $historyTransaction->nama_kasir,
            $historyTransaction->amount,
            // Map more fields here as per your table structure
        ];
    }
}
