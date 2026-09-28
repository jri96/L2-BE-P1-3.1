<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'rolename'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Rol met volledige beheerdersrechten: voorraad bijwerken en rollen beheren.
     */
    public const ROLE_ADMINISTRATOR = 'Administrator';

    /**
     * Rol zonder magazijntoegang: alleen dashboard en profiel.
     */
    public const ROLE_GEBRUIKER = 'Gebruiker';

    /**
     * Standaardrol: alle magazijnschermen bekijken (leesrecht).
     */
    public const ROLE_MAGAZIJNMEDEWERKER = 'Magazijnmedewerker';

    /**
     * Alle rollen die in de applicatie gebruikt worden, oplopend in rechten.
     *
     * @return array<int, string>
     */
    public static function rollen(): array
    {
        return [
            self::ROLE_GEBRUIKER,
            self::ROLE_MAGAZIJNMEDEWERKER,
            self::ROLE_ADMINISTRATOR,
        ];
    }

    /**
     * Of deze gebruiker de magazijnschermen mag bekijken.
     *
     * Alleen rollen met expliciet leesrecht mogen erin, dus een onbekende
     * rol krijgt geen toegang.
     */
    public function heeftMagazijnToegang(): bool
    {
        return in_array($this->rolename, [
            self::ROLE_MAGAZIJNMEDEWERKER,
            self::ROLE_ADMINISTRATOR,
        ], true);
    }

    /**
     * Of deze gebruiker de Administrator-rol heeft.
     */
    public function isAdministrator(): bool
    {
        return $this->rolename === self::ROLE_ADMINISTRATOR;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
