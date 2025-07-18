
@extends('layouts.app') {{-- ou le layout que tu utilises --}}

@section('content')

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Modifier la Facture</h1>

    <form action="{{ route('factures.update', $facture) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="client_id" class="block">Client :</label>
            <select name="client_id" class="form-control">
    @foreach($clients as $client)
        <option value="{{ $client->id }}" {{ $client->id == $facture->client_id ? 'selected' : '' }}>
            {{ $client->nom }}
        </option>
    @endforeach
</select>
        </div>

        <div>
            <label for="numero" class="block">Numéro :</label>
            <input type="text" name="numero" id="numero" class="border p-2 w-full" value="{{ old('numero', $facture->numero) }}">
        </div>

        <div>
            <label for="date" class="block">Date :</label>
            <input type="date" name="date" id="date" class="border p-2 w-full" value="{{ old('date', $facture->date) }}">
        </div>

        <div>
            <label for="montant" class="block">Montant :</label>
            <input type="number" step="0.01" name="montant" id="montant" class="border p-2 w-full" value="{{ old('montant', $facture->montant) }}">
        </div>

        <div>
            <label for="statut" class="block">Statut :</label>
            <select name="statut" id="statut" class="border p-2 w-full">
                <option value="non payé" {{ $facture->statut == 'non payé' ? 'selected' : '' }}>non payé</option>
                <option value="payé" {{ $facture->statut == 'payé' ? 'selected' : '' }}>Payé</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection