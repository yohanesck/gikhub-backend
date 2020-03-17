<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidEmailException;
use App\Exceptions\InvalidLoginException;
use App\Http\Requests\ValidateLogin;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JWTAuthController extends Controller
{
    private $user;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->user = $user;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(ValidateLogin $request)
    {
        if ($request['type'] == 'manual') {
            $credentials = request(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            $token = auth()->login($this->googleLoginHandler($request));
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'result' => [
                'token' => $token,
                'user' => $this->user->profilePhoto()->find(auth()->user()->id)
            ]
        ]);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function googleLoginHandler($request)
    {
        $retrievedUser = $this->user->where('email', $request['email'])->first();

        if (is_null($retrievedUser)) {
            $this->user->insert($this->user->prepareDataInsert($request));
            $retrievedUser = $this->user->where('email', $request['email'])->first();
        } else
            $this->updateClientID($request);

        return $retrievedUser;
    }

    /**
     * @param $request
     */
    public function updateClientID($request)
    {
        $this->user->where('email', $request['email'])->update(['client_id' => $request['client_id']]);
    }
}
