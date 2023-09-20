<x-app-layout>
<head>
    <meta charset="utf-8">
    <title>dashbord</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" >
  </head>
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
    <div>
    <a href="{{ route('book.index') }}" role="button" class="btn01">本の登録システムへ</a>
    </div>
</x-app-layout>