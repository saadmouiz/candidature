<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full md:w-2/3 lg:w-1/2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-4 py-2 border-b">Bienvenue</div>

                <div class="p-4">
                    <div class="flex justify-center">
                        <a href="{{ route('candidature.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mx-2">Postuler</a>
                        <a href="{{ route('login') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mx-2">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection