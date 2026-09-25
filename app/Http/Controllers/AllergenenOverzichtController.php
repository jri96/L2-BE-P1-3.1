<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class AllergenenOverzichtController extends Controller
{
    /**
     * Toont het detailscherm "Overzicht Allergenen" voor een gekozen product,
     * gesorteerd op naam van het allergen oplopend.
     *
     * Zonder allergenen wordt de "geen allergenen" melding getoond met een
     * automatische doorverwijzing naar het magazijoverzicht.
     */
    public function show(Product $product): View
    {
        $allergenen = $product->allergenen()
            ->orderBy('Naam')
            ->get();

        return view('magazijn.allergenen', [
            'product' => $product,
            'allergenen' => $allergenen,
            'heeftAllergenen' => $allergenen->isNotEmpty(),
            'geenAllergenenMelding' => 'In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken',
        ]);
    }
}
