<?php

namespace primus852\ShortResponse;


use Symfony\Component\HttpFoundation\JsonResponse;

class ShortResponse
{

    /**
     * @param string $result
     * @param string $message
     * @param array $extra
     * @return JsonResponse
     */
    static function json(string $result, string $message, array $extra = array())
    {
        return new JsonResponse(array(
            'result' => $result,
            'message' => $message,
            'extra' => $extra
        ));
    }

    /**
     * @param string $message
     * @param array $extra
     * @return JsonResponse
     */
    static function success(string $message, array $extra = array())
    {
        return new JsonResponse(array(
            'result' => 'success',
            'message' => $message,
            'extra' => $extra
        ));
    }

    /**
     * @param string $message
     * @param array $extra
     * @return JsonResponse
     */
    static function error(string $message, array $extra = array())
    {
        return new JsonResponse(array(
            'result' => 'error',
            'message' => $message,
            'extra' => $extra
        ));
    }

    /**
     * @param string $exception
     * @return JsonResponse
     */
    static function mysql(string $exception)
    {
        return new JsonResponse(array(
            'result' => 'error',
            'message' => 'Fehler in der Datenbank. Der Administrator ist informiert.',
            'extra' => array(
                'exception' => $exception
            )
        ));
    }

    /**
     * @param string $message
     * @param string $exception
     * @return JsonResponse
     */
    static function exception(string $message, string $exception)
    {
        return new JsonResponse(array(
            'result' => 'error',
            'message' => $message,
            'extra' => array(
                'exception' => $exception
            )
        ));
    }

    /**
     * @return JsonResponse
     */
    static function denied()
    {
        return new JsonResponse(array(
            'result' => 'error',
            'message' => 'Keine Berechtigung',
            'extra' => array()
        ));
    }

    /**
     * @param string $result
     * @return JsonResponse
     */
    static function uploadError(string $result)
    {
        return new JsonResponse(array(
            'error' => $result
        ));
    }
}
