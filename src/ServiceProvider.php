<?php

namespace Sortarad\Lol;

use Statamic\Providers\AddonServiceProvider;
use Sortarad\Lol\Widgets\Lol;

class ServiceProvider extends AddonServiceProvider
{
    protected $viewNamespace = 'sortarad';

    protected $widgets = [
        Lol::class
    ];
}
