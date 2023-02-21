<?php 

require_once __DIR__ ."./../models/class/user.class.php";
require_once __DIR__ . './../models/autoload.php';





function getViewRegister (){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $patternLetterNumbers = '/^[a-zA-Z0-9]+$/'; // Pattern : qui accepte seulement lettres et chiffres
        $patternPassword = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';  // Pattern : 1 Majuscule , 8 caractères minimum, et un chiffre minimum
      
        $errors = [
          'pseudo' => '',
          'mail' => '',
          'password' => '',
          'confirmPass' => ''
        ];
      
        $input = filter_input_array(INPUT_POST, [
          'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
          'mail' => FILTER_SANITIZE_EMAIL,
          'password' => FILTER_SANITIZE_SPECIAL_CHARS,
          'confirmPass' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
      
        $pseudo = $input['pseudo'] ?? '';
        $mail = $input['mail'] ?? '';
        $password = $input['password'] ?? '';
        $confirmPass = $input['confirmPass'] ?? '';
      
        if (empty($pseudo)) {
          $errors['pseudo'] = ERROR_INPUT;
        } else if (!preg_match($patternLetterNumbers, $pseudo)) {
          $errors['pseudo'] = "Caractères invalide";
        }
      
        if (empty($mail)) {
          $errors['mail'] = ERROR_INPUT;
        } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          $errors['mail'] = ERROR_INVALID_MAIL;
        }
      
        if (empty($password)) {
          $errors['password'] = ERROR_INPUT;
        } else if (!preg_match($patternPassword, $password)) {
          $errors['password'] = "Une Majuscule, un chiffre, 8 caractères";
        }
      
        if (empty($confirmPass)) {
          $errors['confirmPass'] = ERROR_INPUT;
        } else if (!preg_match($patternPassword, $confirmPass)) {
          $errors['confirmPass'] = "Une Majuscule, un chiffre, 8 caractères";
        } else if ($confirmPass !== $password) {
          $errors['confirmPass'] = ERROR_CHECK_PASSWORD;
        }

        if (empty(array_filter($errors, fn ($e) => $e !== ''))) { 
           
            $adduser = [
                "pseudo" => $pseudo,
                "mail" => $mail,
                "password" => $password,
            ];
            $user = new User();
            if ($user->checkIfUserExist($pseudo , $mail) !== true ){
                $user->userRegistered($adduser);
                header ('location: index.php?action=login');
            }


            
            
            
        } else {
            
            
        }
    }

    require_once __DIR__.'./../view/RegisterView.php';
}






