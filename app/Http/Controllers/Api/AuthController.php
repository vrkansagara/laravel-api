<?php

namespace App\Http\Controllers\Api;

use App\Entities\User;
use App\Events\User\LoginEvent;
use App\Interfaces\AuthInterface;
use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Lcobucci\JWT\Parser;
use GuzzleHttp\Client as HttpClient;

class AuthController extends ApiController implements AuthInterface
{

    use AuthenticatesUsers;

    use SendsPasswordResetEmails;

    private $httpClient;
    private $httpClientOptions;

    public function __construct()
    {
        if (env('APP_ENV') == 'local') {
            $options = [
                'verify' => false, // SSL verify false
                'cookies' => false // cookies not necessary.
            ];
            $this->httpClientOptions = $options;
        } else {
            $options = [
                'verify' => true,
            ];
            $this->httpClientOptions = $options;
        }

        $this->httpClient = new HttpClient($options);
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $this->clearLoginAttempts($request);

            /**
             * @ClientName =  NULL
             * @clientCreation = false
             * @usedFor = API only
             * @note = without client creating , Using laravel default passport client
             */
//            $token = $this->getPersonalAccessToken($request, $user);

            /**
             * @ClientName =  authorization_code
             * @clientCreation = true
             * @usedFor = Web only
             * @note = With client creation, web only
             *
             */
//            $token = $this->getAuthorizationCodeTokenWithGrantType($request, $user);

            /**
             * @ClientName =  personal_access
             * @clientCreation = true
             * @usedFor = API only
             * @todo = Under progress
             * @fixme = ASAP for the personal_access
             * @note = Not working as of now.
             *
             */
//            $token = $this->getPersonalAccessTokenWithGrantType($request, $user);


            /**
             * @ClientName =  password
             * @clientCreation = true
             * @usedFor = API only
             * @note = With client creation, with refresh token
             */
            $token = $this->getPasswordTokenWithGrantType($request, $user);

            /**
             * @ClientName =  client_credentials
             * @clientCreation = true
             * @usedFor = API only
             * @note = With client creation, Only access token
             */

//            $token = $this->getClientCredentialsTokenWithGrantType($user);


            $responseData = [
                'token' => $token,
                'user' => $user
            ];

            event(new LoginEvent($user));
            return response()->json($responseData);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get refresh token.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required|string',
        ]);
        $refreshToken = $request->get('refresh_token');


        $user = Auth::user();
        $responseData = [
            'token' => $this->getRefreshToken($refreshToken, $user),
            'user' => $user
        ];

        return response()->json($responseData);
    }


    /**
     * Get passport client
     * @param User $user
     * @param $grantType
     * @return Client
     */
    public function getPassportClient(User $user, $grantType)
    {
        $uuid = $grantType;
        $isPasswordClient = false;
        $isPersonalClient = false;
        if ($grantType == 'password_client') {
            $isPasswordClient = true;
            $clientName = 'password_client';
        }

        if ($grantType == 'personal_client') {
            $isPersonalClient = true;
            $clientName = 'personal_access_client';
        }

        if (empty($clientName)) {
            $isPasswordClient = true;
            $isPersonalClient = false;
            $clientName = 'password_client';
        }


        $isClientExist = Client::where('user_id', '=', $user->id)
            ->where('name', '=', $uuid)
            ->where('revoked', '=', false)
            ->where($clientName, '=', true)
            ->orderby('id', 'desc')
            ->limit(1)
            ->get()
            ->first();
        if (!empty($isClientExist->id)) {
            return $isClientExist;
        } else {
            $client = (new Client())->forceFill(
                [
                    'user_id' => $user->id,
                    'name' => $uuid,
                    'secret' => str_random(40),
                    'redirect' => secure_url('nocallback'),
                    'personal_access_client' => $isPersonalClient,
                    'password_client' => $isPasswordClient,
                    'revoked' => false,
                ]
            );
            $client->save();

            $client = Client::where(
                [
                    'user_id' => $user->id,
                    'name' => $uuid,
                    'revoked' => false,
                    'password_client' => true,
                ]
            )
                ->orderby('id', 'desc')
                ->limit(1)
                ->first();

            return $client;
        }
    }


    /**
     * Create personal access token
     * @param Request $request
     * @param $user
     * @return array
     */
    private function getPersonalAccessToken(Request $request, $user)
    {
        $tokenName = 'Personal Access - ' . $user->email;

        $scope = ['*'];
        $token = $user->createToken(
            $tokenName,
            $scope
        ); // Create personal access token

        $data = [
//            'accessTokenId' => $token->token->id,
//            'accessTokenName' => $token->token->name,
            'accessToken' => $token->accessToken,//'Bearer ' .
//            'clientId' => $token->token->client_id,
//            'scope' => $token->token->scopes,
//            'created_at' => $token->token->created_at,
//            'expire_in' => $token->token->expires_at,
        ];

        return $data;
    }

    /**
     * Create authorization code token
     * @use this method is used for web
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    private function getAuthorizationCodeTokenWithGrantType(Request $request, User $user) // authorization_code
    {
        $passwordClient = $this->getPassportClient($user, 'authorization_code');

        if (env('APP_ENV') == 'local') {
            $tokenUrl = url('oauth/token');
        } else {
            $tokenUrl = secure_url('oauth/token');
        }

        $formData = [
            'grant_type' => 'authorization_code',
            'client_id' => $passwordClient->id,
            'client_secret' => $passwordClient->secret,
            'redirect_uri' => 'http://example.com/callback',
            'code' => $request->code,

        ];

        $http = $this->httpClient;
        $response = $http->post($tokenUrl, [
            'form_params' => $formData
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Create personal access token
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    private function getPersonalAccessTokenWithGrantType(Request $request, User $user) //personal_access
    {
        $passwordClient = $this->getPassportClient($user, 'personal_access');

        if (env('APP_ENV') == 'local') {
            $tokenUrl = url('oauth/token');
        } else {
            $tokenUrl = secure_url('oauth/token');
        }

        $formData = [
            'grant_type' => 'personal_access',
            'client_id' => $passwordClient->id,
            'client_secret' => $passwordClient->secret,
            'scope' => '*',
        ];

        $http = $this->httpClient;
        $response = $http->post($tokenUrl, [
            'form_params' => $formData
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * create password token
     * @param Request $request
     * @param $passwordClient
     * @param $user
     * @return mixed
     */
    private function getPasswordTokenWithGrantType(Request $request, User $user) // password
    {
        $passwordClient = $this->getPassportClient($user, 'password');

        if (env('APP_ENV') == 'local') {
            $tokenUrl = url('oauth/token');
        } else {
            $tokenUrl = secure_url('oauth/token');
        }

        $formData = [
            'grant_type' => 'password',
            'client_id' => $passwordClient->id,
            'client_secret' => $passwordClient->secret,
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'scope' => '*',
        ];


        $http = $this->httpClient;
        $response = $http->post($tokenUrl, [
            'form_params' => $formData
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * create client credentials token
     * @param User $user
     * @return mixed
     */
    private function getClientCredentialsTokenWithGrantType(User $user) // client_credentials
    {
        $passwordClient = $this->getPassportClient($user, 'client_credentials');

        if (env('APP_ENV') == 'local') {
            $tokenUrl = url('oauth/token');
        } else {
            $tokenUrl = secure_url('oauth/token');
        }

        $formData = [
            'grant_type' => 'client_credentials',
            'client_id' => $passwordClient->id,
            'client_secret' => $passwordClient->secret,
            'scope' => '*',
        ];


        $http = $this->httpClient;
        $response = $http->post($tokenUrl, [
            'form_params' => $formData
        ]);

        return json_decode((string)$response->getBody(), true);
    }


    private function getRefreshToken($refreshToken, User $user) // client_credentials
    {
        $passwordClient = $this->getPassportClient($user, 'password');

        if (env('APP_ENV') == 'local') {
            $tokenUrl = url('oauth/token');
        } else {
            $tokenUrl = secure_url('oauth/token');
        }

        $formData = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => $passwordClient->id,
            'client_secret' => $passwordClient->secret,
            'scope' => '',
        ];

        $http = $this->httpClient;
        $response = $http->post($tokenUrl, [
            'form_params' => $formData
        ]);
        return json_decode((string)$response->getBody(), true);
    }

// ==========


//    protected function attemptLogin(Request $request)
//    {
//        $loginPayLoad = $this->credentials($request);
//        // Bellow loginPayLoad will be verified with database.
//        $loginPayLoad['active'] = 1;
//        $loginPayLoad['verify'] = 1;
//        $loginPayLoad['agree'] = 1;
//        return $this->guard()->attempt($loginPayLoad, $request->filled('remember'));
//    }
//

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user != null) {
            $value = $request->bearerToken();
            $id = (new Parser())->parse($value)->getHeader('jti');
            $token = $user->tokens->find($id);
            $token->revoke();
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errorMessages = $validator->getMessageBag();
            $this->response($errorMessages);
        }

        $payLoad = $request->all();
        $userData = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ];
        $user = User::create($userData);
        return $this->response($user);


    }

    public function forgetPassword(Request $request)
    {
        // TODO: Implement resetPassword() method.
    }

    public function resetPassword(Request $request)
    {
        // TODO: Implement resetPassword() method.
    }


    /**
     * Check weather request belongs to the mobile request
     *
     * @param Request $request
     * @return bool
     */
    public static function isMobileRequest(Request $request)
    {
        $platform = $request->header('Platform');

        $mobilePlatformList = [
            'mobile',
            'android',
            'ios',
        ];

        if (in_array($platform, $mobilePlatformList)) {
            return true;
        }
        return false;
    }

}
