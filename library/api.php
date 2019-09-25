<?php


class api
{
    public $dir_methods = __DIR__ . '/../methods/';

    /**
     * The main function to be used. Verifies the signature and loads the method.
     * @author Zakhar https://vk.com/ghost1337gg
     * @return void
     */
    public function Init()
    {
        require './config.php';

        if(VIEW_PHP_ERROR)
        {
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
        else
        {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
        }

        header('Content-Type: application/json; charset=utf-8');

        if(!$this->VerificationSignature())
        {
            $this->ErrorResponse('Failed verification signature', 401);
        }

        $this->LoadMethod();
    }

    /**
     * Used on success and returns the information specified in the argument
     * @param $response *The result that will be returned in response*
     * @return void
     */
    public function SuccessResponse($response)
    {
        die(json_encode(array('response' => $response)));
    }

    /**
     * @param $response *The result that will be returned in error*
     * @param int $status *Return to status*
     * @return void
     */
    public function ErrorResponse($response, $status=200)
    {
        http_response_code($status);

        die(json_encode(array('error' => $response)));
    }

    /**
     * Verification signature
     * @return bool
     */
    private function VerificationSignature()
    {
        if(!isset($_GET['sign']))
        {
            return false;
        }

        $params = [];
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);

        $vk_params = [];
        foreach ($params as $name => $value)
        {
            if (strpos($name, 'vk_') !== 0) {
                continue;
            }

            $vk_params[$name] = $value;
        }

        ksort($vk_params);
        $params_query = http_build_query($vk_params);
        $sign_params = rtrim(strtr(base64_encode(hash_hmac('sha256', $params_query, CLIENT_SECRET, true)), '+/', '-_'), '=');
        return $sign_params == $_GET['sign'] ? true : false;
    }

    /**
     * Loading Method in GET `method`
     * @return void
     */
    private function LoadMethod()
    {
        if(!isset($_GET['method']))
        {
            $this->ErrorResponse('Method not passed');
        }

        if(in_array($_GET['method'], METHOD_LIST))
        {
            require "{$this->dir_methods}{$_GET['method']}.php";
            die();
        }
        else
        {
            $this->ErrorResponse('Method not found');
        }
    }
}