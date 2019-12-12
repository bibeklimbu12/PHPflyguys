<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Musica</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		require 'header.php';
	?>
    <div class="main">
    	<div class="banner">
        	<img src="assets/images/banner2.jpg" height="300px" width="1000px" alt="BANNER"/>        
        </div>
        <div class="content">
        	<div class="info">
            	<p><h1>My Music</h1></p>
                <hr>
            </div>
            <div class="products">
			<table class='table'>
				<tr>
					<th>AlbumID</th>
					<th>Album Title</th>
					<th>Artist</th>
					<th>Year</th>
					<th>View</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
				<?php
				require 'config/config.php';
				$fetchQuery=$db->query("SELECT * FROM album");
				while($rows=mysqli_fetch_array($fetchQuery)){
					$albumID=$rows[0];
					$title=$rows[1];
					$artist=$rows[2];
					$year=$rows[3];
				?>
				<tr>
					<td><?php echo $albumID; ?></td>
					<td><?php echo $title; ?></td>
					<td><?php echo $artist; ?></td>
					<td><?php echo $year; ?></td>
					<td><button onclick="fetchSongs(<?php echo $albumID; ?>)">View Songs</button></td>
					<td><a href="update.php?albumID=<?php echo $albumID; ?>">update</a></td>
					<td><a href="delete.php?albumID=<?php echo $albumID; ?>">Delete</a></td>
				</tr>
				
				
				<?php } ?>
			<table>
            	             
            </div>
				<div class="product" id="songslist">
				</div>			
            </div>
        </div>
    </div>
    <?php 'require footer.php'; ?>
	<script src="assets/js/script.js"></script>
</body>
</html>
