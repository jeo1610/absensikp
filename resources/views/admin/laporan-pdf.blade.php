<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #000;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .info {
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            vertical-align: middle;
        }

        th {
            background-color: #f1f5f9;
            font-weight: bold;
            font-size: 11px;
            text-align: center;
        }

        td {
            font-size: 10.5px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #888;
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>
    <div class="info">Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">NIP</th>
                <th style="width: 20%">Nama Lengkap</th>
                <th style="width: 15%">Jabatan</th>
                <th style="width: 15%">Substansi</th>
                <th style="width: 10%">Jenis Absen</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 10%">Jam</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $i => $data)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center">{{ $data->pegawai->nip ?? '-' }}</td>
                    <td class="text-left">{{ $data->pegawai->namaLengkap ?? '-' }}</td>
                    <td class="text-left">{{ $data->pegawai->jabatan ?? '-' }}</td>
                    <td class="text-left">{{ $data->pegawai->substansi->namaSubstansi ?? '-' }}</td>
                    <td class="text-center">{{ $data->absen->jenisAbsen ?? '-' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($data->created_at)->format('H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Tidak ada data absensi tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
