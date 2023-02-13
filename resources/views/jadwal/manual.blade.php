<div id="manual-{{ $jadwal->id_jadwal }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Presensi Guru Manual</h5>
        <form method="POST" action="/jadwal/manual">
            @csrf

            <div class="uk-margin">
                <p>Jadwal Hari {{ $jadwal->hari }} Mapel {{ $jadwal->mapel }}</p>
            </div>
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">
            <div class="uk-margin">
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label><input name="invalidate" id="status-inval-{{ $jadwal->id_jadwal }}" value="1" class="uk-checkbox" type="checkbox" onchange="invalidation({{ $jadwal->id_jadwal }})"> Inval</label>
                </div>
            </div>
            <div id="wadah-{{ $jadwal->id_jadwal }}"></div>
            <div class="uk-margin">
                <select id="guru-{{ $jadwal->id_jadwal }}" class="uk-select" name="guru_id" required disabled>
                    <option value="">Pilih Guru</option>
                    @foreach ($dataGuru as $guru)
                        <option {{ ($jadwal->guru_id == $guru->id_guru) ? 'selected' : '' }} value="{{ $guru->id_guru }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-margin">
                <input name="masuk" placeholder="Mulai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ date('H:i') }}">
            </div>
            <div class="uk-margin">
                <input name="sampai" placeholder="Sampai" class="textbox-n uk-input" type="text" onfocus="(this.type='time')" id="time" value="{{ $jadwal->sampai }}">
            </div>
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>