@php
/** @var \App\ViewModels\UserViewModel $user */
/** @var \App\ViewModels\ShoppingListViewModel|null $shoppingist */
/** @var \Illuminate\Support\Collection|\App\ViewModels\ShoppingItemViewModel[] $shoppingItems */
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
                @isset ($shoppingList)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2>{{ __('Your Shopping List') }}</h2>
                        <div class="mt-2">
                            {{ __('Add an item to your Shopping List') }}
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            @foreach($shoppingItems as $shoppingItem)
                                <li>
                                    {{ __('Shopping Item: ') }} {{ $shoppingItem->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" action="{{ route('shopping-lists.store') }}">
                            @csrf
                            @method('POST')
                            <x-button class="ml-3">
                                {{ __('Create your shopping List') }}
                            </x-button>
                        </form>
                    </div>
                @endisset

            </div>
        </div>
    </div>
</x-app-layout>
