<?php
	header("content-type:text/html;charset=utf-8");
	error_reporting(0);
	class showpic{
		public $picname;
		public $finish;
		function __construct($picn){
			$this->picname = $picn;
			$this->finish = $this;
		}
		function show(){
			echo "<script>alert('find!');</script>";
			echo "<script>location.href='$this->picname';</script>";
		}
		function alert(){
			echo "<script>alert('finished.');</script>";
		}
		function __destruct(){
			$this->finish->alert();
		}
	}
	$pic_path = "./upload/tmp_".md5($_SERVER['REMOTE_ADDR']);
	if(isset($_SESSION['login'])){
		if(isset($_POST["find"]) && $_POST["find"] == "find"){
			chdir($pic_path);
			$pic = $_POST['picname'];
			if(preg_match("/^(http|https|ftp|file|dict|gopher|phar|php)/i", $pic) or preg_match("/\.\.|\.\.\/|flag|html|js|css|php/i", $pic)){
				die("<script>alert('Hacker!!');history.go(-1);</script>");
			}
			if(!exif_imagetype($pic)) {die("<script>alert('Hacker!!!');history.go(-1);</script>");}
			if(file_exists($pic)){
				$picn = $pic_path . "/" . $pic;
				$pic = new showpic($picn);
				$pic->show();
			}
			else{
				echo "<script>alert('未找到该图片，请确认该图片是否被上传成功.');history.go(-1);</script>";
			}
		}
	}
?>