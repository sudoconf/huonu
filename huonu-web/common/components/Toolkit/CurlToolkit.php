<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 11:20
 */

namespace common\components\Toolkit;

class CurlToolkit
{
    /**
     *
     * $url = 'http://v.juhe.cn/postcode/query';
     * $data = array(
     *      'postcode' => '310018',
     *      'key' => '1c85799c8c1a6675fb8c312e4b7a09d3',
     * );
     * $result = CurlToolkit::request('POST', $url, $data);
     *
     * @param $method
     * @param $url
     * @param array $params
     * @param array $conditions
     * @return array|bool|mixed|string
     */
    public static function request($method, $url, $params = array(), $conditions = array())
    {
        $conditions['userAgent'] = isset($conditions['userAgent']) ? $conditions['userAgent'] : '';
        $conditions['connectTimeout'] = isset($conditions['connectTimeout']) ? $conditions['connectTimeout'] : 10;
        $conditions['timeout'] = isset($conditions['timeout']) ? $conditions['timeout'] : 10;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $conditions['userAgent']);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $conditions['connectTimeout']);
        curl_setopt($curl, CURLOPT_TIMEOUT, $conditions['timeout']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, 1);
            //TODO
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        } elseif ($method == 'PUT') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } elseif ($method == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } elseif ($method == 'PATCH') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        } else {
            if (!empty($params)) {
                $url = $url.(strpos($url, '?') ? '&' : '?').http_build_query($params);
            }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($curl);
        $curlinfo = curl_getinfo($curl);

        $header = substr($response, 0, $curlinfo['header_size']);
        $body = substr($response, $curlinfo['header_size']);

        curl_close($curl);

        if (empty($curlinfo['namelookup_time'])) {
            return array();
        }

        if (isset($conditions['contentType']) && $conditions['contentType'] == 'plain') {
            return $body;
        }

        $body = json_decode($body, true);

        return $body;
    }
}