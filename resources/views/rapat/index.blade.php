<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <a href="#modal-center" uk-toggle="target: #add-rapat" uk-icon="icon: plus" class="uk-margin-small-bottom"></a>
    @include('rapat.add-rapat')
    @if (session()->has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session()->has('failed'))
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('failed') }}</p>
        </div>
    @endif
    @if (session()->has('deleted'))
        <div class="uk-alert-warning" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('deleted') }}</p>
        </div>
    @endif
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Penyelenggara</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Handler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataRapat as $rapat)    
                <tr>
                    <td>{{ $ai++ }}</td>
                    <td>{{ $rapat->judul }}</td>
                    <td>{{ $rapat->penyelenggara }}</td>
                    <td>{{ $rapat->tanggal }} {{ $rapat->mulai }} s/d {{ $rapat->sampai }}</td>
                    <td>
                        <a href="#modal-center" uk-icon="settings" uk-toggle="target: #edit-rapat-{{ $rapat->id_rapat }}">
                        </a> &nbsp;
                        @include('rapat.edit-rapat')
                        <a href="#modal-center" uk-icon="trash" uk-toggle="target: #delete-rapat-{{ $rapat->id_rapat }}">
                        </a> &nbsp;
                        @include('rapat.delete-rapat')
                        <a href="/rapat/{{ $rapat->slug }}/" uk-icon="link" target="blank">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');
    
        judul.addEventListener('keyup', function () {
            let preslug = judul.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });
    </script>
</x-admintemplate>