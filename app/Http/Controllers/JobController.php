<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\AddJobRequest;
use App\Http\Requests\EditJobRequest;
use App\Models\Vacancy;
use App\Models\Application;
use App\Models\inquiry;
use App\Models\Review;
use App\Models\User;
use Auth;
use Carbon\Carbon;
class JobController extends Controller
{
    public function addJobForm()
    {
        
        if (Auth::user()->role != 1) {
            return redirect('/');
            //abort(403);
        }
        $categories = Category::all();
        return view('create_jobs', ['categories' => $categories]);
    }

    public function addJob(AddJobRequest $request)
    {
        if (Auth::user()->role != 1) { //Auth is called a facade
            return redirect('/');
            //abort(403);
        }
        $title = $request->title;
        $category = $request->category;
        $type = $request->type;
        $salary = $request->salary;
        $deadline = $request->deadline;
        $description = $request->description;

        Vacancy::create([
            'title'=>$title,
            'user_id'=> Auth::id(), //Auth::user()->email user is the table name there to access the column of that table
            'category_id'=>$category,
            'type'=>$type,
            'salary'=>$salary,
            'deadline'=>$deadline,
            'description'=>$description
        ]);

        return redirect('/dashboard')->with('message', 'job added sucessfully');

    }

    public function listJobs(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->get('category');
        $search = $request->get('search');
        $vacancy = Vacancy::all()->count();


        if ($category_id && $search) {
            $jobs = Vacancy::where('category_id', $category_id)->where('title', $search)->paginate(3)->withQueryString();
        }
        elseif ($category_id && !$search ) {
            $jobs= Vacancy::where('category_id', $category_id)->paginate(3)->withQueryString(); // $jobs is vacancy model where category id is our input and we paginate the results
        }

        elseif (!$category_id && $search) {
            $jobs = Vacancy::where('title', 'like', '%'.$search.'%')->paginate(3)->withQueryString(); // % means word before it and after it
        }
        else{
            $jobs = Vacancy::paginate(2);
        }
        
        // if ($request->has('category')) {
        //     $category_id = $request->category;
        //     // Filter jobs based on the selected category
        //     // $jobs = Vacancy::where('category_id', $request->category)->paginate(3);
        //     $jobs = Vacancy::where('category_id', $category_id)->paginate(3);
        //     if ($request->has('search')) {
        //         $jobs = Vacancy::where('title', $request->search)->paginate(3);
        //     }
        // } else {
        //     // No filter applied, so get all vacancies
        //     $jobs = Vacancy::paginate(3);
        // }
    
        return view('jobs', ['jobs' => $jobs, 'categories' => $categories, 'vacancy' => $vacancy]);
    }

    public function profileJobs(Request $request){
        //this is for showing jobs in the portfolio
        $categories = Category::all();
        $category_id = $request->get('category');
        $search = $request->get('search');
        $vacancy = Vacancy::all()->count();


        if ($category_id && $search) {
            $jobs = Vacancy::where('category_id', $category_id)->where('title', $search)->paginate(3)->withQueryString();
        }
        elseif ($category_id && !$search ) {
            $jobs= Vacancy::where('category_id', $category_id)->paginate(3)->withQueryString(); // $jobs is vacancy model where category id is our input and we paginate the results
        }

        elseif (!$category_id && $search) {
            $jobs = Vacancy::where('title', 'like', '%'.$search.'%')->paginate(3)->withQueryString(); // % means word before it and after it
        }
        else{
            $jobs = Vacancy::paginate(3);
        }
        

        $reviews = Review::where('status', 1)->get();
       

        return view('welcome', ['jobs'=>$jobs, 'categories'=> $categories, 'vacancy'=> $vacancy, 'reviews'=>$reviews]);
    }

