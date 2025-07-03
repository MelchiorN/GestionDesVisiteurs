@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 ">
    <div class="backdrop-blur-m bg-white/30 rounded-xl shadow-xl max-w-md w-full p-8 space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Connexion</h2>
            <p class="mt-2 text-sm text-gray-700">Système de gestion des visiteurs</p>
        </div>
        <!-- Erreurs -->
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach                                           
            </div>
        @endif      
        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Adresse email" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Mot de passe">
                </div>
                
            </div>
            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    Se connecter
                </button> 
            </div>
        </form>
    </div>
</div>
@endsection
