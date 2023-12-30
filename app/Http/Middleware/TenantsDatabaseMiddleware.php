<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class TenantsDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenants = config('tenants');

        $host = $request->getHost();
        $port = $request->getPort();

        if (isset($tenants[$host])) {
            DB::purge('mysql');
            Config::set('database.connections.mysql.database', $tenants[$host]);
            DB::reconnect('mysql');
        } else
            throw new \Exception('this host is not available');
        return $next($request);
    }
}
