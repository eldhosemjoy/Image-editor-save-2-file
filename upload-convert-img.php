<?php
/**
 * Image resize while uploading
**/

include( 'function.php');
// settings
$max_file_size = 1024*200; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array(150 => 150, 250 => 250);
//$sizes = array(100 => 100, 150 => 150, 250 => 250);

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
	if( $_FILES['image']['size'] < $max_file_size ){
		// get file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h);
			}

		} else {
			$msg = 'Unsupported file';
		}
	} else{
		$msg = 'Please upload image smaller than 200KB';
	}
}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Image Upload Resizer</title>
    <link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font.css" />
	<link rel="stylesheet" type="text/css" href="css/picedit.css" />
</head>


<body>
	<div class="wrap">
		<h1 style="padding-bottom: 10px; border-bottom: #333 2px groove;">Image Resize On Upload</h1>
		<?php if(isset($msg)): ?>
			<p class='alert'><?php echo $msg ?></p>
		<?php endif ?>
		
		<!-- file uploading form -->
		<form action="" method="post" enctype="multipart/form-data">
			<label>
				<span>Choose image</span>
				<input type="file" name="image" accept="image/*" />
                <span>Select Folder</span>
                <select name="folder">
                  <option value="cgc">CGC</option>
                  <option value="company">Company</option>
                  <option value="hr">HR</option>
                  <option value="uploads">uploads</option>
                </select>
			</label>
			<input type="submit" value="Upload" />
		</form>
<br />
<?php
echo "<h3 style='text-align:center; padding-bottom: 5px; border-bottom: #333 2px groove;'>***Copy your Image File Path***</h3>";
if(isset($files)){
	foreach ($files as $image) {
		echo "<table><tr><td>Your Image File Path is: <span class='click-to-copy' style='padding-left:20px; font-weight:bold;'>{$image}</span></td></tr></table>";
	}
}
?>

		<?php
		// show image thumbnails
		if(isset($files)){
			foreach ($files as $image) {
				echo "<img class='img' src='{$image}' /><br /><br />";
			}
		}
		?>
	</div>


</section>
</body>
</html>