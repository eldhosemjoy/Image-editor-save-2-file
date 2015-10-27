<?php

echo "** Post Array **\n";
print_r($_POST);

echo "** Files Array **\n";
print_r($_FILES);

echo "** Image **\n";
foreach($_FILES as $file) {
	$imgData = base64_encode(file_get_contents($file['tmp_name']));
	$src = 'data: '.mime_content_type($file['tmp_name']).';base64,'.$imgData;
	list($type, $src) = explode(';', $src);
	list(, $src)      = explode(',', $src);
	$src = base64_decode($src);
	file_put_contents('image.png', $src);
	echo '<img src="'.$src.'"><br>';
}

?>
