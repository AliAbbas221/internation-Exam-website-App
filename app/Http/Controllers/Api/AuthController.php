<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use App\Models\User;
use App\Models\Collage;
use App\Events\UserCreated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\CollageResource;
use App\Http\Controllers\Api\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'user_name' => $request->user_name,
            'phone' => $request->phone
        ]);
        $collage = Collage::where('uuid', $request->collage_id)->first();
        event(new UserCreated($user, $collage->id));

        return $this->successResponse($user, 'User Registered Successfully.', 201);
    }
    public function login(Request $request)
    {
        $passcode = $request->passcode;
        $user = User::where('user_name', $request->user_name)
            ->whereHas('codes', function ($query) use ($passcode) {
                $query->where('value', $passcode);
            })
            ->first();

        if (!$user) {
            return $this->errorResponse('Invalid User Name or Passcode', 401);
        }

        

        if ($user->isAdmin()) {
            $data = [
                'token' => $user->createToken('Admin-Api-Token')->plainTextToken,
                'id' => $user->uuid,
                'user_name' => $user->user_name
            ];
        } else {
            $collage = $user->codes()->where('value', $passcode)->first()->collage;
            $token = $user->createToken('College Access Token',['collage_id:'. $collage->id]);
           
            $data = [
                'token' => $token->plainTextToken,
                'user_name' => $user->user_name,
                'id' => $user->uuid,
                'collage' => new CollageResource($collage)
            ];
        }
        return $this->successResponse($data, "Logged in successfuly", 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return $this->successResponse(null, "User Logedout Successfully.", 200);
    }
}