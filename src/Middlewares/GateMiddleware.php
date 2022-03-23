<?php

namespace Sunxyw\Policy\Middlewares;

use Sunxyw\Policy\Exceptions\AuthorizationException;
use Sunxyw\Policy\Gate;
use ZM\Annotation\Http\HandleBefore;
use ZM\Annotation\Http\MiddlewareClass;
use ZM\Http\MiddlewareInterface;

#[MiddlewareClass('GateMiddleware')]
class GateMiddleware implements MiddlewareInterface
{
    /**
     * 检查是否有指定权限
     *
     * @return bool
     * @throws AuthorizationException
     */
    #[HandleBefore]
    public function handle(): bool
    {
        $ability = array_shift($this->middleware->params);
        $arguments = $this->middleware->params;
        return Gate::authorize($ability, $arguments);
    }
}