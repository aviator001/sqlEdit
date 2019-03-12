<?
class sql {
	public function connect($ipx="199.91.65.82",$user="root",$pswd="Shadow2015!",$dbx="txt") {
			global $db;
			try {
				global $conn;
				$db = new mysqli($ipx, $user, $pswd, $dbx);
				$this->conn = $db;
				return $this->conn = $db;
			} catch (Exception $e) {
				return "Unable to connect";
				exit;
			}
	}
	public function close() {
		try {
			$this->conn->close();
			return "Closed";
		} catch (Exception $e) {
			return "Unable to Close";
			exit;
		}
	}

	public function sql($sql) {
		return $this->_sql($sql);
	}

	public function insert($sql) {
		return $this->_insert($sql);
	}

	public function query($sql) {
		return $this->_sql_arr($sql);
	}

	public function show($obj) {
		echo "<pre>";
			print_r($obj);
		echo "</pre>";
	}

	protected function _sql($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($this->result = $db->query($sql)){
					return $this->result;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _insert($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($db->query($sql)){
					return $db->insert_id;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _update($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($db->query($sql)){
					return $db->insert_id;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _sql_arr($sql) {
		global $dbs;
		global $row;
		global $rowset;
		try {
				$db=$this->conn;
			try {
					if($r = $db->query($sql)){
						while ($row =  $r->fetch_assoc()) {
							$arr[] = $row;
						}
						$this->rowset = $arr;
						$r->free();
						return $this->rowset;
					} else {
							return null;
					}
				} catch (Exception $e) {
					return null;
				}
			return $res;
		} catch (Exception $e) {
			return "Unable to connect";
			exit;
		}
	}
