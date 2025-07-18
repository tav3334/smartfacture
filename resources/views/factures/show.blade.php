@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Détails de la Facture</h1>

    <div class="bg-white shadow p-6 rounded">
        <p><strong>Numéro :</strong> {{ $facture->numero }}</p>
        <p><strong>Client :</strong> {{ $facture->client->nom }}</p>
        <p><strong>Date :</strong> {{ $facture->date }}</p>
        <p><strong>Montant :</strong> {{ $facture->montant }} DH</p>
        <p><strong>Statut :</strong> {{ $facture->statut }}</p>

        <a href="{{ route('factures.edit', $facture) }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">Modifier</a>

</div>
    <a href="{{ route('factures.index') }}" class="inline-block mt-4 bg-black-500 text-black px-4 py-2 rounded">Retour à la liste</a>
    </div>
@endsection
