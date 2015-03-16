<?php

/**
 * Class CoinzoneUtils
 */
class CoinzoneUtils {

    /**
     * Get headers & normalize them
     * @return array
     */
    public static function getHeaders()
    {
        $headers = getallheaders();
        $nHeaders = array();
        foreach ($headers as $key => $value) {
            $nHeaders[strtolower($key)] = $value;
        }

        return $nHeaders;
    }

    /**
     * Get current URL
     * @return string
     */
    public static function getCurrentUrl()
    {
        $schema = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $currentUrl = $schema . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return $currentUrl;
    }
}
