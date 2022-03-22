<?php

namespace Sunxyw\Policy\Annotations;

use Attribute;
use JetBrains\PhpStorm\Pure;
use ZM\Annotation\Http\Middleware;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
class Gate extends Middleware
{
    #[Pure]
    public function __construct(string $ability, ...$arguments)
    {
        parent::__construct('GateMiddleware', [$ability, ...$arguments]);
    }
}