<?php
require_once "AzureAPI.php";

class Authentication {
    static $microsoft_token;
    static $user_email;

    /**
     * sets the session variables to log the user in
     * @param $token token obtained from Microsoft API
     * @return bool
     */
    public static function login($token) {
        if (!self::is_logged_in()) {
            $userinfo = AzureAPI::get_userinfo($token);
            if ($userinfo === null) return false;
            self::$microsoft_token = $token;
            self::$user_email = $userinfo["userPrincipalName"];
            $_SESSION["microsoft_token"] = self::$microsoft_token;
            $_SESSION["user_email"] = self::$user_email;
            // TODO: Create new user in database
        }
        return true;
    }

    /**
     * clears the user session
     * @return bool success
     */
    public static function logout() {
        if (self::is_logged_in()) {
            session_reset();
            session_destroy();
            return "was logged in";
        }
        return true;
    }

    /**
     * returns the microsoft token if logged in
     * @return null
     */
    public static function get_microsoft_token() {
        if (self::is_logged_in())
            return self::$microsoft_token;
        return null;
    }

    /**
     * checks if user is currently logged in
     * @return bool
     */
    public static function is_logged_in() {
        session_start();
        self::$microsoft_token = $_SESSION["microsoft_token"];
        self::$user_email = $_SESSION["user_email"];
        if (!isset(self::$user_email))
            return false;
        return true;
    }
}