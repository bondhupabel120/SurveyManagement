<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\QuestionCategory;
use App\Models\User;
use App\Models\UserQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{
    public function showSurvey()
    {
        return view('backend.questionAnswer.show-survey');
    }

    public function getSurveyAll(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = UserQuestion::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('userName', function ($list) {
                    if ($list->created_by) {
                        return $list->userName->name;
                    } else {
                        return null;
                    }
                })
                ->editColumn('date', function ($list) {
                    return Carbon::parse($list->created_at)->format('d M Y');
                })
                ->editColumn('time', function ($list) {
                    return Carbon::parse($list->created_at)->format('h:i A');
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('view.survey', ['id' => $list->id, 'user_id' => $list->created_by]) . '" class="btn btn-primary text-white pl-2 pr-2"> <span class="fas fa-eye"></span> Show Data </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['userName', 'date', 'time', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function viewSurvey($id, $user_id)
    {
        $category = QuestionCategory::where('status', 1)->first();
        $questions = DB::table('questions')->where('category_id', $category->id)->get();

        $answer = DB::table('question_answers')
            ->join('user_questions', 'user_questions.id', '=', 'question_answers.user_question_id')
            ->join('questions', 'questions.id', '=', 'question_answers.question_id')
            ->where('user_question_id', $id)
            ->get();
        $answer_images = DB::table('user_question_images')
            ->join('user_questions', 'user_question_images.user_question_id', '=', 'user_questions.id')
            ->where('user_question_images.user_question_id', $id)
            ->select('user_question_images.image')
            ->get();

        return view('backend.questionAnswer.single-survey', compact('questions', 'answer', 'answer_images'));
    }

    public function showMaps($id)
    {
        $map = UserQuestion::findorFail($id);
        return view('backend.questionAnswer.maps', compact('map'));
    }

    public function showMapsAll()
    {
        $maps = UserQuestion::get();
        return view('backend.questionAnswer.all_maps', compact('maps'));
    }
}
