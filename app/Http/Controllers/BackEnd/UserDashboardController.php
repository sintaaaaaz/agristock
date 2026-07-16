<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IncomingGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingGoods = IncomingGood::with([
    'supplier',
    'incomingGoodDetails'
])
->where('user_id', Auth::id())
->latest()
->get();


        return view(
            'backend.user.dashboard',
            compact('incomingGoods')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $suppliers = \App\Models\Supplier::all();

    $products = \App\Models\Product::with('unit')
        ->get();


    return view(
        'backend.user.create',
        compact(
            'suppliers',
            'products'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
