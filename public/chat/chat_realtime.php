<?php

/*****************************************************
* #### Chat Realtime (BETA) ####
* Coded by Ican Bachors 2016.
* https://github.com/bachors/Chat-Realtime
* Updates will be posted to this site.
* Aplikasi ini akan selalu bersetatus (BETA) 
* Karena akan terus di update & dikembangkan.
* Maka dari itu jangan lupa di fork & like ya sob :).
*****************************************************/

class Chat_realtime {
	
	private $name;
	private $host;
	private $username;
	private $password;
	private $imageDir;
	
	function __construct($name, $host, $username, $password, $imageDir)
    {
        $this->dbh = new PDO('mysql:dbname='.$name.';host='.$host.";port=3306",$username, $password);
		$this->imageDir = $imageDir;
    }
	
	function user_login($user_id, $profile){
		$user_id = htmlspecialchars($user_id);
		$data = array();
		$sql=$this->dbh->prepare("SELECT user_id FROM users WHERE user_id=?");
		$sql->execute(array($user_id));

		if($sql->rowCount() == 0){
			// no data
			$data['status'] = 'error';
		}else{
			$upd=$upd=$this->dbh->prepare("UPDATE users SET login=NOW(), login_status=? WHERE user_id=?");
			$upd->execute(array('online', $user_id));

			$data['status'] = 'success';
		}

		// $data['status'] = 'success';
		return $data;
	}
	
	function get_message($tipe, $receiver_id, $user){
		$data = array();
		if($tipe == 'rooms'){
			if($receiver_id == 'all'){
				$sql=$this->dbh->prepare("SELECT m.*, `sender`.`profile`, `sender`.`user_firstname`, `sender`.`user_lastname` FROM messages AS m INNER JOIN users AS sender ON `sender`.`user_id` = `m`.`sender_id` WHERE tipe=? order by date ASC");
				$sql->execute(array($tipe));
			}else{
				$sql=$this->dbh->prepare("SELECT m.*, `sender`.`profile`, `sender`.`user_firstname`, `sender`.`user_lastname` FROM messages AS m INNER JOIN users AS sender ON `sender`.`user_id` = `m`.`sender_id` WHERE receiver_id=? order by date ASC");
				$sql->execute(array( str_replace('s', '', $receiver_id) ));
			}
			while($r = $sql->fetch()){
				$data[] = array(
					'sender_id' => $r['sender_id'],
					'sender_name' => $r['user_firstname'].' '.$r['user_lastname'],
					'profile' => url().'/'.$r['profile'],
					'message' => $r['message'],
					'image' => $r['image'],
					'tipe' => $r['tipe'],
					'date' => $r['date'],
					'selektor' => $r['receiver_id']
				);
			}
		}else if($tipe == 'users'){
			if($receiver_id == 'all'){
				$sql=$this->dbh->prepare("SELECT m.*, `sender`.`profile`, `sender`.`user_firstname`, `sender`.`user_lastname` FROM messages AS m INNER JOIN users AS sender ON `sender`.`user_id` = `m`.`sender_id` WHERE (sender_id = :id1 AND tipe= :id2) OR (receiver_id = :id1 AND tipe = :id2) order by date ASC");
				$sql->execute(array(':id1' => $user, ':id2' => $tipe));
			}else{
				$sql=$this->dbh->prepare("SELECT m.*, `sender`.`profile`, `sender`.`user_firstname`, `sender`.`user_lastname` FROM messages AS m INNER JOIN users AS sender ON `sender`.`user_id` = `m`.`sender_id` WHERE (sender_id = :id1 AND receiver_id= :id2) OR (sender_id = :id2 AND receiver_id = :id1) order by date ASC");
				$sql->execute(array(':id1' => $user, ':id2' => str_replace('s', '', $receiver_id) ));
			}
			while($r = $sql->fetch()){
				$data[] = array(
					'sender_id' => $r['sender_id'],
					'sender_name' => $r['user_firstname'].' '.$r['user_lastname'],
					'profile' => url().'/'.$r['profile'],
					'message' => $r['message'],
					'image' => $r['image'],
					'tipe' => $r['tipe'],
					'date' => $r['date'],
					'selektor' => ($r['sender_id'] == $user ? $r['receiver_id'] : $r['sender_id'])
				);
			}
		}
		return $data;
	}
	
	function get_user($user){
		if(isset($user)){
			$sqlm=$this->dbh->prepare("SELECT user_id FROM users WHERE user_id=?");
			$sqlm->execute(array($user));
			if($sqlm->rowCount() > 0){
				$upd=$this->dbh->prepare("UPDATE users SET login=NOW() WHERE user_id=?");
				$upd->execute(array($user));
			}
		}
		$data = array();
		$sql=$this->dbh->prepare("SELECT * FROM users");
		$sql->execute();
		while($r = $sql->fetch()){
			$data[] = array(
				'user_id' => $r['user_id'],
				'user_name' => $r['user_firstname'].' '.$r['user_lastname'],
				'profile' => url().'/'.$r['profile'],
				'login' => $r['login'],
				'login_status' => $r['login_status']
			);
		}
		return $data;
	}
	
	function send_message($sender_id, $receiver_id, $message, $image, $date, $tipe){		
		$data = array();
		$sql=$this->dbh->prepare("INSERT INTO messages (sender_id,receiver_id,message,image,tipe,date) VALUES (?,?,?,?,?,?)");
		$sql->execute(array($sender_id,$receiver_id,$message,$image,$tipe,$date));
		$data['status'] = 'success';
		return $data;
	}
	
	function user_logout($user_id){
		$data = array();
		$user = $this->dbh->prepare("UPDATE users SET login_status=? WHERE user_id=?");
		$user->execute(array('offline',$user_id));
		$data['status'] = 'success';
		return $data;
	}
	
	// upload image
	function arrayToBinaryString($arr) {
		$str = "";
		foreach($arr as $elm) {
			$str .= chr((int) $elm);
		}
		return $str;
	}

	function createImg($string, $name, $type){
		$im = imagecreatefromstring($string); 
		if($type == 'image/png'){
				imageAlphaBlending($im, true);
				imageSaveAlpha($im, true);
			imagepng($im, $this->imageDir.'/'.$name);
		}else if($type == 'image/gif'){
			imagegif($im, $this->imageDir.'/'.$name);
		}else{
			imagejpeg($im, $this->imageDir.'/'.$name);
		}
		imagedestroy($im);
	}
	
}

function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['SERVER_NAME'].'/development/freelancer/public';
}