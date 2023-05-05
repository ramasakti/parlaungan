    <a href="#import" uk-icon="icon: cloud-upload" uk-toggle></a>
    @include('siswa.kelulusan.import')

    <table class="uk-table uk-table-hover uk-table-divider">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Status</th>
                <th>Handler</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataKelulusan as $item)
                <tr>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td>
                        @if ($item->lulus == true)
                            LULUS
                        @else
                            TIDAK LULUS
                        @endif    
                    </td>
                    <td>
                        <a href="#edit-{{ $item->nisn }}" uk-icon="icon: settings" uk-toggle></a>
                        @include('siswa.kelulusan.edit')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>