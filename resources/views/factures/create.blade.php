@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Créer une Facture</h1>

    <form action="{{ route('factures.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="client_id" class="block">Client :</label>
            <select name="client_id" id="client_id" class="border p-2 w-full">
    @foreach($clients as $client)
        <option value="{{ $client->id }}" {{ (old('client_id', $selectedClientId ?? '') == $client->id) ? 'selected' : '' }}>
            {{ $client->nom }}
        </option>
    @endforeach
</select>

        </div>

        <div>
            <label for="numero" class="block">Numéro :</label>
            <input type="text" name="numero" id="numero" class="border p-2 w-full" value="{{ old('numero') }}">
        </div>

        <div>
            <label for="date" class="block">Date :</label>
            <input type="date" name="date" id="date" class="border p-2 w-full" value="{{ old('date') }}">
        </div>

        <div>
            <label for="montant" class="block">Montant :</label>
            <input type="number" step="50" name="montant" id="montant" class="border p-2 w-full" value="{{ old('montant') }}">
        </div>

        <div>
            <label for="statut" class="block">Statut :</label>
            <select name="statut" id="statut" class="border p-2 w-full">
                <option value="non Payé">non payé</option>
                <option value="payé">Payé</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded">Enregistrer</button>
    </form>
</div>
@endsection