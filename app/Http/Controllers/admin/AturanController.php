<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Aturan;
use App\Models\admin\Gejala;
use App\Models\admin\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aturan = Aturan::with('penyakits')->orderBy('created_at', 'desc')->paginate(10);
        $penyakit = Penyakit::all();
        // if (count($aturan) != count($penyakit)) {
        //     session()->flash('danger', 'Beberapa data penyakit belum ditambahkan');
        // }
        return view('admin.aturan.index', compact('aturan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodeRules = Aturan::kode();
        $penyakit = Penyakit::pluck('nama_penyakit', 'kode');
        $gejala = Gejala::all();
        foreach ($gejala as $key => $value) {
            $kode[$key] = $value->kode;
        }
        return view('admin.aturan.create', compact('penyakit', 'gejala', 'kode', 'kodeRules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gejala = Gejala::all();
        $validate = [
            'kode' => 'required',
            'penyakit' => 'required',
        ];
        for ($i = 0; $i < count($gejala); $i++) {
            $validate['aturan_' . $i] = 'nullable';
        }

        $this->validate($request, $validate);

        for ($x = 0; $x < count($gejala); $x++) {
            if (!empty($request->input('aturan_' . $x))) {
                $push[$x] = $request->input('aturan_' . $x);
            }
        }
        if (empty($push)) {
            session()->flash('error', 'Gejala tidak boleh kosong!');
            return Redirect::back();
        }
        $combine = implode(",", $push);
        // dump($request, $push, $combine);

        $aturan = new Aturan;
        $aturan->kode = $request->kode;
        $aturan->penyakit = $request->penyakit;
        $aturan->aturan = $combine;
        $aturan->save();

        session()->flash('created', 'Berhasil menambahkan data');
        return redirect('aturan');
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
        $aturan = Aturan::where('id', $id)->first();

        $penyakit = Penyakit::pluck('nama_penyakit', 'kode');
        $gejala = Gejala::all();

        $data = explode(",", $aturan->aturan);

        foreach ($gejala as $key1 => $value1) {
            $kode[$key1] = $value1->kode;
        }
        // dump($kode, $data);
        return view('admin.aturan.edit', compact('aturan', 'penyakit', 'gejala', 'kode', 'data'));
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
        $aturan = Aturan::where('id', $id)->firstOrFail();

        $gejala = Gejala::all();
        $validate = [
            'kode' => 'required|unique:aturan,kode,' . $aturan->kode . ',kode',
            'penyakit' => 'required|unique:aturan,penyakit,' . $aturan->penyakit . ',penyakit',
        ];
        for ($i = 0; $i < count($gejala); $i++) {
            $validate['aturan_' . $i] = 'nullable';
        }

        $this->validate($request, $validate);

        for ($x = 0; $x < count($gejala); $x++) {
            if (!empty($request->input('aturan_' . $x))) {
                $push[$x] = $request->input('aturan_' . $x);
            }
        }
        if (empty($push)) {
            session()->flash('error', 'Gejala tidak boleh kosong!');
            return Redirect::back();
        }
        $combine = implode(",", $push);

        Aturan::where('id', $aturan->id)
            ->update([
                'kode' => $request->kode,
                'penyakit' => $request->penyakit,
                'aturan' => $combine
            ]);

        session()->flash('update', 'Berhasil memperbarui data');
        return redirect('aturan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aturan = Aturan::where('id', $id)->firstOrFail();
        $aturan->delete();
        session()->flash('delete', 'Berhasil menghapus data');
        return response()->json($aturan);
    }
}
