<?php 
include 'lib/imageResize.php';
$originalPathImage = 'img/test_300x200.jpg';
$size200x300PathImage = imageResize::GetPathNewImage($originalPathImage, 600, 700, "CENTER", "CENTER");

?>
<html>
<head>
</head>
<body>
	<center><img src="<?php echo $originalPathImage ?>" /></center>
	<br>
	<img src="<?php echo $size200x300PathImage ?>" />

asjdfkldjsfkljasdlf
</body>
</html>