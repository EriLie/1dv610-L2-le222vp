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

	
		if ($isLoggedIn) {
			$response = $this->generateLogoutButtonHTML($this->message);			
		} else {
			$response = $this->generateLoginFormHTML($this->message);
		}
		
		
			
		if(isset($_SESSION['userLoggedIn'])) {
			//echo 'Kommer in hir';	
			//$response = $this->loggedIn() . $this->generateLogoutButtonHTML($message);
		}
	        
		return $response;
	}

	public function controllLoggedIn() {
		$isLoggedIn = false;
		//$this->message = '';
		

		if(isset($_POST[self::$logout]) && isset($_SESSION['userLoggedIn'])) {
			//
			unset($_SESSION['userLoggedIn']);
			unset($_SESSION['shouldWelcome']);

			unset($_COOKIE['Admin']);
			setcookie('Admin', '', time() - 3600, '/');

			//session_destroy();
			$this->message = 'Bye bye!';
			$isLoggedIn = false;
			return $isLoggedIn;		
		}

		

		if(isset($_SESSION['userLoggedIn'])) {
			$isLoggedIn = true;
			$this->message = '';
		}
			
 		if (isset($_COOKIE['Admin']) && !isset($_SESSION['shouldWelcome'])) {
			$this->message = 'Welcome back with cookie';
			
			$isLoggedIn = true;
		}

		if(isset($_POST[self::$submitLogin])) {
			$user = $_POST[self::$name];
			$password = $_POST[self::$password];

			$this->inputPostName = $user;

			
            if(empty($user)) {
				$this->message = 'Username is missing';
				//$response = $this->generateLoginFormHTML($message);
            } else if (empty($password)) {
				$this->message = 'Password is missing';
				//$response = $this->generateLoginFormHTML($message);

			} else if (isset($_SESSION['shouldWelcome'])) {
				if ($_SESSION['shouldWelcome']) {
					$this->message = '';
					$isLoggedIn = true;
				}

			} else if ($user == 'Admin' && $password == 'Password') {
				$isLoggedIn = true;
				$_SESSION['userLoggedIn'] = $user;
				$_SESSION['shouldWelcome'] = true;
				$this->message = 'Welcome';

				$cookieUsername = $user;
				$cookiePassword = $password;

				if(isset($_POST[self::$keep])) {
					setcookie($cookieUsername, $cookiePassword, time() + 3600);
				}
			
			} else if ($user == 'Admin' || $password == 'Password') {
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