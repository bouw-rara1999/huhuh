<?php

require_once('./src/models/class/database.class.php');

class Comment extends Database {

  public function __construct()
  {
    parent::__construct();
  }

}

$comment = new Comment();