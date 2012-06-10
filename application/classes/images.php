<?php defined('SYSPATH') OR die('No direct access allowed.');

class images {

	public static function imagecreatefrombmp($filename) {
	    $file = fopen( $filename, "rb" );
	    $read = fread( $file, 10 );
	    while( !feof( $file ) && $read != "" ){
	        $read .= fread( $file, 1024 );
	    }
	    $temp = unpack( "H*", $read );
	    $hex = $temp[1];
	    $header = substr( $hex, 0, 104 );
	    $body = str_split( substr( $hex, 108 ), 6 );
	    if( substr( $header, 0, 4 ) == "424d" ){
	        $header = substr( $header, 4 );
	        // Remove some stuff?
	        $header = substr( $header, 32 );
	        // Get the width
	        $width = hexdec( substr( $header, 0, 2 ) );
	        // Remove some stuff?
	        $header = substr( $header, 8 );
	        // Get the height
	        $height = hexdec( substr( $header, 0, 2 ) );
	        unset( $header );
	    }
	    $x = 0;
	    $y = 1;
	    $image = imagecreatetruecolor( $width, $height );
	    foreach( $body as $rgb ){
	        $r = hexdec( substr( $rgb, 4, 2 ) );
	        $g = hexdec( substr( $rgb, 2, 2 ) );
	        $b = hexdec( substr( $rgb, 0, 2 ) );
	        $color = imagecolorallocate( $image, $r, $g, $b );
	        imagesetpixel( $image, $x, $height-$y, $color );
	        $x++;
	        if( $x >= $width )
	        {
	            $x = 0;
	            $y++;
	        }
	    }
	    return $image;
	}	
	
	public static function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);

        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

// from here 
		$white = imagecolorallocate($cut, 255, 255, 255);
//		imagealphablending($cut, false );
//		imagesavealpha($cut, false);		
//		$trans = imagecolorallocatealpha($cut, 0, 0, 0, 127 );
		imagefilledrectangle($cut, 0, 0, $src_w, $src_h, $white );
// here

        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        // inverting the opacity
        $opacity = 100 - $opacity;

        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);		
		imagedestroy($cut);
	}

	public static function rotateX($x, $y, $theta){
        return $x * cos($theta) - $y * sin($theta);
    }
    public static function rotateY($x, $y, $theta){
        return $x * sin($theta) + $y * cos($theta);
    }

public static function imagerotateEquivalent($srcImg, $angle, $bgcolor, $ignore_transparent = 0) {


    $srcw = imagesx($srcImg);
    $srch = imagesy($srcImg);

    //Normalize angle
    $angle %= 360;
    //Set rotate to clockwise
    $angle = -$angle;

    if($angle == 0) {
        if ($ignore_transparent == 0) {
            imagesavealpha($srcImg, true);
        }
        return $srcImg;
    }

    // Convert the angle to radians
    $theta = deg2rad ($angle);

    //Standart case of rotate
    if ( (abs($angle) == 90) || (abs($angle) == 270) ) {
        $width = $srch;
        $height = $srcw;
        if ( ($angle == 90) || ($angle == -270) ) {
            $minX = 0;
            $maxX = $width;
            $minY = -$height+1;
            $maxY = 1;
        } else if ( ($angle == -90) || ($angle == 270) ) {
            $minX = -$width+1;
            $maxX = 1;
            $minY = 0;
            $maxY = $height;
        }
    } else if (abs($angle) === 180) {
        $width = $srcw;
        $height = $srch;
        $minX = -$width+1;
        $maxX = 1;
        $minY = -$height+1;
        $maxY = 1;
    } else {
        // Calculate the width of the destination image.
        $temp = array (self::rotateX(0, 0, 0-$theta),
        self::rotateX($srcw, 0, 0-$theta),
        self::rotateX(0, $srch, 0-$theta),
        self::rotateX($srcw, $srch, 0-$theta)
        );
        $minX = floor(min($temp));
        $maxX = ceil(max($temp));
        $width = $maxX - $minX;

        // Calculate the height of the destination image.
        $temp = array (self::rotateY(0, 0, 0-$theta),
        self::rotateY($srcw, 0, 0-$theta),
        self::rotateY(0, $srch, 0-$theta),
        self::rotateY($srcw, $srch, 0-$theta)
        );
        $minY = floor(min($temp));
        $maxY = ceil(max($temp));
        $height = $maxY - $minY;
    }

    $destimg = imagecreatetruecolor($width, $height);
    if ($ignore_transparent == 0) {
        imagefill($destimg, 0, 0, imagecolorallocatealpha($destimg, 255,255, 255, 127));
        imagesavealpha($destimg, true);
    }

    // sets all pixels in the new image
    for($x=$minX; $x<$maxX; $x++) {
        for($y=$minY; $y<$maxY; $y++) {
            // fetch corresponding pixel from the source image
            $srcX = round(self::rotateX($x, $y, $theta));
            $srcY = round(self::rotateY($x, $y, $theta));
            if($srcX >= 0 && $srcX < $srcw && $srcY >= 0 && $srcY < $srch) {
                $color = imagecolorat($srcImg, $srcX, $srcY );
            } else {
                $color = $bgcolor;
            }
            imagesetpixel($destimg, $x-$minX, $y-$minY, $color);
        }
    }
    return $destimg;
}


	
}
