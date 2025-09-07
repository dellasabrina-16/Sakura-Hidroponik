<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks = Stok::with('produk')->get();
        return view('admin.stok', compact('stoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $stok = Stok::findOrFail($id);

        if ($request->has('stok_kg')) {
            $newStok = intval($request->stok_kg);
            $stok->stok_kg = $newStok;
            if ($newStok > 0) {
                $stok->status = true;
            } else {
                $stok->status = false;
            }
        }

        if ($request->has('status')) {
            $stok->status = $request->status && $stok->stok_kg > 0 ? true : false;
        }

        $stok->save();

        return response()->json(['success' => true, 'stok' => $stok]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
