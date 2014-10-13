<?php 
$dbhost = "localhost";
$dbuser = "vusr";
$dbpass = "";
$dbname = "";

$sql = "CREATE TABLE mails (
  `id` INT(11) AUTO_INCREMENT,
  `email` VARCHAR (255),
  `lock` SMALLINT(1) DEFAULT 0,
  `result` SMALLINT(3) DEFAULT 0,
  PRIMARY KEY (`id`)
);";


$sql = "CREATE TABLE `result` (
  `total` INT(11)  DEFAULT 0,
  `checked` INT(11)  DEFAULT 0,
  `notmail` INT(11)  DEFAULT 0,
  `bad` INT(11)  DEFAULT 0,
  `good` INT(11)  DEFAULT 0

);";