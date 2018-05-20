<?php

namespace app\components;

class Curl
{
    public $url = '';
    public $data = [];


    private $_curl;

    public function get()
    {

    }

    public function post()
    {
        // POST 请求
        curl_setopt($this->_curl, CURLOPT_POST, true);
    }

    private function init()
    {
        $this->_curl = curl_init();
        curl_setopt($this->_curl, CURLOPT_URL, $this->url);


    }

    private function _end()
    {
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($this->_curl);
        curl_close($this->_curl);
        return $contents;
    }
}