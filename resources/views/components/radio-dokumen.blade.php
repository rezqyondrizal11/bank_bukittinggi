<input type="hidden" name="dokumen[{{ $i }}][jenis_dokumen]" value="{{ $nama }}">

<td class="text-center">
    <input type="radio" name="dokumen[{{ $i }}][opsi]" value="Ada" required>
</td>

<td class="text-center">
    <input type="radio" name="dokumen[{{ $i }}][opsi]" value="Tidak Ada" required>
</td>

<td>
    <input type="text" name="dokumen[{{ $i }}][keterangan]" class="form-control">
</td>
