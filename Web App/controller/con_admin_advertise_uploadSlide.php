<?php include("../checkAdmin.php"); ?>

		<head><meta charset="UTF-8"></head>

		<?php
		
		if($_FILES["fileToUpload"]["size"] == 0) 
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "ไม่พบไฟล์";
			header("Location: ../view/index.php?advertise");
			exit(); 
		}


		if(!isset($_POST["upload_slide"]))
		{
			echo "<center><br><br><b>The request is invalid <br>";
			exit(); 
		}

		include("dbms.php");
		$obj  = new dbms();

		$sql_comm = "SELECT * FROM `advertise_slide_tb` ORDER BY `id` ASC";
		$count = count($obj->dbms_select($sql_comm));
		if($count >= 5 )
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "เกินจำนวนของสไลด์แล้ว หากต้องการเพิ่มใหม่ ให้ลบสไลด์เดิมออกจากระบบก่อน";
			header("Location: ../view/index.php?advertise");
			exit(); 
		}

		$text = @$_POST["text"];
		$url = @$_POST["url"];
		$active = ($count == 1) ? "active" : "" ;

		$target_dir = "../img/advertise/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$uploadOk = 1;
		while (true)
		{
			$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$random_number = rand(10000000000,99999999999);
			$file_name_to_save = $target_dir . "slide_" . $random_number . "." . $FileType;

			if (!file_exists($target_file))
			{
				break;
			}
		}

		$file_size_MB = 2;
		$limit_size = (($file_size_MB*1024)*1024);
		if ($_FILES["fileToUpload"]["size"] > $limit_size) {
			echo "ขนาดไฟล์ใหญ่เกินไป";
			exit();
			$uploadOk = 0;
		}
		if($FileType != "jpg" && $FileType != "png" && $FileType != "bmp")
		{
			$uploadOk = 0;
		}
		if($uploadOk == 0)
		{
			?>
			<center>
				<br>
				<h1>การอัพโหลดไม่สำเร็จ</h1>
				<h2>ชนิดไฟล์ไม่ถูกต้อง</h2>
				<p>กรุณาตรวจสอบ ชนิดของไฟล์ใหม่อีกครั้ง </p>
				<button onclick="goBack()">Back</button>
			</center>
			<script>
				function goBack() {
					window.history.back();
				}
			</script>
			<?php
			return;
		}

		if ($uploadOk == 1)
		{
			if($FileType == "jpg" || $FileType == "png" || $FileType == "bmp"  )// ถ้า เป็นไฟล์ภาพ จะเข้า if นี้ เพื่อ ดึงข้อมูลของรูปภาพ ( ข้อมูลส่วนนี้จะถูกไป insert ในส่วนของ image // คนล่ะส่วนกับ video )
			{
				$file_name_to_save = $target_dir . "slide_" . $random_number . "." . $FileType;
				$filename_save = "slide_" . $random_number . "." . $FileType;
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_name_to_save))
				{
					$path = $filename_save;

					$sql_comm = "INSERT INTO `advertise_slide_tb` (`id`, `text`, `url`, `path`, `active`) VALUES (NULL, '$text', '$url', '$path', '$active');";

					if($obj->dbms_insert($sql_comm))
					{
						$_SESSION["notify_type"] = "success";
						$_SESSION["notify_string"] = "อัพโหลดสไลด์สำเร็จ";
						header("Location: ../view/index.php?advertise");
						exit();
					}
					else
					{
						$_SESSION["notify_type"] = "danger";
						$_SESSION["notify_string"] = "อัพโหลดสไลด์ไม่สำเร็จ";
						header("Location: ../view/index.php?advertise");
						exit();
					}	
				}
			}
			else
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
		else
		{
			echo "Sorry, your file was not uploaded.";
		}
		?>
