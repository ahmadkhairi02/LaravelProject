<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = \Cart::getContent()->sortBy('name');
        $total = \Cart::getTotal();

        return view('cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $product = Product::with('category')->findOrFail($request->product_id);

        \Cart::add([
            'id'         => $product->id,
            'name'       => $product->name,
            'price'      => (float) $product->price,
            'quantity'   => $request->quantity,
            'attributes' => [
                'image'    => $product->image,
                'slug'     => $product->slug,
                'category' => $product->category?->name,
            ],
        ]);

        return redirect()->back()->with('cart_success', '"' . $product->name . '" was added to your cart.');
    }

    public function update(Request $request, string $rowId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);

        \Cart::update($rowId, [
            'quantity' => ['relative' => false, 'value' => $request->quantity],
        ]);

        return redirect()->route('cart.index');
    }

    public function remove(string $rowId)
    {
        \Cart::remove($rowId);

        return redirect()->route('cart.index')->with('cart_success', 'Item removed from your cart.');
    }

    public function clear()
    {
        \Cart::clear();

        return redirect()->route('cart.index')->with('cart_success', 'Your cart has been cleared.');
    }
}
