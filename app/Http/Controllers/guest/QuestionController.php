<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\admin\Gejala;
use App\Models\admin\History;
use App\Models\admin\HistoryGejala;
use App\Models\admin\Penyakit;
use App\Models\admin\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class QuestionController extends Controller
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
        # redirect jika belum mengisi nama dan email
        if (empty(session('name')) && empty(session('email'))) {
            session()->flash('danger', 'Anda belum mengisi formulir pendaftaran!');
            return redirect('konsultasi');
        }
        $token = Session::token();
        $pertanyaan = Pertanyaan::simplePaginate(1);
        # identitas page
        if (empty($request->page)) {
            $page = 1;
        } else {
            $page = $request->page;
        }
        # sesi jawaban
        $sesi = Session::get('jawaban' . $page);
        # pertanyaan
        $pertanyaan = Gejala::simplePaginate(1);
        $gejala = Gejala::all();
        # pilihan jawaban
        $select = [
            'Ya' => 'Ya',
            'Tidak' => 'Tidak'
        ];
        return view('guest.question', compact('token', 'pertanyaan', 'select', 'page', 'sesi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        # if need kode gejala
        function kode($page)
        {
            $null = '';
            $kode = $page;
            if (strlen((string)$kode) == 1) {
                $null = "0";
            }
            $kode = "G" . $null . $kode;
            return $kode;
        }

        $this->validate($request, [
            'jawaban' => 'required',
            'page' => 'required'
        ]);
        $pertanyaan = Pertanyaan::where('no', $request->page)->first();
        # ini buat pindah ke page selanjutnya dengan kondisi
        if ($request->jawaban == "Ya") {
            # jawaban ya == di alami, push gejala yang dialami
            if (empty(session()->get('gejala'))) {
                $request->session()->push('gejala', $pertanyaan->pertanyaan);
            } else {
                if (!in_array($pertanyaan->pertanyaan, session()->get('gejala'), true)) {
                    $request->session()->push('gejala', $pertanyaan->pertanyaan);
                }
            }
            $request->session()->put(['jawaban' . $request->page => $request->jawaban]);
            # Check data penyakit
            $penyakit = Penyakit::where('kode', $pertanyaan->ya)->first();
            # if found data penyakit
            if (!empty($penyakit)) {
                # get data gejala yang di alami user
                $user_gejala = session()->get('gejala');
                foreach ($user_gejala as $key => $value) {
                    $gejala[$key] = Gejala::where('kode', $value)->first();
                }
                $id = Uuid::uuid4();
                # history save
                $history = new History;
                $history->id = $id;
                $history->name = session('name');
                $history->email = session('email');
                $history->penyakit = $penyakit->nama_penyakit;
                $history->save();
                # history gejala save
                foreach ($gejala as $key => $value) {
                    $history_gejala = new HistoryGejala;
                    $history_gejala->history_id = $id;
                    $history_gejala->gejala = $value->nama_gejala;
                    $history_gejala->save();
                }
                $solusi = explode(",", $penyakit->solusi);
                return view('guest.hasil_diagnosa', compact('gejala', 'penyakit', 'solusi'))->with(session()->flush());
            } else {
                if (!empty($pertanyaan->ya)) {
                    $preg = preg_replace('/\D/', '', $pertanyaan->ya);
                    $page = intval($preg);
                } else {
                    $page = $request->page + 1;
                }
                $url = 'question/guest?page=' . $page;
                return redirect($url);
            }
        } elseif ($request->jawaban == "Tidak") {
            $request->session()->put(['jawaban' . $request->page => $request->jawaban]);
            # check data penyakit
            $penyakit = Penyakit::where('kode', $pertanyaan->tidak)->first();
            # if found data penyakit
            if (!empty($penyakit)) {
                # get data gejala yang di alami user
                $user_gejala = session()->get('gejala');
                foreach ($user_gejala as $key => $value) {
                    $gejala[$key] = Gejala::where('kode', $value)->first();
                }
                $id = Uuid::uuid4();
                # history save
                $history = new History;
                $history->id = $id;
                $history->name = session('name');
                $history->email = session('email');
                $history->penyakit = $penyakit->nama_penyakit;
                $history->save();
                # history gejala save
                foreach ($gejala as $key => $value) {
                    $history_gejala = new HistoryGejala;
                    $history_gejala->history_id = $id;
                    $history_gejala->gejala = $value->nama_gejala;
                    $history_gejala->save();
                }
                $solusi = explode(",", $penyakit->solusi);
                return view('guest.hasil_diagnosa', compact('gejala', 'penyakit', 'solusi'))->with(session()->flush());
            } else {
                if (!empty($pertanyaan->tidak)) {
                    $preg = preg_replace('/\D/', '', $pertanyaan->tidak);
                    $page = intval($preg);
                } else {
                    $page = $request->page + 1;
                }
                $url = 'question/guest?page=' . $page;
                return redirect($url);
            }
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
