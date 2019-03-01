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

        $token = 'EAAc4daEveMEBAEEbWxZAwwZC1vmU2KHm4FaoHncDFNOZCfHwbhCModCujHZAZBw2GOIbwVhZAP8hkS1G4JLKtpCcdxANR9aDJSM3uN9CeuaHb0sXhVTWgx1DcTUdGKwA3cCGZAVvEMzHS6exFGziuuVChdaWKn7QHW0DGmAsspJFgZDZD';
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
        $token = 'EAAc4daEveMEBAMaEZCmiXZCpGxCWBn2TrepjSK5SgfCmSjFAkiYcX1qAXBItorrsLOa2P1SwQiLXFUf1kEtShDPlwZAPzsZAhWRdeZCFigW6Qpf6UJB5QvDgMrlJUHD69EzfJGIHHWFqOZCvLW6ZC3XT8jNiWheFDoAG2exBmUBrgJkW05uEneHN3bUx7SdDQe0waKkop0MYQZDZD';
        $this->config['default_access_token'] = $token;
        $facebookClient = new Facebook($this->config);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
//            $response = $facebookClient->get('/me?fields=id,name,email,first_name,last_name,video_upload_limits');
            $myAllAccounts = $facebookClient->get('/me/accounts');
//            $myAllAccountsBodyData = $myAllAccounts->getBody();
            $myAllAccountsBodyData = json_decode('{"data":[{"access_token":"EAAc4daEveMEBAPLGA61vDd5JxzjENLuMp5z1t4BSggLecYtgmEez8XVIZCq0Jq703NjRrhUA5ZAIaY7mZAPnTzZBjhEOJ2AX7nPAeZBScWJzOLolsbpQt9dNl731UXO8XytrpRZCZBRCcEjCWFn2qOCUr5C5fbzGPFQH2o1oyrNVcNMfUNUf2GLhS0ieziXz56IESS9vSVWFgZDZD","category":"Personal Blog","category_list":[{"id":"2700","name":"Personal Blog"}],"name":"OneTip","id":"110698229261776","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAMeBzJ4G7ietMFAvT8miTowhnbM5ZAn4lWZBoWXHOT538ZCXQZCwtyZACvl259QVyeiPtGmIEm3OpqNSc7JJzrWrMtgq8xfrZC2MyXZBoF4Q1rgEwPqRGldZCwIoIjF0BdOaQ1MKlOOZBCOR0be6UQPQkGod9xrJ4syHDIAmoWLKdj9nSGuVJHjpqygqzPYEW8QZDZD","category":"Education","category_list":[{"id":"2250","name":"Education"}],"name":"Eojas","id":"220291361492195","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAAZBTjOtE7Vf3iaZB2VnEN8juixHf0ZCIJflzcfKUjbl86NAOLPbZAJV33cgbCMfLktb2UZCuirqjAH0cbzMzNmb0sZBNq9ZAWTBM6FrKBscBGtanOGqmjfb1zshkmYYgg76tLAyywex5hvLh2xtVinlw4V5VXfMaMkhNNEZBSB995LENtOJk9fgOJewAHvRKAZDZD","category":"Website","category_list":[{"id":"2202","name":"Website"}],"name":"Urlhub","id":"244559109436198","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAOYmOBEv08IGBtrQHfEY7Bz0NqsoooV3nDW0dq4wxzZBGHVNrqgBE2Fg46IU1q6jKAbts2Aml10uYaIR5yZBy2GZCxQMM7p8HrcrXb0ZBUZCDRDp91qbYm0DThh927k3dkrH4dRZCd3p2GcHZADO9ZAfNvpW8bli8J4fJdYLaJASycXwAnAlvnPIDtmkpAGnbAZDZD","category":"Computer Company","category_list":[{"id":"2255","name":"Computer Company"}],"name":"DotKernel","id":"363083917208646","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAE2phVUgmjls7eGq8TYZCnjlcXrBZBg8xcUcWPha9wNefykY80lyvVxRuDjwLYRy47ZCzZCG2rPRo9UkPwOO77ZAwNdwizZAEQWYkzXyqVFF8pINz4okMcqf7NL9de6zvgRUQZCZCMx7CwB14TqUPI1KBhS0kRiUIDtsRrLmbf4zwAJsMy25JiQUCZA9Dh7ZC7PQZDZD","category":"Arts & Entertainment","category_list":[{"id":"133436743388217","name":"Arts & Entertainment"}],"name":"MannkiBhadas","id":"407072916383639","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAIFCiX7GzXbzSEHMkYyx2ZApRuwHZBJjqpbi6UiFES7CM9k1ZBZCRFD7sJaSrjtf0tfjw8WZCP3TZB8WOShUp3ARmmvYo8MCQMYoUM7L9qVkhkyOv8NmM8uNN8FMZAuEy82A5uGskrsgyZBuiJhm3fyBqvTKBjXGXuT7I49NrBJbfMny4mVUDJAqyKGXE3rEvwZDZD","category":"Local Business","category_list":[{"id":"2500","name":"Local Business"}],"name":"JobzPro","id":"449838528505004","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAA2Uu2Ai3Vuq3qwasc5lyfZCQsZAZBUgsZA0ZCnF0T8DLr1MteZCwgWoPaIlloPnOcYJbRlJ298B9rW5ZAIYaJ9gAqqXYo6gYId0AyJ0kB2BmPBcC9Ll96hqgjCn3TBxBnD5wDlSGUJmZAMhHvxbI8aUDLyuPbHZBO952jFeDCkQPkMZCSmI7iZCrXDRPHSoMJ8UgZDZD","category":"Company","category_list":[{"id":"2200","name":"Company"}],"name":"Idearary","id":"510523479147491","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAMBcBTd4c6yXZAZAi0CncztL6GnM2ILfUMjHMOupbMNJI4WXjH2qTvzC9OLxGE7Koygf57fn3PsFM5oIvttmRMSYztVeU7ZB4Lln94S5Hog9z9uyWYZAUCL3LWn4qXiL7VocyDbXcprkARsitB98FEUB4QofUkMhoLMmjUZCKAWHuE88s11iZB0n30OX6FDgZDZD","category":"Computer Training School","category_list":[{"id":"162237190493977","name":"Computer Training School"},{"id":"1130035050388269","name":"Information Technology Company"}],"name":"MCA Gurus","id":"558189010892185","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAGKFZC1nZBT4VyyXB9CDJSEAZBrQSPH4pZCZAfckVXJXdMLj8QfE77ZBm72ZBTPZBoKhnZAvPwd7z12V46cc4Kw3R7xQxJC0ZCTZAebJeoQ9n9rZAVdSnjgAgu8LQZAIRqOYfGJOYYwL357VF1VIRM03wZBt3g5NTW60p61hDdF9hh47d9ZAOxD8QnE52M5MxpZC5KBOxgZDZD","category":"App Page","category_list":[{"id":"2301","name":"App Page"}],"name":"MCA Gurus Community","id":"634605879885662","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAP6axvyz0ZBASaQPdlmfQBXm1jejCa4dwbbmhPg6aHPZCBXfy1RDjQQi6EIf9h5bs5agXUQVISBDsxaHNy1nUq8ggR5SJT8DO4EslyTOgvfrB4qs9l1dV7nyuq7Ax9NO0SrU93I5cmmGxbKZBeZBzGyCz3GZA1khoYGDUDSb8380amZCUrdjLd6dklZAztQVwZDZD","category":"Education","category_list":[{"id":"2250","name":"Education"}],"name":"Jobz Applicatioon Programm","id":"687650751381373","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBADnfKBs9jGAKAaawsUTqKlpZBKe1NLnMZCvkU3BeQZABhsVnYJBfj7w071XQe7B29LCa3r6W5v9dQKRmNiHWrZC05EO5Tapswvo7HF6UjDANZBEgTDQL4T23FcLJuxVcJEfJ25XAiuRTLUrMYikohb7J6eJ66PicRqnGPrkgs8NFJ5MWXHrau2vKx4ZBfrwgZDZD","category":"Shopping Service","category_list":[{"id":"200046713342752","name":"Shopping Service"}],"name":"100rupeecart","id":"699256733478461","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBALMBsIgSvnN3ebkAZCIkk3PRPkegnH1Ksc76e4WQtnttt4PkNZAdmjHHiIeUlDGMOZBNy8vqPLeIhEXbHEloet8AxvQHSdgHTOLmekiFSLGGcYictZAn4j1IUYx438RZC8GeRAGUH3W8y9uGlRHobKYVwRTCZAOqjVEBq2ZANX0vJSYKy1zbGGR3a4RRThZAZCQZDZD","category":"Computer Company","category_list":[{"id":"2255","name":"Computer Company"}],"name":"Ask Debian","id":"837930129606647","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAIaTh0rlTNFTU6JZBKSZBSPgFEdxMlZCSBg6Voq7dZCB1olQYreeEImefag9HZBzxWbq2d8IoRjvQJvSX5V4tnRF9Oe4HeATLEM6ZCRU23AGwNpcHe6WgJXrJlvAgF5ubHQQYHPnvdot4uZBD8hcmrbeHUGYrgSKa9z2qGzn1lhytweEAwNlmPk6AuT2hoXmQZDZD","category":"Web Designer","category_list":[{"id":"187393124625179","name":"Web Designer"}],"name":"Patidar Web","id":"1455465341344266","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBACQz33UyIr0e8JNQUazof1c70h4VamNL1rZC6lWNkUm8cPBiWsC5dv32QQwZAkshxAMAZC2qbRc1DT0T1gcFfVYd8u1m2J07hkFlCj0E6QarW8kYRUFMnwoP7KCesvej25sE06602x19i7nY1ZCZC2cUBkFYbK2kNEwC57wQxIjV7qxngd8halMXyYgRZCPgZDZD","category":"Education","category_list":[{"id":"2250","name":"Education"}],"name":"PHP User Group Gujarat","id":"1492938490928138","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAC3uDSEVVOvFyXLRxzZCOrZC2EiBfTRewRxgAtX9uwBxF7HZA6vnzCH339Mj0PH91xhQZB962aXFWZBFrHMJvf4fmdiSozCPfZCMfDFedYDiOS9NgWShbWeqR1KLx9rFOUJ7sdZBdBVKo4aFRjjvQ8OlA7llP5SMCeZCyFwmQQkNb7AJ1PqWNpZCWXf9nUQ1lWQZDZD","category":"Computer Company","category_list":[{"id":"2255","name":"Computer Company"}],"name":"Webohub","id":"1571764129806884","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBALFTGMHPiDTPkypJlR0SmmnjPXKW1GtGZBUZBhyr09lQzyEeyTTbWmlONMOIo3VoD4CR3fkqf7mZAhV5xiVPqDGMbkKTGnverTRUgefs7RfOU0NlckEhr2RPl0grZC5P1rxBrmteaZBFqgh4Ak1Iba688saZAofswuZBjRhom10ChQCPuUatNbhpeRP6BqOqAZDZD","category":"Local Business","category_list":[{"id":"2500","name":"Local Business"}],"name":"Jobz Pro","id":"1637907916445714","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]},{"access_token":"EAAc4daEveMEBAA4LDyzooZB5waLarsPb1012ThCN2f8vcXRC4bPvZA59CZB0kEknpU3tQinaBxPKI6k7JZC3KrfoEQ7aRWCLgEbGZAoTJocBWn09idbZAG7f2MKZCfV91jEQhyDhC0duj40DWmLYnsmbOqIZAsGHtZBSLfm42QQykzsPJ9dgPUtifSPwiB9n7ZA4e2ZCUmSwFJu5gZDZD","category":"Design & Fashion","category_list":[{"id":"557045641143373","name":"Design & Fashion"}],"name":"Myappicon","id":"1943161892637314","tasks":["ANALYZE","ADVERTISE","MODERATE","CREATE_CONTENT","MANAGE"]}],"paging":{"cursors":{"before":"MTEwNjk4MjI5MjYxNzc2","after":"MTk0MzE2MTg5MjYzNzMxNAZDZD"}}}', 1);
            $mcaAccessToken = $myAllAccountsBodyData['data'][7]['access_token'];
            $mcagurusToken = $facebookClient->get('558189010892185?fields=can_post,access_token,app_id', $mcaAccessToken);
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
