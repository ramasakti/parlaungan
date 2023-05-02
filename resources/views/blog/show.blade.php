<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
    <!-- Primary Meta Tags -->
    <meta name="title" content="{{ $data->judul }}">
    <meta name="description" content="SMA Islam Parlaungan">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://smaispa.sch.id/blog/view/{{ $data->slug }}">
    <meta property="og:title" content="{{ $data->judul }}">
    <meta property="og:site_name" content="smaispa">
    <meta property="article:publisher" content="https://www.instagram.com/officialsmaispa/"/>
    <meta property="og:description" content="SMA Islam Parlaungan">
    <meta property="og:image" content="https://smaispa.sch.id/storage/blog/{{ $data->foto }}">
    <meta property="og:image:height" content="364">
    <meta property="og:image:width" content="648">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://smaispa.sch.id/blog/view/{{ $data->slug }}">
    <meta property="twitter:title" content="{{ $data->judul }}">
    <meta property="twitter:description" content="SMA Islam Parlaungan">
    <meta property="twitter:image" content="https://smaispa.sch.id/storage/blog/{{ $data->foto }}">
</head>
<body>
    <div class="uk-container uk-container-xsmall">
        <article>
			<header class="uk-margin-medium-bottom">
				<h1 class="uk-article-title" id="title">{{ $data->judul }}</h1>
				<p id="author" class="uk-margin-remove-bottom">Penulis: {{ $data->uploader }}</p>
				<p id="uploaded" class="uk-margin-remove-top">Tanggal: {!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($data->uploaded))) !!}</p>
			</header>

			<div class="uk-margin-small-bottom">
				<img id="banner" src="/storage/blog/{{ $data->foto }}" alt="Gambar artikel" class="uk-align-center">
			</div>
            <div class="uk-margin">
                <a href="https://wa.me/?text=https://smaispa.sch.id/blog/view/{{ $data->slug }}" class="uk-icon-button" style="background: #075E54" uk-icon="icon: whatsapp"></a>
                <a href="https://facebook.com/sharer.php?u=https://smaispa.sch.id/blog/view/{{ $data->slug }}" class="uk-icon-button" style="background: #4267B2" target="_blank" uk-icon="icon: facebook"></a>
                <a href="#" class="uk-icon-button" style="background: #E76161" uk-icon="icon: link" onclick="copyLink()"></a>
            </div>

			<section class="uk-margin-medium-bottom">
                <div id="artikel">
                    {!! $data->isi !!}
                </div>
			</section>

			<footer>
				<p>Tag artikel: <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
			</footer>
		</article>
    </div>

    <script>
        const copyLink = () => { 
            navigator.clipboard.writeText(window.location.href)
            alert('URL telah disalin ke papan klip')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
</body>
</html>