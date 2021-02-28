<?php
echo '<h1>
Buat Table 
</h1>
<hr>';






//membuat table database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysqli_error());
}


echo 'Koneksi Berhasil';


mysqli_select_db('iwan_antrian');


//buat table
$sql = 'CREATE TABLE adminx ('.
  'kd varchar(50) NOT NULL, '.
  'usernamex varchar(50) NOT NULL, '.
  'passwordx varchar(50) NOT NULL, '.
  'postdate datetime NOT NULL '.
  ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';
 

$buattabel = mysqli_query( $sql, $koneksi );
if(! $buattabel )
	{
  	die('Gagal Membuat Tabel: ' . mysqli_error());
	}







//isi data
$sql = 'INSERT INTO adminx (kd, usernamex, passwordx, postdate) VALUES '.
			'(\'1234567890\', \'admin\', \'admin\', \'2018-03-26 00:00:00\');';
 
$buattabel = mysqli_query( $sql, $koneksi );
if(! $buattabel )
	{
  	die('Gagal ENTRI DATA : ' . mysqli_error());
	}








//buat table
$sql = 'CREATE TABLE antrian ( '.
  'kd varchar(50) NOT NULL, '.
  'nama varchar(100) NOT NULL, '.
  'alamat varchar(255) NOT NULL, '.
  'telp varchar(100) NOT NULL, '.
  'noantrian varchar(50) NOT NULL, '.
  'masalah longtext NOT NULL, '.
  'postdate datetime NOT NULL, '.
  'yg_dibawa longtext NOT NULL, '.
  'proses enum(\'true\',\'false\') NOT NULL DEFAULT \'false\', '.
  'berhasil enum(\'true\',\'false\') NOT NULL DEFAULT \'false\', '.
  'proses_postdate datetime NOT NULL, '.
  'berhasil_postdate datetime NOT NULL, '.
  'jml_menit varchar(50) NOT NULL, '.
  'jml_jam varchar(50) NOT NULL, '.
  'display enum(\'true\',\'false\') NOT NULL DEFAULT \'false\', '.
  'solusi longtext NOT NULL '.
  ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';


$buattabel = mysqli_query( $sql, $koneksi );
if(! $buattabel )
	{
  	die('Gagal Membuat Tabel: ' . mysqli_error());
	}




















echo "Tabel sukses dibuat\n";











mysqli_close($koneksi);
?>