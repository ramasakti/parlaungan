<x-admintemplate title='{{ $title }}' navactive='{{ $navactive }}'>
    @error('slug')
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>Judul telah digunakan!</p>
        </div>
    @enderror
    <form action="/web/blog/store" method="post" class="uk-margin" enctype="multipart/form-data">
        @csrf
        <img src="" alt="" class="foto-preview img-fluid uk-align-center uk-height-max-medium">
        <div class="mb-3">
            <label for="foto" class="form-label">Image Post</label>
            <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage()" required>
        </div>
        <input type="text" class="uk-input uk-margin uk-margin-remove-top" id="judul" name="judul" placeholder="Judul Berita" value="{{ old('judul') }}">
        <select name="kategori" id="" class="uk-select uk-margin uk-margin-remove-top" value="{{ old('kategori') }}" required>
            <option value="">Kategori Berita</option>
            <option value="Pengumuman">Pengumuman</option>
        </select>
        <input type="hidden" id="uploader" name="uploader" value="{{ session('username') }}">
        <input type="hidden" id="slug" name="slug" value="{{ old('slug') }}">
        <textarea name="isi" id="isi" cols="30" rows="10">{{ old('isi') }}"</textarea>
        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit">Simpan</button>
    </form>
    <script>
        tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');
    
        judul.addEventListener('keyup', function () {
            let preslug = judul.value;
            preslug = preslug.replace(/ /g,"-");
            slug.value = preslug.toLowerCase();
        });
    
        function previewImage(){
            const foto = document.querySelector('#foto');
            const fotopreview = document.querySelector('.foto-preview');
    
            fotopreview.style.display = 'block';
    
            const ofReader = new FileReader();
            ofReader.readAsDataURL(foto.files[0])
    
            ofReader.onload = function(ofrEvent) {
                fotopreview.src = ofrEvent.target.result;
            }
        }
    </script>
</x-admintemplate>