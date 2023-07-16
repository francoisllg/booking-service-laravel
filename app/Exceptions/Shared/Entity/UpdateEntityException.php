<?php

declare(strict_types=1);

namespace App\Exceptions\Shared\Entity;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Arrayable;
use Symfony\Component\HttpFoundation\Response;

class UpdateEntityException extends Exception implements Arrayable
{
    protected $statusCode = Response::HTTP_BAD_REQUEST;

    public function __construct(string $message, int $code = null)
    {
        parent::__construct($message, $code ?: $this->statusCode);
    }

    /**
     * Convert the exception to an array representation.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'error' => 'Entity update failed.',
            'message' => $this->getMessage(),
        ];
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return new JsonResponse($this->toArray(), $this->getCode());
    }
}
