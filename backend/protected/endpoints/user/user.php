<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use classes\User;
use classes\AnswerHandler;
use classes\Authentication;

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $user = User::class;

        if(isset($_GET["email"])) {
            if ($_GET["email"] == "@me") {
                if (!Authentication::is_logged_in())
                    AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
                $user = User::getUser(Authentication::$user_email);
            } else {
                $user = User::getUser($_GET["email"]);
            }

            if (!$user) AnswerHandler::create_response_and_kill_page(false, "user not found", 404);
            AnswerHandler::create_response_and_kill_page(true, $user);

        }


        if (isset($_GET['action'])) {
            if (!Authentication::is_logged_in())
                AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
            if ($_GET['action'] === 'ifunsettutor') {
                $user = User::getUser(Authentication::$user_email);
                if (!$user->isTutor()) {
                    if ($user->getGrade() == null) {
                        if ($user->getDepartment() == null) {
                            AnswerHandler::create_response_and_kill_page(true, ["unsettutor" => true]);
                        }
                    }
                } else {
                    AnswerHandler::create_response_and_kill_page(true, ["unsettutor" => false]);
                }
            }
        }


        $return = [];
        if(isset($_GET["email"])) {
            $user = User::getUser($_GET["email"]);
            if (!$user) AnswerHandler::create_response_and_kill_page(false, "user not found", 404);
                AnswerHandler::create_response_and_kill_page(true, $user);
            $return['self'] = false;
        } else {
            if (!Authentication::is_logged_in())
                AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
            $user = User::getUser(Authentication::$user_email);
            $return['self'] = true;
        }

        $return['profile'] = $user;
        AnswerHandler::create_response_and_kill_page(true, $return);
        break;

    case "DELETE":
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);

        $user = User::getUser(Authentication::$user_email);
        if (!$user->isAdmin())
            AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);

        $user = User::getUser($_GET["email"]);
        if (!$user) AnswerHandler::create_response_and_kill_page(false, "user not found", 404);

        $user->deleteUser();

        AnswerHandler::create_response_and_kill_page(true, "user deleted");

        break;
    default:
        AnswerHandler::create_response_and_kill_page(false, "invalid request method", 400);
}