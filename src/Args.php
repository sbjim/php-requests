<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/8/17
 * Time: 16:40
 */

namespace think;


trait Args
{
    private $statusCode = 200;
    private $cookies = [];
    private $session = [];
    private $ok = '';


    public function getCookies(){
        return $this->cookies;
    }
    public function getSession(){
        return $this->session;
    }
    public function getStatusCode(){
        return $this->statusCode;
    }

}