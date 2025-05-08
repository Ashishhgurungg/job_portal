<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Category;
use App\Http\Requests\AddApplicationRequest;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // Display the application form for a specific job/vacancy.
    public function ApplicationForm($id)
    {
        // Retrieve the Vacancy using the provided id.
        // Using findOrFail will throw a 404 error if the vacancy doesn't exist.
        $job = Vacancy::findOrFail($id);
        
        // Pass the vacancy to the view so its details (like title) can be displayed.
        return view('create_application', ['job' => $job]);
    }

    // Handle the submission of the application form.
    public function ApplicationPost(AddApplicationRequest $request, $id)
    {
        // Ensure only users with a role of 0 can apply.
        if (Auth::user()->role != 0) {
            return redirect('/dashboard')->with('error', 'Cannot access this page');
        }
        
        // Retrieve the Vacancy using the route parameter.
        $job = Vacancy::findOrFail($id);
        
        // Check if the user has already applied for this vacancy.
        $existingApplication = Application::where('user_id', Auth::id())
                                        ->where('vacancy_id', $job->id)
                                        ->first();
        if ($existingApplication) {
            return redirect('/dashboard')->with('error', 'You have already applied for this job.');
        }
        
        // Initialize resume filename.
        $resume_name = '';
        
        // Handle the file upload for the resume.
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resume_name = $resume->hashName(); // Generate a unique filename.
            $resume->move('uploads/resumes/', $resume_name); // Move the file to uploads directory.
        } else {
            return redirect()->back()->with('error', 'Resume file is required.');
        }

        // Create the Application record using the collected data.
        Application::create([
            'resume'       => $resume_name,      // Stored file name for the resume.
            'cover_letter' => $request->cover,   // Cover letter text.
            'status'       => $request->status,
            'user_id'      => Auth::id(),        // Authenticated user's id.
            'vacancy_id'   => $job->id,          // Vacancy id from the retrieved job.
        ]);

        // Redirect to the dashboard with a success message.
        return redirect('/dashboard')->with('message', 'Applied successfully for the Job');
    }


    public function AppList(Request $request){
        $user_id = Auth::id();
        $applications = Application::where('user_id', $user_id)->simplePaginate(3);
        return view('application',['applications'=> $applications]);
    }

    public function deleteApplication(Request $request)
    {
        $application_id = $request->id;
        $application = Application::find($application_id);
        $application->delete();
        return redirect('/dashboard')->with('deleteApp', 'Application deleted successfully');
    }

    public function appliers($id)
    {
        // Import Category model at the top if not already done:
        // use App\Models\Category;

        // Retrieve all categories (if needed in the view)
        $categories = Category::all();

        // Retrieve the job; using findOrFail ensures a 404 if not found.
        $job = Vacancy::findOrFail($id);

        // Retrieve all applications for this job
        $applicants = Application::where('vacancy_id', $id)->get();

        // Pass the data to the view using a compact method
        return view('appliers', compact('categories', 'job', 'applicants'));
    }

    public function applierDetails(Request $request)
    {
        $applicant_id = $request->id;
        $applications = Application::where('id', $applicant_id)->get();
        return view('details',['applications'=>$applications]);
    }

    public function detailsEdit(Request $request)
    {
        // Validate the request inputs: id must exist in applications and status must be one of the allowed values
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:applications,id',
            'status' => 'required|in:0,1,2,3',
        ]);
    
        // Find the application using the validated id
        $application = Application::findOrFail($validatedData['id']);
    
        // Update only the status column
        $application->update([
            'status' => $validatedData['status'],
        ]);
    
        // Redirect to the appliers route using the vacancy_id of the updated application
        return redirect()->route('appliers', ['id' => $application->vacancy_id])
        ->with('change', 'Application status updated successfully.');
    }
    

}
