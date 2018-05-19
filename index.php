<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Peringkasan Teks Bahasa Indonesia menggunakan AHP</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <title>SweetAlert</title>

    <link rel="stylesheet" href="example/example.css">
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- This is what you need -->
    <script src="dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style type="text/css">
#text5
{
background: url(search-dark.png) no-repeat 10px 6px #333;
color: #ccc;
width: 150px;
padding: 5px 15px 6px 10px;
border-radius: 20px;
box-shadow: 0 1px 0 #ccc inset;
transition:500ms all ease;
}
#text5:hover
{
width:180px;
}
    .jumbotron {
    position:relative
    left: 0px;
    top: 0px
    right: 0px;
    bottom: 25px;
    background: url("img/awan.jpg");
    margin: 0 auto;
    width: 500px;
    color: black;
    }

</style>
<body id="page-top" class="index">
<?php
        error_reporting(E_ERROR | E_PARSE);
        $awal = microtime(true);
        
        // scan nama file korpus
        $dir_corpus = "./corpus";
        $files      = scandir($dir_corpus);
        $files      = array_slice($files, 2);
        $nama_file    = $_GET["filename"];
        $kompresi     = $_GET["compression"];
?>


    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-fixed-top">
        <div class="container">
            <a class="navbar-brand page-scroll" href="#page-top">Peringkasan Teks Bahasa Indonesia menggunakan AHP</a>
            <button class="btn btn-primary btn-toggle hidden-md-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fa fa-bars"></i></button>
            <!-- Clearfix with a utility class added to allow for better navbar responsiveness. -->
            <div class="clearfix hidden-md-up"></div>
            <div class="collapse navbar-toggleable-sm" id="navbarResponsive">
                <ul class="nav navbar-nav float-md-right">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#hasilringkasan">Hasil Ringkasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#proses">Proses</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                
                    <h3><?="Peringkasan Teks"?></h3> 
                    <hr>
                       <form action="index.php" method="GET">
                            <center>
                            <div class="form-group">
                                <select class="form-control" name="filename" style="width:30%;" id="text5">
                                    <option value="0">Pilih File</option>
                                    <?php
                                    foreach ($files as $key => $value) {
                                        $title = str_replace("_", " ", substr($value, 0, -4));
                                        if($filename == $value) {
                                            echo "<option value='$value' SELECTED>$title</option>";
                                        }
                                        else {
                                            echo "<option value='$value'>$title</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            </center>
                            </p>
                            <script type="text/javascript">
                                function minmax(value, min, max) 
                                {
                                    if(parseInt(value) < min || isNaN(parseInt(value))) 
                                        return 0; 
                                    else if(parseInt(value) > max) 
                                        return 100; 
                                    else return value;
                                }
                            </script>
                            <input type="text" style="width:30%;" name="compression" placeholder="Kompresi" id="text5" maxlength="5" onkeyup="this.value = minmax(this.value, 0, 100)"/>
                            <hr>
                            <p><input class="btn btn-primary" type="submit" value="Ringkas Teks!" style="float: center;"></p>
                               
                            
                            
                        </form>
                    
            </div>
        </div>
    <?php        
        include "backup3.php";                           
    ?>
<script>
    swal("Peringkasan Teks Selesai", "", "success");
</script>

    </header>

   <section id="hasilringkasan">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <center><h2>Hasil Ringkasan</h2></center>
                    <center><h5><?=$judul;?></h2></center>


                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
            <div class="table-responsive">
                <table border="1" class="table">
                    <thead>
                        <tr>
                            <th><center>Teks Asli</center></th>
                            <th><center>Sesudah Ringkasan</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="justify" width="400px"><?php 
                                    foreach ($tampil as $line_num => $line){
                                        print $line . "<br />\n"; 
                                    }
                                ?>
                            </td>
                            <td align="justify" width="400px"><?php
                                    arsort($hranking);
                                    $compresi = $kompresi/100;
                                    $hasilcompresi = $compresi*count($hranking);
                                    $i = 0;
                                    foreach ($hranking as $line_num => $line){
                                        if($i<$hasilcompresi){
                                            $hasil[$i] = $line_num;
                                            $i++;
                                        } 
                                    }
                                    asort($hasil);
                                    foreach ($hasil as $line_num => $line){
                                        echo $tkalimat[$line].'. '; 
                                    }
                                ?>
                            </td>
                        </tr>
                       </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>

    <!-- proses Section -->
    <section id="proses">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <center><h2>Proses</h2></center>
                    <hr class="star-primary">
                </div>
                <div class="row">
                    <center><h3>Data Masukan</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Teks Asli</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="justify"><?php 
                                    foreach ($tampil as $line_num => $line){
                                        print $line . "<br />\n"; 
                                    }
                                ?>
                            </td>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Pemisahan Kalimat</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Hasil Kalimat</center></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr>";
                                        echo "<td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$k."</button></center>"." </td>";
                                        echo "<td align=justify>".$kalimat[$i][$j]."</td>";
                                        echo "</tr>";
                                        $k++;
                                        $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Case Folding</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Hasil Kalimat</center></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr>";
                                        echo "<td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$k."</button></center>"." </td>";
                                        echo "<td align=justify>".$kalimatcase[$i][$j]."</td>";
                                        echo "</tr>";
                                        $k++;
                                        $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Filtering</h3></center>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Hasil Kalimat</center></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr>";
                                        echo "<td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$k."</button></center>"." </td>";
                                        echo "<td align=justify>".$kalimatfilter[$i][$j]."</td>";
                                        echo "</tr>";
                                        $k++;
                                        $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Pemisahan Kata</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Kata</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 0;
                                $l = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$l."</button></center></td><td>";
                                        $l++;
                                        $a = count($kata[$i][$j]);
                                        while ($k < $a) {
                                           echo $kata[$i][$j][$k];
                                           $k++;
                                           if($k < $a){
                                             echo " | ";
                                           }
                                        }
                                        echo "</td></tr>";
                                       $k=0;
                                       $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Stopword</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Kata</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 0;
                                $l = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$l."</button></center></td><td>";
                                        $l++;
                                        $a = count($kalimatsw[$i][$j]);
                                        while ($k < $a) {
                                           echo $kalimatsw[$i][$j][$k];
                                           $k++;
                                           if($k < $a){
                                             echo " | ";
                                           }
                                        }
                                        echo "</td></tr>";
                                       $k=0;
                                       $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Stemming</h3></center>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Kata</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $i = 0;
                                $j = 0;
                                $k = 0;
                                $l = 1;
                                while($i <= $jparagraf-1){
                                    // hitung jumlah kalimat
                                    $jkalimat = count($kalimat[$i]);
                                    //selama j < jumlah kalimat
                                    while($j <= $jkalimat-1){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td bgcolor=#64d6c2><center> <button type='button' id='text5' class='btn btn-default'>Kalimat ke ".$l."</button></center></td><td>";
                                        $l++;
                                        $a = count($stemkalimat[$i][$j]);
                                        while ($k < $a) {
                                           echo $stemkalimat[$i][$j][$k];
                                           $k++;
                                           if($k < $a){
                                             echo " | ";
                                           }
                                        }
                                        echo "</td></tr>";
                                       $k=0;
                                       $j++;
                                    }
                                        // jumlah kalimat
                                    $j=0;
                                    $i++;       
                                }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Fitur 1</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f1);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</td><td align='center' width='400px'>".$f1[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Fitur 2</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f2);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f2[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Fitur 3</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f3);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f3[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                      <hr>
                    <center><h3>Fitur 4</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f4);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f4[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                      <hr>
                    <center><h3>Fitur 5</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f5);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f5[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                      <hr>
                    <center><h3>Fitur 6</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                    $a = count($f6);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f6[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                    while($j < 6){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$bfitur[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 1</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f1k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f1k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 2</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f2k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f2k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 3</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f3k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f3k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 4</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f4k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f4k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 5</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f5k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f5k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Bobot Fitur 6</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($f6k);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$f6k[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <center><h3>Ranking Kalimat</h3></center>
                    <table class="table">
                    <thead>
                        <tr>
                            <th><center>Kalimat</center></th>
                            <th><center>Nilai Fitur</center></th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $j = 0;
                                $l = 1;    
                                $a = count($hranking);
                                    while($j < $a){
                                        // case folding / merubah huruf besar ke huruf kecil
                                        echo "<tr><td align='center' width='400px'>Kalimat ke ".$l."</button></center></td><td align='center' width='400px'>".$hranking[$j]."</td></tr>";
                                        $l++;
                                        $j++;
                                    }
                            ?>
                        </tr>
                       </tbody>
                    </table>
                    <hr>
                    <h3>Kesimpulan</h3>
                    Berdasarkan Perhitungan diatas dan dengan kompresi sebesar <?= $kompresi."%"?> maka hasil ringkasan yang terbentuk adalah<br>
                    <?php
                                    arsort($hranking);
                                    $compresi = $kompresi/100;
                                    $hasilcompresi = $compresi*count($hranking);
                                    $i = 0;
                                    foreach ($hranking as $line_num => $line){
                                        if($i<$hasilcompresi){
                                            $hasil[$i] = $line_num;
                                            $i++;
                                        } 
                                    }
                                    asort($hasil);
                                    foreach ($hasil as $line_num => $line){
                                        echo $tkalimat[$line].'. '; 
                                    }
                                ?>
                </div>
            </div>
        </div>
    </section>
     <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Ramdan Chandra M - 10113230
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Tether -->
    <script src="vendor/tether/tether.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>
