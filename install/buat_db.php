<?php
echo '<h1>
BUAT DATABASE
</h1>
<hr>';



//membuat database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysqli_error());
}
echo 'Koneksi Berhasil';
$sql = 'CREATE Database iwan_antrian';
$buatdb = mysqli_query( $sql, $koneksi );
if(! $buatdb )
{
  die('Pembuatan database, gagal: ' . mysqli_error());
}
echo "Database 'iwan_antrian' berhasil dibuat\n";
mysqli_close($koneksi);?>