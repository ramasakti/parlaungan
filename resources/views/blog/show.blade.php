<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data[0]->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/css/uikit.min.css" />
</head>
<body>
    <div class="uk-container uk-container-xsmall">
        <article>
			<header class="uk-margin-medium-bottom">
				<h1 class="uk-article-title" id="title">Judul Artikel</h1>
				<p id="author">Penulis: John Doe</p>
				<p id="uploaded">Tanggal: 1 Mei 2023</p>
			</header>

			<div class="uk-margin-medium-bottom">
				<img id="banner" src="http://127.0.0.1:8000/storage/blog/20230429164815.png" alt="Gambar artikel" class="uk-align-center">
			</div>

			<section class="uk-margin-medium-bottom">
                <div id="artikel"></div>
			</section>

			<footer>
				<p>Tag artikel: <a href="#">Tag 1</a>, <a href="#">Tag 2</a>, <a href="#">Tag 3</a></p>
			</footer>
		</article>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.15/dist/js/uikit-icons.min.js"></script>
    <script>
        const api = window.location.pathname.replace('view', 'api');
        const url = window.location.origin
        const artikel = document.getElementById('artikel')
        const title = document.getElementById('title')
        const author = document.getElementById('author')
        const uploaded = document.getElementById('uploaded')
        const banner = document.getElementById('banner')
        
        fetch(url + api)
            .then(response => response.json())
            .then(data => {
                artikel.innerHTML = data[0].isi
                title.innerHTML = data[0].judul
                author.innerHTML = 'Penulis: ' + data[0].uploader
                uploaded.innerHTML = 'Tanggal: ' + data[0].uploaded
                banner.setAttribute('src', url + '/storage/blog/' + data[0].foto)
            })
            .catch(error => console.error(error));
    </script>
</body>
</html>