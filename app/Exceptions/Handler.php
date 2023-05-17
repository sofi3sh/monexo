<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;
use Log;

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            //$this->sendEmail($exception);
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
        return parent::render($request, $exception);
    }

    /**
     * Отправка email с ошибкой.
     *
     * @param Exception $exception
     */
    public function sendEmail(Exception $exception)
    {
        if ($this->isAdminMailSpecified()) {
            if (!config('app.debug')) {
                try {
                    $e = FlattenException::create($exception);
                    $handler = new SymfonyExceptionHandler();
                    $html = $handler->getHtml($e);
                    Mail::to(config('app.adminEmail'))->send(new ExceptionOccured($html));
                } catch (Exception $ex) {
                    Log::error($ex);
                }
            }
        } else {
            Log::alert('В .env не задан email администратора.');
        }
    }

    /**
     * Возваращет false, если в .env файле не задан email администратора.
     *
     * @return bool
     */
    public function isAdminMailSpecified()
    {
        return !trim(config('app.adminEmail')) == '';
    }
}
