<x-admintemplate title="{{ $title }}" navactive="{{ $navactive }}">
    <form class="uk-form-horizontal uk-margin-large">

        <div class="uk-container uk-container-xsmall">
            <form action="/transaksi/update/" method="post">
                @foreach ($data as $item)
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text">{{ $item->nama_pembayaran }}</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-horizontal-text" type="text" value="{{ $item->terbayar }}">
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    
    </form>
</x-admintemplate>