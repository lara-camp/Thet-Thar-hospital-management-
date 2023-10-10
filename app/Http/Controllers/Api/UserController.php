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

class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = (new FetchUserAction)();
        return response()->json([
            'data' => UserResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    public function store(UserRequest $request)
    {
        (new StoreUserAction())($request->all());
        return $this->success('Inserted hospital successfully.', null, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->success('Data fetched successfully.', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user = (new EditUserAction)($request->all(), $user);
        return $this->success('Successfully updated.', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        (new DeleteUserAction)($user);
        return $this->success('Successfully Deleted', null);
    }

    public function fetchUserHospital()
    {
        $result = (new FetchUserHospitalAction)();
        return response()->json([
            'hospitalId' => $result,
        ]);
    }
}
