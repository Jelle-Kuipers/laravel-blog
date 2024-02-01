@include('layouts.head')
@section('Feed', 'title')

<h1>Create</h1>
<form action={{ route('post@createPost') }} method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Post Title</label>
    <input type="text" name="title" id="title">
    <label for="description">Post Description</label>
    <input type="text" name="description" id="description">
    <label for="topic_id">Post Topic Id</label>
    <input type="text" name="topic_id" id="topic_id">
    <label for="content">Post content</label>
    <input type="text" name="content" id="content">
    <label for="thumbnail">Post Image</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <button type="submit">create</button>
</form>
<hr>
<h1>Update</h1>
<form action={{ route('post@updatePost') }} method="POST" enctype="multipart/form-data">
    @csrf
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
    <label for="description">Post Description</label>
    <input type="text" name="description" id="description">
    <label for="title">Post Title</label>
    <input type="text" name="title" id="title">
    <label for="topic_id">Post Topic Id</label>
    <input type="text" name="topic_id" id="topic_id">
    <label for="content">Post content</label>
    <input type="text" name="content" id="content">
    <label for="thumbnail">Post Image</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <button type="submit">update</button>
</form>
<hr>
<h1>Delete</h1>
<form action={{ route('post@deletePost') }} method="POST" enctype="multipart/form-data">
    @csrf
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
    <button type="submit">delete</button>
</form>
<hr>
@foreach ($posts as $post)
<h1>ID: {{$post->id}}</h1>
<h1>Title: {{$post->title}}</h1>
<h2>Author: {{$post->author}}</h2>
<h2>Description: {{$post->description}}</h2>
<h3>Topic Id: {{$post->topic_id}}</h3>
<h3>Topic title: {{$post->topic_title}}</h3>
<p>Content: {{$post->content}}</p>
<img src="{{ asset('storage/' . $post->thumbnail) }}" alt="">
<p>score: {{$post->score}}</p>
<p>created_at: {{$post->created_at}}</p>
<p>updated_at: {{$post->updated_at}}</p>
<p>HasUserVoted: {{$post->userHasVoted}}</p>
<p>Your Vote: {{$post->userVote}}</p>
@if ($post->userHasVoted == false) 
    <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }}>
        @csrf
        <input type="text" name="upvote" value="1" class="hidden">
        <button type="submit">Upvote</button>
    </form>
    <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }}>
        @csrf
        <input type="text" name="upvote" value="0" class="hidden">
        <button type="submit">Downvote</button>
    </form>
@else
    @if ($post->userVote == true)
        <form action={{ route('post@UnvoteOnPost', ['id' => $post->id]) }}>
            @csrf
            <button type="submit">Remove vote</button>
        </form>
        <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }}>
            @csrf
            <input type="text" name="upvote" value="0" class="hidden">
            <button type="submit">Downvote</button>
        </form>
    @else
    <form action={{ route('post@VoteOnPost', ['id' => $post->id]) }}>
        @csrf
        <input type="text" name="upvote" value="1" class="hidden">
        <button type="submit">Upvote</button>
    </form>
    <form action={{ route('post@UnvoteOnPost', ['id' => $post->id]) }}>
        @csrf
        <button type="submit">Remove vote</button>
    </form>
    @endif
@endif
<hr>
    
@endforeach