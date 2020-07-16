<?php
	if(isset($_SESSION['login'])){
		$dir = "./upload/tmp_".md5($_SERVER['REMOTE_ADDR']);
		$i = 0;
		if(is_dir($dir)) {
			if ($dh = opendir($dir) and count(scandir($dir))>2) {
				echo '<div class="container-fluid">
						<div class="jumbotron jumb">
							<div class="row">';
				while (false !== ($file = readdir($dh))) {
					if ($file != "." && $file != "..") {
						$i = $i + 1;
						$filename = $dir . "/" . $file;
						 echo "
					  			<div class='col-sm-6 col-md-4'>
					    			<div class='thumbnail'>
					      				<img src='$filename' alt='uploadpic'>
					      				<div class='caption'>
						        		<h3>No.$i</h3>
						        		<br>
						        		<p><a href='$filename' class='btn btn-primary' role='button'>ViewPic</a></p>
					      			</div>
					    		</div>
							</div>
						";
					}
				}
				closedir($dh);
			}
		}
		else{
			die("<script>alert('没有此目录，请重新尝试！');history.go(-1);</script>");
		}
	}