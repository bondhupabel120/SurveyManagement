<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    /* Question Category */
    public static function saveQuestionCategoryData($request){
        QuestionCategory::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
    }
    public static function updateQuestionCategoryData($request){
        $category = QuestionCategory::find($request->id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();
    }
}
