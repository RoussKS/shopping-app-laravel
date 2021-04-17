@php
/** @var \App\ViewModels\UserViewModel $user */
/** @var \App\ViewModels\ShoppingListViewModel|null $shoppingist */
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('Welcome') }}: {{ $user->name }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @isset($shoppingList)
                        <h2>{{ __('Shopping List UUID') }}: {{ $shoppingList->uuid }}</h2>
                    @else
                        <form method="POST" action="{{ route('shopping-lists.store') }}">
                            @csrf
                            @method('POST')
                            <x-button class="ml-3">
                                {{ __('Create your shopping List') }}
                            </x-button>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
