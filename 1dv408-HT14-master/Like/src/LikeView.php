<?php

require_once("CookieStorage.php");

class LikeView {
	private $model;
	private $messages;

	public function __construct(LikeModel $model) {
		$this->model = $model;
		$this->messages = new \view\CookieStorage();
	}

	public function didUserPressLike() {
		if (isset($_POST["iLike"]))
			return true;
		return false;
	}

	public function getClientIdentifier() {
		return $_SERVER["REMOTE_ADDR"];
	}

	public function showLikes() {

		//var_dump($_POST);

		$likes = $this->model->getNumLikes();
		$ret = "Antalet likes är $likes ";

		if ($this->model->hasLiked( $this->getClientIdentifier() ) == false) {
			$ret .= "
				<form action='' method='post'>
				<input type='submit' value='Gilla!' name='iLike'/>
				</form>";
		} else {
			$ret .= "
				<form action='' method='post'>
				<input type='submit' value='Gilla!' name='iLike' disabled/>
				</form>";
		}

		if ($this->didUserPressLike()) {
			
			
			$this->messages->save(" You like! ");
			header('Location: ' . $_SERVER['PHP_SELF']);
			//die();
		} else {
			$ret .= $this->messages->load();
		}

		return $ret;
	}
}