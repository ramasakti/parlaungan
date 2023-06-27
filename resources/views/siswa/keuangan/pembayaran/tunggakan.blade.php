<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tunggakan</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.21/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.21/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.21/dist/js/uikit-icons.min.js"></script>
</head>
<body>
    <div class="uk-container uk-container=xsmall">
        <table class="uk-table">
            <caption>Tunggakan {{ $dataTunggakan->nama_siswa }}</caption>
            <thead>
                <tr>
                    <th>Table Heading</th>
                    <th>Table Heading</th>
                    <th>Table Heading</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Table Footer</td>
                    <td>Table Footer</td>
                    <td>Table Footer</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>