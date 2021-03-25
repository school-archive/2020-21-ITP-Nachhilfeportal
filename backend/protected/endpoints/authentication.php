<?php
    /**
     * used to authenticate the user
     * available types:
     * redirect - returns http redirect, used for the frontend
     * login - used for microsoft login callback
     * logout - used to clear the session cookie -> log the user out
     */

    require "../classes/AzureAPI.php";
    require "../classes/Authentication.php";

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

        echo json_encode(array(
            "logged_id" => Authentication::is_logged_in(),
            "microsoft user info" => AzureAPI::get_userinfo(Authentication::$microsoft_token),
        ));
        break;
}