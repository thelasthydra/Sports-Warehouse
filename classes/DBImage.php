<?php 

	class DBImage
	{
		private static $_dir = "imgs/";
		private static $_defaultIMG = "imgs/default-img.jpg";

		public static function checkPhoto($photoPath){
			if(file_exists("imgs/" . $photoPath) && strlen($photoPath) > 0)
			{
				$photoPath = self::$_dir . $photoPath;
			} else {
				$photoPath = self::$_defaultIMG;
			}
			return $photoPath;
		}

		public static function updloadImg($file){
			$error = false;
			$fileName = basename($file["name"]);
			$targetFile = self::$_dir . $fileName;
			$fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
			if($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "gif"){
				$message = "Only JPG, JPEG, PNG & GIF Files Allowed";
				$error = true;
			}
			if($file["error"] == 1){
				$message = "File Is To Large";
				$error = true;
			}

			if(!$error){
				if(move_uploaded_file($file["tmp_name"], $targetFile)){
					$message = $fileName . " Has Been Uploaded";
					return $fileName;
				} else {
					$message = "There Was An Error Uploading YOur File, Error: " . $file["error"];
				}
			}
		}
	}

?>