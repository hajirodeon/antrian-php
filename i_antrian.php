<?php
session_start();

//sleep(1);

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");





$aksi = $_REQUEST['aksi'];
$filenya = "$sumber/i_antrian.php";



//jika tampilakan
if ($aksi == "tampil")
	{
	//ketahui jumlah total sehari...
	$qku1 = mysql_query("SELECT * FROM antrian ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
							"ORDER BY round(noantrian) DESC");
	$rku1 = mysql_fetch_assoc($qku1);
	$tku1 = mysql_num_rows($qku1);
	$ku1_nomer = nosql($rku1['noantrian']); 

	
	//nomor antrian, total yang ada + 1
	$antkd = $ku1_nomer + 1;
	
	
	echo "<div id=\"nomernya\" align=\"center\"><h1 class=\"display-1\">$antkd</h1>
	[$tanggal-$bulan-$tahun]
	</div>
	<br>
	<br>"; 
	
	
	?>
	
	
	<script>
	$(document).ready(function(){

	
		$("#btnKRM").on('click', function(){
			$('#loading').show();
	
			$("#formx2").submit(function(){
	
				$.ajax({
					url: "<?php echo $filenya;?>?aksi=simpan&noantrian=<?php echo $antkd;?>",
					type:"POST",
					data:$(this).serialize(),
					success:function(data){
						$("#iaku").html(data);
						setTimeout('$("#loading").hide()',1000);
						
						window.location.href = "index.html";
						}
					});
				return false;
			});
		
		
		});	
	

	
	
	})
	</script>
	
	
	<?php
	
	
	
	exit();

	}						
			 










//jika simpan
if ($aksi == "simpan")
	{
	//ambil nilai
	$noantrian = $_GET['noantrian'];


	//echo "-> $noantrian";



	//cek
	$qcc = mysql_query("SELECT * FROM antrian ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
							"AND noantrian = '$noantrian'");
	$tcc = mysql_num_rows($tcc);
	
	//jika null
	if (empty($tcc))
		{
		//insert baru...
		mysql_query("INSERT INTO antrian(kd, noantrian, proses, postdate) VALUES ".
						"('$x', '$noantrian', 'false', '$today')");
		}



	 ?>

	<meta charset="utf-8">
	
	<script type="text/javascript" charset="utf-8" src="cordova.js"></script>

		<script>
		$(document).ready(function(){
		
		 
		 
			document.addEventListener('deviceready', function () {
				
			    var text = "<CENTER><BOLD><BIG><?php echo $noantrian;?> <br><br><CENTER><?php echo $today;?> <br><CENTER><LINE> <br><br><cut>";
			    var textEncoded = encodeURI(text);
			    window.location.href="quickprinter://"+textEncoded;
				 
			});
			


		
		})
		</script>
		

	<?php	 
	 
	exit();
	}						
			 



?>
