<?php
    class loginModel {
    	private $correctUsername = "Admin";		// Korrekt användarnamn.
		private $correctPassword = "Password";	// Korrekt lösenord.
		private $usernameLocation = "username";	// Nyckel. Används i $_SESSION för att lagra en inloggad användares användarnamn.
		private $cookieUsername = "Username";	// Nyckel. Används i $_COOKIE för att lagra ett sparat användarnamn.
		private $cookiePassword = "Password";	// Nyckel. Används i $_COOKIE för att lagra ett sparat lösenord.
		
		public function __construct() {
			
		}
		
		// Returnerar true om inloggningsuppgifterna stämmer, annars kastas ett undantag.
		public function login($username, $password, $persistentLogin = FALSE) {
			
			if($this->persistentLogin()) {
				$username = $this->savedUsername();
				$password = $this->savedPassword();
			}
			
			// Validering, om något går fel så kastar vi ett undantag som fångas i controllern och presenteras i view.
			if($username == "") {
				throw new Exception("EmptyUsername");
			}
			
			if($password == "") {
				throw new Exception("EmptyPassword");
			}
			
			// Om inloggningsuppgifterna stämmer så är användaren autentiserad. Sessions-arrayet lagrar användarnamnet.
			if($this->correctUsername == $username && $this->correctPassword == $password){
				$_SESSION[$this->usernameLocation] = $this->correctUsername;
				if($persistentLogin) {
					setcookie($this->cookieUsername, $this->correctUsername, time() + 3600);
					setcookie($this->cookiePassword, $this->correctPassword, time() + 3600);
				}
				return TRUE;
			}
			else {
				throw new Exception("InvalidCredentials");
			}
			
			return FALSE;
		}
		
		// Returnerar true om ett användarnamn är lagrat i sessions-arrayet. 
		public function userIsLoggedIn() {
			if(isset($_SESSION[$this->usernameLocation])) {
				return TRUE;
			}
		}
		
		public function persistentLogin() {
			return (isset($_COOKIE[$this->cookieUsername]) && isset($_COOKIE[$this->cookiePassword]));
		}
		
		public function savedUsername() {
			if(isset($_COOKIE[$this->cookieUsername])) {
				return $_COOKIE[$this->cookieUsername];
			}
		}
		
		public function savedPassword() {
			if(isset($_COOKIE[$this->cookiePassword])) {
				return $_COOKIE[$this->cookiePassword];
			}
		}
		
		// Returnerar användarnamn på inloggad användare.
		public function currentUser() {
			return $_SESSION[$this->usernameLocation];
		}
		
		// Körs om användaren vill logga ut.
		public function doLogout() {
			// Tar bort alla lagrade cookies.
			foreach ($_COOKIE as $c_key => $c_value) {
    			setcookie($c_key, NULL, 1);
			}
			session_unset();	// Tömmer sessions-arrayet.
			session_destroy();	// Förstör användarens lokala sessions-cookie.
			
		}
    }
?>