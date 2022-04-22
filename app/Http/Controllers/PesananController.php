<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStorePesanan;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Transaksi::latest()->where('nama_pelanggan', 'LIKE', '%' . Auth::user()->username . '%')->paginate(10);
        return view('dashboard.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::latest()->where('stok', '>', '0')->paginate(10);
        return view('dashboard.pesanan.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStorePesanan $request)
    {
        $validated = $request->validated() + [
            'nama_pelanggan' => Auth::user()->username,
            'total_harga' => 0,
            'kasir_id' => 1,
            'tanggal' => date("Y-m-d"),
            'created_at' => now()
        ];

        $menu = Menu::findOrFail($validated['menu_id']);

        $validated['total_harga'] = (int) $menu->harga * (int) $validated['jumlah'];

        $newTransaksi = Transaksi::create($validated);

        $menu->update([
            'stok' => $menu->stok - $validated['jumlah'],
            'updated_at' => now()
        ]);

        $message = "Pesanan berhasil ditambahkan, silahkan lanjutkan pembayaran";
        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return redirect(route('pesanan.index'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return $transaksi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pesanan = Transaksi::findOrFail($id);
        return view('dashboard.pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStorePesanan $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bayar($id)
    {
        $pesanan = Transaksi::findOrFail($id);
        $pesanan->update([
            'status' => 'paid',
            'updated_at' => now(),
        ]);

        return redirect(route('pesanan.index'))->with('success', 'Pesanan berhasil dibayar');
    }
}
