<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "antrian.php";
$judul = "ANTRIAN";
$judulku = "$judul  [$adm_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kd = nosql($_REQUEST['kd']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika solusi
if ($_POST['btnSMP2'])
	{
	//ambil nilai
	$kd = nosql($_POST['kd']);
	$utgl = nosql($_POST['utgl']);
	$ubln = nosql($_POST['ubln']);
	$uthn = nosql($_POST['uthn']);
	$e_nama = cegah($_POST['e_nama']);
	$e_alamat = cegah($_POST['e_alamat']);
	$e_telp = cegah($_POST['e_telp']);
	$e_dibawa = cegah($_POST['e_dibawa']);
	$e_masalah = cegah($_POST['e_masalah']);
	$e_solusi = cegah($_POST['e_solusi']);



	//update
	mysqli_query($koneksi, "UPDATE antrian SET nama = '$e_nama', ".
					"alamat = '$e_alamat', ".
					"telp = '$e_telp', ".
					"yg_dibawa = '$e_dibawa', ".
					"masalah = '$e_masalah', ".
					"solusi = '$e_solusi', ".
					"proses = 'true', ".
					"proses_postdate = '$today' ".
					"WHERE kd = '$kd'");
	
	
	//re-direct
	$ke = "$filenya?utgl=$utgl&ubln=$ubln&uthn=$uthn";
	xloc($ke);
	exit();
	}
	
	
	
	
	
	
