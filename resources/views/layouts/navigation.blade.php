<nav x-data="{ open: false }" class="bg-white w-full border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="bg-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between w-full h-16 z-10">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Home
                        </x-nav-link>

                        <nav-link class="my-auto">
                            <div class="border-2 h-10 bg-gray-100 rounded-lg">

                                <i class="fas fa-search inline-block float-left w-2/12 text-center mt-2 text-gray-400 " ></i>

                                <form action="" method="GET" id="formSearch">
                                    <input type="text" placeholder="Search" id="fieldSearch" class="p-0 border-0 inline-block bg-transparent h-9 rounded-lg float-left w-10/12 focus:ring-0">
                                </form>
                            </div>

                        </nav-link>


                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-nav-link :href="url('uploadImage')" class="mb-0.5 mr-2 text-sm font-medium text-gray-500 hover:text-gray-70">
                        Upload Image
                    </x-nav-link>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div> @if(Auth::user()->image)
                                    <img src="{{url('getImage/'.Auth::user()->image)}}" class="mx-auto object-cover rounded-full w-8 h-8 ml-2" alt="IMAGEN">
                                    @else
                                    <img src="{{url('getImage/default_user.png')}}" class="mx-auto  object-cover rounded-full w-8 h-8 ml-2" alt="IMAGEN">
                                    @endif
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{url('profile/'.Auth::user()->id)}}">
                                    My profile
                                </x-dropdown-link>

                                <x-dropdown-link href="{{url('settings')}}">
                                    Settings
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>


                            </form>
                        </x-slot>


                    </x-dropdown>


                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>