<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <ul class="uk-iconnav uk-margin">
        <li>
            <a href="#modal-center" class="mx-2" uk-toggle="target: #add-user" uk-icon="icon: plus"></a>
            @include('user.add-user')
        </li>
        {{-- <li>
            <a href="#modal-center" uk-toggle="target: #import-user" uk-icon="icon: upload"></a>
            @include('user.import-user')
        </li> --}}
    </ul>

    @error('username') 
        <div class="uk-alert-danger mt-0 mb-0 mx-3 uk-padding-remove-vertical" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>Gagal! Username minimal 8 karakter dan unik!</p>
        </div>
    @enderror
    @error('password') 
        <div class="uk-alert-danger mt-0 mb-0 mx-3 uk-padding-remove-vertical" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>Gagal! Password minimal 8 karakter!</p>
        </div>
    @enderror

    <table class="table table-borderless" id="tabel-data">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Telp</th>
                <th scope="col">Status</th>
                <th scope="col">Handler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $user)    
                <tr>
                    <th scope="row">{{ $ai++ }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->telp }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <a href="#modal-center" uk-toggle="target: #edit-user-{{ $user->username }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a> &nbsp;
                        @include('user.edit-user')
                        <a href="#modal-center" uk-toggle="target: #delete-user-{{ $user->username }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                        @include('user.delete-user')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admintemplate>