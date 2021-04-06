<?php
    /**
     * used to authenticate the user
     * available types:
     * redirect - returns http redirect, used for the frontend
     * login - used for microsoft login callback
     * logout - used to clear the session cookie -> log the user out
     */

//    require_once "../classes/AzureAPI.php";
//    require_once "../classes/Authentication.php";
//    require_once "../classes/User.php";
use classes\Authentication;
use classes\AzureAPI;
use classes\User;

require_once __DIR__ . '/../vendor/autoload.php';

switch ($_GET["type"]) {
    case "redirect":
        $login_url = AzureAPI::get_login_url(isset($_GET["path"]) ? $_GET["path"] : "/auth/logout");
        header("Location: $login_url");
        break;
    case "login":
        if (!isset($_GET["code"])) {
            header("Location: /api/auth/login/redirect");
            die();
        }
        $token = AzureAPI::get_token_from_code($_GET["code"]);

        if (Authentication::login($token)) {
            header("Location: /api/auth/authtest");
            die();
        }
        else
            echo "unsuccessful";
        break;
    case "logout":

        Authentication::logout();
        header("Location: /api/auth/authtest");

        break;
    case "authtest":

        header("Content-type: application/json");

        Authentication::is_logged_in();
        ob_start();
        var_dump(User::getUser(Authentication::$user_email));
        $info = ob_get_clean();
        echo json_encode(array(
            "logged_id" => Authentication::is_logged_in(),
            //"sads" => User::createUser(Authentication::$user_email, "sad", "ads", "asd", "ads", 0, 0),
            "microsoft user info" => AzureAPI::get_userinfo(Authentication::$microsoft_token),
            "sad" => User::getUser(Authentication::$user_email)
        ));

        break;
}