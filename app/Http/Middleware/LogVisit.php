<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LogVisit
{
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $this->getRealIpAddress($request);
        $cacheKey = 'visit:' . md5($ipAddress);

        if(!Cache::has($cacheKey)) {
            Visit::create([
                'ip' => $ipAddress,
            ]);

            Cache::put($cacheKey, true, 60 * 60 * 24);
        }

        return $next($request);
    }

    private function getRealIpAddress(Request $request): string
    {
        $ip = $request->ip();
        
        if ($ip === '127.0.0.1' || $ip === '::1' || empty($ip)) {
            if ($request->header('X-Real-IP')) {
                $ip = $request->header('X-Real-IP');
            }
            elseif ($request->header('X-Forwarded-For')) {
                $forwardedFor = $request->header('X-Forwarded-For');
                $ips = explode(',', $forwardedFor);
                $ip = trim($ips[0]);
            }
            elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        
        return $ip ?: 'Неизвестен';
    }
}
