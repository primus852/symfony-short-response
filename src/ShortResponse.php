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
    public static function json(string $result, string $message, array $extra = array())
    {
        return self::display($result, $message, $extra);
    }

    /**
     * @param string $message
     * @param array $extra
     * @return JsonResponse
     */
    public static function success(string $message, array $extra = array())
    {
        return self::display('success', $message, $extra);
    }


    /**
     * @param string $message
     * @param array $extra
     * @return JsonResponse
     */
    public static function error(string $message, array $extra = array())
    {
        return self::display('error', $message, $extra);
    }

    /**
     * @param string $exception
     * @return JsonResponse
     */
    public static function mysql(string $exception = 'hidden')
    {
        return self::display('error', 'Database Error', array(
            'exception' => $exception
        ));
    }

    /**
     * @param string $message
     * @param string $exception
     * @return JsonResponse
     */
    public static function exception(string $message, string $exception = 'hidden')
    {
        return self::display('error', $message, array(
            'exception' => $exception
        ));
    }

    /**
     * @return JsonResponse
     */
    public static function denied()
    {
        return self::display('error', 'Access denied');
    }

    /**
     * @param string $result
     * @return JsonResponse
     */
    public static function uploadError(string $result)
    {
        return self::display(array(
            'error' => $result
        ));
    }

    /**
     * @param mixed $result | can override the whole json if array
     * @param string $message
     * @param array $extras
     * @return JsonResponse
     */
    private static function display($result, string $message = '', array $extras = array())
    {

        $json = is_array($result) ? new JsonResponse($result) : new JsonResponse(array(
            'result' => $result,
            'message' => $message,
            'extra' => $extras
        ));

        return $json;
    }

}
