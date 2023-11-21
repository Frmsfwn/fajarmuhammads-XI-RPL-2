<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		<title>Database Siswa</title>
	</head>
	<body>
	<div class="container">
		<div class="content">
			<div class="content-2">
				<div class="perjalanan">
					<div class="title">
						<h2>Data Siswa</h2>
						<a href="{{ route('siswa.create') }}" class="btn">Tambah Data</a>
					</div>
					<table>
						<tr>
							<th>NIS</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Tempat dan Tanggal Lahir</th>
							<th>Alamat</th>
							<th>No Telepon</th>
						</tr>
							@foreach ($data as $item)
							<tr>
								<td>{{ $item->nis }}</td>
								<td>{{ $item->nama }}</td>
								<td>{{ $item->jenis_kelamin }}</td>
								<td>{{ $item->tmpt_lahir }} {{ $item->tgl_lahir }}</td>
								<td>{{ $item->alamat }}</td>
								<td>{{ $item->notelp }}</td>
								<td>
									<a href="{{ url('siswa/'.$item->nis.'/edit') }}" ><button class="btn">Ubah</button></a>
								</td>
								<td>
									<form onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?')" action="{{ url('siswa/'.$item->nis) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" name="submit" class="btn">Hapus</button>
									</form>
								</td>
							</tr>
							@endforeach
					</table>
					@if (Session::has('Berhasil'))
						{{ Session::get('Berhasil') }}
					@endif
				</div>
			</div>
		</div>
	</div>
	</body>
</html>