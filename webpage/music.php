<?php 
	error_reporting(0);


	function convert_filesize($bytes, $decimals = 2){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

	$playlist = $_GET['playlist'];
	if(isset($playlist) && !empty($playlist)){
		$filename = 'songs/' . $playlist;
		$files = file($filename);
		
	}else{
		$full_dir = 'songs/';
		$files = scandir($full_dir);
	}
	$i = 0;
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

	<div id="listarea">
			<ul id="musiclist">

	<?php	foreach ($files as $music ) { 
		
				$ext = explode('.', $music);
				$filename = "songs/" . $music;
				$filesize = filesize($filename);
				$filesize = convert_filesize($filesize);
				$ext = trim($ext[1]);
				if($ext == 'mp3' ){

							
	?>

	<li class="mp3item"><a href="songs/<?= $music ?>" download><?= $music ?></a><strong><?= '   ('.$filesize .')' ?></strong></li>

	<?php
				}
			}
 	?>

   <?php	foreach ($files as $music ) {  
			  $music_sliced = explode('.', $music);
				if($music_sliced[1] == 'txt' ){
	?>

			<a href="?playlist=<?= $music ?>"><li class="playlistitem"><?= $music?></li></a>

	<?php
				}
			}
 	?> 
		 
			</ul>
		</div>
	</body>
</html>
