<?php

namespace App\Http\Controllers\Api;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ComplaintRequest;
use App\Http\Resources\ComplaintResource;
use App\Http\Controllers\Api\Traits\ApiResponse;

class ComplaintController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $codes = Complaint::all();
        return $this->successResponse(ComplaintResource::collection($codes), "Show All Complaints", 200);
    }
    public function store(ComplaintRequest $request)
    {
        $user =Auth::user();
        $complaint = Complaint::create([
            'content' => $request->content,
            'user_id'=>$user->id
        ]);
        
        return $this->successResponse(new ComplaintResource($complaint), "New Complaint Created Successfully", 201);
    }
    public function show(Complaint $complaint)
    {
        return $this->successResponse(new ComplaintResource($complaint), "Show Complaint Successfully", 200);
    }
    public function update(Request $request, Complaint $complaint)
    {   
        if ($complaint->user_id != Auth::id()) {
            return $this->unauthorized();
         }
       $complaint->update([
        'content' => $request->content
       ]);
        return $this->successResponse(new ComplaintResource($complaint), "Complaint Updated Successfully", 200);
    }
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return $this->successResponse(null, "Complaint Deleted Successfully", 200);
    }
}