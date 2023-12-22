<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request): UserResource
    {
        $user = $request->user();
        $user->load('place');

        return new UserResource(
            resource: $user
        );
    }
}
