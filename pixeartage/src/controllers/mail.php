<?php

require_once __DIR__ . "/../models/autoload.php";
require_once __DIR__ . "/../models/class/user.class.php";

const ERROR_INPUT = "Ce champ est incorrect";
const ERROR_CHECK_PASSWORD = "Votre mail ne correspond pas";
const ERROR_INVALID_MAIL = "Mail non valide";

function modifmail()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [
            "currentmail" => "",
            "newmail" => ""
        ];

        // Retrieve user from session or database
        $user = null; // Replace with code to retrieve user from session or database

        // Check if user is authenticated
        if (!$user) {
            header("Location: index.php");
            exit;
        }

        $input = filter_input_array(INPUT_POST, [
            "currentmail" => FILTER_SANITIZE_SPECIAL_CHARS,
            "newmail" => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        $currentmail = $input["currentmail"] ?? "";
        $newmail = $input["newmail"] ?? "";

        // Check if current username matches with the user's saved username
        if ($currentmail !== $user->mail) {
            $errors["currentmail"] = "mail actuel incorrect";
        }

        if (empty($newmail)) {
            $errors["newmail"] = ERROR_INPUT;
        }

        // Check if new username already exists in the database
        $userDao = new UserDao();
        $existingUser = $userDao->findByPseudo($newmail);
        if ($existingUser !== null && $existingUser->getId() !== $user->getId()) {
            $errors["newmail"] = "Ce mail est déjà pris";
        }

        // Update user's pseudo in database
        $user = new User();
        $user->modifmail($currentmail, $newmail);

        // Redirect to home page
        header("
Location: index.php?action=modifmail");
      exit;
    } else {
      var_dump($errors); // add this to display errors
      // Handle errors
    }
  }

  

require_once __DIR__ . "/../view/mailView.php";
