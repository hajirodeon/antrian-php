<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
$tpl = LoadTpl("../template/login.html");



nocache;

//nilai
$filenya = "index.php";
$filenya_ke = $sumber;
$judul = "Login ADMIN";
$judulku = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





if ($_POST['btnOK'])
	{
	//ambil nilai
	$username = nosql($_POST["usernamex"]);
	$password = nosql($_POST["passwordx"]);

	//cek null
	if ((empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Not Complete...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM adminx ".
							"WHERE usernamex = '$username' ".
							"AND passwordx = '$password'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);

		//cek login
		if ($total != 0)
			{
			session_start();

			//bikin session
			$_SESSION['kd6_session'] = nosql($row['kd']);
			$_SESSION['username6_session'] = $username;
			$_SESSION['pass6_session'] = $password;
			$_SESSION['adm_session'] = "Administrator";
			$_SESSION['hajirobe_session'] = $hajirobe;


			//re-direct
			$ke = "../adm/index.php";
			xloc($ke);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "Failed. Try Again...!!";
			pekem($pesan, $filenya);
			exit();
			}
		}

	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




echo '<form action="'.$filenya.'" method="post" name="formx">

<h1>LOGIN ADMIN</h1>
<table border="0" width="400" border="0" cellspacing="5" cellpadding="0">
<tr valign="top">
<td>


<p>
<img src="'.$sumber.'/img/support.png" width="24" height="24" border="0">
<br>

Username :
<br>
<input name="usernamex" type="text" size="10" class="form-control">
<br>


Password :
<br>
<input name="passwordx" type="password" size="10" class="form-control">
<br>


<input name="btnOK" type="submit" class="btn btn-default" value="NEXT &gt;&gt;&gt;">
</p>





</td>
</tr>
</table>
</p>
<br>




</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
