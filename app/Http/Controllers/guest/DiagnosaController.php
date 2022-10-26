<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\admin\Aturan;
use App\Models\admin\Gejala;
use App\Models\admin\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NlpTools\Similarity\CosineSimilarity;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            session()->flash('danger', 'if you want try consultation, you must be logout!');
            return redirect('home');
        }
        if (empty(session('name')) && empty(session('email'))) {
            session()->flash('danger', 'Anda belum mengisi formulir pendaftaran!');
            return redirect('konsultasi');
        }

        $gejala = Gejala::all();

        return view('guest.select', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # function standart similarity
        function similarity($a = array(), $b = array())
        {
            $c = 0;
            foreach ($a as $i) {
                if (in_array($i, $b)) $c++;
            }
            return ($c / count($a)) * 100;
        };

        $this->validate($request, [
            'gejala' => 'required|array|min:1'
        ]);
        $implode = implode(",", $request->gejala);
        # get kode penyakit
        $aturan = Aturan::where('aturan', $implode)->first();
        # get gejala berdasarkan kode
        foreach ($request->gejala as $key => $value) {
            $exp = Gejala::where('kode', $value)->first();
            $data[$key] = $exp->nama_gejala;
        }
        # Reuse jika gejala yang di alami == aturan || hitung similarity dan simpan sebagai case baru
        if (!empty($aturan)) {
            $penyakit = Penyakit::where('kode', $aturan->penyakit)->first();
            $solusi = explode(",", $penyakit->solusi);
            return view('guest.hasil_select', compact('solusi', 'penyakit', 'data'))->with(session()->flush());
        } else {
            $rule = Aturan::all();
            foreach ($rule as $key => $value) {
                $explode[$key] = explode(",", $value->aturan);
                # enable/disable standart similarity 
                // $percent[$key] = [
                //     'kode' => $value->penyakit,
                //     'percent' => similarity(
                //         $request->gejala,
                //         $explode[$key]
                //     )
                // ];
                # enable/disable cosine similarity
                $val = $request->input('gejala');
                $similarity = new CosineSimilarity;
                $percent[$key] = [
                    'kode' => $value->penyakit,
                    'percent' => $similarity->similarity($val, $explode[$key]) * 100
                ];
            }
            $max = max(array_column($percent, 'percent'));
            $search = array_search($max, array_column($percent, 'percent'));
            $penyakits[$search] = Penyakit::where('kode', $percent[$search]['kode'])->first();
            $percentase[$search] = number_format($max, 2);
            $solusi = explode(",", $penyakits[$search]->solusi);

            # enable for save case
            $save = new Aturan;
            $save->kode = $save->kode();
            $save->penyakit = $penyakits[$search]->kode;
            $save->aturan = $implode;
            $save->save();

            session()->flash('danger', 'In development process');
            return view('guest.hasil_select', compact('data', 'penyakits', 'percentase', 'solusi'))->with(session()->flush());
        }
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
        //
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
        //
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
}
