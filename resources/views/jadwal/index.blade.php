<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @include('jadwal.hari.alert')
    <ul uk-tab>
        <li class="uk-active"><a href="#">Senin</a></li>
        <li class="uk-active"><a href="#">Selasa</a></li>
        <li class="uk-active"><a href="#">Rabu</a></li>
        <li class="uk-active"><a href="#">Kamis</a></li>
        <li class="uk-active"><a href="#">Jumat</a></li>
        <li class="uk-active"><a href="#">Sabtu</a></li>
    </ul>
    
    <ul class="uk-switcher uk-margin">  
        <li class="uk-active">
            @include('jadwal.hari.Senin')
        </li> 
        <li class="uk-active">
            @include('jadwal.hari.Selasa')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Rabu')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Kamis')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Jumat')
        </li>
        <li class="uk-active">
            @include('jadwal.hari.Sabtu')
        </li>
    </ul>
    <script>
        const status = `<div id="status">
                <div class="uk-margin">
                    <select id="status" class="uk-select" name="status" required>
                        <option value="" selected disabled hidden>Keterangan Inval</option>
                        <option value="I">Izin</option>
                        <option value="S">Sakit</option>
                        <option value="A">Alfa</option>
                    </select>
                </div>
            </div>`
        
        const invalidation = (id_jadwal) => {
            const wadah = document.getElementById('wadah-' + id_jadwal)
            const guru = document.getElementById('guru-' + id_jadwal)
            const inval = document.getElementById('status-inval-' + id_jadwal)
            if (inval.checked) {
                wadah.innerHTML = status
                guru.removeAttribute('disabled')
            }else{
                guru.setAttribute('disabled', '')
                wadah.innerHTML = ''
            }
        }
    </script>
</x-admintemplate>