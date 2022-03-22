<?php

namespace Sunxyw\Policy;

use ZM\Store\WorkerCache;

class Gate
{
    public static function define($ability, $callback): void
    {
        WorkerCache::set("policy_$ability", $callback);
    }

    public static function allows($ability, ...$arguments): bool
    {
        $callback = WorkerCache::get("policy_$ability");
        if (!$callback) {
            return false;
        }
        return call_user_func_array($callback, $arguments);
    }

    public static function denies($ability, ...$arguments): bool
    {
        return !static::allows($ability, $arguments);
    }
}