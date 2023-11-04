<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exceptions\SubmissionFailedException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index(): View
    {
        return view('submissions');
    }

    public function submit(Request $request)
    {
        $file = $request->file('fileName');

        try {
            Submission::insert([
                'name' => $request['fullName'],
                'email' => filter_var($request['email'], FILTER_VALIDATE_EMAIL),
                'file_name' => 'submissions/' . $file->getClientOriginalName(),
                'created_at' => Carbon::now(),
            ]);

            Storage::putFileAs('submissions', $file, $file->getClientOriginalName());

            return redirect('/submissions#submissionForm')->with('success', 'Thank you for your submission!');
        } catch(SubmissionFailedException $e) {
            return redirect('/submissions#submissionForm')->with('error', 'Submission Failed');
        }
    }
}
