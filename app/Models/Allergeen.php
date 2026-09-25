<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergeen extends Model
{
    protected $table = 'Allergeen';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'Omschrijving',
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
     * De producten waarin dit allergen voorkomt (koppeltabel ProductPerAllergeen).
     *
     * @return BelongsToMany<Product>
     */
    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'ProductPerAllergeen',
            'AllergeenId',
            'ProductId'
        );
    }
}
