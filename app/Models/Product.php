<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $table = 'Product';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'Barcode',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    /**
     * De voorraadinformatie van dit product in het magazijn.
     *
     * @return HasOne<Magazijn>
     */
    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'Id');
    }

    /**
     * Alle allergenen die in dit product zitten (koppeltabel ProductPerAllergeen).
     *
     * @return BelongsToMany<Allergeen>
     */
    public function allergenen(): BelongsToMany
    {
        return $this->belongsToMany(
            Allergeen::class,
            'ProductPerAllergeen',
            'ProductId',
            'AllergeenId'
        );
    }

    /**
     * Alle uitgevoerde leveringen van dit product (koppeltabel ProductPerLeverancier).
     *
     * @return HasMany<ProductPerLeverancier>
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'ProductId', 'Id');
    }

    /**
     * De leverancier(s) die dit product geleverd hebben.
     *
     * @return BelongsToMany<Leverancier>
     */
    public function leveranciers(): BelongsToMany
    {
        return $this->belongsToMany(
            Leverancier::class,
            'ProductPerLeverancier',
            'ProductId',
            'LeverancierId'
        );
    }
}
