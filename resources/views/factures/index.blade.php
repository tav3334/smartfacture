@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Factures</h1>
    <a href="{{ route('factures.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded mb-4 inline-block">Créer une Facture</a>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">N°</th>
                <th class="px-4 py-2">Client</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Montant</th>
                <th class="px-4 py-2">Statut</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
                <tr>
                    <td class="border px-4 py-2">{{ $facture->numero }}</td>
                    <td class="border px-4 py-2">{{ $facture->client->nom }}</td>
                    <td class="border px-4 py-2">{{ $facture->date }}</td>
                    <td class="border px-4 py-2">{{ $facture->montant }} DH</td>
                    <td class="border px-4 py-2">{{ $facture->statut }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('factures.show', $facture) }}" class="text-green-600">Voir</a> |
                        <a href="{{ route('factures.edit', $facture) }}" class="text-blue-600">Modifier</a> |
                        <form action="{{ route('factures.destroy', $facture) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Supprimer cette facture ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection