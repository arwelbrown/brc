<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Models\Submission;
use Carbon\Carbon;

class SubmissionForm extends Component
{
    use WithFileUploads;

    #[Rule('file')]
    public $submission;

    public string $fullName;
    public string $bookName;
    public string $email;

    public function save()
    {
        $email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
        
        $filePath = 'submissions/' . $this->submission->getClientOriginalName();
        
        $file = $this->submission->storeAs('', $filePath, 'public');
        
        if (!$file) {
            session()->flash('error');
            return;
        }

        Submission::insert([
            'name' => $this->fullName,
            'email' => $email,
            'file_name' => $file,
            'created_at' => Carbon::now(),
        ]);

        $this->reset();
        session()->flash('success', 'Thank you, your book has been submitted!');

        return;
    }

    public function render()
    {
        return view('livewire.submission-form');
    }
}
