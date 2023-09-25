<?php

namespace App\Http\Controllers\Api;

use App\Models\Collage;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
use App\Http\Resources\SpecializationResource;
use App\Http\Controllers\Api\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SpecializationController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $specializations = Specialization::all();
        return $this->successResponse(SpecializationResource::collection($specializations), "show All specializaton ", 200);
    }
    public function store(SpecializationRequest $request)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;
        $spec = Specialization::create([
            'specialization_name' => $request->specialization_name,
            'collage_id' => $collage_id
        ]);
        return $this->successResponse(new SpecializationResource($spec), "specialization created successfully", 201);
    }
    public function show(Specialization $specialization)
    { 
        return $this->successResponse(new SpecializationResource($specialization), "Show Specialization Successfully", 200);
    }
    public function update(SpecializationRequest $request, Specialization $specialization)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;

        $specialization->update([
            'specialization_name' => $request->specialization_name,
            'collage_id' => $collage_id,
        ]);
        return $this->successResponse(new SpecializationResource($specialization), "specialization updated successfully", 200);
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
        return $this->successResponse("specialization updated successfully", 200);
    }

    //get collage's specialization
    public function getCollageSpec(Collage $collage)
    {
        try {
            $specializations = $collage->specializations()->get();
            return $this->successResponse(SpecializationResource::collection($specializations), "Show All Specialization", 200);

        } catch (ModelNotFoundException $e) {
            // Model not found, return a custom response
            return $this->notFound();
        }

    }
}