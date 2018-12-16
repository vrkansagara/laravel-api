<?php

namespace App\Exceptions;

use App\Utilities\ApiResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {

            //Check to see if LERN is installed otherwise you will not get an exception.
            if (app()->bound("lern")) {

                app()->make("lern")->record($exception); //Record the Exception to the database
                /*
                OR...
//                app()->make("lern")->handle($exception); //Record and Notify the Exception
                app()->make("lern")->notify($e); //Notify the Exception
                */
            }
        }


        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if (strpos($request->url(), '/api/') !== false) {
//            dd(get_class($exception));
            Log::debug('API Request Exception - ' . $request->url() . ' - ' . $exception->getMessage() . (!empty($request->all()) ? ' - ' . json_encode($request->except(['password'])) : ''));

            if ($exception instanceof NotFoundHttpException) {
                $data = [
                    'statusCode' => 403,
                    'message' => 'Please check your URL to make sure request is formatted properly. - NotFoundHttpException',
                    'errorCode' => 100,
                    'data' => [],
                    'size' => 0,
                    'no-cache'=>1,
                ];
                return ApiResponse::response($data);
            }
        }

        /*
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }

        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        if ($exception instanceof GeneralException) {
            return redirect()->back()->withInput()->withFlashDanger($exception->getMessage());
        }
        return parent::render($request, $exception);
    }

    /**
     * Get status code.
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status code
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }


    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

}
