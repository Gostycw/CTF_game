<?php
	header("content-type:text/html;charset=utf-8");
	session_start();
	function getkey()
	{
		$key = '';
		$chars = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		for ($i = 0; $i < 48; $i++)
		{
			$key = $key . $chars[random_int(0, 61)];
		}
		$_SESSION['key'] = $key;
		return $key;
	}
	function getreferer() {
		static $referer;
		if (isset($_SERVER['HTTP_REFERER'])) {
				$referer = $_SERVER['HTTP_REFERER'];
			}
		elseif(isset($_POST['URL_REFERER'])){
				$referer = $_POST['URL_REFERER'];
			}
		else{
			die("Where are you from?");
		}
		return $referer;
	}
		$key = getkey();
		$url = getreferer();
		if(!preg_match("/^http[s]{0,1}:\/\//i", $url)){
			die("What do you want to do?");
		}
		$host = parse_url($url, PHP_URL_HOST);
		if(preg_match("/^google\.com$/i", $host) or preg_match("/(.*)\.google\.com$/i", $host)){
			$headers = get_headers($url,1);
			if($headers['dd'] === 'MeAquaNo_1!!!'){
				echo $key;
			}
			else{
				echo 'dd beheading!';
			}
		}
		else{
			die("Only dd working at Google can get the key!");
		}