<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateOrUpdateMenu;
use App\Models\Aktifitas;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('dashboard.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCreateOrUpdateMenu $request)
    {
        $validated = $request->validated();
        $menu = Menu::create([
            'nama_menu' => $validated['nama_menu'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'stok' => $validated['stok'],
            'created_by' => auth()->user()->id,
            'created_at' => now(),
        ]);

        Aktifitas::insert([
            'deskripsi' => 'Menambahkan menu ' . Str::title($menu->nama_menu),
            'pegawai_id' => auth()->user()->id,
            'created_at' => now(),
        ]);
        return redirect()->route('menus.index')->with('success', 'Data menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('dashboard.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestCreateOrUpdateMenu $request, $id)
    {
        $validated = $request->validated();
        $menu = Menu::findOrFail($id);
        if ($menu->nama_menu == $validated['nama_menu'] && $menu->harga ==  $validated['harga'] && $menu->deskripsi == $validated['deskripsi'] && $menu->stok == $validated['stok']) {
            return redirect()->route('menus.index')->with('warning', 'Data menu tidak berubah');
        }
        $menu->update([
            'nama_menu' => $validated['nama_menu'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'stok' => $validated['stok'],
            'updated_by' => auth()->user()->id,
            'updated_at' => now(),
        ]);
        Aktifitas::insert([
            'deskripsi' => 'Mengubah menu ' . Str::title($menu->nama_menu),
            'pegawai_id' => auth()->user()->id,
            'created_at' => now(),
        ]);
        return redirect()->route('menus.index')->with('success', 'Data menu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        Aktifitas::insert([
            'deskripsi' => 'Menghapus menu ' . Str::title($menu->nama_menu),
            'pegawai_id' => auth()->user()->id,
            'created_at' => now(),
        ]);
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Data menu berhasil dihapus');
    }
}
