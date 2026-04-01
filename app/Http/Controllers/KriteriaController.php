<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\KriteriaAHP;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'kode_kriteria' => 'required',
            'jenis' => 'required',
            'bobot' => 'required',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriterias.index')
            ->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        Kriteria::findOrFail($id)->update($request->all());

        return redirect()->route('kriterias.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        Kriteria::destroy($id);
        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function prioritas(Request $request)
    {
        $kriteria = Kriteria::all();

        $list_data = $list_data2 = $list_data3 = $list_data4 = $list_data5 = null;
        if ($request->has('save')) {

            KriteriaAHP::truncate();

            foreach ($kriteria as $i => $row1) {
                foreach ($kriteria as $ii => $row2) {
                    if ($i < $ii) {
                        $nilai_input = $request->input("nilai_{$row1->id_kriteria}_{$row2->id_kriteria}");

                        if ($nilai_input < 1) {
                            $nilai1 = abs($nilai_input);
                            $nilai2 = 1 / abs($nilai_input);
                        } elseif ($nilai_input > 1) {
                            $nilai1 = 1 / abs($nilai_input);
                            $nilai2 = abs($nilai_input);
                        } else {
                            $nilai1 = 1;
                            $nilai2 = 1;
                        }

                        KriteriaAHP::create([
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => round($nilai1, 5),
                            'nilai_2' => round($nilai2, 5)
                        ]);
                    }
                }
            }

            return back()->with('success', 'Nilai AHP berhasil disimpan!');
        }
        if ($request->has('check')) {
            if ($kriteria->count() < 3) {
                return back()->with('pesan_error', 'Minimal 3 kriteria!');
            }

            $ids = $kriteria->pluck('id_kriteria')->toArray();

            $matrik = $this->getMatrik($ids);
            $jumlahKolom = $this->getJumlahKolom($matrik);
            $normalisasi = $this->getNormalisasi($matrik, $jumlahKolom);
            $prioritas = $this->getPrioritas($normalisasi);
            $matrikBaris = $this->getMatrikBaris($prioritas, $matrik);
            $jumlahBaris = $this->getJumlahBaris($matrikBaris);
            $tabelKonsistensi = $this->getTabelKonsistensi($jumlahBaris, $prioritas);

            if ($this->ujiKonsistensi($tabelKonsistensi)) {

                foreach ($kriteria as $i => $row) {
                    $row->update(['bobot' => $prioritas[$i]]);
                }

                $list_data  = $this->viewMatrik($kriteria, $matrik, $jumlahKolom);
                $list_data2 = $this->viewNormalisasi($kriteria, $normalisasi, $prioritas);
                $list_data3 = $this->viewMatrikBaris($kriteria, $matrikBaris, $jumlahBaris);
                [$list_data4, $list_data5] = $this->viewKonsistensi($kriteria, $jumlahBaris, $prioritas);
            } else {
                return back()->with('pesan_error', 'Nilai perbandingan tidak konsisten!');
            }
        }

        $result = [];

        foreach ($kriteria as $i => $row1) {
            foreach ($kriteria as $ii => $row2) {

                if ($i < $ii) {

                    $ahp = KriteriaAHP::where([
                        'id_kriteria_1' => $row1->id_kriteria,
                        'id_kriteria_2' => $row2->id_kriteria
                    ])->first();

                    if (!$ahp) {
                        KriteriaAHP::create([
                            'id_kriteria_1' => $row1->id_kriteria,
                            'id_kriteria_2' => $row2->id_kriteria,
                            'nilai_1' => 1,
                            'nilai_2' => 1
                        ]);
                        $nilai_1 = 1;
                        $nilai_2 = 1;
                    } else {
                        $nilai_1 = $ahp->nilai_1;
                        $nilai_2 = $ahp->nilai_2;
                    }
                    $nilai = 0;
                    if ($nilai_1 < 1) {
                        $nilai = $nilai_2;
                    } elseif ($nilai_1 > 1) {
                        $nilai = -$nilai_1;
                    } elseif ($nilai_1 == 1) {
                        $nilai = 1;
                    }
                    $result[$row1->id_kriteria][$row2->id_kriteria] = $nilai;
                }
            }
        }

        $kriteria_ahp = $result;

        return view('kriteria.prioritas', compact(
            'kriteria',
            'result',
            'list_data',
            'list_data2',
            'list_data3',
            'list_data4',
            'list_data5',
            'kriteria_ahp'
        ));
    }

    public function reset()
    {
        KriteriaAHP::truncate();
        Kriteria::query()->update(['bobot' => null]);

        return back()->with('success', 'Data berhasil direset!');
    }

    private function getMatrik($ids)
    {
        $n = count($ids);
        $matrik = array_fill(0, $n, array_fill(0, $n, 1));

        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {

                $ahp = KriteriaAHP::where([
                    'id_kriteria_1' => $ids[$i],
                    'id_kriteria_2' => $ids[$j]
                ])->first();

                if ($ahp) {
                    $matrik[$i][$j] = $ahp->nilai_1;
                    $matrik[$j][$i] = $ahp->nilai_2;
                } else {
                    $matrik[$i][$j] = 1;
                    $matrik[$j][$i] = 1;
                }
            }
        }
        return $matrik;
    }

    private function getJumlahKolom($matrik)
    {
        $n = count($matrik);
        $jumlah = [];

        for ($i = 0; $i < $n; $i++) {
            $jumlah[$i] = 0;
            for ($j = 0; $j < $n; $j++) {
                $jumlah[$i] += $matrik[$j][$i];
            }
        }
        return $jumlah;
    }

    private function getNormalisasi($matrik, $jumlah)
    {
        $n = count($matrik);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $matrik[$i][$j] = number_format($matrik[$i][$j] / $jumlah[$j], 5);
            }
        }
        return $matrik;
    }

    private function getPrioritas($matrik_normalisasi)
    {
        $prioritas = array();
        for ($i = 0; $i < count($matrik_normalisasi); $i++) {
            $prioritas[$i] = 0;
            for ($ii = 0; $ii < count($matrik_normalisasi); $ii++) {
                $prioritas[$i] = $prioritas[$i] + $matrik_normalisasi[$i][$ii];
            }
            $prioritas[$i] = number_format($prioritas[$i] / count($matrik_normalisasi), 5);
        }
        return $prioritas;
    }

    private function getMatrikBaris($prioritas, $matrik)
    {
        $matrik_baris = array();
        for ($i = 0; $i < count($matrik); $i++) {
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $matrik_baris[$i][$ii] = number_format($prioritas[$ii] * $matrik[$i][$ii], 5);
            }
        }
        return $matrik_baris;
    }

    private function getJumlahBaris($matrik)
    {
        $jumlah_baris = array();
        for ($i = 0; $i < count($matrik); $i++) {
            $jumlah_baris[$i] = 0;
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $jumlah_baris[$i] = $jumlah_baris[$i] + $matrik[$i][$ii];
            }
        }
        return $jumlah_baris;
    }

    private function getTabelKonsistensi($jumlah_matrik_baris, $prioritas)
    {
        $jumlah = array();
        for ($i = 0; $i < count($jumlah_matrik_baris); $i++) {
            $jumlah[$i] = $jumlah_matrik_baris[$i] + $prioritas[$i];
        }

        return $jumlah;
    }

    private function ujiKonsistensi($tabel)
    {
        $jumlah = array_sum($tabel);

        $n = count($tabel);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        if ($cr <= 0.1) {
            return true;
        } else {
            return false;
        }
    }

    private function viewMatrik($kriteria, $matrik, $jumlahKolom)
    {
        $html = '<tr><td></td>';
        foreach ($kriteria as $k) {
            $html .= '<td class="text-center">' . $k->kode_kriteria . '</td>';
        }
        $html .= '</tr>';

        foreach ($kriteria as $i => $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->kode_kriteria . '</td>';

            foreach ($kriteria as $ii => $row2) {
                $html .= '<td class="text-center">' . $matrik[$i][$ii] . '</td>';
            }

            $html .= '</tr>';
        }

        $html .= '<tr><td class="fw-bold">Jumlah</td>';
        foreach ($jumlahKolom as $j) {
            $html .= '<td class="text-center fw-bold">' . $j . '</td>';
        }
        $html .= '</tr>';

        return $html;
    }


    private function viewNormalisasi($kriteria, $normalisasi, $prioritas)
    {
        $html = '<tr><td></td>';
        foreach ($kriteria as $k) {
            $html .= '<td class="text-center">' . $k->kode_kriteria . '</td>';
        }
        $html .= '<td class="fw-bold text-center">Jumlah</td>';
        $html .= '<td class="fw-bold text-center">Prioritas</td>';
        $html .= '</tr>';

        foreach ($kriteria as $i => $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->kode_kriteria . '</td>';

            $jumlah = 0;
            foreach ($kriteria as $ii => $row2) {
                $v = $normalisasi[$i][$ii];
                $jumlah += $v;
                $html .= '<td class="text-center">' . $v . '</td>';
            }

            $html .= '<td class="fw-bold text-center">' . $jumlah . '</td>';
            $html .= '<td class="fw-bold text-center">' . $prioritas[$i] . '</td>';
            $html .= '</tr>';
        }

        return $html;
    }


    private function viewMatrikBaris($kriteria, $matrikBaris, $jumlahBaris)
    {
        $html = '<tr><td></td>';
        foreach ($kriteria as $k) {
            $html .= '<td class="text-center">' . $k->kode_kriteria . '</td>';
        }
        $html .= '<td class="fw-bold text-center">Jumlah</td>';
        $html .= '</tr>';

        foreach ($kriteria as $i => $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row->kode_kriteria . '</td>';

            foreach ($kriteria as $ii => $row2) {
                $html .= '<td class="text-center">' . $matrikBaris[$i][$ii] . '</td>';
            }

            $html .= '<td class="fw-bold text-center">' . $jumlahBaris[$i] . '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    private function viewKonsistensi($kriteria, $jumlahBaris, $prioritas)
    {
        $html = '<tr>
                <td></td>
                <td class="text-center">Jumlah per Baris</td>
                <td class="text-center">Prioritas</td>
            </tr>';

        foreach ($kriteria as $i => $row) {
            $html .= '<tr>
                    <td>' . $row->kode_kriteria . '</td>
                    <td class="text-center">' . $jumlahBaris[$i] . '</td>
                    <td class="text-center">' . $prioritas[$i] . '</td>
                  </tr>';
        }

        $n = count($jumlahBaris);
        $lambda = array_sum($jumlahBaris);
        $ci = ($lambda - $n) / ($n - 1);

        $irList = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];
        $ir = $n <= 15 ? $irList[$n - 1] : $irList[14];

        $cr = $ir == 0 ? 0 : round($ci / $ir, 5);

        $extra = "
    <table class='table'>
        <tr><td width='100'>n</td><td>= $n</td></tr>
        <tr><td>λ maks</td><td>= " . number_format($lambda, 5) . "</td></tr>
        <tr><td>CI</td><td>= " . number_format($ci, 5) . "</td></tr>
        <tr><td>CR</td><td>= $cr</td></tr>
        <tr>
            <td>CR ≤ 0.1</td>
            <td>" . ($cr <= 0.1 ? 'Konsisten' : 'Tidak Konsisten') . "</td>
        </tr>
    </table>";

        return [$html, $extra];
    }
}
