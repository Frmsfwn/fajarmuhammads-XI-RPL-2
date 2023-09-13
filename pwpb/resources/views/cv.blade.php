<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Saya</title>

    <style>
		* {
			box-sizing: border-box;
		}
		body {
			font-family: sans-serif;
			background: linear-gradient(to bottom, #0099cc 0%, #ffa07a 100%);
		}
		.container {
            max-width: 800px;
            margin: 50px auto 50px;
			border: 2px solid black;
            border-radius: 15px;  
            padding: 50px;
        }
        .header {
			float: left;
        }
		.kiri {
			width: 75%;
		}
		.kanan {
			width: 25%;
		}
        .namadep {
            font-size: 40px;
            font-weight: 700;
			margin-right: 10px;
        }
		.namabel {
            font-size: 40px;
            font-weight: 400;
        }
		img {
			padding: 5px;
			width: 150px;
		}
		.container2 {
			max-width: 800px;
			background: white;
			border: 2px solid black;
			border-radius: 15px;
			padding: 50px;
		}
		.keterangan {
			border: 2px solid black;
			border-radius: 15px;
			height: 60px;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.isi {
			border: 2px solid black;
			border-radius: 15px;
			height: 60px;
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.column {
			float: left;
			padding: 5px;
		}
		.left {
			width: 25%;
		}
		.right {
			width: 75%;
		}
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
    </style>
</head>

<body>
    <div class="container">
			<div class="row">
				<div class="header kiri">
					<span class="namadep">Fajar</span>
					<span class="namabel">Muhammad Sofwan</span>
				</div>
				<div class="header kanan">
					<img src="{{ asset('img/myimage.jpg') }}" alt="foto profil">
				</div>
			</div>
			<p>"Siswa SMKN 2 Bandung, Kelas 11 RPL 2"</p>
		<div class="container2">
			<h2>Biodata</h2>
				<div class="row">
					<div class="column left">
						<p class="keterangan">Alamat</p>
						<p class="keterangan">TempatTanggal Lahir</p>
						<p class="keterangan">Email</p>
						<p class="keterangan">No.Telp</p>
						<p class="keterangan">Hobi</p>
					</div>
					<div class="column right">
						<p class="isi">Jl.Sederhana, Gg.Sederhana II, No.02, RT01/RW10, Kel.Pasteur, Kec.Sukajadi, Bandung, Jawa Barat</p>
						<p class="isi">Bandung, 13 Maret 2007</p>
						<p class="isi">ffajarmsofwan@gmail.com</p>
						<p class="isi">0895413018222</p>
						<p class="isi">Mendengarkan Musik</p>
					</div>
				</div>
			<h2>Pendidikan</h2>
				<div class="row">
					<div class="column left">
						<p class="keterangan">SDN 077 Sejahtera Bandung</p>
						<p class="keterangan">SMPN 7 Bandung</p>
						<p class="keterangan">SMKN 2 Bandung</p>
					</div>
					<div class="column right">
						<p class="isi">2013 - 2019</p>
						<p class="isi">2019 - 2022</p>
						<p class="isi">2022 - Saat ini</p>
					</div>
				</div>
		</div>
    </div>
</body>
</html>