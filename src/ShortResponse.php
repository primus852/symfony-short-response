<?php

namespace primus852\ShortResponse;


class ShortResponse
{

    /**
     * @param string $result
     * @param string $message
     * @param array $extra
     * @return string
     * @throws JsonException
     */
    public static function json(string $result, string $message, array $extra = array())
    {
        return self::display($result, $message, $extra);
    }

    /**
     * @param string $message
     * @param array $extra
     * @return string
     * @throws JsonException
     */
    public static function success(string $message, array $extra = array())
    {
        return self::display('success', $message, $extra);
    }


    /**
     * @param string $message
     * @param array $extra
     * @return string
     * @throws JsonException
     */
    public static function error(string $message, array $extra = array())
    {
        return self::display('error', $message, $extra);
    }

    /**
     * @param string $exception
     * @return string
     * @throws JsonException
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
     * @return string
     * @throws JsonException
     */
    public static function exception(string $message, string $exception = 'hidden')
    {
        return self::display('error', $message, array(
            'exception' => $exception
        ));
    }

    /**
     * @throws JsonException
     */
    public static function denied()
    {
        return self::display('error', 'Access denied');
    }

    /**
     * @param string $result
     * @return string
     * @throws JsonException
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
     * @param array $headers
     * @return string
     * @throws JsonException
     */
    private static function display($result, string $message = '', array $extras = array(), array $headers = array('Content-Type' => 'application/json'))
    {

        foreach ($headers as $header => $value) {
            header($header, $value);
        }

        $json = is_array($result) ? json_encode($result) : json_encode(array(
            'result' => $result,
            'message' => $message,
            'extra' => $extras
        ));


        if (json_last_error()) {
            throw new JsonException;
        }

        return $json;
    }

}
