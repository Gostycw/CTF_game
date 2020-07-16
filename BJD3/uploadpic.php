<?php
    header("content-type:text/html;charset=utf-8");
    $upload_path = "./upload/tmp_".md5($_SERVER['REMOTE_ADDR']);
    if(isset($_SESSION['login'])){
        if(!file_exists($upload_path)){
            mkdir($upload_path);
        }

        $is_upload = false;
        $msg = null;
        if (isset($_POST['upload']) && !empty($_FILES["upload_file"])) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $file_name = $_FILES['upload_file']['name'];
            $allow_ext = array(".jpg",".png",".gif");
            $file_ext = strrchr($file_name, '.');
            if(preg_match("/ph/i",$file_ext)) die("What do you want to do?");

            if (in_array($file_ext, $allow_ext)) {
                if(!exif_imagetype($temp_file)) die("What did you upload?");
                if(mb_strpos(file_get_contents($temp_file), 'script')!==False) die("Sorry, I'm a policeman.");
                $file_path = $upload_path.'/'.$file_name;
                if (move_uploaded_file($temp_file, $file_path)) {
                    $is_upload = true;
                } else {
                    $msg = '上传出错！';
                }
            } else {
                $msg = '此文件不允许上传!';
            }
        }
    }
    else{
        echo "<script>alert('Please Login!');history.go(-1);</script>";
    }
?>