<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('student')->get();
        return response()->json($feedbacks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,student_id',
            'feedback_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'submitted_at' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $feedback = Feedback::create($validator->validated());
        return response()->json(['message' => 'Feedback submitted successfully.', 'feedback' => $feedback]);
    }

    public function show($id)
    {
        $feedback = Feedback::with('student')->find($id);
        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }
        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,student_id',
            'feedback_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'submitted_at' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }
        $feedback->update($validator->validated());
        return response()->json(['message' => 'Feedback updated successfully.', 'feedback' => $feedback]);
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }
        $feedback->delete();
        return response()->json(['message' => 'Feedback deleted successfully.']);
    }
}
