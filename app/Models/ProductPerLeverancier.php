<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Koppeltabel tussen Leverancier en Product met leverdata.
 * Geen Laravel-timestamps: de kolommen DatumAangemaakt/DatumGewijzigd worden zelf gevuld.
 */
class ProductPerLeverancier extends Model
{
    protected $table = 'ProductPerLeverancier';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'LeverancierId',
        'ProductId',
        'DatumLevering',
        'Aantal',
        'DatumEerstVolgendeLevering',
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
            'DatumLevering' => 'date',
            'DatumEerstVolgendeLevering' => 'date',
            'Aantal' => 'integer',
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Leverancier, ProductPerLeverancier>
     */
    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'Id');
    }

    /**
     * @return BelongsTo<Product, ProductPerLeverancier>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
}
