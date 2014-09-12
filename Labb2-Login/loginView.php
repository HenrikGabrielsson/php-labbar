<?php
	class loginView {
		private $model;											// Innehåller en referens till loginModel-objektet som skapas i loginController.
		private $usernameLocation = "username";					// Nyckel, används i formuläret samt $_POST-arrayet.
		private $passwordLocation = "password";					// Nyckel, används i formuläret samt $_POST-arrayet.
		private $persistentLoginLocation = "persistentLogin";	// Nyckel, används i formuläret samt $_POST-arrayet.
		private $message = "";									// Felmeddelande/Bekräftelse till användaren.
		
		public function __construct(loginModel $model) {
			$this->model = $model;
		}
		
		public function showHTML() {
			setlocale(LC_ALL, "swedish");						// Sätter att vi vill använda svenska namn på veckodagar och sån skit.
			$weekDay = ucfirst(utf8_encode(strftime("%A")));	// Veckodag. ucfirst() sätter stor bokstav i början av veckodagen, ex: måndag blir Måndag. utf8_encode() gör att åäö funkar.
			$date = strftime("%#d");							// Datum. kommer sannolikt behöva ändras i en linux-miljö.
			$month = ucfirst(strftime("%B"));					// Månad. behöver inte utf8_encode eftersom inga svenska månadsnamn innehåller åäö.
			$year = strftime("%Y");								// År.
			$time = strftime("%H:%M:%S");						// Tid.
			
			$loginStatus = "Ej inloggad";						// Inloggnings-status. Två lägen: "Ej inloggad" & "[Användarnamn] är inloggad".
			
			// $content innehåller de html-delar som är beroende av användarens inloggnings-status. Ett formulär om man är utloggad och en utloggnings-länk om man är inloggad.
			$content = "	<form action='?login' method='post'>
		    					<fieldset>
		    						<legend>Inloggning</legend>
		    						" . $this->message . "
		    						Användarnamn: <input type='text' name='" . $this->usernameLocation . "' value='" . $this->suppliedUsername() . "' /> 
		    						Lösenord: <input type='password' name='" . $this->passwordLocation . "' />
		    						Håll mig inloggad: <input type='checkbox' name='" . $this->persistentLoginLocation . "' value='true' />
		    						<input type='submit' />
		    					</fieldset>
		    				</form>";
							
			// Om användaren är inloggad så ändrar vi på $loginStatus och $content.
			if($this->model->userIsLoggedIn()) {
				$loginStatus = $this->model->currentUser() . " är inloggad.";
				$content = $this->message . "<p><a href='?logout'>Logga ut</a></p>"; //$this->message innehåller eventuellt ett meddelande till användaren.
			}

			// De (än så länge) statiska delarna av sidan.
		    echo  "	
		    		<!doctype html>
		    		<html>
		    			<head>
		    				<title>Logga in!</title>
		    				<meta charset='utf-8'>
		    			</head>
		    			<body>
		    			<h1>Labb 2 - fg222cj</h1>
		    			<a href=''>Registrera ny användare</a>
		    			<h2>". $loginStatus ."</h2>
		    				" . $content . "
		    				" . $weekDay . ", den " . $date . " " . $month . " år " . $year . ". Klockan är [" . $time . "].
		    			</body>
		    		</html>";
		}

		// Körs när användaren har gjort en lyckad inloggning.
		public function loginSuccess() {
			$this->message = "<p>Inloggning lyckades</p>";
		}

		// Körs om något blev fel i inloggningen. Fel-definitionerna görs i loginModel.php.
		public function showLoginError($errorType) {
			if($errorType == "EmptyUsername") {
				$this->message = "<p>Användarnamn saknas</p>";
			}
			
			if($errorType == "EmptyPassword") {
				$this->message = "<p>Lösenord saknas</p>";
			}
			
			if($errorType == "InvalidCredentials") {
				$this->message = "<p>Felaktigt användarnamn och/eller lösenord</p>";
			}
		}

		// Returnerar true om användaren skickat inloggningsformuläret.
		public function loginAttempted() {
			return(isset($_POST[$this->usernameLocation]));
		}
		
		// Returnerar användarnamnet som användaren angav. 
		public function suppliedUsername() {
			if(isset($_POST[$this->usernameLocation])) {
				return $_POST[$this->usernameLocation];
			}
		}
		
		// Returnerar lösenordet som användaren angav.
		public function suppliedPassword() {
			if(isset($_POST[$this->passwordLocation])) {
				return $_POST[$this->passwordLocation];
			}
		}
		
		public function persistentLogin() {
			if(isset($_POST[$this->persistentLoginLocation]) && $_POST[$this->persistentLoginLocation] == TRUE) {
				return TRUE;
			}
			return FALSE;
		}
		
		// Returnerar true om användaren vill logga ut.
		public function logoutRequest() {
			return isset($_GET['logout']);
		}
		
		// Körs om utloggning har lyckats.
		public function doLogout() {
			$this->message = "<p>Du har nu loggat ut</p>";
		}
	}
?>