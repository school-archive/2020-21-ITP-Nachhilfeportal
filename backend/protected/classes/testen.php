<?php
require "User.php";


//$user = User::createUser('9991@htl.rennweg.at', 'Nico', 'Sartori', 'askldjfksdjfkl', 'url_not_found');

$user = User::getUser('9991@htl.rennweg.at');
$student = $user->student();
//var_dump($student);
echo $student->getGrade();


//$error = User::deleteUser('9995@htl.rennweg.at');
//var_dump($user);







