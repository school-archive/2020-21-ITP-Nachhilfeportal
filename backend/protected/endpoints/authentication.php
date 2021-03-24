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
        $scope = "openid email profile offline_access user.read";
        $login_url = "https://login.microsoftonline.com/htl.rennweg.at/oauth2/v2.0/authorize" .
        "?client_id=$client_id&response_type=code&redirect_uri=$redirect_url" .
            "&state=$state&scope=$scope&prompt=select_account";
        header("Location: $login_url");
        break;
    case "login":
        // $token = get_token($_GET["code"]);
        //$token = "eyJ0eXAiOiJKV1QiLCJub25jZSI6ImxsaUllcFBxbXFGajYxU21yYUc0ZDBzbndMaGVnS0NIZVVXRzBab3dmTFUiLCJhbGciOiJSUzI1NiIsIng1dCI6Im5PbzNaRHJPRFhFSzFqS1doWHNsSFJfS1hFZyIsImtpZCI6Im5PbzNaRHJPRFhFSzFqS1doWHNsSFJfS1hFZyJ9.eyJhdWQiOiIwMDAwMDAwMy0wMDAwLTAwMDAtYzAwMC0wMDAwMDAwMDAwMDAiLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC85ZWMyMzIxMC0wZTU3LTQwOWUtYmVhYy0wNWU3NTVlYTNkZDgvIiwiaWF0IjoxNjE2NTcwNDM3LCJuYmYiOjE2MTY1NzA0MzcsImV4cCI6MTYxNjU3NDMzNywiYWNjdCI6MCwiYWNyIjoiMSIsImFjcnMiOlsidXJuOnVzZXI6cmVnaXN0ZXJzZWN1cml0eWluZm8iLCJ1cm46bWljcm9zb2Z0OnJlcTEiLCJ1cm46bWljcm9zb2Z0OnJlcTIiLCJ1cm46bWljcm9zb2Z0OnJlcTMiLCJjMSIsImMyIiwiYzMiLCJjNCIsImM1IiwiYzYiLCJjNyIsImM4IiwiYzkiLCJjMTAiLCJjMTEiLCJjMTIiLCJjMTMiLCJjMTQiLCJjMTUiLCJjMTYiLCJjMTciLCJjMTgiLCJjMTkiLCJjMjAiLCJjMjEiLCJjMjIiLCJjMjMiLCJjMjQiLCJjMjUiXSwiYWlvIjoiRTJaZ1lPRHZEc2xlMUd6bkVmamFrSlAvY04vRTdSMU82d3YwMGh2L1J1a3YzUnFhckFjQSIsImFtciI6WyJwd2QiXSwiYXBwX2Rpc3BsYXluYW1lIjoiTmFjaGhpbGZlcG9ydGFsIiwiYXBwaWQiOiI2Mjk0Yzc3My0wM2E2LTQ5YmMtYWVlYy0zZWM4NGY1YmIzZmMiLCJhcHBpZGFjciI6IjEiLCJmYW1pbHlfbmFtZSI6IlNjaG5laWRlci1TdHVybSIsImdpdmVuX25hbWUiOiJOaWxzIiwiaWR0eXAiOiJ1c2VyIiwiaXBhZGRyIjoiMTk0LjE2Ni4xNTEuMjI3IiwibmFtZSI6IlNjaG5laWRlci1TdHVybSBOaWxzIiwib2lkIjoiNTNmOTNjODktZmU3ZS00OTFjLTllYjYtMDRlMjNlNWIxODEzIiwicGxhdGYiOiIzIiwicHVpZCI6IjEwMDNCRkZEQTQ5NUUyOTYiLCJyaCI6IjAuQVJFQUVETENubGNPbmtDLXJBWG5WZW85MkhQSGxHS21BN3hKcnV3LXlFOWJzX3dSQU1zLiIsInNjcCI6ImVtYWlsIG9wZW5pZCBwcm9maWxlIiwic2lnbmluX3N0YXRlIjpbImttc2kiXSwic3ViIjoiX0tDTkRaU2c1OEtYRDJxa0ZtNkVnV0J0UUNvQms3aG5ieS1DUFEyTlJoOCIsInRlbmFudF9yZWdpb25fc2NvcGUiOiJFVSIsInRpZCI6IjllYzIzMjEwLTBlNTctNDA5ZS1iZWFjLTA1ZTc1NWVhM2RkOCIsInVuaXF1ZV9uYW1lIjoiNzA1NUBodGwucmVubndlZy5hdCIsInVwbiI6IjcwNTVAaHRsLnJlbm53ZWcuYXQiLCJ1dGkiOiJKV3pTWUpORTRFdWMtaEpHWVJNaUFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX3N0Ijp7InN1YiI6InRldUNHS3pYbWF4Szhsay1WNk5TbnVrZENmbEJQNE5OVDAtME1wRXR1UmsifSwieG1zX3RjZHQiOjE0MTQ0ODU2NTR9.d2yiS2kb_L6os-P39PHbgXovnwcecVf9rxoUy1JN43bcMfpxx2i8iDB7RQPtq4a5OYHUMCnVSxzvb_JGvhXVU_Xdm0ToeIU_6FXxueOdwZ6vn-PgLRj_jlQncbdb7Hozhn7DxH6h6Vf5D72B_BL3kXlDU-a3Xx0NgKo4-pSNVQCPLEhiU8jhVAOqQBFc9kqE_XbkbGpWgimajbaVp_0wbCuZGV1OBPmLp1jQTTNCd54MqotkysSYdeNnWHxn2KUzw1UOyzDbNLZiUz5v4vUdPTAY5pTcnKUTHaUo0dCWHPbNVoEVAqCHfcsqQmEfHS3vHME540a5hybIaUAM4484lw";
        //echo $token . '<br>';
        $token = get_token($_GET["code"]);
        echo $token;
        var_dump(get_userinfo($token));

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
    * Liefert den Token von einem User, welcher sich auf der Microsoft Login Seite angemeldet hat
    * $code: Rückgabewert von der Microsoft OAuth
    */
function get_token($code) {
    $client_id = getenv("AZURE_CLIENT_ID");
    $client_secret = urlencode(getenv("AZURE_SECRET"));
    $url = "https://login.microsoftonline.com/htl.rennweg.at/oauth2/v2.0/token";
    $scope = urlencode("openid email profile offline_access user.read");
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
    var_dump(array($url, $options));

    $context  = stream_context_create( $options );
    $result = file_get_contents( $url, false, $context );
    if ($result == false)
        return null;
    $response = json_decode($result, true);
    return $response["access_token"];
}

/*
 * Liefert Benutzerinfos des Tokens
 */
function get_userinfo($token) {
    $url = "https://graph.microsoft.com/v1.0/me";

    $options = array(
        'http' => array(
            'method'  => 'GET',
            'header'=>  "Authorization: Bearer $token\nAccept: application/json\n",
        )
    );

    $context  = stream_context_create( $options );
    $result = file_get_contents( $url, false, $context );
    if ($result == false)
        return null;
    $response = json_decode($result, true);

    return $response;
}