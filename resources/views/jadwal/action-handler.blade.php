<td>
    @if (session('status') === 'Admin' || session('status') === 'Kurikulum')
        <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-jadwal-{{ $jadwal->id_jadwal }}">
        </a>&nbsp;
        @include('jadwal.delete-jadwal')
        <a href="#modal-center" uk-icon="file-text" uk-toggle="target: #manual-{{ $jadwal->id_jadwal }}">
        </a>
        @include('jadwal.manual')
    @endif
</td>