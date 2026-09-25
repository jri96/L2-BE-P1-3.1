<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MagazijnOverzichtTest extends TestCase
{
    use RefreshDatabase;

    public function test_overzicht_is_afgeschermd_achter_authenticatie(): void
    {
        $this->get('/magazijn')->assertRedirect('/login');
    }

    public function test_overzicht_toont_producten_gesorteerd_op_barcode_oplopend(): void
    {
        $gebruiker = User::factory()->create();

        $response = $this->actingAs($gebruiker)->get('/magazijn');

        $response->assertOk();
        $response->assertSee('Overzicht Magazijn Jamin');
        $response->assertSee('Leverantie Info');
        $response->assertSee('Allergenen Info');

        $inhoud = $response->getContent();
        $vorigePositie = -1;

        foreach (Product::orderBy('Barcode')->pluck('Barcode') as $barcode) {
            $positie = strpos($inhoud, $barcode);

            $this->assertNotFalse($positie, "Barcode {$barcode} ontbreekt in het overzicht.");
            $this->assertGreaterThan($vorigePositie, $positie, "Barcode {$barcode} staat niet oplopend gesorteerd.");
            $vorigePositie = $positie;
        }
    }

    public function test_overzicht_bevat_iconen_naar_leverings_en_allergeneninformatie(): void
    {
        $gebruiker = User::factory()->create();
        $product = Product::where('Naam', 'Mintnopjes')->firstOrFail();

        $response = $this->actingAs($gebruiker)->get('/magazijn');

        $response->assertOk();
        $response->assertSee(route('magazijn.levering', $product), false);
        $response->assertSee(route('magazijn.allergenen', $product), false);
    }
}
