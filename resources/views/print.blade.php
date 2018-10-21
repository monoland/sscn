<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Pengumuman</title>
</head>

<style>
@media print {
    body {
        background: white;
        padding: 0;
        margin: 0;
    }

    .page {
        padding: 0;
    }
}

@media screen {
    body {
        background: rgb(81, 86, 89);
        margin: 0;
        padding: 0 128px;
    }

    .page {
        background: white;
        padding: 72px 40px;
    }
}
</style>

<body>
    <div class="page">
        <h2>PENGUMUMAN</h2>
        <table>
            <tbody>
                <tr>
                    <td>Nama Peserta</td>
                    <td>:</td>
                    <td>{{ $record->name }}</td>
                </tr>

                <tr>
                    <td>Nomor Register</td>
                    <td>:</td>
                    <td>{{ $record->id }}</td>
                </tr>

                <tr>
                    <td>N I K</td>
                    <td>:</td>
                    <td>{{ $record->nik }}</td>
                </tr>

                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $record->position_name }}</td>
                </tr>

                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td>{{ $record->location_name }}</td>
                </tr>

                <tr>
                    <td>Nomor Peserta</td>
                    <td>:</td>
                    <td>{{ $record->participant_numb }}</td>
                </tr>

                <tr>
                    <td>Status Verifikasi</td>
                    <td>:</td>
                    <td>{{ $record->verification_status }}</td>
                </tr>
            </tbody>
        </table>
        <p>Selanjutnya dapat mengikuti Seleksi Kemampuan Dasar (SKD) dengan menggunakan system Computer Asissted Test (CAT), dengan ketentuan sebagai berikut:</p>
        <ol>
            <li>Pelamar agar mencetak Kartu Tanda Peserta Ujian melalui laman situs http://sscn.bkn.go.id</li>
            <li>Jadwal pelaksanaan ujian akan diinformasikan lebih lanjut melalui laman situs http://sscn.bkn.go.id. atau https://sscn.tangerangkab.go.id, untuk itu agar Pelamar selalu mengikuti perkembangan pada kedua laman situs diatas.</li>
            <li>Pada pelaksanaan Ujian SKD Peserta wajib  membawa:
                <ol type="a">
                    <li>KTP-el Asli atau Asli Surat Keterangan telah melakukan perekaman E-KTP kependudukan yang dikeluarkan Dinas Kependudukan dan Catatan Sipil.</li>
                    <li>Asli Kartu Tanda Peserta ujian.</li>
                </ol>
            </li>
            <li>Pada pelaksanaan ujian SKD Peserta berpakaian rapi dan sopan dengan ketentuan:
                <ul>
                    <li>Pria, kemeja putih  dan celana warna hitam (tidak berbahan jeans) dan memakai sepatu.</li>
                    <li>Wanita, kemeja putih, rok/celana warna hitam (tidak berbahan jeans) dan memakai sepatu (bagi yang berjilbab menyesuaikan).</li>
                </ul>
            </li>
            <li>Apabila peserta ujian tidak membawa persyaratan pada point  3, maka peserta tidak dapat mengikuti ujian dan dinyatakan gugur.</li>
            <li>Tata Tertib Pelaksanaan Seleksi Kompetensi Dasar (SKD):
                <ol>
                    <li>Peserta ujian wajib  hadir 90 (sembilan puluh) menit  sebelum pelaksanaan SKD dimulai sesuai sesi masing-masing jadwal tes yang telah ditentukan di alamat Badan Pengembangan Sumber Daya Manusia Daerah Provinsi Banten Jl. AMD Lintas Tim. No.6, Kadumerak, Karangtanjung, Kabupaten Pandeglang, Banten 42251.</li>
                    <li>Apabila peserta ujian tidak hadir pada jadwal yang telah ditentukan, maka peserta tidak dapat mengikuti ujian dan dinyatakan gugur.</li>
                    <li>Peserta wajib mengisi daftar hadir yang telah disiapkan oleh Panitia.</li>
                    <li>Peserta wajib menunjukkan KTP-el Asli  atau Asli Surat Keterangan telah melakukan perekaman E-KTP kependudukan yang dikeluarkan Dinas Kependudukan dan Catatan Sipil dan Kartu Peserta Ujian untuk diperiksa oleh Panitia.</li>
                    <li>Bagi peserta ujian yang tidak dapat menyerahkan/menunjukkan dokumen sebagaimana tersebut di atas, maka Panitia berhak membatalkan keikutsertaan sebagai peserta ujian CPNS Tahun 2018.</li>
                    <li>Peserta harus sesuai dengan foto yang ada dalam kartu tanda peserta ujian.</li>
                    <li>Peserta duduk pada tempat yang telah ditentukan.</li>
                    <li>Peserta yang terlambat tidak diperkenankan masuk ruangan tes dan dianggap gugur.</li>
                    <li>Peserta hanya diperbolehkan membawa KTP-el dan  Kartu Tanda Peserta Ujian ke dalam ruangan CAT.</li>
                    <li>Peserta tidak diperkenankan membawa peralatan selain tersebut pada poin 6.i, termasuk jam tangan, perhiasan, HP dan sebagainya.</li>
                    <li>Panitia tidak bertanggung jawab atas kehilangan barang-barang peserta.</li>
                    <li>Peserta dilarang:
                        <ol type="a">
                            <li>Bertanya/berbicara dengan sesama peserta tes.</li>
                            <li>Menerima/memberikan sesuatu dari/kepada peserta lain tanpa seizin panitia selama ujian kecuali memperoleh ijin  dari panitia.</li>
                            <li>Merokok dalam ruangan tes dan di lingkungan lokasi tes.</li>
                            <li>Menggunakan komputer fasilitas CAT selain untuk aplikasi CAT.</li>

                        </ol>
                    </li>
                    <li>Peserta yang telah selesai ujian dapat meninggalkan tempat ujian dengan tertib.</li>
                    <li>Sanksi:
                        <ol type="a">
                            <li>Pelanggaran  tata tertib  dengan sanksi berupa  teguran lisan  sampai dibatalkan  sebagai peserta tes oleh panitia.</li>
                            <li>Peserta  tes yang kedapatan membawa alat komunikasi (HP), kamera, maupun benda selain  yang sudah ditentukan  sebelumnya  dalam bentuk apapun  dinyatakan gugur  dan dikeluarkan dari ruangan  tes.</li>
                        </ol>
                    </li>
                </ol>
            </li>
        </ol>
    </div>
</body>
</html>