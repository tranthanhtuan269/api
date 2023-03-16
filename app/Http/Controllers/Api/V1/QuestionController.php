<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\QQuestion;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\QuestionResource;
use App\Http\Resources\V1\QuestionCollection;
use Illuminate\Support\Facades\Cache;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cache::forget('question_collection');
        $question_collection = Cache::rememberForever('question_collection', function () {
            return json_encode(new QuestionCollection(QQuestion::all()));
        });
        // dd($question_collection);
        return $question_collection;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QQuestion $question)
    {
        // return $question;
        return new QuestionResource($question);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
