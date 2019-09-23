<?php

class LoginView {
	private static $submitLogin = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $message = '';
	
	private $inputPostName = '';

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		$response;

		if(isset($_POST[self::$logout])) {
			//session_destroy();
			$this->message = 'Bye bye!';
			unset($_SESSION['userLoggedIn']);
		}

		if ($isLoggedIn) {
			$response = $this->generateLogoutButtonHTML($this->message);			
		} else {
			$response = $this->generateLoginFormHTML($this->message);
		}
		
		
			
		if(isset($_SESSION['userLoggedIn'])) {
			//echo 'Kommer in hir';	
			//$response = $this->loggedIn() . $this->generateLogoutButtonHTML($message);
		}
	
		
		
		/*if(isset($_POST[self::$submitLogin])) {			
			$this->inputPostName = $_POST[self::$name];

		

            if(empty($_POST[self::$name])) {
				$message = 'Username is missing';
				$response = $this->generateLoginFormHTML($message);
            } else if (empty($_POST[self::$password])) {
				$message = 'Password is missing';
				$response = $this->generateLoginFormHTML($message);

			} else if ($_POST[self::$name] == 'Admin' && $_POST[self::$password] == 'Password') {
				$_SESSION['userLoggedIn'] = $_POST[self::$name];
				//$message = 'Welcome';
				// Måste fixa så index renderas om!!
				
				$response = $this->generateLogoutButtonHTML($message);
			
			} else if ($_POST[self::$name] == 'Admin' || $_POST[self::$password] == 'Password') {
				$message = 'Wrong name or password';
				$response = $this->generateLoginFormHTML($message);	
			} 
			
			
		} else {
			//$this->inputPostName = $_POST[self::$name];
			$response = $this->generateLoginFormHTML($message);
		}*/
		

		

        
		return $response;
	}

	public function controllLoggedIn() {
		$isLoggedIn = false;
		$this->message = '';

		if(isset($_POST[self::$submitLogin])) {			
			$this->inputPostName = $_POST[self::$name];

            if(empty($_POST[self::$name])) {
				$this->message = 'Username is missing';
				//$response = $this->generateLoginFormHTML($message);
            } else if (empty($_POST[self::$password])) {
				$this->message = 'Password is missing';
				//$response = $this->generateLoginFormHTML($message);

			} else if ($_POST[self::$name] == 'Admin' && $_POST[self::$password] == 'Password') {
				$isLoggedIn = true;
				$_SESSION['userLoggedIn'] = $_POST[self::$name];

				$this->message = 'Welcome';
				// Måste fixa så index renderas om!!
				
				//$response = $this->generateLogoutButtonHTML($message);
			
			} else if ($_POST[self::$name] == 'Admin' || $_POST[self::$password] == 'Password') {
				$this->message = 'Wrong name or password';
				//$response = $this->generateLoginFormHTML($message);	
			} 
			
			
		}

		return $isLoggedIn;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->inputPostName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$submitLogin . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		$username = $_POST['name'];
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}