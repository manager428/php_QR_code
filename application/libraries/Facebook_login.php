<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/php-graph-sdk-5.x/src/Facebook/autoload.php';

class Facebook_login {

    function __construct()
    {

    }
    // --------------------------------------------------------------------
    function get_login_url($callback_url){
        $fb = new Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v3.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl($callback_url, $permissions);
        //$loginUrl = $helper->getLoginUrl(array('redirect_uri' => $callback_url,'scope' => 'email'));

        $fb_login_url = htmlspecialchars($loginUrl);
        return $fb_login_url;
    }

    function process_callback(){
        $fb = new Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v3.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        // Logged in
        //echo '<h3>Access Token</h3>';
        //var_dump($accessToken->getValue());
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        //echo '<h3>Metadata</h3>';
        //var_dump($tokenMetadata);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(FB_APP_ID); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }
            //echo '<h3>Long-lived</h3>';
            //var_dump($accessToken->getValue());
        }
        $fb_access_token = (string) $accessToken;
        $fb_user = $this->get_facebook_user_info($fb_access_token);
        $fb_user_info = array();
        if(!empty($fb_user)){
            $fb_user_info['id'] = $fb_user->getId();
            $fb_user_info['name'] = $fb_user->getName();
            $fb_user_info['first_name'] = $fb_user->getFirstName();
            $fb_user_info['last_name'] = $fb_user->getLastName();
            $fb_user_info['middle_name'] = $fb_user->getMiddleName();
            $fb_user_info['birthday'] = $fb_user->getBirthday();
            $fb_user_info['gender'] = $fb_user->getGender();
            $fb_user_info['location'] = $fb_user->getLocation();
            $fb_user_info['hometown'] = $fb_user->getHometown();
            $fb_user_picture = $fb_user->getPicture();
            if(!empty($fb_user_picture)){
                $fb_user_picture->getUrl();
                $fb_user_info['picture'] = $fb_user_picture->getUrl();
            }else{
                $fb_user_info['picture'] = "";
            }
        }
        return $fb_user_info;
    }

    function get_facebook_user_info($fb_access_token){
        $fb = new Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v6.0',
        ]);
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,first_name,middle_name,last_name,email,gender,link,birthday,location,hometown,picture', $fb_access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $user = $response->getGraphUser();
        return $user;
    }

}