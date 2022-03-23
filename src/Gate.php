<?php

namespace Sunxyw\Policy;

use Sunxyw\Policy\Exceptions\AuthorizationException;
use ZM\Store\WorkerCache;

class Gate
{
    public static function define($ability, $callback): void
    {
        WorkerCache::set("policy_$ability", $callback);
    }

    public static function allows($ability, $arguments): bool
    {
        $callback = WorkerCache::get("policy_$ability");
        if (!$callback) {
            return false;
        }
        return call_user_func_array($callback, $arguments);
    }

    public static function denies($ability, $arguments): bool
    {
        return !static::allows($ability, $arguments);
    }

    /**
     * 检查权限，无权限时抛出异常
     *
     * @throws AuthorizationException
     */
    public static function authorize($ability, $arguments): bool
    {
        if (static::allows($ability, $arguments)) {
            return true;
        }
        throw (new AuthorizationException())->need($ability);
    }
}