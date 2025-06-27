@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Notifications</h1>

    <ul class="space-y-4">
        @forelse($notifications as $notif)
            <li class="bg-gray-100 p-4 rounded-lg shadow-sm">
                {{ $notif->data['message'] ?? 'Nouveau visiteur' }}
                <a href="{{ route('notifications.show', [$notif->notifiable_id, $notif->id]) }}"
                   class="text-indigo-600 hover:underline ml-4">Voir</a>
                <span class="text-sm text-gray-500 float-right">{{ $notif->created_at->diffForHumans() }}</span>
            </li>
        @empty
            <li class="text-gray-500">Aucune notification pour le moment.</li>
        @endforelse
    </ul>
</div>
@endsection
