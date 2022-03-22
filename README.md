# zm-policy

一个非常简单的，用于炸毛框架的基础权限控制库。

## 使用方法

```shell
composer require sunxyw/policy
```

在 `OnStart` 方法中：
```php
#[OnStart]
public function init()
{
    \Sunxyw\Policy\Gate::define('can_view_timer', static function ($params) {
        return false;
    });
}
```

```php
use Sunxyw\Policy\Annotations\Gate;

#[CQCommand('view_timer')]
#[Gate('can_view_timer', 'any_param_here')]
public function timer()
{
    return 'This page is used as testing TimerMiddleware! Do not use it in production.';
}
```
