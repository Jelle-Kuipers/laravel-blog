    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-purple-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    <li><a class="hover:text-gray-400 hover:underline px-4" href="#">Home</a></li>
                    <li><a class="hover:text-gray-400 hover:underline px-4" href="#">About</a></li>
                </ul>
            </nav>
            
                <div class="flex flex-col items-center py-3">
                    <a class="font-bold text-white uppercase hover:text-purple-400 text-3xl" href="/">
                        FictitiousForums
                    </a>
                </div>

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="hover:text-gray-400 hover:underline px-4" href="https://github.com/Jelle-Kuipers">
                    <i class="fab fa-github"></i>
                </a>
                <a class="hover:text-gray-400 hover:underline px-4" href="https://www.linkedin.com/in/jelle-kuipers/">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav>
    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b border-purple-800 bg-gray-800" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold text-white uppercase mt-0 px-6 py-2">
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Technology</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Automotive</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Finance</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Politics</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Culture</a>
                <a href="#" class="hover:bg-purple-400 rounded py-2 px-4 mx-2">Sports</a>
            </div>
        </div>
    </nav>