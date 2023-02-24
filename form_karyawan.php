<!-- Best Practice nya kode php taro paling atas -->
<?php
// membuat array kosong untuk menampung data karyawan
$dataKaryawan = [];
// ambil data json
$dataJson = file_get_contents('data_karyawan.json');
// ubah json ke array untuk bisa di manipulasi data nya
$dataKaryawan = json_decode($dataJson, true);

// list agama
$listAgama = ['Islam', 'Budha', 'Kristen', 'Katolik'];
sort($listAgama);

// list golongan
$listGolongan = ['I', 'II', 'III'];

// jika input save di tekan artinya udah di set input name btnSave nya dan data akan masuk ke url query parameter. lalu ambil semua data yang di url parameter nya berdasarkan name/key parameter kemudian masukan ke variabel 
if (isset($_GET['btnSave'])) {
    $nik = $_GET['nik'];
    $nama = $_GET['nama'];
    $jenisKelamin = $_GET['jenisKelamin'];
    $agama = $_GET['agama'];
    $golongan = $_GET['golongan'];
    $gajiPokok = $_GET['gajiPokok'];

    // dari data yang sudah di masukan ke variabel lalu masukan ke array value nya
    $dataArrayBaru = [
        'nik' => $nik,
        'nama' => $nama,
        'jenisKelamin' => $jenisKelamin,
        'agama' => $agama,
        'golongan' => $golongan,
        'gajiPokok' => $gajiPokok,
    ];
    // menambah array baru ke data karyawan
    array_push($dataKaryawan, $dataArrayBaru);
    // ubah dari array ke json
    $dataJson = json_encode($dataKaryawan, JSON_PRETTY_PRINT);
    // menulis dataJson ke file json
    file_put_contents('data_karyawan.json', $dataJson);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM KARYAWAN | VSGA</title>
</head>

<body>
    <form action="#" method="get">
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>
                    <input type="number" name="nik" id="nik">
                </td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama" id="nama">
                </td>
            </tr>
            <tr>
                <td>JENIS KELAMIN</td>
                <td>:</td>
                <td>
                    <select name="jenisKelamin" id="jenisKelamin">
                        <option value="1">Laki-Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>AGAMA</td>
                <td>:</td>
                <td>
                    <select name="agama" id="agama">
                        <?php foreach ($listAgama as $agama) : ?>
                        <option value="<?= $agama ?>"><?= $agama ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>GOLONGAN</td>
                <td>:</td>
                <td>
                    <select name="golongan" id="golongan">
                        <?php foreach ($listGolongan as $golongan) : ?>
                        <option value="<?= $golongan ?>"><?= $golongan ?></option>
                        <?php var_dump($golongan);
                        endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>GAJI POKOK</td>
                <td>:</td>
                <td>
                    <input type="number" name="gajiPokok" id="gajiPokok" value="0">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input style="margin-top: 10px;" type="submit" name="btnSave" value="Save"></input>
                </td>
            </tr>
        </table>
    </form>

    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>NIK</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>AGAMA</th>
                <th>GOLONGAN</th>
                <th>GAJI POKOK</th>
                <th>TUNJANGAN</th>
                <th>PAJAK</th>
                <th>TOTAL GAJI BERSIH</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($dataKaryawan as $karyawan) : ?>
            <tr>
                <td> <?= $karyawan['nik'] ?> </td>
                <td><?= $karyawan['nama'] ?></td>
                <td><?= $karyawan['jenisKelamin'] ?></td>
                <td><?= $karyawan['agama'] ?></td>
                <td><?= $karyawan['golongan'] ?></td>
                <td><?= $karyawan['gajiPokok'] ?></td>
                <td>
                    <?php if ($karyawan['golongan'] == "I") {
                            $tunjangan = 1000000;
                            echo $tunjangan;
                        } else if ($karyawan['golongan'] == "II") {
                            $tunjangan = 2000000;
                            echo $tunjangan;
                        } else if ($karyawan['golongan'] == "III") {
                            $tunjangan = 3000000;
                            echo $tunjangan;
                        } else {
                            echo "Maaf, anda tidak mendapat tunjangan";
                        }
                        ?>
                </td>
                <td>
                    <?php
                        $pajak = ($karyawan['gajiPokok'] + $tunjangan) * 0.05;
                        echo $pajak;
                        ?>
                </td>
                <td>
                    <?php
                        $totalGaji = $karyawan['gajiPokok'] + $tunjangan - $pajak;
                        echo $totalGaji;
                        ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>