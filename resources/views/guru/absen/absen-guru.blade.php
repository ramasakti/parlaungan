<div id="absen-guru-{{ $showGuru->id_guru }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Guru</h5>
        <form id="fAddGuru" method="POST" action="/guru/absen">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="hidden" name="id_guru" value="{{ $showGuru->id_guru }}" required>
            </div>
            <div class="uk-margin">
                <label for="">Keterangan</label>
                <select name="keterangan" class="uk-select">
                    <option selected disabled>Pilih Keterangan</option>
                    <option value="S">Sakit</option>
                    <option value="I">Izin</option>
                    <option value="A">Alfa</option>
                </select>
            </div>
            <button id="bAddGuru" type="submit" class="uk-button uk-button-primary uk-button-small" onclick="addGuru()" onsubmit="addGuru()">Simpan</button>
        </form>
    </div>
</div>
<script>
    const fAddGuru = document.getElementById('fAddGuru')
    const bAddGuru = document.getElementById('bAddGuru')
    const addGuru = () => {
        bAddGuru.setAttribute('disabled', '')
        bAddGuru.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        fAddGuru.submit()
    }
</script>