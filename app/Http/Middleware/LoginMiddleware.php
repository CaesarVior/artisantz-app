<?php

namespace App\Http\Middleware;

use Closure;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = null;
        $cookieHeader = $request->header('Cookie');

        if ($cookieHeader && preg_match('/(?:^|\s)?auth_token=([^;\s]+)/', $cookieHeader, $matches)) {
            $token = urldecode($matches[1]);
        } else {
            $token = $request->bearerToken();
        }

        if (! $token) {
            session(['redirect_to' => url()->current()]);
            session()->flash('session_expired', __('sessions.session_expired'));

            return redirect('/login');
        }

        if (substr_count($token, '.') !== 2) {
            return $this->tokenFailedResponse($request, __('sessions.token_format_invalid'));
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            if (! $user) {
                return $this->tokenFailedResponse($request, __('sessions.invalid_token'));
            }
            auth()->setUser($user);
        } catch (\Exception $e) {
            return $this->tokenFailedResponse($request, __('sessions.token_error', ['message' => $e->getMessage()]));
        }

        return $next($request);
    }

    protected function tokenFailedResponse($request, $message)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => $message], 401);
        }

        session()->flash('session_expired', $message);

        return redirect('/login');
    }
}
