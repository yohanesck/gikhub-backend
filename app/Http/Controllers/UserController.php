<?php

namespace App\Http\Controllers;

use App\Exceptions\ForbiddenException;
use App\Http\Requests\ValidateUmatUpdate;
use App\Http\Requests\ValidateUserInsert;
use App\Http\Requests\ValidateUserRead;
use App\Http\Requests\ValidateUserUpdate;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateUserInsert $request
     * @return JsonResponse
     */
    public function store(ValidateUserInsert $request)
    {
        return response()->json([
            'result' => $this->user->insert($this->user->prepareDataInsert($request->validated()))
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     * @throws ForbiddenException
     */
    public function show(User $user)
    {
        if ($user->id == auth()->user()->id)
            return response()->json([
                'result' => $user
            ], 200);
        throw new ForbiddenException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidateUserUpdate $request
     * @param User $user
     * @return JsonResponse
     * @throws ForbiddenException
     */
    public function update(ValidateUserUpdate $request, User $user)
    {
        if ($user->id == auth()->user()->id)
            return response()->json([
                'result' => $user->update($user->prepareDataUpdate($request->validated()))
            ], 200);
        throw new ForbiddenException();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {

    }
}
