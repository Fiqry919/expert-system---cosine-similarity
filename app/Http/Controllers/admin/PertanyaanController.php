<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Gejala;
use App\Models\admin\Penyakit;
use App\Models\admin\Pertanyaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pertanyaan::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gejala', function ($data) {
                    $gejala = Gejala::where('kode', $data->pertanyaan)->first();
                    return $gejala->kode . ' - ' . $gejala->nama_gejala;
                })->addColumn('action', function ($data) {
                    $actionBtn = '<a href="' . route('question.edit', $data->id) . '" title="edit" class="edit btn text-primary btn-sm"><i class="fa fa-edit"></i></a>';
                    // $actionBtn .= '&nbsp;';
                    $actionBtn .= '<button type="button" name="delete" id="' . $data->id . '" title="hapus" class="delete btn text-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['gejala', 'action'])
                ->make(true);
        }
        return view('admin.pertanyaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = Pertanyaan::kode();
        $type = [
            'number' => 'Number',
            'text' => 'Text',
            'select' => 'Select',
            'choice' => 'choice'
        ];
        $gejala = Gejala::all();
        $penyakit = Penyakit::all();
        return view('admin.pertanyaan.create', compact('kode', 'type', 'penyakit', 'gejala'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = [
            'no' => 'required|numeric|min:1|unique:pertanyaan,no',
            'type' => 'in:number,text,select,choice',
            'pertanyaan' => 'required',
            'parent' => 'nullable',
            'ya' => 'nullable',
            'tidak' => 'nullable'
        ];

        if ($request->type == 'number') {
            $validate['jawaban'] = 'nullable';
        } elseif ($request->type == 'text') {
            $validate['jawaban'] = 'nullable';
        } elseif ($request->type == 'select') {
            $validate['jawaban'] = 'required';
        } elseif ($request->type == 'choice') {
            $validate['jawaban'] = 'required';
        }

        $this->validate($request, $validate);

        $pertanyaan = new Pertanyaan;
        $pertanyaan->no = $request->no;
        $pertanyaan->type = $request->type;
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->jawaban = $request->jawaban;
        $pertanyaan->parent = $request->parent;
        $pertanyaan->ya = $request->ya;
        $pertanyaan->tidak = $request->tidak;
        $pertanyaan->save();

        session()->flash('created', 'Berhasil menambahkan data');
        return redirect('question');
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
        $pertanyaan = Pertanyaan::where('id', $id)->first();
        $type = [
            'number' => 'Number',
            'text' => 'Text',
            'select' => 'Select',
            'choice' => 'choice'
        ];
        $gejala = Gejala::pluck('nama_gejala', 'kode');
        $penyakit = Penyakit::pluck('nama_penyakit', 'kode');
        return view('admin.pertanyaan.edit', compact('pertanyaan', 'type', 'penyakit', 'gejala'));
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
        $pertanyaan = Pertanyaan::where('id', $id)->firstOrFail();

        $validate = [
            'no' => 'required|numeric|min:1|unique:pertanyaan,no,' .  $pertanyaan->no . ',no',
            'type' => 'in:number,text,select,choice',
            'pertanyaan' => 'required',
            'parent' => 'nullable',
            'ya' => 'nullable',
            'tidak' => 'nullable'
        ];

        if ($request->type == 'number') {
            $validate['jawaban'] = 'nullable';
        } elseif ($request->type == 'text') {
            $validate['jawaban'] = 'nullable';
        } elseif ($request->type == 'select') {
            $validate['jawaban'] = 'required';
        } elseif ($request->type == 'choice') {
            $validate['jawaban'] = 'required';
        }

        $this->validate($request, $validate);

        $pertanyaan->no = $request->no;
        $pertanyaan->type = $request->type;
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->jawaban = $request->jawaban;
        $pertanyaan->parent = $request->parent;
        $pertanyaan->ya = $request->ya;
        $pertanyaan->tidak = $request->tidak;
        $pertanyaan->update();

        session()->flash('update', 'Berhasil memperbarui data');
        return redirect('question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::where('id', $id)->firstOrFail();
        $pertanyaan->delete();
        session()->flash('delete', 'Berhasil menghapus data');
        return response()->json($pertanyaan);
    }
}
