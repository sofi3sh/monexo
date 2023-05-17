<?php

namespace Modules\Blog\Exceptions;

use Exception;
use Illuminate\Http\Response;

class IncompatibleEntityModelException extends Exception
{
    /** @inheritDoc */
    protected $message = 'Incompatible entity model';

    /** @inheritDoc */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
