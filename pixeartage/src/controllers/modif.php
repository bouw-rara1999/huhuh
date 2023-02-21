<?php

require_once __DIR__ . "/../models/autoload.php";
require_once __DIR__ . "/../models/class/user.class.php";

const ERROR_INPUT = "Ce champ est incorrect";
const ERROR_CHECK_PASSWORD = "Vos mots de passes ne correspondent pas";
const ERROR_INVALID_MAIL = "Mail non valide";

function modif()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [
            "currentPseudo" => "",
            "newPseudo" => ""
        ];

        // Retrieve user from session or database
        $user = null; // Replace with code to retrieve user from session or database

        // Check if user is authenticated
        if (!$user) {
            header("Location: index.php");
            exit;
        }

        $input = filter_input_array(INPUT_POST, [
            "currentPseudo" => FILTER_SANITIZE_SPECIAL_CHARS,
            "newPseudo" => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        $currentPseudo = $input["currentPseudo"] ?? "";
        $newPseudo = $input["newPseudo"] ?? "";

        // Check if current username matches with the user's saved username
        if ($currentPseudo !== $user->pseudo) {
            $errors["currentPseudo"] = "Pseudo actuel incorrect";
        }

        if (empty($newPseudo)) {
            $errors["newPseudo"] = ERROR_INPUT;
        }

        // Check if new username already exists in the database
        $userDao = new UserDao();
        $existingUser = $userDao->findByPseudo($newPseudo);
        if ($existingUser !== null && $existingUser->getId() !== $user->getId()) {
            $errors["newPseudo"] = "Ce pseudo est déjà pris";
        }

        // Update user's pseudo in database
        $user = new User();
        $user->modif($currentPseudo, $newPseudo);

        // Redirect to home page
        header("
Location: index.php?action=modif");
      exit;
    } else {
      var_dump($errors); // add this to display errors
      // Handle errors
    }
  }

  

require_once __DIR__ . "/../view/modifView.php";