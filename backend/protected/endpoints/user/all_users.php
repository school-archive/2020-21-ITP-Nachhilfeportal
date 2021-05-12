<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use classes\User;
use classes\Authentication;
use classes\AnswerHandler;

if (! Authentication::is_logged_in())
    AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);


if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user = User::getUser(Authentication::$user_email);

    if(isset($_GET['action'])) {
        if($_GET['action']==='filter') {
            AnswerHandler::create_response_and_kill_page(true, $user->filterUser());
        }
    }


    if (!$user->isAdmin())
        AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);

    $count = isset($_GET["count"]) ? $_GET["count"] : 10;
    $offset = isset($_GET["offset"]) ? $_GET["offset"] : 0;

    AnswerHandler::create_response_and_kill_page(true, User::get_users($count, $offset));
}
