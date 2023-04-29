<table class="table table-borderless" id="tabel-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Status</th>
            <th scope="col">Handler</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userSiswa as $siswa)    
            <tr>
                <th scope="row">{{ $ai++ }}</th>
                <td>{{ $siswa->username }}</td>
                <td>{{ $siswa->status }}</td>
                <td>
                    @php
                        $user = DB::table('user')->where('username', $siswa->username)->get();
                    @endphp
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-user-{{ $siswa->username }}">
                    </a> &nbsp;
                    @include('user.edit-user')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>