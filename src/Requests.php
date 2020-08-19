<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/8/17
 * Time: 16:26
 */

namespace think;


/**
 * php http请求
 * Class Requests
 * @package think
 */
class Requests
{
//    use Args;

    private static $_instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }

    /**
     * get请求
     * @param string $url 目标网址
     * @param array $data 需要请求的数据
     * @param array $headers headers信息
     * @return bool|string
     */
    public function get(string $url, array $data = [], array $headers = [])
    {
        $curl = curl_init(); //初始化CURL句柄
        curl_setopt($curl, CURLOPT_URL, $url); //设置请求的URL

        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        // 请求的时候 携带的header参数 比如：token，authorization，cookie 等等....
        if ($headers != null && is_array($headers) && !empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT"); //设置请求方式

        $output = curl_exec($curl);
//        $status = curl_getinfo($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * post 请求目标地址
     * @param string $url 目标网址
     * @param array $data 需要请求的数据
     * @param array $headers headers信息
     * @return bool|string
     */
    public function post(string $url, array $data = [], array $headers = [])
    {
        $curl = curl_init();

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_HEADER, 0);//返回response头部信息
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);


        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}

