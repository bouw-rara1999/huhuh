<?php

require_once __DIR__ . "/../models/autoload.php";
require_once __DIR__ . "/../models/class/user.class.php";

const ERROR_INPUT = "Ce champ est incorrect";
const ERROR_CHECK_PASSWORD = "Vos mots de passes ne correspondent pas";
const ERROR_INVALID_MAIL = "Mail non valide";

function modifpassword()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $errors = [
            "currentpassword" => "",
            "newpassword" => ""
        ];

        // Retrieve user from session or database
        $user = null; // Replace with code to retrieve user from session or database

        // Check if user is authenticated
        if (!$user) {
            header("Location: index.php");
            exit;
        }

        $input = filter_input_array(INPUT_POST, [
            "currentpassword" => FILTER_SANITIZE_SPECIAL_CHARS,
            "newpassword" => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        $currentpassword = $input["currentpassword"] ?? "";
        $newpassword = $input["newpassword"] ?? "";

        // Check if current username matches with the user's saved username
        if ($currentpassword !== $user->password) {
            $errors["currentpassword"] = "password actuel incorrect";
        }

        if (empty($newpassword)) {
            $errors["newpassword"] = ERROR_INPUT;
        }

        // Check if new username already exists in the database
        $userDao = new UserDao();
        $existingUser = $userDao->findByPseudo($newpassword);
        if ($existingUser !== null && $existingUser->getId() !== $user->getId()) {
            $errors["newpassword"] = "Ce password est déjà pris";
        }

        // Update user's pseudo in database
        $user = new User();
        $user->modifpassword($currentpassword, $newpassword);

        // Redirect to home page
        header("
Location: index.php?action=modifpassword");
        exit;
    } else {
        var_dump($errors); // add this to display errors
        // Handle errors
    }
}



require_once __DIR__ . "./../view/passwordView.php";
