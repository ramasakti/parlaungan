<div id="edit-jampel-{{ $jampel->id_jampel }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit Jampel</h5>
        <form method="POST" action="/jampel/update">
            @csrf
            <input type="hidden" name="id_jampel" value="{{ $jampel->id_jampel }}">
            <div class="uk-margin">
                <select class="uk-select" name="hari" id="hari">
                    @foreach ($dataHari as $hari)
                        <option value="{{ $hari->nama_hari }}" {{ ($hari->nama_hari == $jampel->hari) ? 'selected' : ''}}>{{ $hari->nama_hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="text" name="keterangan" placeholder="Keterangan" value="{{ $jampel->keterangan }}">
            </div>
            <div class="uk-margin">
                <input name="mulai" placeholder="Mulai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ $jampel->mulai }}" required>
            </div>
            <div class="uk-margin">
                <input name="selesai" placeholder="Selesai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ $jampel->selesai }}" required>
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>
<script>  
    $('#jampel').select2();
</script>