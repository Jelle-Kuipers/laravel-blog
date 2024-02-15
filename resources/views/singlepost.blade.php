@include('layouts.head')
{{-- page title --}}
<title>Fictional Forums - {{ $post->title }}</title>
@include('layouts.header')
<div class="container">
    <div class="row">
        <!-- Posts box -->
        <div class="col-lg-12" style="margin-top: 1.5rem;">
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <div class="d-flex">
                        <h1 class="fw-bolder mb-1 flex-grow-1">{{ $post->title }}</h1>
                        @if ($user->permission->create_update_post == 1 && $user->id == $post->user_id)
                            <a id="switch" class="btn btn-warning d-flex align-items-center"><i id="stopIcon"
                                    class="fa-solid fa-ban d-none"></i> <i id="editIcon"
                                    class="fa-solid fa-pen-to-square"></i><span id="switchText" class="ms-1">Edit
                                    post</span></a>
                        @endif
                        @if (($user->permission->delete_post == 1 && $user->id == $post->user_id) || $user->permission->delete_others_post == 1)
                            <a id="delete" class="btn btn-danger d-flex align-items-center ms-2">
                                <i class="fa-solid fa-trash-can"></i><span id="switchText" class="ms-1">Delete
                                    post</span></a>
                            <form action="{{ route('post@deletePost', ['id' => $post->id]) }}" method="POST"
                                id="deleteForm" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on {{ $post->created }} by {{ $post->author }}</div>
                    <!-- Post Topic-->
                    <a class="badge bg-secondary text-decoration-none link-light"
                        href="#!">{{ $post->topic_title }}</a>
                    <div class="d-flex align-items-center flex-grow-1 my-3">
                        <div class="me-2">
                            Score: {{ $post->score }}
                        </div>
                        <div class="d-flex flex-column">
                            @if ($post->userHasVoted == false)
                                <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                    @csrf
                                    <input type="text" name="upvote" value="1" class="d-none">
                                    <button type="submit" class="btn btn-link p-0"><a class="text-body"><i
                                                class="fa-solid fa-up-long mb-1"></i></a></button>
                                </form>
                                <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                    @csrf
                                    <input type="text" name="upvote" value="0" class="d-none">
                                    <button type="submit" class="btn btn-link p-0"><a type="submit"
                                            class="text-body"><i class="fa-solid fa-down-long mt-1"></i></a></button>
                                </form>
                            @else
                                @if ($post->userVote == true)
                                    <form action={{ route('post@UnvoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0"><a class="text-danger"><i
                                                    class="fa-solid fa-up-long mb-1"></i></a></button>
                                    </form>
                                    <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                        @csrf
                                        <input type="text" name="upvote" value="0" class="d-none">
                                        <button type="submit" class="btn btn-link p-0"><a class="text-body"><i
                                                    class="fa-solid fa-down-long mt-1"></i></a></button>
                                    </form>
                                @else
                                    <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                        @csrf
                                        <input type="text" name="upvote" value="1" class="d-none">
                                        <button type="submit" class="btn btn-link p-0"><a class="text-body"><i
                                                    class="fa-solid fa-up-long mb-1"></i></a></button>
                                    </form>
                                    <form action={{ route('post@UnvoteOnPost', ['id' => $post->id]) }} class="p-0 m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0"><a class="text-primary"><i
                                                    class="fa-solid fa-down-long mt-1"></i></a></button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                    <hr>
                </header>
                <div id="post">
                    <!-- Preview image figure-->
                    <figure class="mb-4">
                        <img class="img-fluid rounded" src={{ $post->thumbnail_path }} alt="post thumbnail"
                            style="max-width: 1920px; max-height: 1080px; min-height: 300px;" />
                    </figure>
                    <hr>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{{ $post->description }}</p>
                        <hr>
                        <section class="mb-5">
                            {!! $post->content !!}
                        </section>
                        <hr>
            </article>
        </div>

        @if ($user->permission->create_update_post == 1)
            <script src="{{ asset('js/singlepost.js') }}"></script>
            <div id="editPost" class="d-none">
                <h3>Update this post</h3>
                <div class="col-lg-6" style="margin-top: 1.5rem;">
                    <form action="{{ route('post@updatePost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Post Image</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="topic_id" class="form-label">Post Topic</label>
                            <select name="topic_id" id="topic_id" class="form-control">
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}"
                                        {{ $topic->id == $post->topic_id ? 'selected' : '' }}>{{ $topic->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $post->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Post Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ $post->description }}">
                        </div>
                        <div class="mb-3">
                            <label for="content">Post content</label>
                            <textarea type="textarea" class="form-control" id="editor" name="content">{{ $post->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        @endif
        @if (($user->permission->delete_post == 1 && $user->id == $post->user_id) || $user->permission->delete_others_post == 1)
            <script>
                document.getElementById("delete").addEventListener("click", function() {
                    if (confirm("Are you sure you want to delete this post? \nThis action cannot be undone.")) {
                        // Redirect the user
                        document.getElementById("deleteForm").submit();
                    } else {
                        // Do nothing
                    }
                });
            </script>
        @endif
    </div>
</div>
</div>


@include('layouts.footer')
