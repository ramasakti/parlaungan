<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    <div class="uk-container uk-container-xsmall">
        <h4>Tambah Home Page</h4>

        <div class="js-upload uk-placeholder uk-text-center">
            <h6>Foto Pertama (4:3 / 16:9) Landscape</h6>
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Attach binaries by dropping them here or</span>
            <div uk-form-custom>
                <input type="file" accept="*image">
                <span class="uk-link">selecting one</span>
            </div>
        </div>

        <div class="js-upload uk-placeholder uk-text-center">
            <h6>Foto Kedua (4:3 / 16:9) Landscape</h6>
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Attach binaries by dropping them here or</span>
            <div uk-form-custom>
                <input type="file" accept="*image">
                <span class="uk-link">selecting one</span>
            </div>
        </div>

        <div class="uk-margin">
            <input name="judul" class="uk-input" type="text" placeholder="Judul" aria-label="Judul">
        </div>

        <p>Berikan narasi 2 paragraf dan maksimal 140 kata</p>
        <textarea name="konten" id="konten" maxlength="150" cols="30" rows="10">{{ old('isi') }}</textarea>

        <button class="uk-button uk-button-primary uk-button-small uk-width-1-1 uk-margin">Submit</button>
    </div>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</x-admintemplate>