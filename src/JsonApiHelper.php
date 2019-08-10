<?php

namespace Permafrost\Api;

use Illuminate\Http\Resources\Response;

trait JsonApiHelper
{
    /**
     * Returns non-null if not currently authorized, or null if authorized (alias of `ensureAuthorized()`).
     *
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function ensureLoggedIn()
    {
        if (!auth()->check()) {
            return $this->errorUnauthorized();
        }
    }

    /**
     * Returns non-null if not currently authorized, or null if authorized.
     *
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function ensureAuthorized()
    {
        if (!auth()->check()) {
            return $this->errorUnauthorized();
        }
    }

    /**
     * Return a json response.
     *
     * @param $data
     * @param int   $code
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data, $code = 200, $headers = [JSON_UNESCAPED_SLASHES | JSON_BIGINT_AS_STRING])
    {
        return \response()->json($data, $code, $headers);
    }

    /**
     * Returns a successful response.
     *
     * @param string $message
     * @param array  $additional
     * @param int    $code
     * @param array  $headers
     *
     * @return mixed
     */
    public function success(string $message, array $additional = [], $code = 200, $headers = [JSON_UNESCAPED_SLASHES | JSON_BIGINT_AS_STRING])
    {
        $response = array_merge(
            ['message'=>$message],
            $additional
        );

        return $this->response($response, $code, $headers);
    }

    /**
     * Return a successful but no content response.
     *
     * @return $this
     */
    public function noContent()
    {
        return \response()->noContent();
    }

    /**
     * Respond with a created response and associate a location if provided.
     *
     * @param null $location
     * @param null $content
     *
     * @return Response
     */
    public function created($location = null, $content = null)
    {
        $response = new Response($content);
        $response->setStatusCode(201);

        if (!is_null($location)) {
            $response->header('Location', $location);
        }

        return $response;
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int    $statusCode
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $statusCode)
    {
        return \response()->json(['error'=>$message], $statusCode);
    }

    /**
     * Return a 404 not found error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotFound($message = 'Not Found')
    {
        return $this->error($message, 404);
    }

    /**
     * Return a 400 bad request error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorBadRequest($message = 'Bad Request')
    {
        return $this->error($message, 400);
    }

    /**
     * Return a 403 forbidden error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->error($message, 403);
    }

    /**
     * Return a 409 conflict error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorConflict($message = 'Conflict')
    {
        return $this->error($message, 409);
    }

    /**
     * Return a 401 unauthorized error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->error($message, 401);
    }

    /**
     * Return a 405 method not allowed error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorMethodNotAllowed($message = 'Method Not Allowed')
    {
        return $this->error($message, 405);
    }

    /**
     * Return a 429 too many requests (rate-limited) error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorTooManyRequests($message = 'Too Many Requests')
    {
        return $this->error($message, 429);
    }

    /**
     * Return a 500 internal server error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorInternal($message = 'Internal Error')
    {
        return $this->error($message, 500);
    }

    /**
     * Return a 501 not implemented error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotImplemented($message = 'Not Implemented')
    {
        return $this->error($message, 501);
    }
}
