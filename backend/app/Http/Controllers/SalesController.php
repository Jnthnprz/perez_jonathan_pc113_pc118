<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; 

class SalesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'cart.*.code' => 'required|string',
            'cart.*.name' => 'required|string',
            'cart.*.price' => 'required|numeric',
            'cart.*.quantity' => 'required|integer',
        ]);
    
        foreach ($request->cart as $item) {
            Sale::create([
                'product_code' => $item['code'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }
    
        return response()->json(['message' => 'Sale processed successfully'], 201);
    }
}
