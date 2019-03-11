<?
class ipLocate {
	public function locate($ip="") {
		if ($ip=="") $ip=$this->getIP();
		$location=file_get_contents("http://terrawire.com:8080/$ip");
		return $location;
	}
	private function getIP() {
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		$result  = "Unknown";
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		}
		else {
			$ip = $remote;
		}
		return $ip;
	}

}

