@include('layouts.head')
@section('Feed', 'title')

<h1>lol</h1>
<form action={{ route('topic@createTopic') }} method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Topic Title</label>
    <input type="text" name="title" id="title">
    <label for="description">Topic Description</label>
    <input type="text" name="description" id="description">
    <label for="thumbnail">Topic Image</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <button type="submit">submit</button>
</form>
