<div class="container">
    @if (session()->has('biodata'))
        <div class="uk-alert-success uk-margin-small-top" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('biodata') }}</p>
        </div>
    @endif
    
    <form id="fBiodata" class="uk-form-horizontal uk-margin-small mt-3" method="POST" action="/biodata/update">
        @csrf
        <input type="hidden" name="siswa_id" value="{{ session('username') }}">
        <h5>Data Siswa</h5>
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">NISN</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="nisn" id="nisn" value="{{ $dataUser[0]->nisn }}">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">NIK</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="nik" id="nik" value="{{ $dataUser[0]->nik }}">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">NO KK</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="nokk" id="nokk" value="{{ $dataUser[0]->nokk }}">
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Transportasi</label>
            <div class="uk-form-controls">
                <select name="transportasi" id="transportasi" class="uk-select">
                    <option value=""></option>
                    @foreach ($transportasi as $transport)
                        <option {{ ($transport->id_transport == $dataUser[0]->transportasi) ? 'selected' : '' }} value="{{ $transport->id_transport }}">{{ $transport->transport }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Anak Ke- (Sesuai dengan KK)</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="anak" id="anak" value="{{ $dataUser[0]->anak }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Jenis Tinggal</label>
            <div class="uk-form-controls">
                <select name="jenis_tinggal" id="jenis_tinggal" class="uk-select">
                    <option value=""></option>
                    @foreach ($jenis_tinggal as $jeting)
                        <option {{ ($jeting->id_jeting == $dataUser[0]->jenis_tinggal) ? 'selected' : '' }} value="{{ $jeting->id_jeting }}">{{ $jeting->jeting }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Asal Sekolah (SMP/MTs)</label>
            <label class="uk-form-label" for="form-horizontal-text">Jika mutasi diisi dengan asal sekolah (SMA/SMK/MA)</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="text" name="askol" id="askol" value="{{ $dataUser[0]->askol }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Tinggi Badan (cm)</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="tinggi" id="tinggi" value="{{ $dataUser[0]->tinggi }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Berat Badan (kg)</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="berat" id="berat" value="{{ $dataUser[0]->berat }}">
            </div>
        </div>
        
        <h5>Data Ibu</h5>
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Nama Ibu Kandung</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="text" name="ibu" id="ibu" value="{{ $dataUser[0]->ibu }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">NIK Ibu</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="nikibu" id="nikibu" value="{{ $dataUser[0]->nik_ibu }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Pendidikan Ibu</label>
            <div class="uk-form-controls">
                <select name="pendidikan_ibu" id="pendidikan_ibu" class="uk-select">
                    <option value=""></option>
                    @foreach ($pendidikan as $pend)
                        <option {{ ($pend->id_pendidikan == $dataUser[0]->pendidikan_ibu) ? 'selected' : '' }} value="{{ $pend->id_pendidikan }}">{{ $pend->pendidikan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Profesi Ibu</label>
            <div class="uk-form-controls">
                <select name="profesi_ibu" id="profesi_ibu" class="uk-select" onchange="setPenghasilanIbu()">
                    <option value=""></option>
                    @foreach ($profesi as $profesi_ibu)
                        <option {{ ($profesi_ibu->id_profesi == $dataUser[0]->profesi_ibu) ? 'selected' : '' }} value="{{ $profesi_ibu->id_profesi }}">{{ $profesi_ibu->profesi }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Penghasilan Ibu</label>
            <div class="uk-form-controls">
                <input class="uk-input rupiah" type="number" name="penghasilan_ibu" id="penghasilan_ibu" value="{{ $dataUser[0]->penghasilan_ibu }}">
            </div>
        </div>

        <h5>Data Ayah</h5>
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Nama Ayah</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="text" name="ayah" id="ayah" value="{{ $dataUser[0]->ayah }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">NIK Ayah</label>
            <div class="uk-form-controls">
                <input class="uk-input"  type="number" name="nikayah" id="nikayah" value="{{ $dataUser[0]->nik_ayah }}">
            </div>
        </div>
        
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Pendidikan Ayah</label>
            <div class="uk-form-controls">
                <select name="pendidikan_ayah" id="pendidikan_ayah" class="uk-select">
                    <option value=""></option>
                    @foreach ($pendidikan as $pend)
                        <option {{ ($pend->id_pendidikan == $dataUser[0]->pendidikan_ayah) ? 'selected' : '' }} value="{{ $pend->id_pendidikan }}">{{ $pend->pendidikan }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Profesi Ayah</label>
            <div class="uk-form-controls">
                <select name="profesi_ayah" id="profesi_ayah" class="uk-select" onchange="setPenghasilanAyah()">
                    <option value=""></option>
                    @foreach ($profesi as $profesi_ayah)
                        <option {{ ($profesi_ayah->id_profesi == $dataUser[0]->profesi_ayah) ? 'selected' : '' }} value="{{ $profesi_ayah->id_profesi }}">{{ $profesi_ayah->profesi }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">Penghasilan Ayah</label>
            <div class="uk-form-controls">
                <input class="uk-input rupiah"  type="number" name="penghasilan_ayah" id="penghasilan_ayah" value="{{ $dataUser[0]->penghasilan_ayah }}">
            </div>
        </div>
    
        <button id="bBiodata" class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit" onclick="savingBiodata()" onsubmit="savingBiodata()">Simpan</button>
    </form>
</div>
<script>
    const setPenghasilanIbu = () => {
        const profesi_ibu = document.getElementById('profesi_ibu').value
        const penghasilan_ibu = document.getElementById('penghasilan_ibu')
        if (profesi_ibu == 12 || profesi_ibu == 13) {
            penghasilan_ibu.setAttribute('value', '0')
            penghasilan_ibu.setAttribute('disabled', '')
        }else{
            penghasilan_ibu.removeAttribute('value', '0')
            penghasilan_ibu.removeAttribute('disabled', '')
        }
    }

    const setPenghasilanAyah = () => {
        const profesi_ayah = document.getElementById('profesi_ayah').value
        const penghasilan_ayah = document.getElementById('penghasilan_ayah')
        if (profesi_ayah == 12 || profesi_ayah == 13) {
            penghasilan_ayah.setAttribute('disabled', '')
            penghasilan_ayah.setAttribute('value', '0')
        }else{
            penghasilan_ayah.removeAttribute('disabled', '')
            penghasilan_ayah.removeAttribute('value', '0')
        }
    }

    const fBiodata = document.getElementById('fBiodata')
    const bBiodata = document.getElementById('bBiodata')
    const savingBiodata = () => {
        bBiodata.setAttribute('disabled', '')
        bBiodata.innerHTML = `<div uk-spinner="ratio: 0.5"></div>`
        fBiodata.submit()
    }
</script>