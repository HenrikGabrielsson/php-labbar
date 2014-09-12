<?php
	require_once("loginModel.php");
	require_once("loginView.php");
	class loginController {
		private $model;
		private $view;
		
		public function __construct() {
			$this->model = new loginModel();
			$this->view = new loginView($this->model);
			
			// Om användaren försöker logga in och inte redan är inloggad så kör vi doLogin().
			if(($this->model->persistentLogin() || $this->view->loginAttempted()) && !$this->model->userIsLoggedIn()) {
				$this->doLogin();
			}
			
			// Om användaren vill logga ut och är inloggad så kör vi doLogout().
			if($this->view->logoutRequest() && $this->model->userIsLoggedIn()) {
				$this->model->doLogout();	// Hanterar utloggningen i systemet.
				$this->view->doLogout();	// Genererar eventuella ut-meddelanden till användaren.
			}
			
			$this->doStuff();
		}
		
		// Sämsta namnet på en metod nånsin. Förlåt.
		public function doStuff() {
			$this->view->showHTML();	// Säger till view att trycka ut färdig html till användaren.
		}
		
		public function doLogin() {
			// loginModel->login() kastar undantag om autentiseringen misslyckas, därav try - catch.
			try {
				// Om autentisering lyckas så säger vi till vyn att visa ett glatt meddelande!
				$loginResult = $this->model->login($this->view->suppliedUsername(), $this->view->suppliedPassword(), $this->view->persistentLogin());
				$this->view->loginSuccess($loginResult);
			}
			// Om något går fel i autentiseringen så kastas ett undantag. Detta presenteras sedan i view.
			catch(Exception $e) {
				$this->view->showLoginError($e->getMessage());
			}
		}
	
	}
?>