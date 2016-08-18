<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	<title>Corerman Player</title>
	<style type="text/css">
		body{
			margin: 0px;
			padding: 0px;
		}
	</style>
</head>
<body style="background-color:black;">
	<?php
		$video_src="";
		$video_type="";
		if($_GET['url']!=""){
			$video_src=base64_decode($_GET['url']);
			$video_type=substr($video_src,-3,3);
			echo $video_src."<br />".$video_type;
			if(strtolower($video_type)!='mp4'&&strtolower($video_type)!='flv')
			{
				echo "<center><font color=\"white\">URL Error!</font></center>";
				die();
				
			}
		}
		else
		{
			die("<center><font color=\"white\">URL Error!</font></center>");
			
		}
	?>
	<div style="width: 1289px; height: 706px;margin-left: auto;margin-right: auto;margin-top:100px;border-radius:10px;">
		<script type="text/javascript" src="./sewise.player.min.js?server=vod&
		type=<?php echo $video_type;  ?>&
		videourl=<?php echo $video_src;  ?>&
		sourceid=&
		autostart=true&
		starttime=0&
		lang=en_US&
		title=Corerman Player&
		buffer=10&
		claritybutton=disable&
		skin=vodFlowPlayer&
		topbardisplay=disable"></script>
	</div>

</body>
</html>