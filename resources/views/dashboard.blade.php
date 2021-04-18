@php
/** @var \App\ViewModels\UserViewModel $user */
/** @var \App\ViewModels\ShoppingListViewModel|null $shoppingList */
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
                            <form method="POST"
                                  action="{{ route('shopping-items.store', ['shopping_list' => $shoppingList->uuid]) }}">
                                @csrf
                                @method('POST')
                                <div class="flex flex-wrap items-center">
                                    <x-label for="shopping_item_name" :value="__('Item:')" />

                                    <x-input id="shopping_item_name"
                                             class="ml-2"
                                             type="text"
                                             name="shopping_item_name"
                                             :value="old('shopping_item_name')"
                                             required />

                                    <x-button class="ml-2">
                                        {{ __('Add item to your shopping List') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="underline">{{ __('Your Items') }}</h3>
                        <ul class="mt-2">
                            @forelse($shoppingItems as $shoppingItem)
                                <li class="flex flex-wrap items-center">
                                    <span class="list-disc">{{ $shoppingItem->name }}</span>
                                    <form method="POST"
                                          action="{{ route('shopping-items.destroy', ['shopping_list' => $shoppingList->uuid, 'shopping_item' => $shoppingItem->uuid]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="flex flex-wrap items-center">
                                            <x-button class="ml-2">
                                                {{ __('Remove item') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </li>
                            @empty
                                <li>{{ __('You do not have any items in your list') }}</li>
                            @endforelse
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
