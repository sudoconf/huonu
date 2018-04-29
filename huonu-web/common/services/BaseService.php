<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/3/19 11:03
 */

namespace common\services;

use Yii;

class BaseService implements \SplSubject
{
    private static $_instance;
    private $observers; // 观察者基类
    protected $observerData = []; // 观察者需要的数据

    /**
     * TODO 构造方法（目的是有session时不用每次赋值给本类）
     */
    public function __construct()
    {
    }

    /**
     * @name service统一访问接口
     * @return static
     */
    final public static function service()
    {
        $class = get_called_class();
        if (!isset(self::$_instance[$class]) || !(self::$_instance[$class] instanceof BaseService)) {
            self::$_instance[$class] = new static();
        }
        return self::$_instance[$class];
    }

    /**
     * 添加观察者
     * @param \SplObserver $observer
     */
    final public function attach(\SplObserver $observer)
    {
        $class = get_class($observer);
        $this->observers[$class] = $observer;
    }

    /**
     * 删除观察者
     * @param \SplObserver $observer
     */
    final public function detach(\SplObserver $observer)
    {
        $class = get_class($observer);
        if (isset($this->observers[$class])) {
            unset($this->observers[$class]);
        }
    }

    /**
     * 同步通知观察者对象
     * @return array|void
     */
    final public function notify()
    {
        $data = [];

        // TODO 同步通知观察者对象

        return $data;
    }

    /**
     * 返回观察者需要的数据
     * @return mixed
     */
    final public function getData()
    {
        return $this->observerData;
    }

}