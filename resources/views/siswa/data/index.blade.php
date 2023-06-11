<a class="uk-margin" href="#modal-center" uk-toggle="target: #add-siswa" uk-icon="icon: plus"></a>
@include('siswa.data.add-siswa')
<a class="uk-margin" href="#modal-center" uk-toggle="target: #import-siswa" uk-icon="icon: upload"></a>
@include('siswa.data.import-siswa')

<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<form action="/siswa" method="get" id="submitKelas">
    <div class="uk-margin">
        <select name="id_kelas" class="uk-select" id="" onchange="this.form.submit()" onsubmit="submitKelas(); return false">
            <option value="">Pilih Kelas</option>
            @foreach ($dataKelas as $kelas)
                &nbsp; <option {{ ($kelas->id_kelas === request('id_kelas')) ? 'selected' : '' }} value="{{ $kelas->id_kelas }}">{{ $kelas->tingkat }} {{ $kelas->jurusan }}</option>
            @endforeach
        </select>
    </div>
</form>

@foreach ($kelasSelected as $kelas)    
    <div class="uk-margin">
        <h5>Data Siswa Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan }}</h5>
    </div>
@endforeach
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataSiswa as $siswa)    
            <tr>
                <td>{{ $ai++ }}</td>
                <td>{{ $siswa->id_siswa }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-siswa-{{ $siswa->id_siswa }}"></a> &nbsp;
                    @include('siswa.data.edit-siswa')
                    <a href="#modal-overflow" uk-icon="trash" uk-toggle="target: #delete-siswa-{{ $siswa->id_siswa }}"></a>
                    @include('siswa.data.delete-siswa')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $(document).on('submit', '#submitKelas', function() {
            // do your things
            return false;
        });
    });
</script>