<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ApiResponse, ImageUploadTrait;

    public function index()
    {
        $users = User::all();

        return $this->successResponse($users, "Show All Users", 200);
    }

    public function show(User $user)
    {
        if (auth()->user()->id == $user->id || auth()->user()->isAdmin()){
            return $this->successResponse($user, 'Show User Successfully.');
        }
        else{
            return $this->unauthorized();
        }
    }
    public function update(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_name' =>'required|string|unique:users',
            'phone' =>'required|string|digits_between:7,20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),400);
        }
        if (auth()->user()->id == $user->id || auth()->user()->isAdmin()){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image = $this->uploadImage($image);
            }
            $user->update([
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'image' => $image['path'] ?? null
            ]);
            return $this->successResponse(null,'User Updated Successfully.');
        }
        else{
            return $this->unauthorized();
        }
    }

    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id || auth()->user()->isAdmin()){
            if($user->image)
            {
                $this->deleteImage($user->image);
            }
            $user->delete();
            return $this->successResponse(null, "User Deleted Successfully", 200);
        }
        else{
            return $this->unauthorized();
        }
    }
}