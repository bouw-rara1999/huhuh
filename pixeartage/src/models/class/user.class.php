<?php
require_once('./src/models/class/database.class.php');

class User extends Database
{

  public int $id;
  public string $pseudo;
  public string $mail;
  private string $password;
  public string $avatar;

  public function __construct()
  {
    parent::__construct();
  }

  public function checkIfUserExist($pseudo, $mail)
  {
    $checkIfUserExist = $this->pdo->prepare("SELECT pseudo, mail FROM users ");
    $checkIfUserExist->execute();
    $checkIfExist = $checkIfUserExist->fetchAll();
    $result = false;
    for ($i = 0; $i < count($checkIfExist); $i++) {
      if (
        $pseudo == $checkIfExist[$i]['pseudo'] ||
        $pseudo == $checkIfExist[$i]['mail']
      ) {
        $result = true;
      }
    }
    for ($i = 0; $i < count($checkIfExist); $i++) {
      if (
        $mail == $checkIfExist[$i]['pseudo'] ||
        $mail == $checkIfExist[$i]['mail']
      ) {
        $result = true;
      }
    }
    return $result;
  }


  public function userRegistered($user)
  {
    $userRegistered = $this->pdo->prepare("INSERT INTO users (pseudo, mail, password) VALUES (:pseudo, :mail, :password)");
    return $userRegistered->execute($user);
  }

  function checkIfPasswordOK($pseudo, $password)
  {
    $checkIfPasswordOkExist = $this->pdo->prepare("SELECT password FROM users WHERE pseudo=:pseudo OR mail=:mail");

    $checkIfPasswordOkExist->BindParam(":pseudo", "$pseudo");
    $checkIfPasswordOkExist->BindParam(":email", "$pseudo");
    $checkIfPasswordOkExist->execute();

    $return = $checkIfPasswordOkExist->fetchAll();
    $result = false;

    if ($password == $return[0]["password"]) {
      $result = true;
    }
    return $result;
  }

  function getHashePassword($pseudo)
  {
    $getHashePassword = $this->pdo->prepare("SELECT password FROM users WHERE pseudo=:pseudo");
    $getHashePassword->BindParam(":pseudo", $pseudo);
    $getHashePassword->execute();
    $return = $getHashePassword->fetchAll();

    return $return;
  }


  function modif()
  {
    $currentpseudo = $_POST['currentpseudo'];
    $newpseudo = $_POST['newpseudo'];

    if ($currentpseudo === $newpseudo) {
      echo "Erreur: Le nouveau pseudo doit être différent du pseudo actuel.";
      return;
    }

    $checkmail = $this->pdo->prepare("SELECT * FROM users WHERE pseudo = :newpseudo");
    $checkmail->bindParam(':newpseudo', $newpseudo);
    $checkmail->execute();
    $rows = $checkmail->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
      echo "Erreur: Ce pseudo est déjà utilisé par un autre utilisateur.";
    } else {


      $updatepseudo = $this->pdo->prepare("UPDATE users SET pseudo = :newpseudo WHERE pseudo = :currentpseudo");
      $updatepseudo->bindParam(':newpseudo', $newpseudo);
      $updatepseudo->bindParam(':currentpseudo', $currentpseudo);

      try {
        $updatepseudo->execute();
        echo "Le changement de nom a été effectué avec succès.";
      } catch (PDOException $e) {
        echo "Erreur lors du changement de nom: " . $e->getMessage();
      }
    }
  }



  function modifmail()
  {
    $currentmail = $_POST['currentmail'];
    $newmail = $_POST['newmail'];

    // Check if the new email already exists in the database
    $checkmail = $this->pdo->prepare("SELECT * FROM users WHERE mail = :newmail");
    $checkmail->bindParam(':newmail', $newmail);
    $checkmail->execute();
    $rows = $checkmail->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
      echo "Erreur: Cette adresse email est inexistante ou déjà utilisée par un autre utilisateur.";
    } else {
      // Update the email for the current user
      $updatemail = $this->pdo->prepare("UPDATE users SET mail = :newmail WHERE mail = :currentmail");
      $updatemail->bindParam(':newmail', $newmail);
      $updatemail->bindParam(':currentmail', $currentmail);

      try {
        $updatemail->execute();
        echo "Le changement de mail a été effectué avec succès.";
      } catch (PDOException $e) {
        echo "Erreur lors du changement de mail: " . $e->getMessage();
      }
    }
  }
function modifpassword()
  {

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];

    $updatepassword = $this->pdo->prepare("UPDATE users SET password = :newpassword WHERE password = :currentpassword");
    $updatepassword->bindParam(':newpassword', $newpassword);
    $updatepassword->bindParam(':currentpassword', $currentpassword);

    try {
      $updatepassword->execute();
      var_dump($updatepassword->execute());
      echo "Le changement de password a été effectué avec succès";
    } catch (PDOException $e) {
      echo "Erreur lors du changement de password: " . $e->getMessage();
    }
  }
 } 




  