<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Cart;
use App\Models\HistoryTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::doesntHave('cart')->where('stock', '>', 0)->get()->sortBy('expire_date');
        $carts = Product::has('cart')->get()->sortByDesc('cart.created_at');
        return view('pages.transactionCart.index', [
            // 'products' => Product::latest()->paginate(10),
            'products' => $products,
            'itemCarts' => $carts,
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
    public function store(Request $request)
    {
        // ddd($request->all());
        $total = $request->total;
        $bayar = $request->pay_total;
        $carts = Cart::all()->map(function ($cart) {
            return [
                'product_id' => $cart->product_id,
                'name' => $cart->product->name,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity, 'amount' => $cart['quantity'],
                'subtotal' => $cart->product->price * $cart->quantity
            ];
        })->toArray();

        $cartsData = Cart::get();
        // dd($carts);

        $transactionData = [
            'total_harga' => $total,
            'total_bayar' => $bayar,
            'nama_kasir' => auth()->user()->name,
        ];
        // save to transaction
        Transaction::create($transactionData);

        $transaction = Transaction::latest()->first();
        $transactionId = $transaction ? $transaction->id : 1;

        foreach ($cartsData as $cart) {
            $historyTransactionData = [
                'product_id' => $cart['product_id'],
                'name' => $cart->product->name,
                'price' => $cart->product->price,
                'amount' => $cart['quantity'],
                'transaction_id' => $transactionId,
            ];
            HistoryTransaction::create($historyTransactionData);
        }
        Cart::truncate();

        foreach ($cartsData as $cart) {
            $product = Product::find($cart->product_id);
            $product->stock -= $cart->quantity;
            $product->save();
        }

        return redirect('/features/history-transactions')->with('success', 'History created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
