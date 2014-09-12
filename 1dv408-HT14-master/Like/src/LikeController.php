<?php

 require_once("src/LikeModel.php");
 require_once("src/LikeView.php");

class LikeController {
	private $view;
	private $model;

	public function __construct() {
		$this->model = new LikeModel();
		$this->view = new LikeView($this->model);
	}

	/**
	* @return String HTML
	*/ 
	public function doLike() {
		$clientIdentifier = $this->view->getClientIdentifier();
		//Hantera indata
		if ($this->view->didUserPressLike()) {
			$this->model->addLike($clientIdentifier);
		}

		//Generera utdata
		return $this->view->showLikes($clientIdentifier);

	}
}