<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['produk'] = Produk::orderBy('id', 'DESC')->get();

        return view('produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk' => ['required','min:3','unique:produk'],
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Produk::create($request->only('produk', 'stok', 'harga'));
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['item'] = Produk::find($id);

        return view('produk.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['item'] = Produk::find($id);

        return view('produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'produk' => ['required','min:3',Rule::unique('produk')->ignore($id)],
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Produk::find($id)->update($request->only('produk', 'stok', 'harga'));
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produk::find($id)->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
