<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/company">Company Section</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/employee">Employee Section</a>
                                </li>
                            </ul>
                        </div>  
                    </nav>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
