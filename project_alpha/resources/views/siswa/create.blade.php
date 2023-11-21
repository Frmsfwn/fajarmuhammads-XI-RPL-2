<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('css/form.css') }}">
		<title>Tambah Data</title>
	</head>
	<body>
	<div class="container-2">
		<div class="perjalanan">
			@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $item)
						<li>{{ $item }}</li>
					@endforeach
				</ul>
			@endif
		<form action='{{ url('siswa') }}' method='POST' >
			@csrf
			<table>
				<tbody>
					<tr>
						<td> NIS </td>
						<td> : </td>
						<td>
							<input type="text" name="nis" value="{{ Session::get('nis') }}" id="nis">
						</td>
					</tr>
					<tr>
						<td> Nama </td>
						<td> : </td>
						<td>
							<input type="text" name="nama" value="{{ Session::get('nama') }}" id="nama">
						</td>
					</tr>
					<tr>
						<td> Jenis Kelamin </td>
						<td> : </td>
						<td>
							<select name="jenis_kelamin" id="jenis_kelamin">
								<option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
								<option value="Pria">Pria</option>
								<option value="Wanita">Wanita</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> Tempat Lahir </td>
						<td> : </td>
						<td>
							<input type="text" name="tmpt_lahir" value="{{ Session::get('tmpt_lahir') }}" id="tmpt_lahir">
						</td>
					</tr>
					<tr>
						<td> Tanggal Lahir </td>
						<td> : </td>
						<td>
							<input type="date" name="tgl_lahir" value="{{ Session::get('tgl_lahir') }}" id="tgl_lahir">
						</td>
					</tr>
					<tr>
						<td> Alamat </td>
						<td> : </td>
						<td>
							<input type="text" name="alamat" value="{{ Session::get('alamat') }}" id="alamat">
						</td>
					</tr>
					<tr>
						<td> No.Telepon </td>
						<td> : </td>
						<td>
							<input type="text" name="notelp" value="{{ Session::get('notelp') }}" id="notelp">
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>
							<input type="submit" name="simpan" value="Simpan" onclick="return confirm('Apakah Anda ingin menambahkan data ini?')">
							<input type="reset" name="batal" value="Batal">
							<input type="button" name="kembali" value="Kembali" onclick="self.history.back()">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		</div>
	</div>
	</body>
</html>