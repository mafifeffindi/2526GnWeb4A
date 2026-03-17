<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas CSS - Juni Martalena Zega (026)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Comments: Bagian ini adalah gaya utama untuk halaman */

        /* CSS Box Model, Margins, Padding, Height/Width */
        * {
            box-sizing: border-box; /* CSS Box Model */
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif; /* CSS Fonts */
        }

        /* CSS Colors & Backgrounds */
        body {
            background-color: #f4f7f6;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            width: 80%; /* CSS Width */
            max-width: 900px;
            margin: 40px auto; /* CSS Margins */
            background: #ffffff;
            padding: 30px; /* CSS Padding */
            /* CSS Borders & Outline */
            border: 2px solid #2c3e50; 
            outline: 5px solid #ecf0f1;
            border-radius: 10px;
        }

        /* CSS Text & Links */
        h1 {
            color: #2c3e50;
            text-align: center;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #e74c3c; /* CSS Links Hover */
        }

        /* CSS Lists */
        ul {
            list-style-type: square;
            margin-left: 40px;
            margin-bottom: 20px;
        }

        /* CSS Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #bdc3c7;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        /* CSS Errors Handling (Simulasi) */
        .error-box {
            color: red; /* Sengaja dibuat untuk menunjukkan CSS Colors */
            background: #ffdada;
            border: 1px solid red;
            padding: 10px;
            display: none; /* Disembunyikan, hanya contoh */
        }

        /* CSS Icons Styling */
        .icon {
            font-size: 24px;
            margin-right: 10px;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Implementasi CSS - Pekan 05</h1>

        <p><strong>Nama Lengkap:</strong> Juni Martalena Zega</p>
        <p><strong>NIM Terakhir:</strong> 026</p>
        
        <hr style="margin: 20px 0;">

        <h3><i class="fas fa-info-circle icon"></i>Data Mahasiswa (CSS Tables)</h3>
        <table>
            <tr>
                <th>Detail</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
                <td>Pemrograman Web</td>
            </tr>
            <tr>
                <td>Status Tugas</td>
                <td>Selesai (Pekan 05)</td>
            </tr>
        </table>

        <br>

        <h3>Materi yang Dipelajari (CSS Lists):</h3>
        <ul>
            <li>Box Model (Margin, Padding, Border)</li>
            <li>Text and Fonts Manipulation</li>
            <li>Colors and Background Styling</li>
            <li>Table and Link Styling</li>
        </ul>

        <p>Kunjungi profil GitHub untuk referensi lainnya: <a href="https://github.com/mafifeffindi" target="_blank">Klik di sini</a></p>
    </div>

</body>
</html>
