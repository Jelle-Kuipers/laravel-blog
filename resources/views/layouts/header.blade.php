<body class="bg-gray-900 font-family-karla flex flex-col h-screen justify-between">
<!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-purple-800 shadow">
        <div class="w-full container mx-auto flex justify-between">

            <nav class="justify-self-start w-1/6">
                <ul
                    class="flex items-center justify-flex-end font-bold text-sm text-white uppercase no-underline">
                    <li class="text-xl"><a class="hover:text-gray-400 hover:underline w-min"
                            href="https://github.com/Jelle-Kuipers"> <i class="fab fa-github mx-4"></i></a></li>
                    <li class="text-xl"><a class="hover:text-gray-400 hover:underline w-min"
                            href="https://www.linkedin.com/in/jelle-kuipers/"> <i class="fab fa-linkedin mx-4"></i></a>
                    </li>
                </ul>
            </nav>

            <div class="flex flex-col items-center w-1/6">
                <a class="font-bold text-white uppercase hover:text-purple-400 text-3xl justify-self-center" href="/">
                    FictitiousForums
                </a>
            </div>

            <div class="flex items-center text-lg no-underline text-white justify-self-end w-1/6">
                <a class="hover:text-gray-200 hover: mx-2 border-0 border-purple-600 px-1 rounded-lg bg-purple-600 hover:bg-purple-700"
                    href="">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
                <a class="hover:text-gray-200 hover: mx-2 border-0 border-red-500 px-1 rounded-lg bg-red-500 hover:bg-red-600"
                    href="">
                    <i class="fas fa-sign-out-alt"></i> Log out
                </a>
            </div>
        </div>

    </nav>
    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b border-purple-800 bg-gray-800">
        <div class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div
                class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold text-white uppercase mt-0 px-6 py-2">
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Home</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Topics</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Posts</a>
                @if ($userdata->hasAdminPermission)
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Admin-panel</a> 
                
                @endif
            </div>
        </div>
    </nav>
    <div class="container mx-auto h-full py-6 mb-auto">
