<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class LeveringInformatieController extends Controller
{
    /**
     * Toont het detailscherm "Levering Informatie" voor een gekozen product.
     */
    public function show(Product $product): View
    {
        return view('magazijn.levering', [
            'product' => $product,
        ]);
    }
}
