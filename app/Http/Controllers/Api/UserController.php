<?php

namespace App\Http\Controllers\Api;

use Error;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\UseCases\Users\EditUserAction;
use App\UseCases\Users\FetchUserAction;
use App\UseCases\Users\StoreUserAction;
use App\UseCases\Users\DeleteUserAction;
use App\UseCases\Users\FetchUserHospitalAction;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use HttpResponses;

    //Display a listing of the resource.
    public function index(): JsonResponse
    {
        $result = (new FetchUserAction)();
        return response()->json([
            'data' => UserResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    //Store User
    public function store(UserRequest $request): JsonResponse
    {
        (new StoreUserAction())($request->all());
        return $this->success('Inserted hospital successfully.', null, 201);
    }

    //Display the specified resource.
    public function show(User $user): JsonResponse
    {
        return $this->success('Data fetched successfully.', $user);
    }

    //Update the specified User Info.
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user = (new EditUserAction)($request->all(), $user);
        return $this->success('Successfully updated.', $user);
    }

    //Delete User
    public function destroy(User $user): JsonResponse
    {
        (new DeleteUserAction)($user);
        return $this->success('Successfully Deleted', null);
    }

    //Fetch User Hospital
    public function fetchUserHospital(): JsonResponse
    {
        $result = (new FetchUserHospitalAction)();
        return response()->json([
            'hospitalId' => $result,
        ]);
    }

    public function authUserInfo(Request $request)
    {
        return $request->user();
    }
}
