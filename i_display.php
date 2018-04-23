<?php
session_start();

//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");



//ambil nilai
$aksi = $_REQUEST['aksi'];






//ambil request data, tiap lima detik...
//jika baca
if ($aksi == "baca")
	{
	//sleep(1);

	//tampilkan yang terbaru, yang belum muncul display...
	// setelah itu, set update, bila udah dimunculkan dilayar display...
	
	$qku = mysql_query("SELECT * FROM antrian ".
							"WHERE display = 'true' ".
							"AND berhasil = 'false' ".
							"ORDER BY postdate DESC");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
	
	
	//jika null, kasi info...
	if (empty($tku))
		{
		echo "<hr>
		<h1 class=\"display-1\">System ANTRIAN...</h1>
		<hr>";	
		}
	else
		{
		$ku_kd = nosql($rku['kd']);
		$ku_no = balikin($rku['noantrian']);
		
	
		echo "<h1 class=\"display-1\">
		ANTRIAN NOMER : $ku_no
		</h1>
		<hr>";
		
		
		
		//update berhasil
		mysql_query("UPDATE antrian SET berhasil = 'true' ".
						"WHERE kd = '$ku_kd'");
		}





	
	 	
	exit();
	}



//jika baca2
if ($aksi == "baca2")
	{
	//tampilkan yang terbaru, yang belum muncul display...
	// setelah itu, set update, bila udah dimunculkan dilayar display...
	
	$qku = mysql_query("SELECT * FROM antrian ".
							"WHERE display = 'true' ".
							"AND berhasil = 'false' ".
							"AND solusi = '' ".
							"ORDER BY postdate DESC");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);	


	//jika null, kasi info...
	if (empty($tku))
		{
		//$infoya = "Welcome to Queue System...";
		//diam saja...	
		}
	else
		{
		$ku_kd = nosql($rku['kd']);
		$ku_no = balikin($rku['noantrian']);
	
			

		//bacakan suara...
		$infoya = "Queue number $ku_no, please proceed";

	
		?>
		
		
		
		
		
		
		
	
	    <!-- Bootstrap core JavaScript -->
	    <script src="vendor/jquery/jquery.min.js"></script>
	    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	    <!-- Plugin JavaScript -->
	    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
	    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
	
	    <!-- Custom scripts for this template -->
	    <script src="js/creative.min.js"></script>
	
	
	
	    <!-- Bootstrap core CSS -->
	    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	    <!-- Custom fonts for this template -->
	    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	    <!-- Plugin CSS -->
	    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
	
	    <!-- Custom styles for this template -->
	    <link href="css/creative.min.css" rel="stylesheet">
	
	
		<script type="text/javascript" charset="utf-8" src="cordova.js"></script>
		<script type="text/javascript" charset="utf-8" src="tts.js"></script>
		
	
	
		<script>
		$(document).ready(function(){
		
			document.addEventListener('deviceready', function () {
			    TTS.speak('<?php echo $infoya;?>', function () {
				console.log('Ready !');
			    }, function (reason) {
				console.log(reason);
			    });
			
			});
	
		
		
		
		
		

		setInterval(loadLog2, 5000);
		
		function loadLog2(){
			console.log("interval2...");
			window.location.href = "index.html";
			}
		

		
    
		
		});
		</script>
		
		
		<?php
		}		

		

		
		
	exit();
	}
	
	
exit();
?>