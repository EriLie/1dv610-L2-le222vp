<?php


class LayoutView {
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $regV, $newUserRegister) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          <div class="linkRegister">
            ' . $this->newUserRegistration($isLoggedIn, $newUserRegister) . '
          </div>
            ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $this->rightResponse($isLoggedIn, $newUserRegister, $v, $regV) . '

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

  private function newUserRegistration($isLoggedIn, $newUserRegister){
    $link = '';
    
    if ($newUserRegister && isset($_SESSION['newRegister'])) {
      $link = '<a href="?">Back to login</a>';
    }
    if($isLoggedIn) {
       $link = '';
    } 
    if(!$isLoggedIn && !$newUserRegister) {
      $link = '<a href="?register">Register a new user</a>';
    }
     
    
    return $link;
  }

  private function rightResponse($isLoggedIn, $newUserRegister, $v, $regV) {
    $response = '';

    if (!$newUserRegister) {
      $response = $v->response($isLoggedIn);
    } else {
      $message = '';
      $response = $regV->render($message);
    }
    
    return $response;
  }

  private function checkIfRegister($regV) {
    //$regV->render();
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
