<?php
    /**
     * used to authenticate the user
     * available types:
     * redirect - returns http redirect, used for the frontend
     * login - used for microsoft login callback
     * logout - used to clear the session cookie -> log the user out
     */

switch ($_GET["type"]) {
    case "redirect":
        $client_id = getenv("AZURE_CLIENT_ID");
        $redirect_url = urlencode((isSecure() ? 'https://' : 'http://') . "$_SERVER[HTTP_HOST]/api/auth/login/");
        $state = isset($_GET["state"]) ? $_GET["state"] : urlencode("/");
        $scope = "openid email profile offline_access";
        $login_url = "https://login.microsoftonline.com/htl.rennweg.at/oauth2/v2.0/authorize" .
        "?client_id=$client_id&response_type=code&redirect_uri=$redirect_url" .
            "&state=$state&scope=$scope&prompt=select_account";
        header("Location: $login_url");
        break;
    case "login":
        $token = get_token($_GET["code"]);
        echo $token . '<br>';
        break;
    case "logout":

        break;
}

/**
 * returns true if php file is served securely
 * @return bool
 */
function isSecure() {
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}

/*
 * returns the token of a user who authenticated with microsoft oauth
 * $code: code from microsoft oauth
 */
function get_token($code) {
    $client_id = getenv("AZURE_CLIENT_ID");
    $client_secret = urlencode(getenv("AZURE_SECRET"));
    $url = "https://login.microsoftonline.com/htl.rennweg.at/oauth2/v2.0/token";
    $scope = urlencode("openid email profile offline_access");
    $redirect_url = urlencode((isSecure() ? 'https://' : 'http://') . "$_SERVER[HTTP_HOST]/api/auth/login/");

    // $query = "client_id=$client_id&scope=$scope&code=$code&grant_type=authorization_code&redirect_uri=$redirect_url&client_secret=$client_secret";
    $query = "client_id=$client_id&scope=$scope&code=$code&grant_type=authorization_code&redirect_uri=$redirect_url&client_secret=$client_secret";
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'=>  "Content-type: application/x-www-form-urlencoded\n" . "Accept: application/json\n",
            'content'=> $query
        )
    );
    var_dump($options);

    $context  = stream_context_create( $options );
    $result = file_get_contents( $url, false, $context );
    if ($result == false)
        return null;
    $response = json_decode($result, true);
    return $response["access_token"];
}