<div class="col">
    <div class="card h-100 custom-card">
        @if(Auth::user()->role == 'admin' || $course->professor == Auth::user()->id)
            <div class="admin-buttons">
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary me-2" aria-label="Edit"><x-lucide-pencil/></a>
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" aria-label="Delete" class="btn btn-danger"><x-lucide-trash-2/></button>
                </form>
            </div>
        @endif
        <div class="card-content-wrapper">
            <div class="card-content">
                <h5 class="card-title fw-bold">{{ $course->name }}</h5>
                <p class="card-text">{{ substr($course->description, 0, 100) }}</p>
                <p class="card-text">Difficulty: {{ $course->diff }}</p>
                <p class="card-text">Created: {{ $course->prof->name }}</p>

                <div class="button-group">
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">See details</a>
                    @if(count($course->users) != 0)
                        {{-- U kursu je... --}}
                        @if($course->users[0]->pivot->completed)
                            <div class="progress_button completed">
                                Completed <x-lucide-circle-check-big />
                            </div>
                        @else
                            <div class="progress_button joined">
                                Joined <x-lucide-circle />
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <a href="{{ route('courses.show', $course->id) }}" class="card-image" style="background-image: url('{{ asset('storage/' . $course->image) }}');"></a>
        </div>
        <div class="card-footer text-white">
            {{ date_format(date_create($course->created_at), 'd.m.Y. H:i') }}, {{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}
        </div>
    </div>
</div>
