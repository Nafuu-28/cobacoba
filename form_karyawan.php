<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$listAgama = [ "Kristen"," Hindu", "Islam", "Budha"];
sort($listAgama); //mengurutkan array dari yang terkecil
$listGolongan = [ "I", "II", "III"];

$fileJson = 'data_karyawan.json';
$dataKaryawan = array();

// membaca file json
$dataJson = file_get_contents($fileJson);
$dataKaryawan = json_decode($dataJson, true);

if(isset($_GET['btnSave'])){
    $nik = $_GET['nik'];
    $nama = $_GET['nama'];
    $jenisKelamin = $_GET['jeniskelamin'];
    $agama = $_GET['agama'];
    $golongan = $_GET['golongan'];
    $gajiPokok = $_GET['gajiPokok'];

        // buat array asosiatif baru
    $dataBaru = array(
        "nik" => $nik,
        "nama" => $nama,
        "jenisKelamin" => $jenisKelamin,
        "agama" => $agama,
        "golongan" => $golongan,
        "gajiPokok" => $gajiPokok,
    );
    // nambahin object baru ke data karyawan
    array_push($dataKaryawan, $dataBaru);

    // mengubah array ke json
    $dataToJson = json_encode($dataKaryawan, JSON_PRETTY_PRINT);

    file_put_contents($fileJson, $dataToJson);
}


?>
<body>
     <h1>Form Karyawan</h1>
     <form action ="#" method="get">
     <table>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><input type="text" name="nik" id="NIK"></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td> <input type="text" name="nama" id="nama"></td>
        </tr>
        <tr>
            <td>jenisKelamin</td>
            <td>:</td>
            <td><select name="jeniskelamin" id="JenisKelamin">
                <option value="1">Laki Laki</option>
                <option value="0">Perempuan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>AGAMA</td>
            <td>:</td>
            <td>
            <select name="agama" id="agama">
                    <?php
                        // cara ke 1
                    // foreach ($listAgama as $agama){
                    //     echo "<option value= '$agama'>$agama</option>";
                    // }
                    // cara ke 2
                for ($index = 0; $index <count($listAgama); $index++){
                    echo "<option value = '$listAgama[$index]'>$listAgama[$index]</option>";
                }


                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>GOLONGAN</td>
            <td>:</td>
            <td>
                <select name="golongan" id="golongan">
                    <?php
                    foreach($listGolongan as $golongan){
                        echo "<option value='$golongan'>$golongan</option>";
                    } ?>
                </select>
              
            </td>
        </tr>
        <tr>
            <td>GAJI POKOK</td>
            <td>:</td>
            <td> 
                <input type="number" name= "gajiPokok" id="gajiPokok">
            </td>
        </tr>
        <tr>
            <td colspan="3" align = "right">
                <input type ="submit"value="save" name="btnSave" id="btnSave">
            </td>
            <td></td>
            <td></td>
        </tr>
     </table>
                </form>

    
        <hr> 
        <table border ="1">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>JenisKelamin</th>
                <th>golongan</th>
                <th>Agama</th>
                <th>Tunjangan</th>
                <th>Pajak</th>
                <th>Total gaji</th>
            </tr>;
            <?php 
            foreach ($dataKaryawan as $Karyawan){
                $tunjangan;
                $pajak;
                $totalGaji;
                
                // echo $Karyawan['nama'] . "<br>";
                // echo $Karyawan['agama'] . "<br>";
                // echo $Karyawan['nik'] . "<br>";
                // echo $Karyawan['jenisKelamin']. "<br>";

            }
                
                ?>
                <tr>
                    
                    <td> <?php
                     echo $Karyawan['nik']; ?></td>
                    <td>
                    <?php
                     echo $Karyawan['nama']; ?>
                    </td>
                    <td>
                    <?php
                     $kelamin = $Karyawan['jenisKelamin'];
                     if ($kelamin > 0){
                        echo "Laki Laki";
                     } else {
                        echo "Perempuan";
                     }
                     ?>
                    </td>
                    <td>
                    <?php 
                    
                    echo $Karyawan ['golongan'];
                   
                    
                    ?>
                    </td>
                    <td>
                   <?php
                     echo $Karyawan['agama']; ?>
                
                    </td>
                    <td>
                        <?php 
                     if ($Karyawan['golongan'] = "I"){
                        $tunjangan = 1000000;
                        echo $tunjangan;
                     } else if ($Karyawan['golongan'] = "II"){
                        $tunjangan = 2000000;
                        echo $tunjangan;
                     } else if ($Karyawan['golongan'] = "III"){
                        $tunjangan = 3000000;
                        echo $tunjangan;
                     } else{
                        echo "tidak mendapat Tunjangan"
                     };
                        ?>
                    </td>
                    <td>
                        <?php 
                        $gaji = $Karyawan ['gajiPokok'];
                        $pj =  $gaji + $tunjangan;
                        $pajak =$pj * 0.05;
                        echo $pajak ;
                        ?>
                    </td>
                    <td>
                    <?php 
                    $totalGaji = $Karyawan [ 'gajiPokok' ] + $tunjangan;
                    $gaji = $totalGaji - $ppn;
                    echo "RP. $gaji";
                    ?>        
                </td>
                    
                </tr>
                </table>
                
</body>
</html> 

<!-- perulangan
//1. conditonal looping
    While do , do while
  2. unconditional looping(perulangan pasti)
  for



-->