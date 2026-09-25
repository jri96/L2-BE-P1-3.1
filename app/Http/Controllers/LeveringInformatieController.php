<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPerLeverancier;
use Illuminate\View\View;

class LeveringInformatieController extends Controller
{
    /**
     * Toont het detailscherm "Levering Informatie" voor een gekozen product:
     * alle leverdata + de verwachte eerstvolgende leveringsdatum, gesorteerd op
     * datum van de laatste levering oplopend.
     *
     * Zonder voorraad wordt het scherm "geen voorraad" getoond met een
     * automatische doorverwijzing naar het magazijoverzicht.
     */
    public function show(Product $product): View
    {
        $magazijn = $product->magazijn;
        $heeftVoorraad = $magazijn !== null && $magazijn->AantalAanwezig !== null && $magazijn->AantalAanwezig > 0;

        $leveringen = $product->leveringen()
            ->orderBy('DatumLevering')
            ->get();

        $verwachteEerstvolgendeLevering = $leveringen
            ->filter(static fn (ProductPerLeverancier $levering): bool => $levering->DatumEerstVolgendeLevering !== null)
            ->last()
            ?->DatumEerstVolgendeLevering;

        $geenVoorraadMelding = 'Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: '
            .($verwachteEerstvolgendeLevering?->format('d-m-Y') ?? __('onbekend'));

        return view('magazijn.levering', [
            'product' => $product,
            'leverancier' => $product->leveranciers()->first(),
            'leveringen' => $leveringen,
            'verwachteEerstvolgendeLevering' => $verwachteEerstvolgendeLevering,
            'geenVoorraadMelding' => $geenVoorraadMelding,
            'heeftVoorraad' => $heeftVoorraad,
        ]);
    }
}
