<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Student;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('student')->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $students = Student::all();
        return view('feedback.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'feedback_text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'submitted_at' => 'required|date',
        ]);
        Feedback::create($request->all());
        return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully.');
    }

    public function show($id)
    {
        $feedback = Feedback::with('student')->findOrFail($id);
        return view('feedback.show', compact('feedback'));
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        $students = Student::all();
        return view('feedback.edit', compact('feedback', 'students'));
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
        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}
