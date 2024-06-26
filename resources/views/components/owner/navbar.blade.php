<div>
    <div class="fixed top-0 w-full bg-white z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 sm:px-6 ">
            <div class="inline-flex items-center space-x-2">
                <span class="font-bold text-berkleyBlue text-lg py-2 lg:py-0">Web App</span>
            </div>
            <div class="hidden md:block">
                <ul class="inline-flex space-x-8">
                    <li>
                        <a href="{{ url('/home') }}" id="home"
                        class=" inline-flex items-center text-lg font-semibold text-black hover:bg-honeydew/80 px-3 py-2 rounded-md hover:text-berkleyBlue transition duration-150 ease-in-out">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/dashboard') }}" id="dashboard"
                        class=" inline-flex items-center text-lg font-semibold text-black hover:bg-honeydew/80 px-3 py-2 rounded-md hover:text-berkleyBlue transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/')}}" id="developers"
                        class=" inline-flex items-center text-lg font-semibold text-black hover:bg-honeydew/80 px-3 py-2 rounded-md hover:text-berkleyBlue transition duration-150 ease-in-out">
                            Developers
                        </a>
                    </li>
                </ul>
            </div>
            <div class="hidden space-x-2 md:block">
                <button type="button"
                    class="rounded-md bg-transparent px-3 py-2 text-lg font-semibold text-black hover:bg-burntSienna/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Sign In
                </button>
                <button type="button"
                    class="rounded-md bg-transparent px-3 py-2 text-lg font-semibold text-black hover:bg-burntSienna/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black ">
                    Log In
                </button>
            </div>
            <div class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-6 w-6 cursor-pointer">
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="18" x2="20" y2="18"></line>
                </svg>
            </div>
        </div>
    </div>
    <div class="pt-[3.76rem]">
        <!-- padding provided so that navbar doesnt overlap the sidebar. -->
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current URL path
        var currentPath = window.location.pathname;
        console.log(currentPath);

        // Add the 'active' class to the corresponding link
        if (currentPath === "/home" || currentPath === "/") {
            document.getElementById("home").classList.add("active");
        } else if (currentPath === "/dashboard") {
            document.getElementById("dashboard").classList.add("active");
        } else if (currentPath === "/developers") {
            document.getElementById("developers").classList.add("active");
        }
    });
</script>