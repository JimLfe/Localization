<?php namespace Arcanedev\Localization\Traits;

/**
 * Class     LocalizationKernelTrait
 *
 * @package  Arcanedev\Localization\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Illuminate\Foundation\Application      app
 * @property  \Arcanedev\Localization\Routing\Router  router
 * @property  array                                   routeMiddleware
 */
trait LocalizationKernelTrait
{
    /**
     * Get the route dispatcher callback.
     *
     * @return \Closure
     */
    protected function dispatchToRouter()
    {
        $this->router = $this->app['router'];

        foreach ($this->routeMiddleware as $name => $middleware) {
            $this->router->middleware($name, $middleware);
        }

        return parent::dispatchToRouter();
    }
}
