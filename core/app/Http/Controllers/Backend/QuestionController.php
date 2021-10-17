<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use App\Libraries\CommonFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    /* Question Category */
    public function addQuestionCategory()
    {
        return view('backend.questionCategory.add-question-category');
    }
    public function saveQuestionCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:question_categories',
        ]);
        QuestionCategory::saveQuestionCategoryData($request);
        return back()->withSuccess('Save Successfully');
    }
    public function manageQuestionCategory()
    {
        return view('backend.questionCategory.manage-question-category');
    }

    public function  getQuestionCategory(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = QuestionCategory::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('edit.question.category', ['id' => $list->id]) .
                        '" class="btn btn-primary btn-xs pl-1 pr-1"> <i class="fa fa-folder-open"></i> Edit </a> <a style="padding:2px; font-size:15px; color: #fff" class="btn btn-danger btn-xs pl-1 pr-1" id="' . $list->id . '" onClick="deleteQustionCategory(this.id,event)"> <i class="fas fa-trash"></i> Delete </a> ';
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }
    public function editQuestionCategory($id)
    {
        $category = QuestionCategory::findorFail($id);
        return view('backend.questionCategory.edit-question-category', compact('category'));
    }
    public function updateQuestionCategory(Request $request)
    {
        $category = QuestionCategory::find($request->id);
        $this->validate($request, [
            'name' =>  $request->name != $category->name ? 'required|unique:question_categories,name' : 'required',
        ]);
        QuestionCategory::updateQuestionCategoryData($request);
        return redirect()->route('manage.question.category')->withSuccess('Update Successfully');
    }
    public function deleteQuestionCategory(Request $request)
    {
        $category = QuestionCategory::find($request->id);
        $question = Question::where('category_id', $request->id)->first();
        if ($category != null) {
            if ($question == null) {
                $category->delete();
                return response()->json('success');
            } else {
                return response()->json('Something Error');
            }
        }
    }

    /* Question */
    public function addQuestion()
    {
        $categories = QuestionCategory::where('status', 1)->get();
        return view('backend.question.add-question', compact('categories'));
    }
    public function saveQuestion(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'type' => 'required',
            'name' => 'required|unique:questions',
        ]);
        Question::saveQuestionData($request);
        return back()->withSuccess('Save Successfully');
    }
    public function questionCategoryList()
    {
        return view('backend.question.category-list');
    }

    public function  questionCategoryFilter(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = QuestionCategory::where('status', 1)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('name', function ($list) {
                    $questionCount = Question::where('category_id', $list->id)->where('status', 1)->count();
                    return '<td>' . $list->name . ' (' . $questionCount . ' Questions)</td>';
                })
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {
                    return '<a href="' . route('manage.question', ['id' => $list->id]) . '" target="_blank" class="btn btn-primary text-white">
                    <span class="fa fa-eye"></span> View Question
                </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function manageQuestion($id)
    {
        return view('backend.question.manage-question', compact('id'));
    }

    public function getQuestion(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Question::where('category_id', $request->category_id)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('category_name', function ($list) {
                    return '<td>' . $list->categoryName->name . '</td>';
                })
                ->editColumn('type', function ($list) {
                    if ($list->type == 1) {
                        return 'Input/Text';
                    } elseif ($list->type == 2) {
                        return 'Dropdown';
                    } elseif ($list->type == 3) {
                        return 'MCQ';
                    } elseif ($list->type == 4) {
                        return 'Checkbox';
                    }
                })
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {
                    return '<a style="padding:2px;font-size:15px;" href="' . route('edit.question', ['id' => $list->id]) .
                        '" class="btn btn-primary btn-xs"> <i class="fa fa-folder-open"></i> Edit </a> <a style="padding:2px; font-size:15px; color: #fff" class="btn btn-danger btn-xs" id="' . $list->id . '" onClick="deleteQuestion(this.id,event)"> <i class="fas fa-trash"></i> Delete </a>
                    <a style="padding:2px; font-size:15px; color: #fff" class="btn btn-primary btn-xs" id="' . $list->id . '" name="' . $list->position . '" onClick="showMyModalSetTitle(this.id, this.name)"> <i class="fa fa-folder-open"></i> Position </a>';
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'category_name', 'type', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function SavePosition(Request $request)
    {
        $check = Question::where('position', $request->position_number)->first();
        if ($check != '') {
            return back()->withErrors('This position already taken');
        } else {
            Question::UpdatePosition($request);
        }
        return redirect()->back()->withSuccess('Update Successfully');
    }

    public function editQuestion($id)
    {
        $categories = QuestionCategory::where('status', 1)->get();
        $question = Question::findorFail($id);
        $options = QuestionOption::where('question_id', $id)->get();
        $optionCount = QuestionOption::where('question_id', $id)->count();
        return view('backend.question.edit-question', compact('categories', 'question', 'options', 'optionCount'));
    }
    public function updateQuestion(Request $request)
    {
        $question = Question::find($request->id);
        $this->validate($request, [
            'category_id' => 'required',
            'type' => 'required',
            'name' =>  $request->name != $question->name ? 'required|unique:questions,name' : 'required',
        ]);
        Question::updateQuestionData($request);
        return redirect('admin/manage/question/' . $request->category_id)->withSuccess('Update Successfully');
    }
    public function deleteQuestion(Request $request)
    {
        Question::deleteQuestionData($request);
        return response()->json('success');
    }
}
