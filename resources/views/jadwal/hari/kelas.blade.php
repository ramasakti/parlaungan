<form action="/jadwal" method="get">
    <select class="uk-margin uk-select" name="id_kelas" id="" onchange="this.form.submit()">
        <option value="">Pilih Kelas</option>
        @foreach ($dataKelas as $kelas)
            <option value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
        @endforeach
    </select>
</form>
@include('jadwal.hari.alert')