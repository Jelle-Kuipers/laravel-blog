@include('layouts.head')
@include('layouts.header')

<div class="h-full w-full items-center justify-center grid grid-cols-2 gap-6">
    <div class="flex flex-col h-3/4 items-center justify-around py-20">
        <h1 class="text-6xl text-purple-600">Welcome to:</h1>
            <h1 class="text-8xl text-purple-800">FictitiousForums</h1>
        <h2 class="text-4xl text-purple-500">Start reading and start blogging!</h2>
    </div>
    <div class="flex flex-col h-3/4 items-center justify-around py-20">
        <img style="height: 400px;" src="{{ asset('img/FF_logo.svg') }}" alt="Image">
    </div>
</div>
<div></div>
</div>


@include('layouts.footer')
