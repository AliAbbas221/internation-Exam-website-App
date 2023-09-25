<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use App\Models\User;
use App\Models\Collage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CodeResource;
use App\Http\Requests\CreateCodeRequest;
use App\Http\Controllers\Api\Traits\ApiResponse;

class CodeController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $codes = Code::all();
        return $this->successResponse(CodeResource::collection($codes), "Show All Codes", 200);

    }
    public function store(CreateCodeRequest $request)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;
        
        $code = Code::create([
            'value' => Str::random(10),
            'collage_id'=>$collage_id
        ]);
        
        return $this->successResponse(new CodeResource($code), "New Code Created Successfully", 201);
    }
    public function show()
    {

    }
    public function update(Request $request, Code $code)
    {   //only update code to set user to this code
    
        $user = User::where('user_name', $request->user_name)->first();
        if (!$user) {
            return $this->notFound("User Not Found.");
        }
        $code->update([
            'user_id' => $user->id,
        ]);
        return $this->successResponse(new CodeResource($code), "Code Updated Successfully", 200);
    }
    public function destroy(Code $code)
    {
        $code->delete();
        return $this->successResponse(null, "Code Deleted Successfully", 200);
    }
}
