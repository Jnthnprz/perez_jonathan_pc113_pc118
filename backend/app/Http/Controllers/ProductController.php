<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // kuhaon ang mga product tapos pwede nka maka pamili kung unsa nga category
    // ang gusto nimo ipakita
    if ($request->has('category') && $request->category != '') {
        $products = Product::where('category', $request->category)->get();
    } else {
        $products = Product::all();
    }

    return response()->json($products);
}


    public function store(Request $request)
    {
        // Validation rules for creating a product
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }
    
        // Create a new product with the validated data
        $product = Product::create($validated);
        $product->image = $product->image ? asset('storage/' . $product->image) : null;

        return response()->json($product, 201);
    }

   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Validate incoming request
    $validated = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle image update if a new one is uploaded
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $validated['image'] = $path; // ✅ Save only the relative path in DB
    }

    // Update product
    $product->update($validated);

    // Optional: return full image URL if you want it on frontend
    $product->image = $product->image ? asset('storage/' . $product->image) : null;

    return response()->json($product);
}


    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function show($id)
{
    $product = Product::findOrFail($id);
    $product->image = $product->image ? asset('storage/' . $product->image) : null;
    return response()->json($product);
}

}