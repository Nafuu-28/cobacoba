<?php

require_once "vendor/autoload.php";

$factory = new RandomLib\Factory;
$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));



?>
<?php
function hitungTunjangan($golongan){
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
        echo "tidak mendapat Tunjangan";
     }
};


function hitungPajak($gajiPokok, $tunjangan)
{

    $pajak = ($gajiPokok + $tunjangan) * 0.05;
    return $pajak;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel ="stylesheet" href = "css/bootstrap.css"> 
</head>
<?php
$listAgama = [ "Kristen"," Hindu", "Islam", "Budha"];
sort($listAgama); //mengurutkan array dari yang terkecil
$listGolongan = [ "I", "II", "III"];
$generator =  $generator -> generateString(32,"sadw123as21e");


$fileJson = 'data/data_karyawan.json';
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
        "Token" => $generator
    );
    // nambahin object baru ke data karyawan
    array_push($dataKaryawan, $dataBaru);

    // mengubah array ke json
    $dataToJson = json_encode($dataKaryawan, JSON_PRETTY_PRINT);

    file_put_contents($fileJson, $dataToJson);
}


?>
<body class="text-bg-dark p-3">
    <img width ="250px" height= "200px" src = gambar/logo-esports.jpg>
     <h1 ><button type="button" class="btn btn-primary btn-lg">Form Karyawan</button>
    </h1>
     <form action ="#" method="get">
     <table >
     <tr>
            <td class="btn btn-outline-danger">NIK</td>
            <td><input class="form-control form-control-lg" type="text" name="nik" id="NIK"></td>
        </tr>
        <tr>
            <td class="btn btn-outline-primary">NAMA</td>
            <td> <input class="form-control form-control-lg" type="text" name="nama" id="nama"></td>
        </tr>
        <tr>
            <td class="btn btn-outline-danger"> jenisKelamin</td>
            <td><select class="form-select" aria-label="Default select example" name="jeniskelamin" id="JenisKelamin">
                <option value="1">Laki Laki</option>
                <option value="0">Perempuan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="btn btn-outline-primary">AGAMA</td>
            <td>
            <select class="form-select" aria-label="Default select example" name="agama" id="agama">
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
            <td class="btn btn-outline-danger">GOLONGAN</td>
            <td>
                <select  class="form-select" aria-label="Default select example" name="golongan" id="golongan">
                    <?php
                    foreach($listGolongan as $golongan){
                        echo "<option value='$golongan'>$golongan</option>";
                    } ?>
                </select>
              
            </td>
        </tr>
        <tr>
            <td class="btn btn-outline-primary">GAJI POKOK</td>
            <td  class="w-40 p-1">
            <span class="input-group-text">IDR</span> 
                <input type="number" name= "gajiPokok" id="gajiPokok">
                <span class="input-group-text">.00</span>

                
            </td>
        </tr>
        <tr>
            <td colspan="3" align = "right">
                <input  class="btn btn-primary" type ="submit"value="save" name="btnSave" id="btnSave">

            </td>
            <td></td>
            <td></td>
        </tr>
     </table>
                </form>

    
        <hr> 
        <!-- <table border ="1"> -->
            <table class="table table-bordered border-primary">
            <tr class ="text-body-emphasis">
                <th> NIK </th>
                <th >Nama</th>
                <th>JenisKelamin</th>
                <th>golongan</th>
                <th>Agama</th>
                <th>Tunjangan</th>
                <th>Pajak</th>
                <th>Total gaji</th>
            </tr>
            <tbody>
            <?php 
            
                
                // echo $Karyawan['nama'] . "<br>";
                // echo $Karyawan['agama'] . "<br>";
                // echo $Karyawan['nik'] . "<br>";
                // echo $Karyawan['jenisKelamin']. "<br>";
                foreach ($dataKaryawan as $Karyawan):
                    $tunjangan = hitungTunjangan($Karyawan['golongan']);
                    $pajak = hitungPajak($gajiPokok, $tunjangan);
                    $gajiBersih = ($gajiPokok + $tunjangan);

            
                
                ?>
                <tr class="text-white bg-dark">
               
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
                    
                    echo $Karyawan['golongan'];
                   
                    
                    ?>
                    </td>
                    <td>
                   <?php
                     echo $Karyawan['agama']; ?>
                
                    </td>
                    <td>
                    <?php 
                        $tunjangan;
                        ?>
                    </td>
                    <td>
                       <?php
                       $tunjangan;
                       ?>
                    </td>
                    <td>
                     <?php
                        $pajak;
                    ?>
                     
                    <?php
                       $gajiBersih;
                        ?>
                </td>
                    
                </tr>
                <?php endforeach ?>
                    </tbody>
                </table>
               
</body>

</html> 


<!-- perulangan
//1. conditonal looping
    While do , do while
  2. unconditional looping(perulangan pasti)
  for



-->
