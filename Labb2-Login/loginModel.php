<?php
    class loginModel {
    	private $correctUsername = "Admin";		// Korrekt användarnamn.
		private $correctPassword = "Password";	// Korrekt lösenord.
		private $usernameLocation = "username";	// Nyckel. Används i $_SESSION för att lagra en inloggad användares användarnamn.
		
		public function __construct() {
			
		}
		
		// Om inloggningen lyckas så returneras ett lyckat state, annars kastas ett undantag.
		public function login($username, $password, $saveCredentials = FALSE, $loginWithSavedCredentials = FALSE) {
			
			// Validering, om något går fel så kastar vi ett undantag som fångas i controllern och presenteras i view.
			if(!isset($username) || $username == "") {
				throw new Exception("EmptyUsername");
			}
			
			if(!isset($password) || $password == "") {
				throw new Exception("EmptyPassword");
			}
			
			// Om det finns sparade kakor med korrekt inloggningsuppgifter så används dem i första hand. 
			if($loginWithSavedCredentials) {
				if($username == $this->correctUsername && $password == $this->correctPassword) {
					$_SESSION[$this->usernameLocation] = $this->correctUsername;
					return "CookieLoginSuccess";	// En status som skickas vidare till view för att berätta för användaren att vi loggade in med sparad info.
				}
				throw new Exception("BadCookieCredentials");
			}
			
			// Om inloggningsuppgifterna stämmer så är användaren autentiserad. Sessions-arrayet lagrar användarnamnet.
			if($this->correctUsername == $username && $this->correctPassword == $password){
				$_SESSION[$this->usernameLocation] = $this->correctUsername;
				if($saveCredentials) {
					return "SaveCredentialsLoginSuccess";	//En status som skickas vidare till användaren för att visa att vi sparade inloggningsuppgifterna.
				}
				return "LoginSuccess";	// En status som skickas vidare till användaren för att visa att inloggningen lyckades.
			}
			else {
				throw new Exception("InvalidCredentials");
			}
			
			throw new Exception("Unexpected");
		}
		
		// Returnerar true om ett användarnamn är lagrat i sessions-arrayet. 
		public function userIsLoggedIn() {
			if(isset($_SESSION[$this->usernameLocation])) {
				return TRUE;
			}
		}
		
		// Returnerar användarnamn på inloggad användare.
		public function currentUser() {
			return $_SESSION[$this->usernameLocation];
		}
		
		// Körs om användaren vill logga ut.
		public function doLogout() {
			session_unset();	// Tömmer sessions-arrayet.
		}
    }
?>