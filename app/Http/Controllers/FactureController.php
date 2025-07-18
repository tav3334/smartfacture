<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::with('client')->get();
        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $clients = Client::all();
        $selectedClientId = $request->client_id;

        return view('factures.create', compact('clients', 'selectedClientId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'numero' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'statut' => 'required|string|max:50',
        ], [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'numero.required' => 'Le numéro de facture est obligatoire.',
            'date.required' => 'La date est obligatoire.',
            'montant.required' => 'Le montant est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                Facture::create($validatedData);
            });

            return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la facture.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture)
    {
        return view('factures.show', compact('facture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facture $facture)
{
    $clients = Client::all(); // ajout important !
    return view('factures.edit', compact('facture', 'clients'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facture $facture)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'numero' => 'required|string|max:255',
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'statut' => 'required|string|max:50',
        ], [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'numero.required' => 'Le numéro de facture est obligatoire.',
            'date.required' => 'La date est obligatoire.',
            'montant.required' => 'Le montant est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
        ]);

        try {
            DB::transaction(function () use ($facture, $validatedData) {
                $facture->update($validatedData);
            });

            return redirect()->route('factures.index')->with('success', 'Facture mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour de la facture.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        try {
            DB::transaction(function () use ($facture) {
                $facture->delete();
            });

            return redirect()->route('factures.index')->with('success', 'Facture supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la facture.');
        }
    }
}
