<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $products = Product::with(['category','unit'])
        ->latest()
        ->get();

    return view('backend.product.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('backend.product.create', compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'category_id'=>'required',
            'product_code'=>'required|unique:products',
            'product_name'=>'required',
            'unit_id'=>'required',
            'purchase_price'=>'required|numeric',
            'stock'=>'required|integer',
            'minimum_stock'=>'required|integer',
            'image'=>'nullable|image|max:2048'

        ]);

        $imageName = null;


        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $imageName
            );

        }

         Product::create([

            'category_id'=>$request->category_id,

            'product_code'=>$request->product_code,

            'product_name'=>$request->product_name,

            'unit_id'=>$request->unit_id,

            'purchase_price'=>$request->purchase_price,

            'stock'=>$request->stock,

            'minimum_stock'=>$request->minimum_stock,

            'image'=>$imageName,

            'description'=>$request->description,
         ]);
         return redirect()
             ->route('products.index')
             ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $categories = Category::all();

    $units = Unit::all();

    $product = Product::findOrFail($id);

    return view(
        'backend.product.edit',
        compact('product', 'categories', 'units')
    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

            'category_id'=>'required',

            'product_name'=>'required',

            'unit_id'=>'required',

            'purchase_price'=>'required|numeric',

            'stock'=>'required|integer',

            'minimum_stock'=>'required|integer',

            'image'=>'nullable|image|max:2048'
            

        ]);

        $imageName = $product->image;



        if($request->hasFile('image')){


            $imageName = time().'.'.$request->image->extension();


            $request->image->move(
                public_path('uploads/products'),
                $imageName
            );

        }

        $product->update([

            'category_id'=>$request->category_id,

            'product_name'=>$request->product_name,

            'unit_id'=>$request->unit_id,

            'purchase_price'=>$request->purchase_price,

            'stock'=>$request->stock,

            'minimum_stock'=>$request->minimum_stock,

            'image'=>$imageName,

            'description'=>$request->description,

        ]);

        return Redirect()
        ->route('products.index')
        ->with('success','Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
        ->route('products.index')
        ->with('success','Produk Berhasil dihapus');
    }
}
