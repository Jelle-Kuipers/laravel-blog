@include('layouts.head')
@section('Feed', 'title')

<body class="bg-gray-900 font-family-karla">

    @include('layouts.header')


    <div class="container mx-auto flex flex-wrap py-6 grid-cols-3">

        <!-- Posts Section -->
        <section class="w-full md:w-3/3 grid grid-cols-3 gap-6 place-items-stretch px-3">

            <article class="flex flex-col shadow my-4 hover:opacity-90">
                <!-- Article Image -->
                <a href="#" class="border-2 border-purple-800 rounded-t-xl overflow-hidden">
                    <img src="https://source.unsplash.com/collection/1346951/750x500?sig=1">
                </a>
                <div class="bg-white flex flex-col justify-start p-6 border-2 border-purple-800 rounded-b-xl">
                    <a href="#" class="text-purple-800 text-sm font-bold uppercase pb-4">Technology</a>
                    <a href="#" class="text-3xl font-bold hover:text-purple-400 pb-4">Lorem Ipsum Dolor Sit Amet
                        Dolor Sit Amet</a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-purple-400">David Grzyb</a>, Published on
                        April 25th, 2020
                    </p>
                    <a href="#" class="pb-6 hover:text-purple-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
                        quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat.
                        In sit amet posuere magna..</a>
                </div>
            </article>

        </section>

        <!-- Pagination -->
        <div class="w-auto flex items-center justify-self-center py-8 mx-auto">
            <a href="#"
                class="h-10 w-10 bg-purple-800 hover:bg-purple-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
            <a href="#"
                class="h-10 w-10 font-semibold text-gray-200 hover:bg-purple-600 hover:text-white text-sm flex items-center justify-center">2</a>
            <a href="#"
                class="h-10 w-10 font-semibold text-gray-200 hover:text-purple-400 text-sm flex items-center justify-center ml-3">Next
                <i class="fas fa-arrow-right ml-2"></i></a>
        </div>

    </div>

    <footer class="w-full border-t border-purple-800 bg-gray-800">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center text-gray-200 md:text-left md:justify-between py-6">
                <a href="#" class="hover:text-purple-400 hover:underline uppercase mx-3">About Us</a>
                <a href="#" class="hover:text-purple-400 hover:underline uppercase mx-3">Privacy Policy</a>
                <a href="#" class="hover:text-purple-400 hover:underline uppercase mx-3">Terms & Conditions</a>
                <a href="#" class="hover:text-purple-400 hover:underline uppercase mx-3">Contact Us</a>
            </div>
            <div class="uppercase pb-6 text-gray-200">&copy; FictitiousForums.com</div>
        </div>
    </footer>

</body>

</html>
