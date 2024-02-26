@if (!isset($user) || empty($user))
    {{abort(500, 'Critical error, contact site administrators')}}
@endif
@include('layouts.head')
{{-- page title --}}
<title>Fictional Forums - Topics</title>
@include('layouts.header')
<div class="container">
    <div class="row">
        <!-- Topics box -->
        <div class="col-lg-12" style="margin-top: 1.5rem;">
            <div id="topicsHead" class="d-flex justify-content-between">
                <h1>Recent Topics</h1>
                @if ($user->permission->manage_topics == 1)
                    <a id="switch" class="btn btn-primary d-flex align-items-center"><i id="minusIcon"
                            class="fa-solid fa-ban d-none"></i> <i id="plusIcon" class="fa-solid fa-plus"></i><span
                            id="switchText" class="ms-1">Create a new topic</span></a>
                @endif
            </div>
            <div id="seeTopics">
                <!-- Topicss sorted by age -->
                <div class="row" style="margin-top: 1.5rem;">
                    @if ($topics->isEmpty())
                        <div class="col-lg-12">
                            <p>No topics found</p>
                        </div>
                    @else
                        @foreach ($topics as $topic)
                            <div class="col-lg-4">
                                {{-- Topic --}}
                                <div class="card mb-4">
                                    <a 
                                    href={{ route('topic@singleTopic', ['id' => $topic->id]) }}
                                    ><img class="card-img-top"
                                            src="{{ $topic->thumbnail_path }}" alt="Topic Thumbnail"
                                            style="max-height: 350px;" /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">{{ $topic->created ?: 'Data missing' }}</div>
                                        <h2 class="card-title h4">{{ $topic->title ?: 'Data missing'  }}</h2>
                                        <blockquote class="blockquote mb-0">
                                            <p>{{ $topic->description }}</p>
                                        </blockquote>
                                        <a class="btn btn-primary"
                                            
                                        href={{ route('topic@singleTopic', ['id' => $topic->id]) }}
                                        >View posts <i
                                                class="fa-solid fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Pagination-->
                {{ $topics->links('vendor.pagination.bootstrap-5') }}
                <hr>
            </div>
            @if ($user->permission->manage_topics == 1)
                <div id="newTopic" class="d-none">
                    <h3>Create a new topic</h3>
                    <div class="col-lg-6" style="margin-top: 1.5rem;">
                        <form action="{{ route('topic@createTopic') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Topic Image</label>
                                <input required type="file" name="thumbnail" id="thumbnail" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Topic Title</label>
                                <input required type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Topic Description</label>
                                <input required type="text" name="description" id="description" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create Topic</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@if ($user->permission->manage_topics == 1)
    <script src="{{ asset('js/topics.js') }}"></script>
@endif

@include('layouts.footer')
