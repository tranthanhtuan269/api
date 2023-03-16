<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'category' => $this->category,
            'type' => $this->type,
            'difficulty' => $this->difficulty,
            'question' => $this->question,
            'correct_answer' => $this->correct_answer,
            'incorrect_answers' => $this->answers
        ];
    }
}
