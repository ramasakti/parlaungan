<x-admintemplate title="{{ $title }}" navactive="{{ $navactive }}">
    <div class="uk-container uk-container-xsmall">
        @if (session()->has('success'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session()->has('fail'))
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>{{ session('fail') }}</p>
            </div>
        @endif
        <form action="/transaksi/update" method="POST">
            @csrf
            <input type="hidden" name="id_siswa" value="{{ $data[0]->siswa_id }}">
            <input type="hidden" name="kwitansi" value="{{ $data[0]->kwitansi }}">
            @foreach ($data as $item)
                <div class="uk-margin">
                    <input type="hidden" name="id_transaksi[]" value="{{ $item->id_transaksi }}">
                    <input type="hidden" name="id_pembayaran[]" value="{{ $item->id_pembayaran }}">
                    <input type="hidden" name="nominal[]" value="{{ $item->nominal }}">
                    <label class="uk-form-label" for="form-horizontal-text">{{ $item->nama_pembayaran }}</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="terbayar[]" id="{{ $item->id_pembayaran }}" type="text" value="{{ number_format($item->terbayar,0,'','.') }}" onkeyup="rupiah('{{ $item->id_pembayaran }}', this.value)">
                    </div>
                </div>
            @endforeach
            <button class="uk-button uk-button-primary uk-button-small uk-width-1-1" type="submit">Simpan</button>
        </form>
    </div>
    <script>
        const rupiah = (id, value) => document.getElementById(id).value = formatRupiah(value)
    </script>
</x-admintemplate>