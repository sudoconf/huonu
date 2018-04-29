<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 11:32
 */

namespace common\components;

use Yii;
use yii\web\Response;

class CtHelper
{
    public static function makeResponse($result = true, $message = '', $data = [])
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'result' => $result,
            'message' => $message,
            'data' => $data,
        ];
    }

    /**
     * 统一返回结果
     * @param bool $result 状态 true or false
     * @param string $message
     * @param array $data
     */
    public static function response($result = true, $message = '', $data = [])
    {
        Yii::$app->response->data = CtHelper::makeResponse($result, $message, $data);
        Yii::$app->response->send();
        exit();
    }

    /**
     * 获取IP地址
     * @return array|false|string
     */
    public static function getIpAddress()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $strIpAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $strIpAddress = $_SERVER['HTTP_CLIENT_IP'];
                } else {
                    $strIpAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $strIpAddress = getenv('HTTP_X_FORWARDED_FOR');
            } else {
                if (getenv('HTTP_CLIENT_IP')) {
                    $strIpAddress = getenv('HTTP_CLIENT_IP');
                } else {
                    $strIpAddress = getenv('REMOTE_ADDR') ? getenv('REMOTE_ADDR') : '';
                }
            }
        }

        return $strIpAddress;
    }
}