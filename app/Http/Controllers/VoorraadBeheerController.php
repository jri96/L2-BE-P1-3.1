<?php

namespace App\Http\Controllers;

use App\Models\Magazijn;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoorraadBeheerController extends Controller
{
    /**
     * Toont alle voorraadregels zodat een administrator de aantallen
     * aanwezige producten kan bijwerken.
     */
    public function index(): View
    {
        return view('magazijn.voorraad', [
            'voorraadregels' => Magazijn::with('product')
                ->orderBy('Id')
                ->get(),
        ]);
    }

    /**
     * Werkt het aantal aanwezige producten van één voorraadregel bij.
     */
    public function update(Request $request, Magazijn $magazijn): RedirectResponse
    {
        $data = $request->validate([
            'AantalAanwezig' => ['required', 'integer', 'min:0', 'max:65535'],
        ]);

        $magazijn->update([
            'AantalAanwezig' => $data['AantalAanwezig'],
            'DatumGewijzigd' => now(),
        ]);

        return redirect()
            ->route('magazijn.voorraad')
            ->with('status', __('De voorraad is bijgewerkt.'));
    }
}
