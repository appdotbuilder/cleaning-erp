<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use Inertia\Inertia;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        
        return Inertia::render('materials/index', [
            'materials' => $materials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('materials/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        $material = Material::create($request->validated());

        return redirect()->route('materials.show', $material)
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return Inertia::render('materials/show', [
            'material' => $material
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return Inertia::render('materials/edit', [
            'material' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->update($request->validated());

        return redirect()->route('materials.show', $material)
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}