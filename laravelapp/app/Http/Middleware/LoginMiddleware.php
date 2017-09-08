<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
{
    $this->sessionHandled = true;
 
    //如果session驱动已配置，那么我们需要开启session以便为应用准备好数据
    //注意Laravel session并没有使用原生的PHP session相关方法
    if ($this->sessionConfigured()) {
        $session = $this->startSession($request);
        $request->setSession($session);
    }
 
    $response = $next($request);
 
    // 同样，如果session经过配置那么我们需要关闭session以便将session数据持久化到某些存储介质中
    // 我们还会添加session id到响应头cookie中
    if ($this->sessionConfigured()) {
        $this->storeCurrentUrl($request, $session);
        $this->collectGarbage($session);
        $this->addCookieToResponse($response, $session);
    }
 
    return $response;
}

}
