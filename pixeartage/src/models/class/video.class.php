<?php

require_once('./src/models/class/database.class.php');

class Video extends Database {

  public function __construct()
  {
    parent::__construct();
  }
  
}

$video = new Video();