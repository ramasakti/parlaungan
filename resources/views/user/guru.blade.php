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
        @foreach ($userGuru as $guru)    
            <tr>
                <th scope="row">{{ $ai++ }}</th>
                <td>{{ $guru->username }}</td>
                <td>{{ $guru->status }}</td>
                <td>
                    @php
                        $user = DB::table('user')->where('username', $guru->username)->get();
                    @endphp
                    <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-user-{{ $guru->username }}">
                    </a> &nbsp;
                    @include('user.edit-user')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>