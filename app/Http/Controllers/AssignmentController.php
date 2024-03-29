<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use App\Models\Content;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AssignmentController.
 */
class AssignmentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Assignments for the instructors
     */
    public function index()
    {
        $courses = Auth::user()->courses()->has('assignments')->get();

        return view('theme::dashboard.assignments.index', compact('courses'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * View all assignments
     */
    public function assignmentsByCourse($course_id)
    {
        $course = Course::find($course_id);
        $assignments = $course->assignments()->with('submissions')->paginate(50);

        return view('theme::dashboard.assignments.assignments', compact('course', 'assignments'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submissions($assignment_id)
    {
        $assignment = Content::find($assignment_id);
        $submissions = $assignment->submissions()->paginate(50);

        return view('theme::dashboard.assignments.submissions', compact('title', 'assignment', 'submissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * All submission for the quiz
     */
    public function submission($submission_id)
    {
        $submission = AssignmentSubmission::find($submission_id);

        return view('theme::dashboard.assignments.submission', compact('title', 'submission'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * Evaluating the quiz
     */
    public function evaluation(Request $request, $submission_id)
    {
        $submission = AssignmentSubmission::find($submission_id);
        $max_number = $submission->assignment->option('total_number');

        $rules = ['give_numbers' => "required|numeric|max:{$max_number}"];
        $this->validate($request, $rules);

        $user_id = Auth::id();
        $time_now = Carbon::now()->toDateTimeString();

        $data = [
            'instructor_id' => $user_id,
            'earned_numbers' => $request->give_numbers,
            'instructors_note' => clean_html($request->evaluation_notes),
            'is_evaluated' => 1,
            'evaluated_at' => $time_now,
        ];

        $submission->update($data);

        return redirect()->back();
    }
}
