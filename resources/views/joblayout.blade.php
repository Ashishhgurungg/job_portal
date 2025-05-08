
<div>

    <h2>Job listings</h2>
    <h3>Total Jobs: {{$vacancy}}</h3>
</div>
<form action="/jobs" method="get">
    <select name="category">
        <option value="">none</option>
    @foreach($categories as $category)
        <option value="{{ $category->id}}">{{ $category->name  }}</option>
    @endforeach
    </select>
    <input type="text" name="search" placeholder="Search here">
    <button type="submit" name="go">Go</button>
</form>
<a href="/jobs">Clear filter</a>
@forelse($jobs as $job)
    <div>
        Job Title:{{ $job->title }}
        <br>
        Salary: Nrs{{ $job->salary }}
        <br>
        Type:{{ $job->type }}
        <br>
        Description:{{ $job->description }}
        <br>
        <!-- Deadline:{{ $job->deadline->format('Y-M-d') }} -->
        Deadline:{{ $job->deadline->format('jS M Y') }}
        <br>
        Category:{{ $job->category->name }}
        <!-- by using the eloquent relation we turned that category as a function and made relation so we can access the name -->
        <br>
        Company Name:{{ $job->user->name }} 
        <!-- $job is a model, user and job(vacancy) has relation so we can access that model, but that model is a collection -->
        <br>
        Company Address:{{ $job->user->address }}
        <br>
        Company description:{{ $job->user->description }}
        <br>
        Company phone:{{ $job->user->phone }}
        <hr  style="height: 50px color:red">
        @auth
            @if(auth()->user()->role == 0)  
                <button><a href="/create-application/{{ $job->id }}">Apply</a></button>        
            @endif
        @endauth

    </div>
@empty
    No jobs found.
@endforelse

{{ $jobs->links()}}

