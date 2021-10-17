<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\UserQuestion;
use App\Models\UserQuestionImage;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Image;

class SurveyController extends Controller
{
    public function startSurvey()
    {
        $category = QuestionCategory::where('status', 1)->first();
        $inputQuestions = Question::where('category_id', $category->id)->where('status', 1)->orderByRaw('-position DESC', 'id DESC')->get();
        return view('user.survey.start-survey', compact('inputQuestions'));
    }
    public function submitSurvey(Request $request)
    {
        $ip = $request->ip; // the IP address to query
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

        $userQuestionId = UserQuestion::create([
            'created_by' => Auth::guard('web')->user()->id,
            'latitude' => $query['lat'] ? $query['lat'] : 23.810331,
            'longitude' => $query['lon'] ? $query['lon'] : 90.412521,
        ]);
        for ($i = 1; $i <= $request->question_length; $i++) {
            $ans = array();
            $type = "question_type" . $i;
            if ($request->$type == "1") {
                $name = "input_ans" . $i;
            } else if ($request->$type == "2") {
                $name = "dropdown_ans" . $i;
            } else if ($request->$type == "3") {
                $name = "mcq_ans" . $i;
            } else {
                $name = "checkbox_ans" . $i;
            }

            $user_question_id = $userQuestionId->id;
            $question_id = "question_id" . $i;
            $others = "others" . $i;
            $ans['question_id'] = $request->$question_id;

            if ($request->$type == "4") {
                $ans['question_ans'] = json_encode($request->$name);
                $ans['others'] = $request->$others;
            } else {
                $ans['question_ans'] = $request->$name;
                $ans['others'] = $request->$others;
            }
            $ans['user_question_id'] = $user_question_id;
            DB::table('question_answers')->insert($ans);
        }
        if ($request->hasFile('images')) {
            foreach ($request->images as $key => $i) {
                $image = $request->file('images')[$key];
                $filename = $image->hashName();
                $location = 'assets/backend/images/user/' . $filename;
                Image::make($image)->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);
                UserQuestionImage::create([
                    'user_question_id' => $userQuestionId->id,
                    'image' => $request->hasFile('images') ? $location : null,
                ]);
            }
        }
        return back()->withSuccess('Survey Submitted Successful');
    }

    /* Collected Data */
    public function userCollectedData()
    {
        return view('user.survey.collected-data');
    }

    public function getCollectedData(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = UserQuestion::where('created_by', Auth::guard('web')->user()->id)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('date', function ($list) {
                    return '<td>' . Carbon::parse($list->created_at)->format('d M Y') . '</td>';
                })
                ->editColumn('time', function ($list) {
                    return '<td>' . Carbon::parse($list->created_at)->format('h:i A') . '</td>';
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('user.view.collected.data', ['id' => $list->id, 'user_id' => $list->created_by]) . '" class="btn btn-primary text-white pl-1 pr-1"> <span class="fas fa-eye"></span> Show Data </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['date', 'time', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }
    public function userViewCollectedData($id, $user_id)
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
        return view('user.survey.view-collected-data', compact('answer', 'questions', 'answer_images'));
    }
}
