<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (\Cart::isEmpty()) {
            return redirect()->route('cart.index')
                ->with('cart_success', 'Your cart is empty. Add some products first.');
        }

        $items = \Cart::getContent()->sortBy('name');
        $total = \Cart::getTotal();

        return view('checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city'    => 'required|string|max:100',
        ]);

        $cartItems = \Cart::getContent();
        $total     = \Cart::getTotal();

        $order = Order::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'address'      => $validated['address'],
            'city'         => $validated['city'],
            'total_amount' => $total,
            'status'       => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item->id,
                'product_name' => $item->name,
                'price'        => $item->price,
                'quantity'     => $item->quantity,
            ]);
        }

        \Cart::clear();

        return redirect()->route('home')
            ->with('order_success', 'Thank you, ' . $validated['name'] . '! Your order #' . $order->id . ' has been placed successfully. We will contact you at ' . $validated['email'] . ' with updates.');
    }
}
