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
