<?php
echo '<h1>
BUAT DATABASE
</h1>
<hr>';



//membuat database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $koneksi )
{
  die('Gagal Koneksi: ' . mysql_error());
}
echo 'Koneksi Berhasil';
$sql = 'CREATE Database iwan_antrian';
$buatdb = mysql_query( $sql, $koneksi );
if(! $buatdb )
{
  die('Pembuatan database, gagal: ' . mysql_error());
}
echo "Database 'iwan_antrian' berhasil dibuat\n";
mysql_close($koneksi);?>