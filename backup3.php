<?php
    include "koneksi.php";
    include "steamming.php";
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    $tampil = file("./corpus/".$nama_file);
    //////////////////////////////////////////////////////////////////
    $file = fopen("./corpus/".$nama_file,"r"); // masukan file yang diproses    //
    //////////////////////////////////////////////////////////////////
    $judul = substr($nama_file, 0, -4);
    function bacatext($file){
        $isitext = fgets($file); // baca text perbaris
        return $isitext;
    }
    if($file == false) // cek file
    {
       //echo "Error ketika membuka file";
       exit(); // hentikan script bila error
    }
     $za = 0;
   
    // inisialisasi jumlah paragraf
    $jparagraf = 0;
    while(!feof($file))
    {
        // masukan paragraf ke array
        $paragraf[$jparagraf][0]=bacatext($file);
        // jumlah paragraf
        $jparagraf++;
    }
    $jkalimat=0;
    
    // baca text
    // fungsi untuk pemisahan kalimat menggunakan banyak parameter
    function multiexplode ($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    while($jkalimat <= $jparagraf-1){
        // 1. pemisahan kalimat <- memisahkan kalimat dengan tanda .,?,!
        $kalimat[$jkalimat] = multiexplode(array(". ","? ","! "),$paragraf[$jkalimat][0]);
        $jkalimat++;       
    }
    function stopword($kalimatword) {
        include 'koneksi.php';
        $k=0;
        $a = count($kalimatword);
        while($k <= $a-1){
            $s_word = $kalimatword[$k];
            $result = $con->query("SELECT word FROM stopword WHERE word = '$s_word'");
            // jika data ada didalam kamus. maka, array yang di cari dihilangkan dari array
            if($result->num_rows > 0 ){// stopword removal
            // hapus array yang terdapat dikamys
                unset($kalimatword[$k]);
            }
            $k++;
        }
        $hasil = array_values($kalimatword);   
        return $hasil;
    }
    function stemming($kalimatstem) {
        
        $k=0;
        $a = count($kalimatstem);
        while($k <= $a-1){
            $s_tem = $kalimatstem[$k];
            $s_tem2 = $s_tem;
            if(cari($s_tem)!=1){
                $s_tem = hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($s_tem)))));
            }
            
                $kalimatstem[$k] = $s_tem;
            
            $k++;
        }
        $hasil = array_values($kalimatstem);   
        return $hasil;
    }
    
    $k = 0;
    $judulcase = strtolower($judul);
    // fitering
    $judulfilter = preg_replace("/[^a-z ]/", '',$judulcase);   
    // tokenizing
    $kjudul = explode(" ",$judulfilter);
    $kjudul = array_values(array_filter($kjudul));
    $judulword = stopword($kjudul);
    // proses case folding
    $i=0;
    $j=0;
    $k=0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        //selama j < jumlah kalimat
        while($j <= $jkalimat-1){
            // case folding / merubah huruf besar ke huruf kecil
            
            $tkalimat[$k] = $kalimat[$i][$j];
            $k++;
            $kalimatcase[$i][$j] = strtolower($kalimat[$i][$j]);
            // fitering
            $kalimatfilter[$i][$j] = str_replace('-', ' ', $kalimatcase[$i][$j]);
            $kalimatfilter[$i][$j] = preg_replace("/[^a-z ]/", '',$kalimatfilter[$i][$j]);   
            // tokenizing
            $kata[$i][$j] = explode(" ",$kalimatfilter[$i][$j]);
            $kata[$i][$j] = array_values(array_filter($kata [$i][$j]));
            // urutkan kembali array
            $hasil[$i][$j] = array_values($kata[$i][$j]);   
            $kalimatsw[$i][$j] = stopword($kata[$i][$j]);
            $j++;
        }
        // jumlah kalimat
        $j=0;
        $i++;       
    }
    $stemjudul = stemming($judulword);
       
    // inisialisasi variable untuk case folding
    $i = 0;
    $j = 0;
    $k = 0;
    // proses stemming
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            // jumlah kata dalam kalimat
            $a = count($kalimatsw[$i][$j]);
            $stemkalimat[$i][$j] = stemming($kalimatsw[$i][$j]);
            $stemkalimat2[$k] = $stemkalimat[$i][$j];
            $j++;
            $k++;
        }
        // jumlah kalimat
        $j=0;
        $i++;
    }
    //////////////////////////////////////////////////
    // F1
    //////////////////////////////////////////////////
    $i = 0;
    $j = 0;
    $k = 0;
    $skalimat = 0;
    $df = 0;
    $df_token	= array();

    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        $skalimat += $jkalimat;
        while($j <= $jkalimat-1){

            $inv_index	= array();

            // menyimpan nilai df tiap token
            $token = array_count_values($stemkalimat[$i][$j]); // hilangkan redudansi token
            foreach ($token as $key => $value) {
                // jika token sudah ada
				if (isset($df_token[$key])==false){
					$df_token[$key] = 1;
                }
                else{
                    $df_token[$key] = $df_token[$key] +1;
                }    
            }
            // membuat array inverted index
            foreach ($df_token as $key => $value) { 
                $df	= $value;
                $inv_index[$key] 		= array();
                $inv_index[$key]['idf']	= log10($skalimat/$df); // simpan nilai idf
            }
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }
    $i = 0;
    $j = 0;
    $k = 0;
    $max = 0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            $tf_idf 	= 0;
			$freq_word 	= array_count_values($stemkalimat[$i][$j]);

			// hitung bobot tf.idf
			foreach ($freq_word as $token => $tf){
                $tf_idf += $tf * $inv_index[$token]['idf'];
                $a = $tf * $inv_index[$token]['idf'];
                if($max<$a){
                    $max = $a;
                }
            }
            $f1[$k]= $tf_idf/$max;
            $k++;
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }        
    ///////////////////////////////////////////////////////////////////
    ////Fitur2/////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////
   
    $i = 0;
    $j =0;
    
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            $freq_word 	= array_count_values($stemkalimat[$i][$j]);    
			
            // hitung bobot tf.idf
			foreach ($freq_word as $token => $tf){
                $xaxa[$token] =null;            
            }
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }
    $d = 0;
    $i = 0;
    $j =0;
    $tkeyword = 0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            $freq_word 	= array_count_values($stemkalimat[$i][$j]);    
	        
            // hitung bobot tf.idf
			foreach ($freq_word as $token => $tf){
                foreach ($freq_word as $token2 => $tf2){
                
                    if($token == $token2){
                        $xaxa[$token2] = $xaxa[$token2] + $tf;
                    }
                }
            }
                
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    } 
    
    $i = 0;
    $j = 0;
    $k = 0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        $hf2 = 0.1;
        while($j <= $jkalimat-1){
            $freq_word 	= array_count_values($stemkalimat[$i][$j]);    
	        
            // hitung bobot tf.idf
			foreach ($freq_word as $token => $tf){
                if($xaxa[$token]>1){
                    $hf2 = $hf2 + (0.1*$tf);
                    $tkeyword++;
                }
            }
            $f2[$k] = $hf2; 
            $k++;
            $hf2 = 0.1;
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }        
    //////////////////////////////////////////
    // Fitur ke 3
    //////////////////////////////////////////
    
    $i =0;
    $j =0;
    $k =0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        $hf3a = 0.1;
        $hf3b = 0;
        while($j <= $jkalimat-1){
            $freq_word 	= array_count_values($stemkalimat[$i][$j]);    
	        
            // hitung bobot tf.idf
			foreach ($freq_word as $token => $tf){
                if (in_array($token, $stemjudul)){
                    $hf3a +=1;
                }else{
                    $hf3b +=1;
                }
            }
            $f3[$k] = $hf3a/($hf3a+$hf3b);
            $hf3a = 0.1;
            $hf3b = 0;
            $j++;
            $k++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }
    //////////////////////////////////////////
    // Fitur ke 4
    //////////////////////////////////////////
    
    $i =0;
    $j =0;
    $k =0;
    $a = 0.1;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        $hf4a = 0.1;
        while($j <= $jkalimat-1){
            $freq_word  = array_count_values($stemkalimat[$i][$j]);    
            // hitung bobot tf.idf
            foreach ($freq_word as $token => $tf){
                $hf4a +=1;       
            }
            $f4[$k] = $hf4a/($tkeyword+$a);  
            $f4[$k];
            $k++;
            $hf4a = 0.1;
            $j++;
        }
        // jumlah kalima
        $j=0;
        $i++;
    }
    //////////////////////////////////////////
    // Fitur ke 5
    //////////////////////////////////////////
    
    $i =0;
    $j =0;
    $k =0;
    $max = 0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            $a = count($stemkalimat[$i][$j]);
            $jkkalimat = $a;
            if($max<$jkkalimat){
                $max = $jkkalimat;
            }
            $j++;
            $lk = max((1/$j),(1/($jkalimat-$j+1)));
            $f5[$k] = $lk;
            $k++;
        }
        $lk = 0;
        // jumlah kalima
        $j=0;
        $i++;
    }
    //////////////////////////////////////////
    // Fitur ke 6
    //////////////////////////////////////////
    
    $i =0;
    $j =0;
    $k =0;
    $hf6 = 0;
    while($i <= $jparagraf-1){
        // hitung jumlah kalimat
        $jkalimat = count($kalimat[$i]);
        while($j <= $jkalimat-1){
            $a = count($stemkalimat[$i][$j]);
            $hf6 = $a/$max;
            $f6[$k]=$hf6;
            $hf6 = 0;
            $k++;
            $j++;
        }
        $j=0;
        $i++;
    }
    
    //...... /////////
    //....... Penjelasannya salah
    //......... Perbaiki Lagi
    ///////////////////////////////////////////
    // Metode AHP
    // 1. Jumlahkan setiap isi Fitur 
    // 2. Bandingkan jumlah isi fitur dengan jumlah isi fitur lainnya 
    // 3. Bandingkan kalimat tiap fitur
    // 4. Hitung bobot akhir untuk menentukan kalimat
    //////////////////////////////////////////
    ////////
    // 1 ///
    ////////
    $i = 0;
    $jf1 = 0;
    $jf2 = 0;
    $jf3 = 0;
    $jf4 = 0;
    $jf5 = 0;
    $jf6 = 0;
    
    while($i<$skalimat){
        $jf1 += $f1[$i];
        $jf2 += $f2[$i];
        $jf3 += $f3[$i];
        $jf4 += $f4[$i];
        $jf5 += $f5[$i];
        $jf6 += $f6[$i];
        $i++;
        if($i==$skalimat){
            $jf1 = $jf1/$skalimat;
            $jf2 = $jf2/$skalimat;
            $jf3 = $jf3/$skalimat;
            $jf4 = $jf4/$skalimat;
            $jf5 = $jf5/$skalimat;
            $jf6 = $jf6/$skalimat;
        }
    }
    ////////
    // 2 ///
    ////////
    $mfitur = [$jf1,$jf2,$jf3,$jf4,$jf5,$jf6];
    //echo $hjmatriks[0].' | '.$hjmatriks[1].' | '.$hjmatriks[2].' | '.$hjmatriks[3].' | '.$hjmatriks[4].' | '.$hjmatriks[5].'<br>';
    function hbobotmatriks($mfitur) {
        // array fitur
        $hjmatriks = array();
        $i = 0;
        $j = 0;
        $k = 0;
        $c = count($mfitur);
        while($i<=$c-1){
            while($j<=$c-1){
                $hmatriks[$i][$j] = $mfitur[$i]/$mfitur[$j];
                $j++;
            }
            $j=0;
            $i++;
        }
        $i = 0;
        $j = 0;
        $k = 0;
        $hjmatrik = 0;
        $c = count($mfitur);
        //penjumlahan array
        while($j<=$c-1){
            while($i<=$c-1){
                $hjmatrik += $hmatriks[$i][$j];
                $i++;
            }
            $hjmatriks[$k] = $hjmatrik;
            $k++;
            $hjmatrik =0;
            $i=0;
            $j++;       
        }
        //normalisasi
        $i = 0;
        $j = 0;
        $k = 0;
        $c = count($mfitur);
        while($j<=$c-1){
            while($i<=$c-1){
                $hmatriks[$i][$j] = $hmatriks[$i][$j]/$hjmatriks[$k];
                $i++;
            }
            $k++;
            $i=0;
            $j++;
        }
        $i = 0;
        $j = 0;
        $k = 0;
        $hjmatrik = 0;
        $c = count($mfitur);
        while($i<=$c-1){
            while($j<=$c-1){
                $hjmatrik += $hmatriks[$i][$j];
                $j++;
            }
            $hjmatriks[$k] = $hjmatrik/$c;
            $k++;
            $hjmatrik =0;
            $j=0;
            $i++;       
        }
        return $hjmatriks;
    }
    function perkalian_matriks($bfitur, $bkalimat) {
        $i = 0;
        $j = 0;
        $k = 0;
        $c = count($bkalimat[0]);
        while($j<=$c-1){
            $d = count($bfitur);
            while($i<=$d-1){
                $hbobot[$i][$j] = $bkalimat[$i][$j]*$bfitur[$i];
                $i++;
            }
            $k++;
            $i=0;
            $j++;
        }
        $i = 0;
        $j = 0;
        $k = 0;
        $hranking = 0;
        $c = count($bkalimat[0]);
        while($j<=$c-1){
             $d = count($bfitur);
            while($i<=$d-1){
                $hranking += $hbobot[$i][$j];
                $i++;
            }
            $hjmatriks[$k] = $hranking;
            $k++;
            $hranking =0;
            $i=0;
            $j++;       
        }
        return $hjmatriks;
    }
    $bfitur = hbobotmatriks($mfitur);
    $f1k = hbobotmatriks($f1);
    $f2k = hbobotmatriks($f2);
    $f3k = hbobotmatriks($f3);
    $f4k = hbobotmatriks($f4);
    $f5k = hbobotmatriks($f5);
    $f6k = hbobotmatriks($f6);
    $bkalimat = array($f1k,$f2k,$f3k,$f4k,$f5k,$f6k);
    $hranking = perkalian_matriks($bfitur,$bkalimat);
    ?>