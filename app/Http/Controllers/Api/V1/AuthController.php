<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\{JsonResponse, Request};
use App\Http\Controllers\Controller;
use App\Http\Request\Auth\LoginRequest;


class AuthController extends Controller
{
    // ─── POST /api/v1/auth/login ──────────────────────────
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        try {
            $result = $action(LoginData::from($request));

            $response = AuthResource::fromLoginResult($result);

            return $response->withCookie(
                cookie(
                    name:     'refresh_token',
                    value:    $result->refresh_token,
                    minutes:  30 * 24 * 60,
                    secure:   app()->isProduction(),
                    httpOnly: true,
                    sameSite: 'Lax',
                )
            );

        } catch (AuthException $e) {
            return $this->authError($e);
        }
    }
}