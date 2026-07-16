<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.supplier.index', compact('suppliers')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $request->validate([
        'supplier_name'=>'required',
        'phone'=>'nullable',
        'email'=>'nullable|email',
        'address'=>'required'
    ]);


    Supplier::create([

        'supplier_name'=>$request->supplier_name,

        'phone'=>$request->phone,

        'email'=>$request->email,

        'address'=>$request->address

    ]);


    return redirect()
        ->route('suppliers.index')
        ->with('success','Supplier berhasil ditambahkan');

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
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
{

    $request->validate([
        'supplier_name'=>'required',
        'phone'=>'nullable',
        'email'=>'nullable|email',
        'address'=>'required'
    ]);


    $supplier->update([

        'supplier_name'=>$request->supplier_name,

        'phone'=>$request->phone,

        'email'=>$request->email,

        'address'=>$request->address

    ]);


    return redirect()
        ->route('suppliers.index')
        ->with('success','Supplier berhasil diperbarui');

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }
}
