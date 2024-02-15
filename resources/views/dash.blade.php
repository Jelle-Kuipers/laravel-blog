@include('layouts.head')
@include('layouts.header')
        <!-- Page Content-->
        <section>
            <div class="container px-4 px-lg-5 mt-3">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-6">
                        <h1 class="mt-5">Fictional forums</h1>
                        <p>Welcome {{$user->name}}, It's good to see you. How about we start reading some new blogs?</p>
                    </div>
                    <img src="{{ asset('img/index.png') }}" alt="">
                </div>
            </div>
@include('layouts.footer')
