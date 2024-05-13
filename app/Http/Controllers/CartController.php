<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store()
    {
        $rules = [
            'quantity' => 'required|numeric|min:1',
            'product_id' => 'required|exists:products,id'
        ];
        $validatedData = request()->validate($rules);

        // ddd(request()->all());
        if (request()->product_id) {
            Cart::create($validatedData);
        }

        return redirect('/features/transactions')->with('success', 'New product has been added!');
    }

    public function update(Cart $cart)
    {
        $cart->update(request()->all());

        return redirect()->back();
    }

    public function destroy(Cart $cart)
    {
        Cart::destroy($cart->id);

        return redirect()->back();
    }
}
