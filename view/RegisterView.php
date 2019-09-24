<?php

class RegisterView {
    private static $username = 'RegisterView::UserName';
	private static $newMessage = 'RegisterView::Message';
	private static $password = 'RegisterView::Password';
	private static $copyPassword = 'RegisterView::PasswordRepeat';
	private static $addRegistration = 'RegisterView::Register';


    public function render($message) {
        //$message = $messageIncoming;
        return '
            <h2>Register new user</h2>
            <form action="?register" method="post">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$newMessage . '">' . $message . '</p>                
                    
                    <label for="' . self::$username . '" >Username :</label>
                    <input type="text" size="20" name="'. self::$username .'" id="'. self::$username .'" value="" />
                    
                    <br>
                    
                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" size="20" name="'. self::$password .'" id="' . self::$password . '" value="" />
                    
                    <br>
                    
                    <label for="' . self::$copyPassword .'" >Repeat password :</label>
                    <input type="password" size="20" name="' . self::$copyPassword . '" id="' . self::$copyPassword . '" value="" />
                    
                    <br>
                    
                    <input id="submit" type="submit" name="' . self::$addRegistration . '"  value="Register" />
                    <br>
                </fieldset>
            </form> 
        ';
    }



}
