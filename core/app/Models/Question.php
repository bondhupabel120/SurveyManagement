<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }
    public function categoryName()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id', 'id');
    }

    /* Question */
    public static function saveQuestionData($request)
    {
        $questionId = Question::create([
            'category_id' => $request->category_id,
            'type' => $request->type,
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if ($request->option != '') {
            foreach ($request->option as $key => $i) {
                QuestionOption::create([
                    'question_id' => $questionId->id,
                    'option' => $request->option[$key],
                ]);
            }
        }
    }
    public static function updateQuestionData($request)
    {
        $question = Question::find($request->id);
        $question->category_id = $request->category_id;
        $question->type = $request->type;
        $question->name = $request->name;
        $question->status = $request->status;
        $question->save();
        QuestionOption::where('question_id', $request->id)->delete();
        if ($request->option != '') {
            foreach ($request->option as $key => $i) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option' => $request->option[$key],
                ]);
            }
        }
    }
    public static function deleteQuestionData($request)
    {
        $question = Question::find($request->id);
        if ($question != null) {
            QuestionOption::where('question_id', $request->id)->delete();
            $question->delete();
        }
    }

    public static function UpdatePosition($request)
    {
        $position = Question::find($request->id);
        if ($position != null) {
            $position->position = $request->position_number;
            $position->save();
        }
    }
}
