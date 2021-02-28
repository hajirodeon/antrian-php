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
$judul = "ACTIVITY : Queue";
$judulku = "$judul  [$adm_session]";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}






mysqli_query($koneksi, "SET character_set_results = 'utf8'");
mysqli_query($koneksi, "character_set_client = 'utf8'");
mysqli_query($koneksi, "character_set_connection = 'utf8'");
mysqli_query($koneksi, "character_set_database = 'utf8'");






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();

//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
xheadline($judul);





//refresh setiap 15detik
$kee = "$filenya?uthn=$uthn&ubln=$ubln&utgl=$utgl&page=$page";
$jmldetik = 30000;
?>
<script>setTimeout("location.href='<?php echo $kee;?>'", <?php echo $jmldetik;?>);</script>

<?php





//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
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
	<b>Please Select Date...!!</b>
	</font>
	</p>';
	}
else
	{
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
						"ORDER BY postdate DESC";
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
		
		$qku2 = mysqli_query($koneksi, "SELECT * FROM antrian ".
								"WHERE round(DATE_FORMAT(postdate, '%d')) = '$utgl' ".
								"AND round(DATE_FORMAT(postdate, '%m')) = '$ubln' ".
								"AND round(DATE_FORMAT(postdate, '%Y')) = '$uthn' ".
								"AND berhasil = 'true'");
		$tku2 = mysqli_num_rows($qku2);
		
				
		
		echo '<p>
		TOTAL ANTRIAN : '.$count.' 
		<br>
		TOTAL PROSES : '.$tku1.'
		<br>
		TOTAL BERHASIL : '.$tku2.'
		</p>';
		
		
		
		echo '<table width="800" border="1" cellspacing="0" cellpadding="3">
		<tr bgcolor="'.$warnaheader.'">
		<td width="5"><strong><font color="'.$warnatext.'">TANGGAL</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">ANTRIAN</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">PROSES</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">BERHASIL</font></strong></td>
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
			$i_proses = nosql($data['proses']);
			$i_proses_postdate = $data['proses_postdate'];
			$i_berhasil = nosql($data['berhasil']);
			$i_berhasil_postdate = $data['berhasil_postdate'];



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
			<td>'.$i_nama.' </td>
			<td bgcolor="'.$i_proses_warna.'">
			'.$i_proses_ket.'
			<br>
			['.$i_proses_postdate.'].
			</td>
			<td bgcolor="'.$i_berhasil_warna1.'">
			'.$i_berhasil_ket1.'
			</td>

			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));

		echo '</table>
		<table width="800" border="0" cellspacing="0" cellpadding="3">
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

	}

echo '</form>';
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