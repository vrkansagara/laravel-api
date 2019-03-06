<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = [
            //ManageYourTRP
            'app_id' => '2032402703546561',
            'app_secret' => '21bcfdb6d33c130e3ff1a65106d92458'
        ];

    }

    public function login()
    {

        /* Apps need both manage_pages and publish_pages to be able to publish as a Page.
        Posting to User timelines:

        publish_video
        Posting to Groups:

        publish_to_groups
        Posting to Pages:

        manage_pages
        pages_show_list
        publish_pages
        Allowed Usage
        */
        $facebookApp = new Facebook($this->config);


        $helper = $facebookApp->getRedirectLoginHelper();

        $permissions = [
            'email',
            'manage_pages',
            'pages_show_list',
            'publish_pages',
            'publish_to_groups',
            'publish_video',
//            'ownership_permissions{can_customize_link_posts}'

        ]; // Optional permissions
        $loginUrl = $helper->getLoginUrl(route('facebook.callback'), $permissions);

//        echo url($loginUrl);
//        echo '<br>';
        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    }

    public function callback(Request $request)
    {
        echo '<pre>';
        $facebookClient = new Facebook($this->config);
        $helper = $facebookClient->getRedirectLoginHelper();

        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }


        try {
            $accessToken = $helper->getAccessToken();
//            session('fbtoken',$accessToken);
            echo '<pre>'; print_r($accessToken); echo __FILE__; echo __LINE__; exit(0);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
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


// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
    }

    public function tokenInfo()
    {

        $token = 'EAAc4daEveMEBAA5uZBUMo3ZAWQ8AdzdfZBI7V6STZCZCnXRllEYPp1z2I47Hdl3PHZBWwEpzEidJ5xVqFOlEAZA5dUTHQMq26pRRo8MeKA1DJgQS9Otpn5bkCAPOXZA7xpZCP6m67ThuCPc3ZCpBFqb2zY5HMwwW1LHR2eNXWG84CVmAZDZD';
        $this->config['default_access_token'] = $token;
        $facebookClient = new Facebook($this->config);

        // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            /**
             * {
             * "id": "2558351647570469",
             * "name": "Vallabh Kansagara",
             * "first_name": "Vallabh",
             * "last_name": "Kansagara",
             * "video_upload_limits": {
             * "length": 14460,
             * "size": 28633115306
             * }
             * }
             */
//            $response = $facebookClient->get('/me?fields=id,name,email,first_name,last_name,video_upload_limits');
            $response = $facebookClient->get('/2558062077599426/accounts');
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        echo $response->getBody();

    }

    public function mcaGurus()
    {
        $token = 'EAAc4daEveMEBAA5uZBUMo3ZAWQ8AdzdfZBI7V6STZCZCnXRllEYPp1z2I47Hdl3PHZBWwEpzEidJ5xVqFOlEAZA5dUTHQMq26pRRo8MeKA1DJgQS9Otpn5bkCAPOXZA7xpZCP6m67ThuCPc3ZCpBFqb2zY5HMwwW1LHR2eNXWG84CVmAZDZD';
        $mcaAccessToken = 'AAc4daEveMEBAO3A6igiv9RNwhGdRR1HptDAhViHjTT4ZAtZByRMHXfXhxHDt75wkfkfgnwWzYjRBZBn4gHJdaWuZAd5HFnHbkYgP0H3ZBeFcCwg5syTecIJaFVtsoTDy9yqclOAavZBMUFk9Xo6ZByox3iaogcGRxvL3zqVjlwBgZDZD';
        $this->config['default_access_token'] = $token;
        $facebookClient = new Facebook($this->config);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
//            $response = $facebookClient->get('/me?fields=id,name,email,first_name,last_name,video_upload_limits');
//            $myAllAccounts = $facebookClient->get('/me/accounts');
//            $myAllAccountsBodyData = $myAllAccounts->getBody();
//            echo '<pre>'; print_r($myAllAccountsBodyData); echo __FILE__; echo __LINE__; exit(0);
//            $mcaAccessToken = $myAllAccountsBodyData['data'][7]['access_token'];
            $mcagurusToken = $facebookClient->get('558189010892185?fields=can_post,access_token,app_id', $token);
            $tokenBody = $mcagurusToken->getDecodedBody();
            if ($tokenBody['can_post']) {
                $pageToken = $mcagurusToken->getAccessToken();

//                $linkData = [
////                    'link' => route('front.home'),
////                    'picture' => asset('assets/img/googlelogo_color_272x92dp.png'),
//                    'caption' => 'Google',
////                    'description' => 'Google is one of the best search engine on earth.',
//                    'message' => 'Google is all time hige in search rank!!!'
//                ];
////                $response = $facebookClient->post('me/feed', $linkData, $pageToken);
///
                $linkData = [
                    'source' => $facebookClient->fileToUpload(public_path('assets/img/googlelogo_color_272x92dp.png')),
                    'message' => 'Google is all time heighe in search rank!!!',
                    'published' => 1
                ];
                $response = $facebookClient->post('me/photos', $linkData, $pageToken);

//                $linkData = [
//                    'message' => 'An unpublished post :)',
//                    'link' =>'www.projecteuler.net',
//                    'published' =>false
//                ];
//                                $response = $facebookClient->post('me/feed', $linkData,$pageToken);


//
//                $linkData = [
//                    'link' => asset('assets/img/googlelogo_color_272x92dp.png'),
//                    'picture' => asset('assets/img/googlelogo_color_272x92dp.png'),
//                ];
//                $response = $facebookClient->post('me/feed', $linkData, $pageToken);


            }


        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        echo $response->getBody();

    }
}
