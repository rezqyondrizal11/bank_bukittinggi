<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\SubKriteria;


class SubKriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::with('subKriterias')->get();

        return view('sub-kriteria.index', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required|numeric'
        ]);

        SubKriteria::create([
            'id_kriteria' => $request->id_kriteria,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai,
        ]);

        return back()->with('success', 'Sub Kriteria berhasil ditambahkan');
    }


    public function update(Request $request, SubKriteria $subKriteria)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nilai' => 'required|numeric'
        ]);

        $subKriteria->update($request->all());

        return back()->with('success', 'Sub Kriteria berhasil diupdate');
    }

    public function destroy(SubKriteria $subKriteria)
    {
        $subKriteria->delete();

        return back()->with('success', 'Sub Kriteria berhasil dihapus');
    }
}
