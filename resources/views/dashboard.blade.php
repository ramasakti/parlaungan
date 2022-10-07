<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match uk-margin-top-small" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                {!! $dataQR !!}
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <div class="uk-panel">
                    <img class="uk-border-circle uk-align-left uk-margin-small-right uk-margin-small-bottom" width="35%" height="35%" src="img/default-user.jpg">
                    <h5 class="uk-card-title uk-margin-remove ">{{ session('username') }}</h5>
                </div>
                <p class="uk-margin-remove"><span class="uk-margin-small-right" uk-icon="calendar"></span>Surabaya, 27 September 1986</p>
                <p class="uk-margin-remove"><span class="uk-margin-small-right" uk-icon="location"></span>Jl. Berbek I 2 - 4 Waru Sidoarjo</p>
            </div>
        </div>
    </div>
    <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Siswa</h3>
                <p>Jumlah siswa saat ini {{ $dataSiswa }} siswa</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Guru</h3>
                <p>Jumlah guru dan staf saat ini {{ $dataGuru }} orang</p>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Kelas</h3>
                <p>Jumlah kelas saat ini {{ $dataKelas }} kelas</p>
            </div>
        </div>
    </div>
    <script>
        const svg = document.getElementsByTagName('svg')[0]
        svg.setAttribute('class', 'uk-align-center')
        svg.setAttribute('height', '40%')
        svg.setAttribute('width', '40%')
    </script>
</x-admintemplate>