<?
sleep(1);
session_start();

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");









//hapus yang ada dulu...
mysqli_query($koneksi, "DROP DATABASE iwan_antrian");

//bikin database dulu...
mysqli_query($koneksi, "CREATE DATABASE iwan_antrian");





mysqli_query($koneksi, "CREATE TABLE `adminx` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");



mysqli_query($koneksi, "INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`, `postdate`) VALUES ('admin', 'admin', 'admin', '2018-02-22 00:00:00'); ");






/*
mysqli_query($koneksi, "CREATE TABLE `antrian` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `noantrian` varchar(50) NOT NULL,
  `masalah` longtext NOT NULL,
  `postdate` datetime NOT NULL,
  `yg_dibawa` longtext NOT NULL,
  `proses` enum('true','false') NOT NULL DEFAULT 'false',
  `berhasil` enum('true','false') NOT NULL DEFAULT 'false',
  `proses_postdate` datetime NOT NULL,
  `berhasil_postdate` datetime NOT NULL,
  `jml_menit` varchar(50) NOT NULL,
  `jml_jam` varchar(50) NOT NULL,
  `display` enum('true','false') NOT NULL DEFAULT 'false',
  `solusi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;");
*/



echo "BERHASIL INSTALL DATABASE";


exit();
?>
