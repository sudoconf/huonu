<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/3/19 11:03
 */

namespace common\services;

use Yii;

class BaseService
{

    private static $_instance;

    // TODO 构造方法（目的是有session时不用每次赋值给本类）
    public function __construct()
    {
    }

    /**
     * @name service统一访问接口
     * @author huxiao
     * @return mixed
     */
    final public static function service()
    {
        $class = get_called_class();
        if (!isset(self::$_instance[$class]) || !(self::$_instance[$class] instanceof BaseService)) {
            self::$_instance[$class] = new static();
        }
        return self::$_instance[$class];
    }

}