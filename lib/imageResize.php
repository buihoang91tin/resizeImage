<?php 
class imageResize{
	public function GetPathNewImage($path, $new_width, $new_height, $align_horizontal = "CENTER", $align_vertical = "CENTER")
    {
        if (file_exists($path) && $new_width != 0 && $new_width != 0) 
        {
            $filename = $path;
            $path_parts = pathinfo($filename);
            $dir = $path_parts['dirname'];
            $name = $path_parts['filename'];
            $ext = strtolower($path_parts['extension']);

            $new_path = $dir.'/'.$name.'_'.$new_width.'x'.$new_height.'.'.$ext;

        	// Content type
            if ($ext == 'jpg' || $ext == 'jpeg') {
                $source = imagecreatefromjpeg($filename);
            }
            elseif ($ext == 'png') {
                $source = imagecreatefrompng($filename);
            }

            // Load
            $thumb = imagecreatetruecolor($new_width, $new_height);

            list($width, $height) = getimagesize($filename);

            $i = $width / $height;
            $n = $new_width / $new_height;

            if( ( $width >= $height && $i < $n) || ( $width < $height && !($i < $n && $n < 1) ) ){
            	$src_w = $width;
                $src_h = $src_w / $n;
                $src_x = 0;
                
                switch ($align_horizontal) {
                	case 'TOP':
                		$src_y = 0;
                		break;
                	case 'BOTTOM':
                		$src_y = ($height - $src_h);
                		break;
                	default:
                		$src_y = ($height - $src_h) / 2;
                		break;
                }
            }else{
            	$src_h = $height;
                $src_w = $n * $src_h;
                $src_y = 0;
                switch ($align_vertical) {
                	case 'LEFT':
                		$src_x = 0;
                		break;
                	case 'RIGHT':
                		$src_x = ($width - $src_w);
                		break;
                	default:
                		$src_x = ($width - $src_w) / 2;
                		break;
                }
            }
            
            $dst_x = 0;
            $dst_y = 0;

            imagecopyresized ( $thumb ,  $source ,  $dst_x ,  $dst_y , $src_x ,  $src_y ,  $new_width , $new_height,  $src_w ,  $src_h );
            imagejpeg($thumb, $new_path);
                               
            return $new_path;
        }
        else{
            return $path;
        }        
        
    }
}