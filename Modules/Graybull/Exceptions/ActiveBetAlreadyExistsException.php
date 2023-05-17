<?php

namespace Modules\Graybull\Exceptions;

use Exception;
use Illuminate\Http\{Request, Response, JsonResponse};

class ActiveBetAlreadyExistsException extends Exception
{
    /** @inheritDoc */
    protected $message = 'Active bet already exists';

    /** @inheritDoc */
    protected $code = Response::HTTP_BAD_REQUEST;

    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(__($this->message), $this->code);
    }
}
