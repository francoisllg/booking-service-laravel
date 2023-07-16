<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\User\GetUserByIdService;

class CheckUserId
{

    private $getUserByIdService;

    public function __construct(GetUserByIdService $get_user_by_id_service)
    {
        $this->getUserByIdService = $get_user_by_id_service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = intval($request->route('user_id'));
        if (!$this->isValidUserId($userId)) {
            return response()->json( ['error' => 'Invalid or non-existent user id. Request aborted.'], 400);
        }

        return $next($request);

    }

    private function isValidUserId($userId):bool
    {
        if(!is_numeric($userId)) return false;
        if(empty($this->getUserByIdService->handle($userId))) return false;
        return true;
    }
}
