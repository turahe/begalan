<?php

namespace App\Services\Helpers;

/**
 * Class RajaOngkir.
 */
class RajaOngkir
{
    private $key;
    private $endpoint;

    public function __construct()
    {
        $this->key = config('rajaongkir.api_key');
        $endpoint_starter = 'http://rajaongkir.com/api/starter/';
        $endpoint_basic = 'http://rajaongkir.com/api/basic/';
        $endpoint_pro = 'http://pro.rajaongkir.com/api/';
        $this->endpoint = $endpoint_pro;
    }

    public function getProvince($params = [])
    {
        return $this->http('get', 'province', $params);
    }

    public function getCity($params = [])
    {
        return $this->http('get', 'city', $params);
    }

    public function getCost($params = [])
    {
        return $this->http('post', 'cost', $params);
    }

    private function http($type, $path, $params)
    {
        $client = new \GuzzleHttp\Client();
        $headers = ['headers'=>['key'=>$this->key]];
        if ($type == 'post') {
            $url = $this->endpoint.$path;
            $headers['form_params'] = $params;
            $response = $client->post($url, $headers);
        } else {
            $url = $this->endpoint.$path.$this->query($params);
            $response = $client->get($url, $headers);
        }
        $data = json_decode($response->getBody());

        return $data->rajaongkir->results;
    }

    private function query($params)
    {
        return $query = is_array($params) ? '?'.http_build_query($params) : '';
    }
}
