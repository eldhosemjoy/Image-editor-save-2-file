<?php
/**
 * Image resize while uploading
**/

include( 'function.php');
// settings
$max_file_size = 1024*350; // 300kb
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
		$msg = 'Please upload image smaller than 350KB';
	}
}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Image Resizer</title>
    <link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font.css" />
	<link rel="stylesheet" type="text/css" href="css/picedit.css" />
</head>


<body>
	<div class="wrap">
		<h1 style="padding-bottom: 10px; border-bottom: #333 2px groove;">Edit Image</h1>
        
		<ul>
        	<li>"Click & Drag"</li>
            <li>"Copy & Paste"</li>
            <li>"Click & Upload"</li>
        </ul>
		
		<!-- file uploading form -->
<form name="testform" action="out.php" method="post" enctype="multipart/form-data">
<!--<form name="testform" action="out.php" method="post" enctype="multipart/form-data">-->


<div style="margin:0 auto; display:table;">

<!-- begin_picedit_box -->
<div class="picedit_box">
    <!-- Placeholder for messaging -->
    <div class="picedit_message">
    	 <span class="picedit_control ico-picedit-close" data-action="hide_messagebox"></span>
        <div></div>
    </div>
    <!-- Picedit navigation -->
    <div class="picedit_nav_box picedit_gray_gradient">
    	<div class="picedit_pos_elements"></div>
       <div class="picedit_nav_elements">
			<!-- Picedit button element begin -->
			<div class="picedit_element">
				<span class="picedit_control picedit_action ico-picedit-insertpicture" title="Crop" data-action="crop_open"></span>
           </div>
           <!-- Picedit button element end -->
			<!-- Picedit button element begin -->
			<div class="picedit_element">
           	 <span class="picedit_control picedit_action ico-picedit-redo" title="Rotate"></span>
             	 <div class="picedit_control_menu">
               	<div class="picedit_control_menu_container picedit_tooltip picedit_elm_1">
                    <label>
                      <span>90° CW:</span>
                      <span class="picedit_control picedit_action ico-picedit-redo" data-action="rotate_cw" style="background-color:#ccc;padding:5px;border-radius:25px;"></span>
                    </label>
                    <label>
                      <span>90° CCW:</span>
                      <span class="picedit_control picedit_action ico-picedit-undo" data-action="rotate_ccw" style="background-color:#ccc;padding:5px;border-radius:25px;"></span>
                    </label>
                  </div>
               </div>
           </div>
           <!-- Picedit button element end -->
       </div>
	</div>
	<!-- Picedit canvas element -->
	<div class="picedit_canvas_box">
		<div class="picedit_painter">
			<canvas></canvas>
		</div>
		<div class="picedit_canvas">
			<canvas></canvas>
		</div>
		<div class="picedit_action_btns active" style="padding-bottom: 5px;">
          <label style="cursor:default;">
          <div class="picedit_control ico-picedit-picture" data-action="load_image"><br />
          <input id="imageLoader" name="image" accept="image/*" style="display:none;">
          <!--<span style="font-size:14px">Select Folder</span>
          <select name="folder" style="cursor:pointer;">
            <option value="cgc">CGC</option>
            <option value="company">Company</option>
            <option value="hr">HR</option>
            <option value="uploads">uploads</option>
          </select>-->
          </label>
          </div>
          <!--<div class="picedit_control ico-picedit-picture" data-action="load_image"></div>-->
          <!--<div class="picedit_control ico-picedit-camera" data-action="camera_open"></div>-->
          <div class="center">Insert Image Here</div>
		</div>
	</div>
	<!-- Picedit Video Box -->
	<div class="picedit_video">
    	<video autoplay></video>
		<div class="picedit_video_controls">
			<span class="picedit_control picedit_action ico-picedit-checkmark" data-action="take_photo"></span>
			<span class="picedit_control picedit_action ico-picedit-close" data-action="camera_close"></span>
		</div>
    </div>
    <!-- Picedit draggable and resizeable div to outline cropping boundaries -->
    <div class="picedit_drag_resize">
    	<div class="picedit_drag_resize_canvas"></div>
		<div class="picedit_drag_resize_box">
			<div class="picedit_drag_resize_box_corner_wrap">
           	<div class="picedit_drag_resize_box_corner"></div>
			</div>
			<div class="picedit_drag_resize_box_elements">
				<span class="picedit_control picedit_action ico-picedit-checkmark" data-action="crop_image"></span>
				<span class="picedit_control picedit_action ico-picedit-close" data-action="crop_close"></span>
			</div>
       </div>
    </div>
</div>

<input type="submit" value="Upload Edited Image (uploads 2 nowhere)" />
</div>
</form>
<br />

		<h1 style="padding-bottom: 10px; border-bottom: #333 2px groove;">Create Article Images</h1>
		<?php if(isset($msg)): ?>
			<p class='alert'><?php echo $msg ?></p>
		<?php endif ?>
        <?php
		if (isset($_POST['folder'])) {

		if(empty($_POST['folder'])) {
		   echo '<p class="alert">Please Select a Folder Destination</p>';
		}}
		?>

<div>
<form action="" method="post" enctype="multipart/form-data" class="upload">
    <div>
    <span>Upload Saved Image:</span>
    <input type="file" name="image" accept="image/*" value="" style="width:auto;margin:0 0 0 10px;cursor:pointer;"/><br />
    <!--<input type="file" id="imageLoader" name="image" accept="image/*" value=""/>-->
    </div>
    
    <div>
    <span>Upload to Folder:</span>
    <select name="folder" style="width:50%;margin:0 0 0 10px;cursor:pointer;">
      <option value="" selected>choose folder</option>
      <option value="cgc">CGC</option>
      <option value="company">Company</option>
      <option value="hr">HR</option>
      <option value="it">IT</option>
      <option value="upload">Uploads</option>
    </select>
    </div>
<!-- end_picedit_box -->




			<input type="submit" value="Upload" />

		</form>
</div>
<br />
<!-- Show the Uploaded files and the path -->
<div class='uploadedFrame'>
<?php
//if(isset($files)){
//	foreach ($files as $imgupload) {
//		echo "<h3 style='text-align:center; padding-bottom: 5px; border-bottom: #333 2px groove;'>***Copy your Image File Path***</h3>";
//		echo "<table><tr><td>Your Image File Path is: <span class='click-to-copy' style='padding-left:20px; font-weight:bold;'>{$imgupload}</span></td></tr></table>";
//	}
//}
?>

		<?php
		// show image thumbnails
		if(isset($files)){
			foreach ($files as $imgupload) {
				echo "<div class='imgUploaded'><img class='img' src='{$imgupload}' /><p>Your Image File Path is: </p><p><span class='click-to-copy' style='font-weight:bold;'>{$imgupload}</span></p></div>";
			}
		}
		?>
</div>	</div>


</section>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/picedit.js"></script>

<script type="text/javascript">
	$(function() {
		$('.picedit_box').picEdit({
			imageUpdated: function(img){
			},
			formSubmitted: function(response){
			},
			redirectUrl: false,
            defaultImage: false
		});
	});
</script>


</body>
</html>