<?php

require_once('./src/models/class/database.class.php');

class Picture extends Database {

  public function __construct()
  {
    parent::__construct();
  }

}


$picture = new Picture();