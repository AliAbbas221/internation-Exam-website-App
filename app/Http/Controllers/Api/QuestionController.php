<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Collage;
use App\Models\Question;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Controllers\Api\Traits\ApiResponse;

class QuestionController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $questions = Question::all();

        return $this->successResponse(QuestionResource::collection($questions), "Show All Questions", 200);
    }

    public function store(QuestionRequest $request)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;
        $specialization_id = Specialization::where('uuid', $request->specialization_id)->first()->id;
        $term_id = $request->has('term_id') ? Term::where('uuid', $request->term_id)->first()->id : null;
        
        $question = Question::create([
            'content' => $request->content,
            'reference' => $request->reference,
            'term_id' => $term_id,
            'collage_id' => $collage_id,
            'specialization_id' => $specialization_id
        ]);
        return $this->successResponse(new QuestionResource($question), "New Question Created Successfully", 201);
    }

    public function show(Question $question)
    {
        return $this->successResponse(new QuestionResource($question), "Show Question  Successfully", 200);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $collage_id = Collage::where('uuid', $request->collage_id)->first()->id;
        $specialization_id = Specialization::where('uuid', $request->specialization_id)->first()->id;
        $term_id = $request->has('term_id') ? Term::where('uuid', $request->term_id)->first()->id : null;
        
        $question->update([
            'content' => $request->content,
            'reference' => $request->reference,
            'term_id' => $term_id,
            'collage_id' => $collage_id,
            'specialization_id' => $specialization_id
        ]);
        return $this->successResponse(new QuestionResource($question), "Question Updated Successfully", 200);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return $this->successResponse(null, "Question Deleted Successfully", 200);
    }
}