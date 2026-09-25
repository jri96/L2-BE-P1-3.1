<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class AllergenenOverzichtController extends Controller
{
    /**
     * Toont het detailscherm "Overzicht Allergenen" voor een gekozen product.
     */
    public function show(Product $product): View
    {
        return view('magazijn.allergenen', [
            'product' => $product,
        ]);
    }
}
