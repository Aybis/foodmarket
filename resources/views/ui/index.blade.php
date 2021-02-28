<x-mobile>
    <x-slot name="header">
        <p class="hidden md:block font-semibold text-lg text-gray-800 leading-tight">Dashboard</p>
        <h2 class="sm:hidden font-semibold text-lg text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>


</x-mobile>