//jika panggil display
if ($s == "display")
	{
	//ambil nilai
	$kd = nosql($_REQUEST['kd']);

	//update
	mysqli_query($koneksi, "UPDATE antrian SET display = 'true' ".
					"WHERE kd = '$kd'");
	
	//re-direct
	$ke = "$filenya?utgl=$utgl&ubln=$ubln&uthn=$uthn";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");







//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<h1>'.$judul.'</h1>';

echo "<select name=\"uthnx\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$uthn.'">'.$uthn.'</option>';
for ($j=$surat01;$j<=$surat02;$j++)
	{
	echo '<option value="'.$filenya.'?uthn='.$j.'">'.$j.'</option>';
	}

echo '</select>, ';

echo "<select name=\"ublnx\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$ubln.'">'.$arrbln[$ubln].'</option>';
for ($i=1;$i<=12;$i++)
	{
	echo '<option value="'.$filenya.'?uthn='.$uthn.'&ubln='.$i.'">'.$arrbln[$i].'</option>';
	}
echo '</select>, ';

echo "<select name=\"utglx\" onChange=\"MM_jumpMenu('self',this,0)\">";
echo '<option value="'.$utgl.'">'.$utgl.'</option>';
for ($i=1;$i<=31;$i++)
	{
	echo '<option value="'.$filenya.'?uthn='.$uthn.'&ubln='.$ubln.'&utgl='.$i.'">'.$i.'</option>';
	}
echo '</select>';




//cek
if ((empty($utgl)) OR (empty($ubln)) OR (empty($uthn)))
	{
	echo '<p>
	<font color="red">
	<b>Pilih Dahulu Tanggal...!!</b>
	</font>
	</p>';
	}
else
	{
	//jika proses
	if ($s == "proses")
		{
		//ketahui antrian
		$qku = mysqli_query($koneksi, "SELECT * FROM antrian ".
							"WHERE kd = '$kd'");
		$rku = mysqli_fetch_assoc($qku);
		$ku_noantrian = nosql($rku['noantrian']);
		$ku_nama = balikin($rku['nama']);
		$ku_alamat = balikin($rku['alamat']);
		$ku_telp = balikin($rku['telp']);
		$ku_masalah = balikin($rku['masalah']);
		$ku_solusi = balikin($rku['solusi']);



		echo '<form action="'.$filenya.'" method="post" name="formx">
		<hr>
		
		<table width="800" border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="400">
		<h3>NOMOR ANTRIAN : '.$ku_noantrian.'</h3>
		
		<p>
		Nama : 
		<br>
		<input name="e_nama" type="text" size="30" value="'.$e_nama.'">		
		</p>
		
		<p>
		Alamat : 
		<br>
		<input name="e_alamat" type="text" size="30" value="'.$e_alamat.'">		
		</p>
		
		
		<p>
		Telepon : 
		<br>
		<input name="e_telp" type="text" size="15" value="'.$e_telp.'">		
		</p>
		
		
		<p>
		Yang Dibawa : 
		<br>
		<input name="e_dibawa" type="text" size="15" value="'.$e_dibawa.'">		
		</p>
		
		</td>
		
		<td>		

		
		<p>
		Masalah : 
		<br>
		<textarea name="e_masalah" rows="5" cols="50">'.$e_masalah.'</textarea>
		</p>
		
		<p>
		Solusi : 
		<br>
		<textarea name="e_solusi" rows="5" cols="50">'.$e_solusi.'</textarea>

		</p>
		
		<p>
		<input name="kd" type="hidden" value="'.$kd.'">
		<input name="noantrian" type="hidden" value="'.$ku_noantrian.'">
		<input name="utgl" type="hidden" value="'.$utgl.'">
		<input name="ubln" type="hidden" value="'.$ubln.'">
		<input name="uthn" type="hidden" value="'.$uthn.'">
		<input name="btnSMP2" type="submit" value="SIMPAN">
		<input name="btnBTL2" type="reset" value="BATAL">
		</p>

		</td>
		</tr>
		</table>
		</form>';
					
		}
	
	else
		{
		echo '<form action="'.$filenya.'" method="post" name="formx">';
		
		
		//query
		$p = new Pager();
		$start = $p->findStart($limit);
	
		$sqlcount = "SELECT antrian.*, ".
							"DATE_FORMAT(postdate, '%d') AS surat_tgl, ".
							"DATE_FORMAT(postdate, '%m') AS surat_bln, ".
							"DATE_FORMAT(postdate, '%Y') AS surat_thn ".
							"FROM antrian ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$utgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ubln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$uthn' ".
							"ORDER BY display ASC, ".
							"postdate ASC";
		$sqlresult = $sqlcount;
	
		$count = mysqli_num_rows(mysqli_query($sqlcount));
		$pages = $p->findPages($count, $limit);
		$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
		$target = "$filenya?utgl=$utgl&ubln=$ubln&uthn=$uthn";
		$pagelist = $p->pageList($_GET['page'], $pages, $target);
		$data = mysqli_fetch_array($result);
	
	
		if ($count != 0)
			{
			//ketahui detail...
			$qku1 = mysqli_query($koneksi, "SELECT * FROM antrian ".
									"WHERE round(DATE_FORMAT(postdate, '%d')) = '$utgl' ".
									"AND round(DATE_FORMAT(postdate, '%m')) = '$ubln' ".
									"AND round(DATE_FORMAT(postdate, '%Y')) = '$uthn' ".
									"AND proses = 'true'");
			$tku1 = mysqli_num_rows($qku1);
			

			
			echo '<p>
			TOTAL ANTRIAN : '.$count.' 
			<br>
			TOTAL PROSES : '.$tku1.'
			</p>';
			
			
			
			echo '<table width="1000" border="1" cellspacing="0" cellpadding="3">
			<tr bgcolor="'.$warnaheader.'">
			<td width="5"><strong><font color="'.$warnatext.'">TANGGAL</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">ANTRIAN</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">PROSES</font></strong></td>
			<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
			<td><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
			<td><strong><font color="'.$warnatext.'">TELEPON</font></strong></td>
			<td><strong><font color="'.$warnatext.'">MASALAH</font></strong></td>
			<td><strong><font color="'.$warnatext.'">SOLUSI</font></strong></td>
			<td width="50"><strong><font color="'.$warnatext.'">PANGGIL DISPLAY</font></strong></td>
			</tr>';
	
			do
				{
				if ($warna_set ==0)
					{
					$warna = $warna01;
					$warna_set = 1;
					}
				else
					{
					$warna = $warna02;
					$warna_set = 0;
					}
	
				$nomer = $nomer + 1;
				$i_kd = nosql($data['kd']);
				$i_no_urut = nosql($data['noantrian']);
				$i_postdate = $data['postdate'];
	
				$i_nama = balikin($data['nama']);
				$i_alamat = balikin($data['alamat']);
				$i_telp = balikin($data['telp']);
				$i_masalah = balikin($data['masalah']);
				$i_solusi = balikin($data['solusi']);
				$i_proses = nosql($data['proses']);
				$i_proses_postdate = $data['proses_postdate'];
				$i_berhasil = nosql($data['berhasil']);
				$i_berhasil_postdate = $data['berhasil_postdate'];
				$i_display = nosql($data['display']);
	
	
	
				//jika proses
				if ($i_proses == "true")
					{
					$i_proses_ket = "PROSES";
					$i_proses_warna = "yellow";
					}
				else
					{
					$i_proses_ket = "BELUM PROSES";
					$i_proses_warna = "red";
					}
				
	
	
	
	
				//jika berhasil
				if ($i_berhasil == "true")
					{
					$i_berhasil_ket1 = "BERHASIL";
					$i_berhasil_warna1 = "green";
					}
				else
					{
					$i_berhasil_ket1 = "";
					$i_berhasil_warna1 = "";					
					}
					
					
					
	
	
	
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>'.$i_no_urut.'</td>
				<td bgcolor="'.$i_proses_warna.'">
				'.$i_proses_ket.'
				<br>
				<br>
				'.$i_proses_postdate.'
				<br>
				<br>
				
				[<a href="'.$filenya.'?uthn='.$uthn.'&ubln='.$ubln.'&utgl='.$utgl.'&s=proses&kd='.$i_kd.'">EDIT</a>].
				</td>
				<td>'.$i_nama.' </td>
				<td>'.$i_alamat.' </td>
				<td>'.$i_telp.' </td>
				<td>'.$i_masalah.' </td>
				<td>'.$i_solusi.' </td>';
				

				//jika belum diproses
				if ($i_proses == "false")
					{
					//jika belum panggil
					if ($i_display == "false") 
						{
						$diskuya = '<a href="'.$filenya.'?uthn='.$uthn.'&ubln='.$ubln.'&utgl='.$utgl.'&s=display&kd='.$i_kd.'">PANGGIL DISPLAY</a>';
						$warnaya = "yellow";
						}
					else
						{
						$diskuya = 'SEDANG DIPANGGIL';
						$warnaya = "green";
						}
					}
					
				else
					{
					$diskuya = 'SELESAI';
					$warnaya = "red";
					}
					
				
				echo '<td bgcolor="'.$warnaya.'">
				
				'.$diskuya.'
				</td>

				</tr>';
				}
			while ($data = mysqli_fetch_assoc($result));
	
			echo '</table>
			<table width="1000" border="0" cellspacing="0" cellpadding="3">
			<tr>
			<td>Total : <strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
			</tr>
			</table>
			</p>';
			}
		else
			{
			echo '<p>
			<font color="red">
			<strong>BELUM ADA DATA. </strong>
			</font>
			</p>';
			}


		echo '</form>';			
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>