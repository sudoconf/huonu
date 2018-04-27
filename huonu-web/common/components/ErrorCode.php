<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/27 14:48
 */

namespace common\components;

/**
 * 统一 code
 * Class ErrorCode
 * @package common\components
 */
class ErrorCode
{
    /**
     * 返回错误 code 对应的错误内容
     * @param $code
     * @return array|string
     */
    public static function getCode($code)
    {
        $codeArray = [
            '' => '',
        ];

        if (!array_key_exists($code, $codeArray)) {
            return '暂无 error code';
        }
        return $codeArray[$code];
    }
}