<script type="text/javascript"> 
function PRINT(){ 
win=window.open('print.php','win','width=1000, height=1000, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>

<div align="right">
	<h3>
	<a href="?mnu=apriori">Apriori </a> |
	<a href="?mnu=cbc">Colaborative</a>
	</h3>
</div>
<?php
$sql="select `tanggal` from `$tbbaca` order by `tanggal` asc limit 0,1";
$d=getField($conn,$sql);
$tanggal=$d["tanggal"];
$ar=explode("-",$tanggal);
$bul=$ar[1];
$thn=$ar[2];
$awaltanggal=$tanggal;//"$thn-$bul-01";


function getSel($tanggal1,$tanggal2){
	$tanggal1 = new DateTime($tanggal1);
	$tanggal2 = new DateTime($tanggal2);
	$perbedaan = $tanggal2->diff($tanggal1)->format("%a");
	return $perbedaan;
} 

$sql="select * from `$tbpengujian` order by `id_pengujian` desc";
if(isset($_GET["id"])){
	$id_pengujian=$_GET["id"];
	$sql="select * from `$tbpengujian` where `id_pengujian`='$id_pengujian'";
}

	$d=getField($conn,$sql);
				$id_pengujian=$d["id_pengujian"];
				$_SESSION["id_pengujian"]=$id_pengujian;
				$nama_pengujian=$d["nama_pengujian"];
				$waktu_pengujian=$d["waktu_pengujian"];
				$tanggal_mulai_analisa=($d["tanggal_mulai_analisa"]);
				$tanggal_akhir_analisa=($d["tanggal_akhir_analisa"]);
				
				$tanggal1=WKT($tanggal_mulai_analisa);
				$tanggal2=WKT($tanggal_akhir_analisa);
				
				$support_min=$d["support_min"];
				$confident_mint=$d["confident_mint"];
				$catatanq=$d["catatan"];
				$keterangan1=$d["keterangan"];
				$rekapitulasi1=$d["rekapitulasi1"];
				$hasil1=$d["hasil1"];
				
				//$_SESSION["chitung"]=true;
			
$SUP=$support_min;
$CONF=$confident_mint;

if(isset($_POST["Hitung"])){// || isset($_SESSION["chitung"])
	$SUP=$_POST["sup"];
	$CONF=$_POST["conf"];
		$tanggal1=$_POST["tanggal1"];
		$tanggal2=$_POST["tanggal2"];
		$_SESSION["chitung"]=true;
}


$_SESSION["cid_pengujian"]=$id_pengujian;
$_SESSION["cnama_pengujian"]=$nama_pengujian;				
echo"	
<h1>Analisa Base Market Analysis</h1>		
<table class='table table-bordered' >
<tr>
<td width='162' height='24'><label for='nama_pengujian'>Nama Pengujian</label>
<td width='27'>:<td width='393'><b>$nama_pengujian</b></td>
</tr>


<tr>
<td height='24'><label for='tanggal_mulai_analisa'>Waktu</label>
<td>:<td>$tanggal1 s/d $tanggal2
</td>
</tr>

<tr>
<td height='24'><label for='support_min'>Support Min</label>
<td>:<td>$support_min %</td>
</tr>

<tr>
<td height='24'><label for='confident_mint'>Confident Min</label>
<td>:<td>$confident_mint %
</td>
</tr>
<tr>
<td width='162' height='24'><label for='nama_pengujian'>Tanggal Pengujian</label>
<td width='27'>:<td width='393'>$waktu_pengujian Wib</td>
</tr>
<tr>
<td height='24'><label for='catatan'>Catatan</label>
<td>:<td>$catatan1 $keterangan1</td>
</tr>
</table><hr>";

echo"<H1>Algoritma Apriori</h1>";

echo"Merupakan salah satu algoritma klasik Data Mining. 
Algoritma APRIORI digunakan agar komputer dapat mempelajari aturan asosiasi, 
mencari pola hubungan antar satu atau lebih item dalam suatu dataset.
Disebut juga sebagai Market Base Analitik yaitu untuk mempelajari tentang patterrn growth.
<br>
merupakan algoritma  berbasis  <i>candidate generation and test</i>  dan merupakan penyempurnaan dari algoritme penentuan pola sekuensial sebelum-sebelumnya. Selanjutnya akan dilihat kecenderungan pembelian berita oleh customer dalam kurun waktu tertentu. Kejadian seperti ini sebenarnya terekam dalam database, hanya saja belum tergali informasi tentang itu. Dengan mencari pola- pola dari database menggunakan algoritma APRIORI, akan terlihat keterkaitan jenis berita yang dibeli oleh customer pada waktu tertentu

<br><br>

<b><u>Prosesnya adalah sbb:</b></u><br>

<b>A.Sequential Pattern Mining</b><br>
Untuk menemukan hubungan antar item yang ada pada suatu dataset (data-sequence).
<br>

<b>B.Pola Sekuensial</b><br>
Sebagai daftar urutan dari sekumpulan  item. Diaman sebuah pola sekuensial dengan  k-item   disebut  k-sequence. 
Sebagai contoh, (A →BC) merupakan sebuah sequence dengan 3-sequence. 
Panjang sebuah pola sekuensial adalah jumlah item yang terdapat pada pola sekuensial tersebut yang dilambangkan dengan |s|.
<br>
Sebagai contoh, (A→BC) merupakan subsequence  dari (A→DE→BC) atau (D→AB→BC) tetapi bukan  subsequence  dari (ABC) atau (BC→A) (berdasarakan α Minimum Supportnya).
<br>

<b>C.Pendekatan Hyper-lattice</b><br>
Setiap  sequences  dibentuk dengan menambah sebuah  item  baru ke sequences dari layer sebelumnya.
<br>
<b>D.Apriori Algorithm</b><br>
Penemuan pola urutan / sekuensial data menggunakan kelas yang ekivalen / sama) berurutan.<br>
<img src='ypathfile/Apriori.jpg' width='300' height='180'>
<hr>

<b>Besaran Pada Apriori</b>:<br>
Penentuan pola sekuiensial pertama kali diperkenalkan oleh Agrawal dan Srikant pada tahun 1994. 
Pola sekuensial adalah pola yang menggambarkan urutan waktu dari peristiwa yang sering terjadi. Diberikan satu set sequence, dimana setiap sequence terdiri dari satu set item, dan diberikan sebuah batasan minimum support yang ditentukan oleh pengguna, sequential pattern mining adalah menemukan seluruh sub-sequence dimana frekuensi kemunculannya tidak lebih kecil dari minimum support yang sudah ditentukan di atas.
<br>
Dalam aturan asosiasi, ada 2 poin untuk menghasilkan aturan yang tepat, yaitu Nilai Support dan Confident.
<b>Nilai Support (s)</b> merupakan persentase jumlah kasus untuk kombinasi item tertentu.
<img src='ypathfile/app1.png' width='300' height='180'>
Dimana X∪Y merupakan jumlah baca yang berisi X dan Y, sementara N merupakan total jumlah seluruh baca. Nilai support menjadi ukuran yang sangat penting dalam aturan asosiasi karena aturan yang sangat lemah nilai support-nya berarti asosiasi tersebut sangat jarang terjadi dalam dataset (seluruh data baca).
<br>
<b>Nilai Confident</b>
<img src='ypathfile/app2.png' width='300' height='180'><br>
Nilai Confident (c) merupakan persentase keakurasian dari aturan asosiasi yang dihasilkan.
<hr>";


				

if(isset($_POST["Reset"])){
	$sql="select `tanggal` from `$tbbaca` order by `tanggal` asc limit 0,1";
	$d=getField($conn,$sql);
	$tanggal1=WKT($d["tanggal"]);
	$tanggal2=WKT(date("Y-m-d"));
		unset($_SESSION["chitung"]);		
$SUP=2;
$CONF=40;
}


echo"<form action='' method='post'>";
echo"<table width='100%' border='1'>";
$NM=strtoupper($nama_pengujian);
echo"<tr bgcolor='#ffff00'><td colspan='3'>SPADE ASSOSIASI $NM</tr>";
echo"<tr><td>Batas Minimum Support<td>:<td><input type='text' name='sup' value='$SUP'> %</tr>";
echo"<tr><td>Batas Minimum Confident<td>:<td><input type='text' name='conf' value='$CONF'> %</tr>";
echo"<tr><td>Batas Tanggal<td>:<td>
<input type='text' name='tanggal1' value='$tanggal1' id='tanggal1'> 
s/d
<input type='text' name='tanggal2' value='$tanggal2' id='tanggal2'> 
</tr>";
echo"<tr><td colspan='3' align='right'>
<input type='submit' class='btn btn-success'  value='HITUNG / ANALISA APRIORI' name='Hitung'>
<input type='submit' class='btn btn-danger'  value='RESET' name='Reset'>

</tr>";
echo"</table>";
echo"</form>";

if(isset($_POST["Hitung"]) ){//|| isset($_SESSION["chitung"])
	$SUP=$_POST["sup"];
	$CONF=$_POST["conf"];
	$TGL1=$_POST["tanggal1"];
	$TGL2=$_POST["tanggal2"];
	$tanggal1=BAL($TGL1);
	$tanggal2=BAL($TGL2);
	
	$_SESSION["csup"]=$SUP;
	$_SESSION["cconf"]=$CONF;
	$_SESSION["ctgl1"]=$TGL1;
	$_SESSION["ctgl2"]=$TGL2;
	
	
	
$sql="select `id_baca`,`tanggal` from `$tbbaca` where `tanggal` between '$tanggal1' and '$tanggal2'  order by `id_baca` asc ";
$jum0=getJum($conn,$sql);
  

$gabx="<b>Informasi baca  $TGL1 s/d $TGL2</b>";
$gabx.="<table width='100%' border='1'>";
$gabx.="<tr bgcolor='#ffff00'>
<td>No
<td><label title='ID Pelanggan/Customer'>IDC</label>
<td><label title='Selisih Waktu baca'>SEL</label><td>Item List (Sequence)</tr>";
$total=0;

$arG=array();
$arSID=array();
$arSID_=array();
$m=0;
  $jum0=getJum($conn,$sql);
		if($jum0 <1){
			echo"Maaf data baca belum tersedia...<br>";
		}
		else{
		$arr=getData($conn,$sql);
		foreach($arr as $d) {	
				$clr="#dddddd";if($m%2==0){$clr="$eeeeee";}					
				$id_baca=$d["id_baca"];
				$tanggaltx=$d["tanggal"];
				
				$SID=getSel($awaltanggal,$tanggaltx);
$clr="";
				$gab="$id_baca#";
				$gabcol="@";
				$mlist="";				
				$sqlg="select `id_berita` from `$tbdetail` where `id_baca`='$id_baca' order by `id_detail` asc";
					$arrg=getData($conn,$sqlg);
					foreach($arrg as $dg) {
						$id_berita=$dg["id_berita"];
						$nmberita=getberita($conn,$id_berita);
							$jd0=cekAda($gabcol,$nmberita);
							if($jd0>1){$gabcol.="#";$mlist.="#";$clr="#ff0000";}
							
						$gab.="$id_berita#";
						$gabcol.="$nmberita#";
						
						$mlist.="$nmberita ($id_berita),";
					}
					$gab=substr($gab,0,strlen($gab)-1);
					$arG[$m]=$gab;
					$arSID[$m]=$SID;
					$tglrange="$awaltanggal s/d $tanggaltx";
					$arSID_[$m]=$tglrange;
					//echo $arG[$m]."<br>";
					$m++;
					
					$mlist=substr($mlist,0,strlen($mlist)-1);
					$gabx.="<tr bgcolor='$clr'><td>$m<td>$id_baca
					<td><label title='$tglrange'>$SID</label><td>$mlist</tr>";	
			}//foreach
		}//jum0
$gabx.="</table><br><br>";
echo $gabx;		
//======================================================================
if( $jum0>0){
$record="<b>Perhitungan $jum0 Data baca yang Terjadi Antara $TGL1 s/d $TGL2 <br>
Dengan Batas Ambang Support $SUP dan batas Ambang Confident $CONF adalah sebagai berikut</b><br>";
$_SESSION["cket"]="<b>Perhitungan dari $jum0 Data baca yang Terjadi Antara $TGL1 s/d $TGL2</b> dengan Batas Ambang Support $SUP % dan batas Ambang Confident $CONF %";

$sqlg="select distinct(`id_berita`) from `$tbdetail` order by `id_berita` asc";
$arrg=getData($conn,$sqlg);
$n=0;

echo $record;

$gab="<b>k-itemset ( k=1)</b><br>
baca dengan pembangkitan itemset k=1, 
maka itemset yang dapat dibentuk beserta dengan jumlah kemunculan nya dalam seluruh baca sebagai berikut :<br>";
$gab.="<table width=\"60%\" border=\"1\">";






//SID EID SIZE ITEM_SET
$gab.="<tr bgcolor=\"#ffff00\"><td>No<td>Kode<td> Item List<td>Jumlah<td>Support<td>Confident</tr>";
$total=0;
foreach($arrg as $dg) {
	$id_berita=$dg["id_berita"];
	$nm=getberita($conn,$id_berita);
	$jump=hitJumlah1($arG,$id_berita);
	$support=($jump/$jum0)*100;
	$support_="($jump/$jum0)x100";
	
	$cc0="$id_berita";
	$confident=($jump/$jump)*100; if($confident>100){$confident=100;}
	if($support>=$SUP && $confident>=$CONF){
		$cc=$id_berita;
		$arP[$n]=$cc;
		$arN[$n]=$nm;
		$arJ[$n]=$jump;
		$arS[$n]=$support;
		$total+=$jump;
		
		$ARI[$cc]=$jump;
		
		$confident_="($jump/".$ARI[$arP[$n]].")x100";
		$arC[$n]=$confident;
		$no=$n+1;
		$clr="#dddddd";if($no%2==0){$clr="$eeeeee";}
		$gab.="<tr bgcolor=\"$clr\"><td>$no<td>$id_berita<td>$nm<td>$jump
		<td><label title=\"$support_\">$support</label>
		<td><label title=\"$confident_\">".bul($confident)."</label></tr>";
			$n++;
	}
}
$gab.="<tr bgcolor=\"#ff00f0\"><td colspan=\"3\">
Total baca<td colspan=\"3\"  align=\"left\">$total</tr>";
$gab.="</table><br>";
echo $gab;
$record.=$gab;
$gab="<b>k-itemset (k=2)</b><br>
lanjut pada tahap iterasi kedua dengan nilai k=2, 
berarti kita akan membentuk kombinasi dari 2 buah itemset sebagai berikut :";

$gab.="<table width=\"80%\" border=\"1\">";
$gab.="<tr bgcolor=\"#ffff00\"><td>No<td>Kode1-Kode2<td>Nama Item1-Nama Item2-<td>Jumlah<td>Support<td>Confident</tr>";
$n=0;
$total=0;
$JTX1=count($arP);
for($i=0;$i<$JTX1-1;$i++){
	$id_berita1=$arP[$i];
	$nm1=$arN[$i];
for($j=$i+1;$j<$JTX1;$j++){
	$id_berita2=$arP[$j];
	$nm2=$arN[$j];
	$jump=hitJumlah2($arG,$id_berita1,$id_berita2);
	$support=($jump/$jum0)*100;
	$support_="($jump/$jum0)x100";
	
	$cc0=$id_berita1;
	$confident=($jump/$ARI[$cc0])*100;if($confident>100){$confident=100;}	
	if($support>=$SUP && $confident>=$CONF){
		$cc="$id_berita1-$id_berita2";
		$arP2[$n]=$cc;
		$arN2[$n]="$nm1-$nm2";
		$arJ2[$n]=$jump;
		$arS2[$n]=$support;
		$total+=$jump;
		
		
		$confident_="($jump/".$ARI[$cc0].")x100";
		$arC2[$n]=$confident;
		$ARI2[$cc]=$jump;
		
		$no=$n+1;
		$clr="#dddddd";if($no%2==0){$clr="$eeeeee";}
		$gab.="<tr bgcolor=\"$clr\"><td>$no<td>$arP2[$n]<td>$arN2[$n]<td>$arJ2[$n]
		<td><label title=\"$support_\">$support</label>
		<td><label title=\"$confident_\">".bul($confident)."</label></tr>";

			$n++;
	}
	}//j
}//i
$gab.="<tr bgcolor=\"#ff00f0\"><td colspan=\"3\">Total baca<td colspan=\"3\" align=\"left\">$total</tr>";
$gab.="</table><br>";
echo $gab;
$record.=$gab;

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


$kes="<b>Aturan Asosiasi :</b><br><ul>";
$sql="delete from `$tbtemp` where `id_pengujian`='$id_pengujian'";
$hapus=process($conn,$sql);


$gab="<b>k-itemset (k=3)</b><br>
lanjut pada tahap iterasi kedua dengan nilai k=3, 
berarti kita akan membentuk kombinasi dari 3 buah itemset sebagai berikut :";

$gab.="<table width=\"100%\" border=\"1\">";
$gab.="<tr bgcolor=\"#ffff00\"><td>No<td>Kode1-Kode2-Kode3<td>Nama Item1-Nama Item2-Nama Item3
<td>Jumlah<td>Support<td>Confident</tr>";
$n=0;
$total=0;
$JTX1=count($arP);
for($i=0;$i<$JTX1-2;$i++){
	$id_berita1=$arP[$i];
	$nm1=$arN[$i];
for($j=$i+1;$j<$JTX1-1;$j++){
	$id_berita2=$arP[$j];
	$nm2=$arN[$j];
	for($k=$j+1;$k<$JTX1;$k++){
		$id_berita3=$arP[$k];
		$nm3=$arN[$k];
		
	$jump=hitJumlah3($arG,$id_berita1,$id_berita2,$id_berita3);
	$support=($jump/$jum0)*100;
	$support_="($jump/$jum0)x100";
	
	$cc0="$id_berita1-$id_berita2";
	$BWH=$ARI2[$cc0];
	$confident=0;
	if($BWH>0){
		$confident=($jump/$BWH)*100;
		if($confident>100){$confident=100;}
	}
	if($support>=$SUP && $confident>=$CONF){
		$cc="$id_berita1-$id_berita2-$id_berita3";
		
		$key1="$id_pengujian-$id_berita1";
		$key2="$id_pengujian-$id_berita2";
		$key3="$id_pengujian-$id_berita3";
		$ctt0="<b>Jika Membaca</b> <i>$nm1</i>  <b>dan</b> <i>$nm2</i> <b>maka akan Membaca</b> <i>$nm3</i> =".round($confident)." %";
		$ctt="<b>Jika Membaca</b> $nm1 <b>dan</b> $nm2 <b>maka akan Membaca</b> $nm3=".round($confident)." %";
 $sqlw="INSERT INTO `$tbtemp` (`id_key`, `id_pengujian`, `id_berita`, `keterangan`) 
	VALUES ('$key1', '$id_pengujian', '$id_berita1', '$ctt')";	
		process($conn,$sqlw);
		
 $sqlw="INSERT INTO `$tbtemp` (`id_key`, `id_pengujian`, `id_berita`, `keterangan`) 
	VALUES ('$key2', '$id_pengujian', '$id_berita2', '$ctt')";	
		process($conn,$sqlw);

 $sqlw="INSERT INTO `$tbtemp` (`id_key`, `id_pengujian`, `id_berita`, `keterangan`) 
	VALUES ('$key3', '$id_pengujian', '$id_berita3', '$ctt')";	
		process($conn,$sqlw);

		
		
		$kes.="<li>$ctt0</li>";
		$arP3[$n]=$cc;
		$arN3[$n]="$nm1-$nm2-$nm3";
		$arJ3[$n]=$jump;
		$total+=$jump;
		$arS3[$n]=$support;
		
		
		$confident_="($jump/".$ARI2[$cc0].")x100";
		$arC3[$n]=$confident;
		$ARI3[$cc]=$jump;
		
		$no=$n+1;
		$clr="#dddddd";if($no%2==0){$clr="$eeeeee";}
		$gab.="<tr bgcolor=\"$clr\"><td>$no<td>$arP3[$n]<td>$arN3[$n]<td>$arJ3[$n]
		<td><label title=\"$support_\">$support</label>
		<td><label title=\"$confident_\">".bul($confident)."</label></tr>";

			$n++;
	}
	}//k
	}//j
}//i
$kes.="</ul>";

$gab.="<tr bgcolor=\"#ff00f0\"><td colspan=\"3\">Total baca<td colspan=\"3\" align=\"left\">$total</tr>";
$gab.="</table><br><hr>";
echo $gab;
echo $kes;

$record.=$gab;
$record.=$kes;
$_SESSION["crecord"]=$record;
$_SESSION["chasil"]=$kes;

echo"<img src='ypathfile/print2.jpg' title='PRINT'  width='150' height='130' OnClick='PRINT()'> ||";
echo"<a href='?mnu=apriori&pro=save'><img src='ypathfile/save.jpg' title='SIMPAN' width='120' height='100'></a>";

}// $jum0>0
}//isset hitung

else{
	
	if(strlen($keterangan1)>30){	
	echo"	
		<h1>Hasil Base Market Analysis</h1>		
		<table class='table table-bordered' > 
		<tr>
		<td width='162' height='24'>
		<label for='nama_pengujian'>Rekapitulasi Pengujian</label>
		<td width='27'>:<td width='393'>$rekapitulasi1</td>
		</tr>
		</table><hr>";
	}//length	
else{
	echo"<h3><marquee>Silakan Lakukan Perhitungan Apriori kembali...</marquee></h3>";
}
}



function cekAda($str,$cari){
 $str=($str);
 $sp=strstr($str,$cari);
 $p=strlen($sp)+0;
 return $p;
}
function hitJumlah1($arG,$id_berita){
	$m=count($arG);
	$ada=0;
	for($i=0;$i<$m;$i++){
		$ar=explode("#",$arG[$i]);
			for($j=1;$j<count($ar);$j++){//id_baca,ID_berita1,ID_berita2,ID_berita1,
				if($ar[$j]==$id_berita){$ada++;break;}//Tak ada break =krn  1 idInvoice tak ada berita yg berulang
			}
	}
	return $ada;
}

function hitJumlah2($arG,$id_berita,$id_berita2){
	$m=count($arG);
	$ada=0;
	for($i=0;$i<$m;$i++){
		$ada2=0;
		$ar=explode("#",$arG[$i]);
			for($j=1;$j<count($ar);$j++){//id_baca,ID_berita1,ID_berita2,ID_berita1,
				if($ar[$j]==$id_berita || $ar[$j]==$id_berita2){$ada2++;}
			}
		if($ada2>=2){$ada++;}
	}
	return $ada;
}
function hitJumlah3($arG,$id_berita,$id_berita2,$id_berita3){
	$m=count($arG);
	$ada=0;
	for($i=0;$i<$m;$i++){
		$ada2=0;
		$ar=explode("#",$arG[$i]);
			for($j=1;$j<count($ar);$j++){//id_baca,ID_berita1,ID_berita2,ID_berita1,
				if($ar[$j]==$id_berita || $ar[$j]==$id_berita2 || $ar[$j]==$id_berita3){$ada2++;}
			}
		if($ada2>=3){$ada++;}
	}
	return $ada;
}
function hitJumlah4($arG,$id_berita,$id_berita2,$id_berita3,$id_berita4){
	$m=count($arG);
	$ada=0;
	for($i=0;$i<$m;$i++){
		$ada2=0;
		$ar=explode("#",$arG[$i]);
			for($j=1;$j<count($ar);$j++){//id_baca,ID_berita1,ID_berita2,ID_berita1,
				if($ar[$j]==$id_berita || $ar[$j]==$id_berita2 || $ar[$j]==$id_berita3 || $ar[$j]==$id_berita4){$ada2++;}
			}
		if($ada2>=4){$ada++;}
	}
	return $ada;
}



	
if(isset($_GET["pro"]) && $_GET["pro"]=="save"){
  //$tanggal=date("Y-m-d");
  //$nama_pengujian=$_SESSION["cid"]."-".date("Y-m-d H:i:s");
  $keterangan=$_SESSION["cket"];
  $hasil=$_SESSION["chasil"];
  $nama_pengujian=$_SESSION["cnama_pengujian"];
  $rekapitulasi=$_SESSION["crecord"];
  $id_pengujian=$_SESSION["cid_pengujian"];
  	$SUP=$_SESSION["csup"];
	$CONF=$_SESSION["cconf"];
	$TGL1=$_SESSION["ctgl1"];
	$TGL2=$_SESSION["ctgl2"];
	
  $sql="update `$tbpengujian` set 
	`support_min`='$SUP' ,`keterangan`='$keterangan' ,
	`confident_mint`='$CONF',
	`rekapitulasi1`='$rekapitulasi',
	`hasil1`='$hasil'
	 where `id_pengujian`='$id_pengujian'";
	$simpan=process($conn,$sql);
	
	$_SESSION["chitung"]="";
	unset($_SESSION["chitung"]);
  
  
	if($simpan) {echo "<script>alert('Data Pengujian \"$nama_pengujian \" berhasil disimpan !');document.location.href='?mnu=apriori';</script>";}
		else{echo"<script>alert('Data \"$nama_pengujian\" gagal disimpan...');document.location.href='?mnu=apriori';</script>";}

}

?>