<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Koppeltabel tussen Product en Allergeen.
 * Geen Laravel-timestamps: de kolommen DatumAangemaakt/DatumGewijzigd worden zelf gevuld.
 */
class ProductPerAllergeen extends Model
{
    protected $table = 'ProductPerAllergeen';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'ProductId',
        'AllergeenId',
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
     * @return BelongsTo<Product, ProductPerAllergeen>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    /**
     * @return BelongsTo<Allergeen, ProductPerAllergeen>
     */
    public function allergeen(): BelongsTo
    {
        return $this->belongsTo(Allergeen::class, 'AllergeenId', 'Id');
    }
}
