<?php

namespace App\Http\Controllers\Api;

use App\Models\Collage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollageRequest;
use App\Http\Resources\CollageResource;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Api\Traits\ImageUploadTrait;

class CollageController extends Controller
{
    use ApiResponse, ImageUploadTrait;
    public function index()
    {
        $collages = Collage::all();

        return $this->successResponse(CollageResource::collection($collages),"Show All Collages",200);
    }

    public function store(CollageRequest $request)
    {
        $id = Category::where('uuid', $request->category_id)->first()->id;

        $image = $this->uploadImage($request, "image", "collages/");
        $collage = Collage::create([
            'collage_name' => $request->collage_name,
            'image' => $image,
            'category_id' => $id,
        ]);
       
        return $this->successResponse(new CollageResource($collage), " collage created successfully", 200);
    }
    public function show(Collage $collage)
    {
        return  $this->successResponse(new CollageResource($collage), "show your collage", 200);
    }
        public function update(CollageRequest $request, Collage $collage)
        {
            $category = Category::where('uuid',$request->category_id)->first();
    
            if (!$category) {
                return $this->notFound();
            }
            $image = $this->uploadImage($request,"image", "collages/");

            $collage->update([
                'collage_name' => $request->collage_name ?? $collage->collage_name,
                'image' => $image ?? $collage->image,
                'category_id' => $category->id ?? $collage->category_id,
            ]);
            return $this->successResponse(new CollageResource($collage), " collage updated successfully", 200);
        }
    public function destroy(Collage $collage)
    {
        $image = $collage->image;
        $this->deleteImage($image);
        $collage->delete();

        return $this->successResponse("Collage deleted successfully", 200);
    }
    public function getEngineerCollages()
    {
        $collages = Collage::where('category_id',1)->get();
        return $this->successResponse(CollageResource::collection($collages),"Show Engineer Collages",200);
    }
    public function getMedicalCollages()
    {
        $collages = Collage::where('category_id',2)->get();
        return $this->successResponse(CollageResource::collection($collages),"Show Medical Collages",200);
    }
}
