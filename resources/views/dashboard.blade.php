@auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}" class="text-blue-500">Gestion des utilisateurs</a>
    @endif

    <a href="{{ route('factures.index') }}">Mes Factures</a>
@endauth


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
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