    public function inquiry(Request $request){
        $request->validate([
            'name'=>['required', 'string', 'max:100'],
            'email'=>['required', 'string', 'lowercase', 'email', 'max:200'],
            'inquiry'=>['required'],
            'message'=>['required', 'string'],
        ]);

        $inquiry = Inquiry::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'inquiry'=>$request->inquiry,
            'message'=>$request->message
        ]);
        return redirect()->route('home')->with('inquiry', 'inquiry message sent successfully');
    }
    public function inquiryList()
    {
        $inquiries = Inquiry::paginate(4);
        return view('inquiry',['inquiries'=>$inquiries]);
    }

    public function deleteInquiry(Request $request)
    {
        // Check if user is authenticated and has role 2
        
        if (Auth::check() && Auth::user()->role == 2) {
            $inquiry_id = $request->id;
            $inquiry = Inquiry::find($inquiry_id);

            if ($inquiry) {
                $inquiry->delete();
                return redirect()->route('dashboard')->with('deleteInquiry', 'Inquiry deleted successfully.');
            } else {
                return redirect()->route('dashboard')->with('error', 'Inquiry not found.');
            }
        } else {
            // If not authorized
            abort(403, 'Unauthorized action.');
        }
    }



    // public function listMyJobs(){
    //     $user_id = Auth::id();
    //     // $jobs = Vacancy::where('user_id', Auth::id())->get();
    //     // $jobs = Vacancy::where('user_id', $user_id)->get();
    //     //$jobs = Vacancy::where('user_id', $user_id)->paginate(2);// paginate for pagination
    //     $jobs = Vacancy::where('user_id', $user_id)->simplePaginate(2);// paginate for pagination
        
    //     $applications = Application::all()->count();

    //     return view('my_jobs', ['jobs'=> $jobs, 'applications'=> $applications]);
    // }
    public function listMyJobs()
{
    $user_id = Auth::id();

    // Retrieve the user's job postings with the count of related applications
    $jobs = Vacancy::where('user_id', $user_id)
                   ->withCount('applications')
                   ->simplePaginate(2);

    return view('my_jobs', ['jobs' => $jobs]);
}



    public function editJobForm(Request $request){

        if (Auth::user()->role != 1) { //Auth is called a facade
            return redirect('/');
            //abort(403);
        }
        $categories = Category::all();
        $job_id = $request->id;
        $job = Vacancy::find($job_id);
        return view('edit_job',['categories' => $categories], ['job' => $job]);
    }
    public function editJob(EditJobRequest $request){

        if (Auth::user()->role != 1) { //Auth is called a facade
            return redirect('/');
            //abort(403);
        }
        $title = $request->title;
        $category = $request->category;
        $type = $request->type;
        $salary = $request->salary;
        $deadline = $request->deadline;
        $description = $request->description;

        $job_id = $request->id;
        $job = Vacancy::find($job_id);
        if (!$job) {
            return redirect('/dashboard')->with('error', 'Job not found');
        }

        $job->update([
            'title'=>$title,
            'user_id'=> Auth::id(), //Auth::user()->email user is the table name there to access the column of that table
            'category_id'=>$category,
            'type'=>$type,
            'salary'=>$salary,
            'deadline'=>$deadline,
            'description'=>$description
        ]);

        return redirect('/my-jobs')->with('message', 'Job Updated Sucessfully');

     }

     public function deleteJob(Request $request){
        $job_id = $request->id;
        $job = Vacancy::find($job_id);
        $job->delete();
        return redirect('/my-jobs')->with('delete', 'Job Deleted Sucessfully');
        
     }
     public function jobsLayout(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->get('category');
        $search = $request->get('search');
        $vacancy = Vacancy::all()->count();


        if ($category_id && $search) {
            $jobs = Vacancy::where('category_id', $category_id)->where('title', $search)->paginate(3)->withQueryString();
        }
        elseif ($category_id && !$search ) {
            $jobs= Vacancy::where('category_id', $category_id)->paginate(3)->withQueryString(); // $jobs is vacancy model where category id is our input and we paginate the results
        }

        elseif (!$category_id && $search) {
            $jobs = Vacancy::where('title', 'like', '%'.$search.'%')->paginate(3)->withQueryString(); // % means word before it and after it
        }
        else{
            $jobs = Vacancy::paginate(3);
        }
        return view('joblayout', ['jobs' => $jobs, 'categories' => $categories, 'vacancy' => $vacancy]);
    }

    public function deleteTodayDeadline()
    {
        $today = Carbon::today()->toDateString();

        $deleted = Vacancy::whereDate('deadline', '<', $today)->delete();

        if ($deleted > 0) {
            return redirect()->back()->with('successd', "jobs with a deadline before today deleted successfully.");
        } else {
            return redirect()->back()->with('successn', 'No jobs found with a deadline before today.');
        }
    }

    public function dashboardView()
    {
        $normalUsers = User::where('role', 0)->count();
        $employers = User::where('role', 1)->count();
        $total = User::whereIn('role', [0,1])->count();
        // $superAdmins = User::where('role', 2)->count();
        
        $jobs = Vacancy::all()->count();
        $applications = Application::all()->count();
        $inquiries = Inquiry::all()->count();
        $reviews = Review::all()->count();
        return view('dashboard', compact('normalUsers', 'employers', 'total', 'jobs', 'applications', 'inquiries', 'reviews'));
    }

  
}
