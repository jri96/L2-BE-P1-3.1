<?php

namespace Tests\Feature;

use App\Models\Magazijn;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolRechtenTest extends TestCase
{
    use RefreshDatabase;

    public function test_beide_rollen_kunnen_het_magazijnoverzicht_bekijken(): void
    {
        $medewerker = User::factory()->create();
        $administrator = User::factory()->administrator()->create();

        foreach ([$medewerker, $administrator] as $gebruiker) {
            $this->actingAs($gebruiker)
                ->get('/magazijn')
                ->assertOk()
                ->assertSee('Overzicht Magazijn Jamin');
        }
    }

    public function test_beide_rollen_kunnen_de_detailschermen_bekijken(): void
    {
        $product = Product::where('Naam', 'Mintnopjes')->firstOrFail();

        foreach ([User::factory()->create(), User::factory()->administrator()->create()] as $gebruiker) {
            $this->actingAs($gebruiker)
                ->get(route('magazijn.levering', $product))
                ->assertOk()
                ->assertSee('Levering Informatie');

            $this->actingAs($gebruiker)
                ->get(route('magazijn.allergenen', $product))
                ->assertOk()
                ->assertSee('Overzicht Allergenen');
        }
    }

    public function test_magazijnmedewerker_ziet_geen_beheerschermen_en_krijgt_verboden_toegang(): void
    {
        $medewerker = User::factory()->create();
        $magazijn = Magazijn::firstOrFail();

        $overzicht = $this->actingAs($medewerker)->get('/magazijn');

        $overzicht->assertOk();
        $overzicht->assertDontSee(route('magazijn.voorraad'), false);
        $overzicht->assertDontSee(route('gebruiker.index'), false);

        $this->actingAs($medewerker)->get(route('magazijn.voorraad'))->assertForbidden();
        $this->actingAs($medewerker)->get(route('gebruiker.index'))->assertForbidden();
        $this->actingAs($medewerker)
            ->put(route('magazijn.voorraad.bijwerken', $magazijn), ['AantalAanwezig' => 1])
            ->assertForbidden();
    }

    public function test_administrator_ziet_de_beheerschermen_in_de_navigatie(): void
    {
        $administrator = User::factory()->administrator()->create();

        $this->actingAs($administrator)
            ->get('/magazijn')
            ->assertOk()
            ->assertSee(route('magazijn.voorraad'), false)
            ->assertSee(route('gebruiker.index'), false);
    }

    public function test_administrator_kan_de_voorraad_bijwerken(): void
    {
        $administrator = User::factory()->administrator()->create();
        $magazijn = Magazijn::whereHas('product', function ($query): void {
            $query->where('Naam', 'Mintnopjes');
        })->firstOrFail();

        $this->actingAs($administrator)
            ->put(route('magazijn.voorraad.bijwerken', $magazijn), ['AantalAanwezig' => 999])
            ->assertRedirect(route('magazijn.voorraad'));

        $this->assertSame(999, $magazijn->fresh()->AantalAanwezig);
        $this->assertNotNull($magazijn->fresh()->DatumGewijzigd);
    }

    public function test_voorraad_mag_niet_negatief_of_te_groot_zijn(): void
    {
        $administrator = User::factory()->administrator()->create();
        $magazijn = Magazijn::firstOrFail();

        $this->actingAs($administrator)
            ->put(route('magazijn.voorraad.bijwerken', $magazijn), ['AantalAanwezig' => -1])
            ->assertSessionHasErrors('AantalAanwezig');
    }

    public function test_administrator_kan_de_rol_van_een_andere_gebruiker_wijzigen(): void
    {
        $administrator = User::factory()->administrator()->create();
        $collega = User::factory()->create();

        $this->actingAs($administrator)
            ->patch(route('gebruiker.rol', $collega), ['rolename' => User::ROLE_ADMINISTRATOR])
            ->assertRedirect(route('gebruiker.index'));

        $this->assertSame(User::ROLE_ADMINISTRATOR, $collega->fresh()->rolename);
    }

    public function test_administrator_kan_zijn_eigen_rol_niet_wijzigen(): void
    {
        $administrator = User::factory()->administrator()->create();

        $this->actingAs($administrator)
            ->patch(route('gebruiker.rol', $administrator), ['rolename' => User::ROLE_MAGAZIJNMEDEWERKER])
            ->assertSessionHasErrors('rolename');

        $this->assertTrue($administrator->fresh()->isAdministrator());
    }

    public function test_rol_wijzigen_weigert_een_onbekende_rol(): void
    {
        $administrator = User::factory()->administrator()->create();
        $collega = User::factory()->create();

        $this->actingAs($administrator)
            ->patch(route('gebruiker.rol', $collega), ['rolename' => 'Superadmin'])
            ->assertSessionHasErrors('rolename');

        $this->assertSame(User::ROLE_MAGAZIJNMEDEWERKER, $collega->fresh()->rolename);
    }

    public function test_beheerschermen_zijn_afgeschermd_achter_authenticatie(): void
    {
        $this->get(route('magazijn.voorraad'))->assertRedirect('/login');
        $this->get(route('gebruiker.index'))->assertRedirect('/login');
    }
}
