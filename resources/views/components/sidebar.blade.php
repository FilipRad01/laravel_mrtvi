<style>
/* Adjustments for the <aside> element */
aside.position-fixed {
    width: 100%; /* Ensure the <aside> takes the full width of its container */
    height: 100%; /* Adjust as needed */
    overflow-y: auto; /* Enable vertical scrolling if content overflows */
    padding: 1rem; /* Optional: Add some padding inside the <aside> */
}

/* Adjustments for the sidebar to fill the <aside> width */
.sidebar {
    width: 100%; /* Make the sidebar fill the full width of the <aside> */
    background-color: #f0f0f0; /* Light grey background */
    padding: 20px; /* Padding inside the sidebar */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

/* Style for the course list */
.course-list {
    list-style-type: none; /* Remove default list styling */
    padding: 0; /* Remove default padding */
    margin: 0; /* Remove default margin */
}

/* Style for each course list item */
.course-list li {
    padding: 10px; /* Padding around the text */
    margin-bottom: 5px; /* Space between items */
    background-color: #fff; /* White background */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

/* Hover effect for course list items */
.course-list li:hover {
    background-color: #e0e0e0; /* Light grey background on hover */
}

/* Style for the course name link */
.course-list li a {
    text-decoration: none; /* Remove underline */
    color: #333; /* Dark grey text */
    display: block; /* Make the link fill the entire list item */
}

/* Hover effect for the course name link */
.course-list li a:hover {
    color: #007bff; /* Blue text on hover */
}

.side_bar{
    
}

.sidebar_img{
    width: 36px;
    height: 36px;
    border-radius: 100%;
}

.progress_button {
    padding: 2px;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-bottom: 6px;
    width: 33%;
    text-align: center;
    font-weight: bold;
    border-radius: 15px;
}

.completed {
    color: rgb(0, 58, 22);
    background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(43,199,19,1) 0%, rgba(0,255,106,1) 100%);
    
}

.joined {
    color: rgb(234, 237, 255);
    background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(19,174,199,1) 0%, rgba(0,129,255,1) 100%);
}

</style>
<aside class="position-fixed d-none d-md-block side_bar right-0 bottom-0 h-100 overflow-auto bg-light" style="top: 4rem; z-index: 40; width: 16rem; transition: transform 0.3s ease; right:0;">
    
        <ul class="course-list">
            @foreach($courses as $course)
                <li>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn d-flex gap-3 justify-content-start align-items-center text-uppercase fw-bold">
                        <img src="{{ asset('storage/'.$course->image) }}" alt="category item" class="sidebar_img">
                        {{ $course->name }}
                    
                        @if(count($course->users) != 0)
                        {{-- U kursu je... --}}
                        @if($course->users[0]->pivot->completed) 
                            <div class="progress_button completed">
                                <x-lucide-circle-check-big />
                            </div>
                        @else
                            <div class="progress_button joined">
                                <x-lucide-circle />
                            </div>
                        @endif
                    @endif
                    </a>
                </li>
            @endforeach
        </ul>
    
</aside>
