<nav class="bg-genoa-600 shadow-lg">
    <div class="grid grid-cols-3 p-4">
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-masala-50 rounded-lg md:hidden hover:bg-genoa-950 focus:outline-none focus:ring-2 focus:ring-gray-200 "
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 ">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 text-masala-50  hover:bg-genoa-950 md:hover:bg-transparent md:border-0 md:hover:text-genoa-950 md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('game') }}"
                        class="block py-2 px-3 text-masala-50  hover:bg-genoa-950 md:hover:bg-transparent md:border-0 md:hover:text-genoa-950 md:p-0">Game</a>
                </li>
            </ul>
        </div>
        <div class="text-masala-50 mx-auto font-title text-3xl">Memory Game</div>
    </div>
</nav>
