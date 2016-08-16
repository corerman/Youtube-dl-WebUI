<?php
	require_once 'class/Session.php';
	require_once 'class/Downloader.php';
	require_once 'class/FileHandler.php';

	$session = Session::getInstance();
	$file = new FileHandler;

	if(!$session->is_logged_in())
	{
		header("Location: login.php");
	}

	if(isset($_GET['type']) && !empty($_GET['type']))
	{
		$t = $_GET['type'];
		if($t === 'v')
		{
			$type = "videos";
			$files = $file->listVideos();
		}
		elseif($t === 'm')
		{
			$type = "musics";
			$files = $file->listMusics();
		}
	}

	if($session->is_logged_in() && isset($_GET["delete"]))
	{
		$file->delete($_GET["delete"], $t);
		header("Location: list.php?type=".$t);
	}

	require 'views/header.php';
?>
		<div class="container">
		<?php
			if(!empty($files))
			{
		?>
			<h2>List of available <?php echo $type ?> :</h2>
			<table class="table table-striped table-hover ">
				<thead>
					<tr>
						<th style="min-width:800px; height:35px">Title</th>
						<th style="min-width:80px">Size</th>
						<th style="min-width:110px">Delete link</th>
					</tr>
				</thead>
				<tbody>
			<?php
				$i = 0;
				$totalSize = 0;
				$url_head=$file->get_downloads_folder();  //get full localtion of files
				$url_head="/downloads";  //Set new localtion of files
				foreach($files as $f)
				{
					echo $file->get_downloads_folder()."<br />";
					echo "<tr>";
						
					echo "<td><a href=\"".$url_head.'/'.$f["name"]."\" download>".$f["name"]."</a></td>";
					echo "<td>".$f["size"]."</td>";
					echo "<td><a href=\"./list.php?delete=$i&type=$t\" class=\"btn btn-danger btn-sm\">Delete</a></td>";
					echo "</tr>";
					$i++;
				}
			?>
				</tbody>
			</table>
			<br/>
			<br/>
		<?php
			}
			else
			{
				if(isset($t) && ($t === 'v' || $t === 'm'))
				{
					echo "<br><div class=\"alert alert-warning\" role=\"alert\">No $type !</div>";
				}
				else
				{
					echo "<br><div class=\"alert alert-warning\" role=\"alert\">No such type !</div>";
				}
			}
		?>
			<br/>
		</div><!-- End container -->
<?php
	require 'views/footer.php';
?>
