<div id="add-arsip" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Add Arsip</h5>
        <form method="POST" action="/arsip/store" enctype="multipart/form-data">
            @csrf
            <div class="uk-margin">
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label><input class="uk-radio" type="radio" name="jenis" value="K" onclick="InOut('out')" required> Keluar</label>
                    <label><input class="uk-radio" type="radio" name="jenis" value="M" onclick="InOut('in')" required> Masuk</label>
                </div>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
            </div>
            <div id="form-arsip"></div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="perihal" placeholder="Perihal" required>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="file" name="surat" id="surat" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Tambah</button>
        </form>
    </div>
</div>
<script>
    const formArsip = document.getElementById('form-arsip')
    const bulanRomawi = () => {
        const date = new Date()
        const bulan = date.getMonth()
        
        switch (bulan) {
            case 0:
                return 'I'
                break;
            case 1:
                return 'II'
                break;
            case 2:
                return 'III'
                break;
            case 3:
                return 'IV'
                break;
            case 4:
                return 'V'
                break;
            case 5:
                return 'VI'
                break;
            case 6:
                return 'VII'
                break;
            case 7:
                return 'VIII'
                break;
            case 8:
                return 'IX'
                break;
            case 9:
                return 'X'
                break;
            case 10:
                return 'XI'
                break;
            case 11:
                return 'XII'
                break;
        }
    }

    const regex = () => {
        const string = {{ $lastData }}
        if (string.toString().length == 1) {
            return '00'
        }else if (string.toString().length == 2) {
            return '0'
        }else{
            return ''
        }
    }

    const formMasuk = `
        <div class="uk-margin">
            <input class="uk-input" type="text" name="nomor" placeholder="Instansi Pengirim" required>
        </div>
    `
    const formKeluar = `
            <div class="uk-margin">
                <input class="uk-input" type="text" name="nomor" value="K.6/${regex()}{{ $lastData+1 }}/E.14/404.31.046/${bulanRomawi()}/{{ date('Y') }}" required>
            </div>
    `
    
    const InOut = (status) => status == 'in' ? formArsip.innerHTML = formMasuk : formArsip.innerHTML = formKeluar
</script>