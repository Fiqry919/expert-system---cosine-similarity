<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gejala = Gejala::all();
        return view('admin.gejala.index', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Gejala::kode();
        return view('admin.gejala.create', compact('kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:gejala,kode',
            'nama_gejala' => 'required'
        ]);

        $gejala = new Gejala;
        $gejala->kode = $request->kode;
        $gejala->nama_gejala = $request->nama_gejala;
        $gejala->save();

        session()->flash('created', 'Berhasil menambahkan data');
        return redirect('gejala');
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
        $gejala = Gejala::where('id', $id)->first();
        return view('admin.gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gejala = Gejala::where('id', $id)->firstOrFail();
        $this->validate($request, [
            'kode' => 'required|unique:gejala,kode,' . $gejala->kode . ',kode',
            'nama_gejala' => 'required'
        ]);

        Gejala::where('id', $gejala->id)
            ->update([
                'kode' => $request->kode,
                'nama_gejala' => $request->nama_gejala
            ]);

        session()->flash('update', 'Berhasil memperbarui data');
        return redirect('gejala');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gejala = Gejala::where('id', $id)->firstOrFail();
        $gejala->delete();
        session()->flash('delete', 'Berhasil menghapus data');
        return response()->json($gejala);
    }
}
