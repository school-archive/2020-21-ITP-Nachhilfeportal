<?php
namespace classes;
use classes\User;
use classes\AzureAPI;

require_once __DIR__ . '/../vendor/autoload.php';

class Authentication {
    static $microsoft_token;
    static $user_email;

    /**
     * sets the session variables to log the user in
     * @param $token string obtained from Microsoft API
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
            echo "hello";
            // download profile picture
            AzureAPI::download_profile_picture(Authentication::$microsoft_token, "../../cache/profile_images/".Authentication::$user_email . ".png");
            // create user in db
            var_dump(User::getUser(self::$user_email));
            if (!User::getUser(self::$user_email)) {
                echo "not existt";
                $u = User::createUser(self::$user_email, $userinfo["givenName"], $userinfo["surname"], null,
                    "/api/cache/profile_images/" . self::$user_email . ".png");
                var_dump($u);
                var_dump(User::getUser(self::$user_email));
            }
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