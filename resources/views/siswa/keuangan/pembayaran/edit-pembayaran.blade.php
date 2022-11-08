<div id="edit-pembayaran-{{ $pembayaran->id_pembayaran }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Pembayaran</h5>
        <form method="POST" action="/pembayaran/update">
            @csrf
            <input type="hidden" name="id_pembayaran" value="{{ $pembayaran->id_pembayaran }}">
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_pembayaran" placeholder="Nama pembayaran" value="{{ $pembayaran->nama_pembayaran }}" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="number" name="nominal" placeholder="Nominal" value="{{ $pembayaran->nominal }}" required>
            </div>
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                @foreach ($dataKelas as $kelas)
                    <label>
                        @php
                            $xplodeKelas = explode('#', $pembayaran->kelas)
                        @endphp
                        <input name="kelas[]" class="uk-checkbox" type="checkbox" value="{{ $kelas->id_kelas }}" {{ (array_search($kelas->id_kelas, $xplodeKelas)) ? 'checked' : '' }}>
                        {{ $kelas->tingkat }} {{ $kelas->jurusan }}
                    </label>
                @endforeach
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>