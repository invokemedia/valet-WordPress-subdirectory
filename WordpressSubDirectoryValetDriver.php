<?php

/**
 * Modified from: https://github.com/danielbachhuber/quickstart-minus-quickstart/blob/a0051a2298e7ec4e48dc1d9cc8c5ad644638e9dd/config/VipValetDriver.php
 */
class WordpressSubDirectoryValetDriver extends BasicValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return bool
     */
    public function __construct() {
        $this->subfolder = 'public';
    }


    public function serves($sitePath, $siteName, $uri)
    {
        return is_dir($sitePath . '/' . $this->subfolder . '/wp-admin');
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {

        $_SERVER['PHP_SELF']    = $uri;
        $_SERVER['SERVER_ADDR'] = '127.0.0.1';
        $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];

        $matched = false;
        $paths = ['wp-admin', 'wp-includes', 'wp-login'];
        foreach ($paths as $path) {
            if (false !== ($pos = stripos($uri, '/' . $path))) {
                $uri = '/' . $this->subfolder . substr( $uri, $pos );
            }
        }

        return parent::frontControllerPath(
            $sitePath, $siteName, $this->forceTrailingSlash($uri)
        );
    }

    public function isStaticFile($sitePath, $siteName, $uri)
    {
        $paths = ['wp-admin/css', 'wp-includes'];
        foreach ($paths as $path) {
            if (false !== ($pos = stripos($uri, '/' . $path))) {
                $new_uri = '/' . $this->subfolder . substr($uri, $pos);
                if (file_exists($sitePath . $new_uri)) {
                    return $sitePath . $new_uri;
                }
            }
        }

        return parent::isStaticFile($sitePath, $siteName, $uri);
    }

    /**
     * Redirect to uri with trailing slash.
     *
     * @param  string $uri
     * @return string
     */
    private function forceTrailingSlash($uri)
    {
        if (substr($uri, -1 * strlen('/wp-admin')) == '/wp-admin') {
            header('Location: '.$uri.'/');
            die;
        }

        return $uri;
    }
}
