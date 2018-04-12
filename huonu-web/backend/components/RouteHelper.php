<?php

namespace backend\components;

use mdm\admin\models\Route;
use Yii;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;
use yii\web\User;

class RouteHelper
{
    private static $_userRoutes = [];
    private static $_defaultRoutes;
    private static $_routes;

    private static $_onlyRegisteredRoute = false; // 如果是真的，那么AccessControl只检查路线是否注册。
    private static $_strict = true; // 如果是假的，那么访问控制将会在没有规则的情况下进行检查
    private static $_advanced;

    public static function getRegisteredRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            $manager = Yii::$app->authManager;
            foreach ($manager->getPermissions() as $item) {
                if ($item->name[0] === '/') {
                    self::$_routes[$item->name] = $item->name;
                }
            }
        }
        return self::$_routes;
    }

    /**
     * 通过默认角色获得指定的路由
     * @return array|mixed
     */
    protected static function getDefaultRoutes()
    {
        if (self::$_defaultRoutes === null) {
            $manager = Yii::$app->authManager;
            $roles = $manager->defaultRoles;
            $cache = Yii::$app->cache;
            if ($cache && ($routes = $cache->get($roles)) !== false) {
                self::$_defaultRoutes = $routes;
            } else {
                $permissions = self::$_defaultRoutes = [];
                foreach ($roles as $role) {
                    $permissions = array_merge($permissions, $manager->getPermissionsByRole($role));
                }
                foreach ($permissions as $item) {
                    if ($item->name[0] === '/') {
                        self::$_defaultRoutes[$item->name] = true;
                    }
                }
                if ($cache) {
                    $cache->set($roles, self::$_defaultRoutes, CtConstant::CACHE_DURATION, new TagDependency([
                        'tags' => CtConstant::CACHE_TAG,
                    ]));
                }
            }
        }
        return self::$_defaultRoutes;
    }

    /**
     * 获取用户的指定路由
     * @param $userId
     * @return mixed
     */
    public static function getRoutesByUser($userId)
    {
        if (!isset(self::$_userRoutes[$userId])) {
            $cache = Yii::$app->cache;
            if ($cache && ($routes = $cache->get([__METHOD__, $userId])) !== false) {
                self::$_userRoutes[$userId] = $routes;
            } else {
                $routes = static::getDefaultRoutes();
                $manager = Yii::$app->authManager;
                foreach ($manager->getPermissionsByUser($userId) as $item) {
                    if ($item->name[0] === '/') {
                        $routes[$item->name] = true;
                    }
                }
                self::$_userRoutes[$userId] = $routes;
                if ($cache) {
                    $cache->set([__METHOD__, $userId], $routes, CtConstant::CACHE_DURATION, new TagDependency([
                        'tags' => CtConstant::CACHE_TAG,
                    ]));
                }
            }
        }
        return self::$_userRoutes[$userId];
    }

    /**
     * 检查用户的访问路径
     * @param $route
     * @param array $params
     * @param null $user
     * @return bool
     */
    public static function checkRoute($route, $params = [], $user = null)
    {
        $r = static::normalizeRoute($route, self::$_advanced);
        if (self::$_onlyRegisteredRoute && !isset(static::getRegisteredRoutes()[$r])) {
            return true;
        }

        if ($user === null) {
            $user = Yii::$app->getUser();
        }
        $userId = $user instanceof User ? $user->getId() : $user;

        if (self::$_strict) {
            if ($user->can($r, $params)) {
                return true;
            }
            while (($pos = strrpos($r, '/')) > 0) {
                $r = substr($r, 0, $pos);
                if ($user->can($r . '/*', $params)) {
                    return true;
                }
            }
            return $user->can('/*', $params);
        } else {
            $routes = static::getRoutesByUser($userId);
            if (isset($routes[$r])) {
                return true;
            }
            while (($pos = strrpos($r, '/')) > 0) {
                $r = substr($r, 0, $pos);
                if (isset($routes[$r . '/*'])) {
                    return true;
                }
            }
            return isset($routes['/*']);
        }
    }

    /**
     * 规范化的路线
     * @param  string $route Plain route string
     * @param  boolean|array $advanced Array containing the advanced configuration. Defaults to false.
     * @return string            Normalized route string
     */
    protected static function normalizeRoute($route, $advanced = false)
    {
        if ($route === '') {
            $normalized = '/' . Yii::$app->controller->getRoute();
        } elseif (strncmp($route, '/', 1) === 0) {
            $normalized = $route;
        } elseif (strpos($route, '/') === false) {
            $normalized = '/' . Yii::$app->controller->getUniqueId() . '/' . $route;
        } elseif (($mid = Yii::$app->controller->module->getUniqueId()) !== '') {
            $normalized = '/' . $mid . '/' . $route;
        } else {
            $normalized = '/' . $route;
        }
        // Prefix @app-id to route.
        if ($advanced) {
            $normalized = Route::PREFIX_ADVANCED . Yii::$app->id . $normalized;
        }
        return $normalized;
    }

    /**
     * 过滤器菜单项
     * @param $items
     * @param null $user
     * @return array
     */
    public static function filter($items, $user = null)
    {
        if ($user === null) {
            $user = Yii::$app->getUser();
        }
        return static::filterRecursive($items, $user);
    }

    /**
     * 过滤器菜单递归
     * @param $items
     * @param $user
     * @return array
     */
    protected static function filterRecursive($items, $user)
    {
        $result = [];
        foreach ($items as $i => $item) {
            $url = ArrayHelper::getValue($item, 'url', '#');
            $allow = is_array($url) ? static::checkRoute($url[0], array_slice($url, 1), $user) : true;

            if (isset($item['items']) && is_array($item['items'])) {
                $subItems = self::filterRecursive($item['items'], $user);
                if (count($subItems)) {
                    $allow = true;
                }
                $item['items'] = $subItems;
            }
            if ($allow && !($url == '#' && empty($item['items']))) {
                $result[$i] = $item;
            }
        }
        return $result;
    }

    /**
     * 过滤操作栏按钮. Use with [[yii\grid\GridView]]
     * ```php
     * 'columns' => [
     *     ...
     *     [
     *         'class' => 'yii\grid\ActionColumn',
     *         'template' => Helper::filterActionColumn(['view','update','activate'])
     *     ]
     * ],
     * ```
     * @param array|string $buttons
     * @param integer|User $user
     * @return string
     */
    public static function filterActionColumn($buttons = [], $user = null)
    {
        if (is_array($buttons)) {
            $result = [];
            foreach ($buttons as $button) {
                if (static::checkRoute($button, [], $user)) {
                    $result[] = "{{$button}}";
                }
            }
            return implode(' ', $result);
        }
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use ($user) {
            return static::checkRoute($matches[1], [], $user) ? "{{$matches[1]}}" : '';
        }, $buttons);
    }

    /**
     * 使用缓存失效
     */
    public static function invalidate()
    {
        if (Yii::$app->cache !== null) {
            TagDependency::invalidate(Yii::$app->cache, CtConstant::CACHE_TAG);
        }
    }
}
