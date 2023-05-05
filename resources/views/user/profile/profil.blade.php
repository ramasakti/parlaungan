<div class="container">
    <form class="uk-form-horizontal uk-margin-small mt-3">

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Nama Lengkap</label>
            <div class="uk-form-controls">
                @switch(session('status'))
                    @case('Siswa')
                        <input class="uk-input" type="text" value="{{ $dataUser[0]->nama_siswa }}">
                        @break
                    @case('Walmur')
                        <input class="uk-input" type="text" value="{{ $dataUser[0]->nama_walmur }}">
                        @break
                    @default
                        <input class="uk-input" type="text" value="{{ $dataUser[0]->nama_guru }}">
                @endswitch
            </div>
        </div>
    
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Tempat Lahir</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="text" value="{{ $dataUser[0]->tempat_lahir }}">
            </div>
        </div>
    
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Tanggal Lahir</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="date" value="{{ $dataUser[0]->tanggal_lahir }}">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Telp / WA</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="text" value="{{ $dataUser[0]->telp }}">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Alamat</label>
            <div class="uk-form-controls">
                <textarea name="alamat" id="textarea" cols="30" rows="3" class="uk-textarea">{{ $dataUser[0]->alamat }}</textarea>
            </div>
        </div>
    
        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit">Simpan</button>
        
    </form>
</div>