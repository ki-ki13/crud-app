<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request -> get('status') == 'archived'){
            $items = Item::onlyTrashed()->get();
        }else{
            $items = Item::get();
        }
        $title = "Dashboard";

        return view('item.index', compact('items','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Barang";
        return view('item.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = Item::create([
            "kode_barang" => $request -> kode,
            "nama_barang" => $request -> nama,
            "stock" => $request -> stock,
            "harga" => $request -> harga
        ]);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function edit($home)
    {
        $item = Item::findorfail($home);
        $title = "Edit Barang";
        return view('item.edit',compact('item','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $home)
    {
        $item = Item::findorfail($home);
        $item -> update([
            "kode_barang" => $request -> kode ?? $item -> kode,
            "nama_barang" => $request -> nama ?? $item -> nama,
            "stock" => $request -> stock ?? $item -> stock,
            "harga" => $request -> harga ?? $item -> harga
        ]);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function destroy($home)
    {
        Item::find($home)->delete();
        return redirect('/home');
    }


    public function restore($home){
        $item = Item::withTrashed();
        $item->find($home)->restore();
        return redirect('/home?status=archived');
    }

    
    public function restoreAll(){
        Item::onlyTrashed()->restore();
        return redirect('/home?status=archived');
    }

    public function forceDelete($home){
        $item = Item::withTrashed();
        $item -> find($home)->forceDelete();
        return redirect('/home?status=archived');
    }
}
