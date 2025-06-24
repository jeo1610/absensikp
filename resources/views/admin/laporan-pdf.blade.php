<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #000;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .info {
            margin-top: 5px;
            font-size: 11px;
            color: #666;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px 6px;
            text-align: center;
        }

        th {
            background-color: #e9ecef;
            font-weight: bold;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
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
                <th style="width: 15%">Bidang</th>
                <th style="width: 10%">Jenis Absensi</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 10%">Jam</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $i => $data)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $data->pegawai->nip ?? '-' }}</td>
                    <td style="text-align: left;">{{ $data->pegawai->namaLengkap ?? '-' }}</td>
                    <td style="text-align: left;">{{ $data->pegawai->jabatan ?? '-' }}</td>
                    <td style="text-align: left;">{{ $data->pegawai->bidang ?? '-' }}</td>
                    <td>{{ $data->absensi->jenisAbsensi ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada data tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
