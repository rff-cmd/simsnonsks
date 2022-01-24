<?php
	
	define ("MAX_SIZE","1000");
	
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	function resize_image($name='', $folder='', $folder1='', $folder2='', $syscode='', $nama_file='') {
		
		$errors=0;
		$image =$_FILES[$name]["name"];
		$uploadedfile = $_FILES[$name]['tmp_name'];
		
		
		if ($image) {
			
			$filename = stripslashes($_FILES[$name]['name']);		 	
	  		$extension = getExtension($filename);
	 		$extension = strtolower($extension);
	 		
	 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
				
				$change='<div class="msgdiv">Unknown Image extension </div> ';
		 		$errors=1;
				
			} else {
				
				$size=filesize($_FILES[$name]['tmp_name']);
				if ($size > MAX_SIZE*1024) {
					$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
					$errors=1;
				}
				
				if($extension=="jpg" || $extension=="jpeg" ) {
					$uploadedfile = $_FILES[$name]['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				} else if($extension=="png") {
					$uploadedfile = $_FILES[$name]['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				} else {
					$src = imagecreatefromgif($uploadedfile);
					
				}
				
				
				//echo $scr;
				list($width,$height)=getimagesize($uploadedfile);
		
				$newwidth=840; //60;
				$newheight=1000; //($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);


				$newwidth1=380; //25;
				$newheight1=380; //450 ($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
				
				$newwidth2=93; //60;
				$newheight2=110; //($height/$width)*$newwidth;
				$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);				
				imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

				$filename = $folder . $syscode . "_" . $_FILES[$name]['name']; //save to folder 1
				$filename1 = $folder1 . $syscode . "_" . $_FILES[$name]['name']; //save to folder 2				
				$filename2 = $folder2 . $syscode . "_" . $_FILES[$name]['name']; //save to folder 3
				
				//imagejpeg($tmp,$filename,100);
				imagejpeg($tmp1,$filename1,100);				
				//imagejpeg($tmp2,$filename2,100);

				imagedestroy($src);
				//imagedestroy($tmp);
				imagedestroy($tmp1);
				//imagedestroy($tmp2);

				/*$filename = $folder . $syscode . "_" . $_FILES[$name]['name']; //save to folder 1
				$filename1 = $folder1 . $syscode . "_" . $_FILES[$name]['name']; //save to folder 2				
				$filename2 = $folder2 . $syscode . "_" . $_FILES[$name]['name']; //save to folder 3
				
				imagejpeg($tmp,$filename,100);
				imagejpeg($tmp1,$filename1,100);				
				imagejpeg($tmp2,$filename2,100);

				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
				imagedestroy($tmp2);*/ 
		
		
			}
			
			$nama_file = $syscode . "_" . $image;
			
		}
		
		return $nama_file;
			
	} 
	
	/*
	function resize_image($file='', $folder='', $folder1='', $folder2='', $syscode='', $nama_file='') {
		
		$errors=0;
		$image =$_FILES["file"]["name"];
		$uploadedfile = $_FILES['file']['tmp_name'];
		
		
		if ($image) {
			
			$filename = stripslashes($_FILES['file']['name']);		 	
	  		$extension = getExtension($filename);
	 		$extension = strtolower($extension);
	 		
	 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
				
				$change='<div class="msgdiv">Unknown Image extension </div> ';
		 		$errors=1;
				
			} else {
				
				$size=filesize($_FILES['file']['tmp_name']);
				if ($size > MAX_SIZE*1024) {
					$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
					$errors=1;
				}
				
				if($extension=="jpg" || $extension=="jpeg" ) {
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				} else if($extension=="png") {
					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				} else {
					$src = imagecreatefromgif($uploadedfile);
				}
				
				
				//echo $scr;
				list($width,$height)=getimagesize($uploadedfile);
		
				$newwidth=840; //60;
				$newheight=1000; //($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);


				$newwidth1=380; //25;
				$newheight1=450; //($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
				
				$newwidth2=93; //60;
				$newheight2=110; //($height/$width)*$newwidth;
				$tmp2=imagecreatetruecolor($newwidth2,$newheight2);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);				
				imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);


				$filename = $folder . $syscode . "_" . $_FILES['file']['name']; //save to folder 1
				$filename1 = $folder1 . $syscode . "_" . $_FILES['file']['name']; //save to folder 2				
				$filename2 = $folder2 . $syscode . "_" . $_FILES['file']['name']; //save to folder 3
				
				imagejpeg($tmp,$filename,100);
				imagejpeg($tmp1,$filename1,100);				
				imagejpeg($tmp2,$filename2,100);

				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
				imagedestroy($tmp2); 
		
		
			}
			
			$nama_file = $syscode . "_" . $image;
			
		}
		
		return $nama_file;
			
	}
	*/
	
?>