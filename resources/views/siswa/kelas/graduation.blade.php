<div id="graduation" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Kenaikan Kelas</h5>
        <p>Anda yakin akan menaikkan kelas?</p>
        <ul>
            <li>1. Siswa jenjang terakhir akan dihapus</li>
            <li>2. Siswa kelas 10 dan 11 akan naik menjadi kelas 11 dan 12</li>
            <li>3. Tunggakan siswa kelas 12 akan dipindah ke tabel tunggakan alumni</li>
            <li>4. Tunggakan siswa kelas 10 dan 11 akan dipindah ke tabel tunggakan</li>
        </ul>
        
        <form method="POST" action="/kelas/graduation">
            @csrf
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Go</button>
        </form>
    </div>
</div>