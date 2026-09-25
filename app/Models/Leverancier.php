<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leverancier extends Model
{
    protected $table = 'Leverancier';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
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
     * Alle leveringen die deze leverancier uitgevoerd heeft.
     *
     * @return HasMany<ProductPerLeverancier>
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'Id');
    }
}
