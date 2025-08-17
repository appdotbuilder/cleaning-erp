<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        
        return Inertia::render('suppliers/index', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('suppliers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return Inertia::render('suppliers/show', [
            'supplier' => $supplier->load('purchaseOrders')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return Inertia::render('suppliers/edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return redirect()->route('suppliers.show', $supplier)
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }
}