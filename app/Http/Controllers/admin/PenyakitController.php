<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Penyakit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penyakit = Penyakit::all();
        if (!empty($penyakit)) {
            foreach ($penyakit as $key => $value) {
                $solusi[$key] = $value->solusi;
                $explode[$key] = explode(",", $solusi[$key]);
            }
        }
        if (!empty($explode)) {
            return view('admin.penyakit.index', compact('penyakit', 'explode'));
        } else {
            return view('admin.penyakit.index', compact('penyakit'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Penyakit::kode();
        return view('admin.penyakit.create', compact('kode'));
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
            'kode' => 'required|unique:penyakit,kode',
            'nama_penyakit' => 'required',
            'solusi' => 'required'
        ]);

        $penyakit = new Penyakit;
        $penyakit->kode = $request->kode;
        $penyakit->nama_penyakit = $request->nama_penyakit;
        $penyakit->solusi = $request->solusi;
        $penyakit->save();

        session()->flash('created', 'Berhasi menambahkan data');
        return redirect('penyakit');
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
        $penyakit = Penyakit::where('id', $id)->first();
        return view('admin.penyakit.edit', compact('penyakit'));
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
        $penyakit = Penyakit::where('id', $id)->firstOrFail();

        $this->validate($request, [
            'kode' => 'required|unique:penyakit,kode,' . $penyakit->kode . ',kode',
            'nama_penyakit' => 'required',
            'solusi' => 'required'
        ]);

        Penyakit::where('id', $penyakit->id)
            ->update([
                'kode' => $request->kode,
                'nama_penyakit' => $request->nama_penyakit,
                'solusi' => $request->solusi
            ]);

        session()->flash('update', 'Berhasil memperbarui data');
        return redirect('penyakit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyakit = Penyakit::where('id', $id)->firstOrFail();
        $penyakit->delete();
        session()->flash('delete', 'Berhasil menghapus data');
        return response()->json($penyakit);
    }
}
