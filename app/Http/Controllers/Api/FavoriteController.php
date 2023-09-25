<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\UserResource;
use App\Models\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use ApiResponse;
    public function addFavorite(Question $question)
    {
        auth()->user()->favorites()->syncWithoutDetaching($question->id);
        $data = [
            'user' => new UserResource(auth()->user()),
            'question' => new QuestionResource($question)
        ];
        return $this->successResponse($data, 'Question Added to Favorites Successfully');
    }

    public function toggleFavorite(Question $question)
    {
        $user = auth()->user();
        
        if ($user->favorites->contains($question)) {
            $user->favorites()->detach($question);
            return $this->successResponse('Question Removed from Favorites');
        }
        $user->favorites()->attach($question);
        
        return $this->successResponse('Question Added to Favorites Successfully');
    }

    public function getFavorites()
    {
        $user = auth()->user();
        $favoriteQuestions = $user->favorites;
        return $this->successResponse(QuestionResource::collection($favoriteQuestions), 'Show Favorite Questions Successfully');
    }
}