<?php
    /**
     * used to authenticate the user
     * available types:
     * redirect - returns http redirect, used for the frontend
     * login - used for microsoft login callback
     * logout - used to clear the session cookie -> log the user out
     */

    require "../classes/AzureAPI.php";

switch ($_GET["type"]) {
    case "redirect":
        $login_url = AzureAPI::get_login_url($_GET["path"]);
        header("Location: $login_url");
        break;
    case "login":
        $token = AzureAPI::get_token_from_code($_GET["code"]);

        header("Content-type: application/json");
        echo json_encode(AzureAPI::get_userinfo($token));
        break;
    case "logout":

        break;
}