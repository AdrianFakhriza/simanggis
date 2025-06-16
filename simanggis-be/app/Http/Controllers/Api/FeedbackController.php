<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Student;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('student')->get();
        return response()->json($feedbacks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'feedback_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'submitted_at' => 'required|date',
        ]);
        $feedback = Feedback::create($request->all());
        return response()->json(['message' => 'Feedback submitted successfully.', 'feedback' => $feedback]);
    }

    public function show($id)
    {
        $feedback = Feedback::with('student')->findOrFail($id);
        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'feedback_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'submitted_at' => 'required|date',
        ]);
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());
        return response()->json(['message' => 'Feedback updated successfully.', 'feedback' => $feedback]);
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return response()->json(['message' => 'Feedback deleted successfully.']);
    }
}
