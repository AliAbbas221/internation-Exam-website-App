<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Collage;
use App\Models\Question;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\QuestionResource;
use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Resources\QuestionAnswerResource;

class QuestionHandlingController extends Controller
{
    use ApiResponse;
    public function spcializationTermQuestions(Specialization $specialization)
    {
        //get  all questions of all terms of specific specialization
        $questions = $specialization->questions()->whereNotNull('term_id')->get();

        return $this->successResponse(QuestionResource::collection($questions), 'Questions of All Terms');
    }

    public function spcializationBookQuestions(Specialization $specialization)
    {
        //get  book questions of specific specialization

        $questions = $specialization->questions()->whereNull('term_id')->get();

        return $this->successResponse(QuestionResource::collection($questions), 'Questions of Specialization');
    }

    public function getTermQuestions(Term $term)
    {
        //get  all questions of specific term

        $questions = $term->questions()->get();

        return $this->successResponse(QuestionResource::collection($questions), 'Questions of Term');
    }

    public function getTestQuestions(Collage $collage)
    {
        //get 50 random questions
        $questionRand = $collage->questions()
            ->inRandomOrder()
            ->limit(50)
            ->get();

        return $this->successResponse(QuestionAnswerResource::collection($questionRand), "Show 50 Random Questions");
    }
}