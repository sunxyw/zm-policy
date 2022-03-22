<?php

namespace Sunxyw\Policy\Middlewares;

use Sunxyw\Policy\Gate;
use ZM\Annotation\Http\HandleBefore;
use ZM\Annotation\Http\MiddlewareClass;

#[MiddlewareClass('GateMiddleware')]
class GateMiddleware implements \ZM\Http\MiddlewareInterface
{
    #[HandleBefore]
    public function handle(): bool
    {
        $ability = array_shift($this->middleware->params);
        $arguments = $this->middleware->params;
        return Gate::allows($ability, ...$arguments);
    }
}