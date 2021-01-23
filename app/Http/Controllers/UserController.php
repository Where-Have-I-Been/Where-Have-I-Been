<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Authentication\Password\PasswordServiceInterface;
use App\Services\User\Statistics\UserStatisticsGetterInterface;
use App\Services\User\UserQueryString\Mapper\UserMapperInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private PasswordServiceInterface $passwordService;
    private UserServiceInterface $userService;

    public function __construct(PasswordServiceInterface $passwordService, UserServiceInterface $userService)
    {
        $this->passwordService = $passwordService;
        $this->userService = $userService;
    }

    public function show(Request $request): JsonResource
    {
        return new UserResource($request->user());
    }

    public function getStatistics(User $user, UserStatisticsGetterInterface $getter): JsonResponse
    {
        return response()->json($getter->getUserStatistics($user));
    }

    public function index(Request $request, UserMapperInterface $mapperService): ResourceCollection
    {
        $users = $this->userService->getUsers($mapperService->map(
            $request->only("by-followings", "by-followers", "search-query")),
            $request->user(),
            $request->input("per-page"));
        return new UserCollection($users);
    }

    public function changePassword(User $user, ChangePasswordRequest $request): JsonResponse
    {
        $this->passwordService->changePassword($request->validated(), $user);

        return response()->json([
            "message" => __("passwords.updated"),
        ], Response::HTTP_OK);
    }
}
