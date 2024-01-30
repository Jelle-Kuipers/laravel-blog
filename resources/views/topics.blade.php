@include('layouts.head')
@section('Feed', 'title')

<h1>Create</h1>
<form action={{ route('topic@createTopic') }} method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Topic Title</label>
    <input type="text" name="title" id="title">
    <label for="description">Topic Description</label>
    <input type="text" name="description" id="description">
    <label for="thumbnail">Topic Image</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <button type="submit">create</button>
</form>
<hr>
<h1>Update</h1>
<form action={{ route('topic@updateTopic') }} method="POST" enctype="multipart/form-data">
    @csrf
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
    <label for="title">Topic Title</label>
    <input type="text" name="title" id="title">
    <label for="description">Topic Description</label>
    <input type="text" name="description" id="description">
    <label for="thumbnail">Topic Image</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <button type="submit">update</button>
</form>
<hr>
<h1>Delete</h1>
<form action={{ route('topic@deleteTopic') }} method="POST" enctype="multipart/form-data">
    @csrf
    <label for="id">ID</label>
    <input type="text" name="id" id="id">
    <button type="submit">delete</button>
</form>
