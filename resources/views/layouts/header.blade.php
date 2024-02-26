<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href={{ route('dash@show') }}>Fictional Forums</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href={{ route('post@readPosts') }}>Recent posts</a></li>
                    <li class="nav-item"><a class="nav-link" href={{ route('topic@readTopics') }}>Topics</a></li>
                    @isset($user->hasAdminPermission)
                        <li class="nav-item"><a class="nav-link" href={{ route('admin@panel') }}>Admin Panel</a></li>
                    @endisset
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content-->
    <section>
