<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class MagazijnOverzichtController extends Controller
{
    /**
     * Toont het scherm "Overzicht Magazijn Jamin" met alle producten,
     * gesorteerd op barcode oplopend.
     */
    public function index(): View
    {
        $producten = Product::with('magazijn')
            ->orderBy('Barcode')
            ->get();

        return view('magazijn.overzicht', [
            'producten' => $producten,
        ]);
    }
}
