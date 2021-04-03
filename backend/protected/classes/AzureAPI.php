<?php
class AzureAPI {
    private static $scope = "user.read";
    private static $redirect_endpoint = "/api/auth/login/";
    private static $domain = "htl.rennweg.at";

    /**
     * returns a url to the microsoft login page
     * @param $state current path
     */
    public static function get_login_url($state="/") {
        $client_id = getenv("AZURE_CLIENT_ID");
        $redirect_url = urlencode(self::get_redirect_url());
        $state = urlencode($state);
        $scope = self::$scope;
        $domain = self::$domain;
        $login_url = "https://login.microsoftonline.com/$domain/oauth2/v2.0/authorize" .
            "?client_id=$client_id" .
            "&response_type=code".
            "&redirect_uri=$redirect_url" .
            "&state=$state" .
            "&scope=$scope" .
            "&prompt=select_account";
        return $login_url;
    }

    /**
     * returns the authenticated user token from the azure api
     * @param $code from login
     * @return mixed|null token or null if error occurred
     */
    public static function get_token_from_code($code) {
        $client_id = getenv("AZURE_CLIENT_ID");
        $client_secret = urlencode(getenv("AZURE_SECRET"));
        $domain = self::$domain;
        $url = "https://login.microsoftonline.com/$domain/oauth2/v2.0/token";
        $scope = self::$scope;
        $redirect_url = urlencode(self::get_redirect_url());

        $query = "client_id=$client_id" .
            "&scope=$scope" .
            "&code=$code" .
            "&grant_type=authorization_code" .
            "&redirect_uri=$redirect_url" .
            "&client_secret=$client_secret";

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'=>
                    "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Accept: application/json\r\n",
//                'ignore_errors' => true,
                'content'=> $query
            )
        );

        $context  = stream_context_create( $options );
        $result = @file_get_contents( $url, false, $context );
        if ($result == false)
            return null;
        $response = json_decode($result, true);
        return $response["access_token"];
    }

    /*
     * returns userinfos from supplied token
     */
    public static function get_userinfo($token) {
        $url = "https://graph.microsoft.com/v1.0/me";

        $options = array(
            'http' => array(
                'method'  => 'GET',
                'header'=>  "Authorization: Bearer $token\r\nAccept: application/json\r\n",
//                'ignore_errors' => true
            )
        );

        $context  = stream_context_create( $options );
        $result = @file_get_contents( $url, false, $context );
        if ($result == false)
            return null;
        $response = json_decode($result, true);

        return $response;
    }

    /*
     * downloads profile picture from supplied token
     */
    public static function download_profile_picture($token, $file_path) {
        $url = 'https://graph.microsoft.com/v1.0/me/photo/$value';

        $options = array(
            'http' => array(
                'method'  => 'GET',
                'header'=>  "Authorization: Bearer $token\r\nAccept: application/json\r\n",
//                'ignore_errors' => true
            )
        );

        $context  = stream_context_create( $options );
        $result = @file_get_contents( $url, false, $context );
        if ($result == false)
            return null;
        file_put_contents($file_path, $result);
    }

    /**
     * returns the current redirect url
     */
    private static function get_redirect_url() {
        return (self::is_secure() ? 'https://' : 'http://') . $_SERVER["HTTP_HOST"] . self::$redirect_endpoint;
    }

    /**
     * returns true if php file is served securely
     * @return bool
     */
    private static function is_secure() {
        return
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || $_SERVER['SERVER_PORT'] == 443;
    }
}