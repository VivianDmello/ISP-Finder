<!-- #ISP Finder v1.1 bY Vivian Dmello #
#Upload the .txt file in the format as below#

123.63.215.217
123.63.215.217
123.63.215.217
106.220.172.240
106.220.172.240
106.220.81.116
106.220.81.116
23.27.250.74

###Thanks to ip-api.com ###
-->
<html>
<head>
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="file" name="fileToUpload"  ></input>
<input name="submit"type="Submit" value="Go">
</form>
</body>
</html>
<!-- ISP Finder v1.1 bY Vivian Dmello -->
<?php
//ISP Finder v1.1 bY Vivian Dmello
ini_set('max_execution_time', 0);
if(isset($_REQUEST['submit'])){
$target_file =  "upload/".$_FILES["fileToUpload"]["name"];
 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ".$_FILES["fileToUpload"]["name"]. " has been uploaded. <br>";
    } else {
        die("Sorry, there was an error uploading your file.<br>");
    }
echo "your file was uploaded now processing the data";
$txt=file_get_contents($target_file);
$rows =explode("\r\n",$txt);
$uni_ips=array_unique($rows);
$nu=count($uni_ips);
$n=1;
echo "<br>A total number of ".$nu." were found<br>";
$txt = fopen('result.html','w');
fwrite($txt,"<html><body>\n\r<table><tr><th>Sr.No</th><th>IP</th><th>ISP</th><th>Country</th><th>Region</th><th>City</th></tr>");
 foreach ($uni_ips as $ip){	
	$html = file_get_contents('http://ip-api.com/json/'.$ip);
	$data = json_decode($html,TRUE); 
	fwrite($txt,"\n\r<tr><td>".$n."</td><td>".$ip."</td><td>".$data['isp']."</td><td>".$data['country']."</td><td>".$data['regionName']."</td><td>".$data['city']."</td></tr>");
		$n++;
		}

fwrite($txt,"\n</table></body></html>");
fclose($txt);
echo "Result generated successfully";
header("Location:http://localhost/result.html");
//ISP Finder v1.1 bY Vivian Dmello
	}
//###Thanks to ganon and whoismyisp.org ###
<<<<<<< HEAD
?>
=======
?>
>>>>>>> origin/master
