<div id="edit-absen-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Absen Siswa</h5>
        <form id="fEditAbsen" method="POST" action="/absen/update">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="id_siswa" value="{{ $siswa->id_siswa }}" readonly>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}" readonly>
            </div>
            <div class="uk-margin">
                <select name="keterangan" id="" class="uk-select">
                    <option value=""></option>
                    <option {{ ($siswa->keterangan === 'S') ? 'selected' : '' }} value="S">Sakit</option>
                    <option {{ ($siswa->keterangan === 'I') ? 'selected' : '' }} value="I">Izin</option>
                    <option {{ ($siswa->keterangan === 'A') ? 'selected' : '' }} value="A">Alfa</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Terlambat">Terlambat</option>
                </select>
            </div>
            <button id="bEditAbsen" type="submit" class="uk-button uk-button-primary uk-button-small" onclick="updateAbsen()" onsubmit="updateAbsen()">Simpan</button>
        </form>
    </div>
</div>
<script>
    const fEditAbsen = document.getElementById('fEditAbsen')
    const bEditAbsen = document.getElementById('bEditAbsen')
    const updateAbsen = () => {
        bEditAbsen.setAttribute('disabled', '')
        bEditAbsen.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        fEditAbsen.submit()
    }
</script>