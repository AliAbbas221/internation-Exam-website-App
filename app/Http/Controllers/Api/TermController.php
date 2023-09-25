<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Collage;
use Illuminate\Http\Request;
use App\Http\Requests\TermRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TermResource;
use App\Http\Controllers\Api\Traits\ApiResponse;

class TermController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $terms = Term::all();

        return $this->successResponse(TermResource::collection($terms), "Show All Terms", 200);
    }

    public function store(TermRequest $request)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;

        $term = Term::create([
            'term_name' => $request->term_name,
            'type' => $request->type,
            'collage_id' => $collage_id
        ]);
        return $this->successResponse(new TermResource($term), "New Term Created Successfully", 201);
    }

    public function show(Term $term)
    {
        return $this->successResponse(new TermResource($term), "Show Term Successfully", 200);
    }


    public function update(TermRequest $request, Term $term)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;

        $term->update([
            'term_name' => $request->term_name,
            'type' => $request->type,
            'collage_id' => $collage_id
        ]);
        return $this->successResponse(new TermResource($term), "Term Updated Successfully", 200);

    }
    public function destroy(Term $term)
    {
        $term->delete();
        return $this->successResponse(null, "Term Deleted Successfully", 200);
    }
    public function getCollageTerms(Collage $collage, $type)
    {
        $terms = $collage->terms()->where('type',$type)->orderBy('created_at', 'desc')->limit(5)->get();
        return $this->successResponse(TermResource::collection($terms),"Show Last 5 Collage's Terms");
    }
}