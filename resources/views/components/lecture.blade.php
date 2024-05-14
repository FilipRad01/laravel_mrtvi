@props(['lectures' => array(),'joined'=>false,'prof'])

@section('styles')
    @vite(['resources/css/lecture.css'])
@endsection

<div class="lectures">
    @if (count($lectures)>0)
        <h2>Lectures</h2>
        <ul>
        <div class="container">
            <div class="row">
                @foreach($lectures as $index=>$lecture)
                    <div class="col-lg-4 mb-3">
                        <div class="card card-margin">
                            <div class="card-header no-border">
                                <h5 class="card-title">#{{ $index + 1 }}</h5>
                            </div>
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <div class="widget-49-title-wrapper">
                                        <div class="widget-49-date-primary">
                                            <h3 class="widget-49-date-day">{{ $lecture->name }}</h3>
                                        </div>
                                        <div class="widget-49-meeting-info">
                                            <span class="widget-49-pro-title">{{substr($lecture->description,0,100)}}</span>
                                        </div>
                                    </div>
                                </div>
                                @if($joined || Auth::user()->role=='admin' || $prof==Auth::user()->id)
                                <a href="{{ route('lectures.show', ['course' => $lecture->course_id, 'lecture' => $lecture->id]) }}" class="btn btn-primary">View Lecture</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        </ul>
    @endif
</div>
