<?php


class LayoutView {
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $regV) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          <div class="linkRegister">
            ' . $this->newUserRegistration() . '
          </div>
            ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response($isLoggedIn) . '
              ' . $this->checkIfRegister($regV) . '

              ' . $dtv->show() . '
          </div>
          
        </body>
      </html>
    ';
  }


  /*
  '. var_dump($_SESSION) .'
          <br>
          '. var_dump($_POST) .'
          <br>
          '. var_dump($_GET) .'
  
  */

  private function newUserRegistration(){
    if(isset($_SESSION['newRegister'])) {
      return '<a href="?">Back to login</a>'; 
    } else {
      return '<a href="?register">Register a new user</a>';
    }
     
  }

  private function checkIfRegister($regV) {
    $regV->render();
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
