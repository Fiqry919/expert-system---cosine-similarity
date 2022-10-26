<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\History;
use App\Models\admin\HistoryGejala;
use App\Models\admin\Penyakit;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.history.index', compact('history'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history = History::where('id', $id)->first();
        $gejala = HistoryGejala::where('history_id', $history->id)->get();

        $getSolusi = Penyakit::where('nama_penyakit', $history->penyakit)->firstOrFail();
        if (!empty($getSolusi)) {
            $solusi = explode(",", $getSolusi->solusi);
            return view('admin.history.show', compact('history', 'gejala', 'solusi'));
        } else {
            return view('admin.history.show', compact('history', 'gejala'));
        }
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
        $history = History::where('id', $id)->first();
        $history->delete();

        session()->flash('delete', 'Berhasil menghapus data');
        return response()->json($history);
    }
}
