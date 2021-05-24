<?php


namespace controller;

use classes\Authentication;
use classes\AzureAPI;

class AuthenticationController
{
    public static function redirect()
    {
        $login_url = AzureAPI::get_login_url(isset($_GET["path"]) ? $_GET["path"] : "/auth/logout");
        header("Location: $login_url");
    }

    public static function login()
    {
        if (!isset($_GET["code"])) {
            header("Location: /api/auth/login/redirect");
            die();
        }
        $token = AzureAPI::get_token_from_code($_GET["code"]);

        if (Authentication::login($token)) {
            header("Location: /");
            die();
        }
        else
            echo "unsuccessful";
    }

    public static function logout()
    {
        Authentication::logout();
        header("Location: /");
    }

    public static function authtest()
    {
        header("Content-type: application/json");

        $userinfo = null;
        if (Authentication::is_logged_in()) {
            $userinfo = AzureAPI::get_userinfo(Authentication::$microsoft_token);
            if ($userinfo == null)
                Authentication::logout();
        }

        echo json_encode(array(
            "logged_id" => Authentication::is_logged_in(),
            "userinfo" => $userinfo,
        ));

    }
}