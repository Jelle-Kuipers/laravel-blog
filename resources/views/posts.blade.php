@include('layouts.head')
{{-- page title --}}
<title>Fictional Forums - Recent Posts</title>
@include('layouts.header')
<div class="container">
    <div class="row">
        <!-- Posts box -->
        <div class="col-lg-12" style="margin-top: 1.5rem;">
            <div id="postsHead" class="d-flex justify-content-between">
                <h1>Recent Posts</h1>
                {{-- TODO, fix permission check --}}
                @if ($user->permission->create_update_post == 1)
                    <a id="switch" class="btn btn-primary d-flex align-items-center"><i id="minusIcon"
                            class="fa-solid fa-ban d-none"></i> <i id="plusIcon" class="fa-solid fa-plus"></i><span
                            id="switchText" class="ms-1">Create new post</span></a>
                @endif
            </div>
            <div id="seePosts">
                <!-- Posts sorted by age -->
                <div class="row" style="margin-top: 1.5rem;">
                    @foreach ($posts as $post)
                        <div class="col-lg-4">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href={{ route('post@singlePost', ['id' => $post->id]) }}><img class="card-img-top"
                                        src="{{ $post->thumbnail_path }}" alt="Post Thumbnail"
                                        style="max-height: 350px;" /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $post->created }} in {{ $post->topic_title }}</div>
                                    <h2 class="card-title h4">{{ $post->title }}</h2>
                                    <blockquote class="blockquote mb-0">
                                        <p>{{ $post->description }}</p>
                                        <footer class="blockquote-footer">Author: <cite
                                                title="Source Title">{{ $post->author }}</cite></footer>
                                    </blockquote>
                                    <p class="small text-muted">Score: {{ $post->score }}</p>
                                    <a class="btn btn-primary"
                                        href={{ route('post@singlePost', ['id' => $post->id]) }}>Read more <i
                                            class="fa-solid fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination-->
                {{ $posts->links('vendor.pagination.bootstrap-5') }}
                <hr>
            </div>
            @if ($user->permission->create_update_post == 1)
                <div id="newPost" class="d-none">
                    <h3>Create a new post</h3>
                    <div class="col-lg-6" style="margin-top: 1.5rem;">
                        <form action="{{ route('post@createPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Post Image</label>
                                <input required type="file" name="thumbnail" id="thumbnail" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="topic_id" class="form-label">Post Topic</label>
                                <select required name="topic_id" id="topic_id" class="form-control">
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Post Title</label>
                                <input required type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Post Description</label>
                                <input required type="text" name="description" id="description" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="content">Post content</label>
                                <textarea required type="textarea" class="form-control" id="editor" name="content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create post</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/posts.js') }}"></script>

@include('layouts.footer')
