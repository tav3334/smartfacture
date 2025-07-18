@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Liste des Utilisateurs</h2>

<table class="w-full border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Nom</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Rôle</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="border px-4 py-2">{{ $user->name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">{{ $user->role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
