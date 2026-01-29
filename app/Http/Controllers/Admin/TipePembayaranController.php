<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipePembayaran;
use Illuminate\Http\Request;

class TipePembayaranController extends Controller
{
    // READ
    public function index()
    {
        $tipes = TipePembayaran::all();
        return view('admin.tipe-pembayaran.index', compact('tipes'));
    }

    // CREATE (FORM)
    public function create()
    {
        return view('admin.tipe-pembayaran.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        TipePembayaran::create($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.tipe-pembayaran.index');
    }

    // EDIT (FORM)
    public function edit(TipePembayaran $tipe_pembayaran)
    {
        return view('admin.tipe-pembayaran.edit', compact('tipe_pembayaran'));
    }

    // UPDATE
    public function update(Request $request, TipePembayaran $tipe_pembayaran)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $tipe_pembayaran->update($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.tipe-pembayaran.index');
    }

    // DELETE
    public function destroy(TipePembayaran $tipe_pembayaran)
    {
        $tipe_pembayaran->delete();
        return redirect()->route('admin.tipe-pembayaran.index');
    }
}
