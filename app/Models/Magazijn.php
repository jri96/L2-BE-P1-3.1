<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magazijn extends Model
{
    protected $table = 'Magazijn';

    protected $primaryKey = 'Id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'ProductId',
        'VerpakkingsEenheid',
        'AantalAanwezig',
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
            'VerpakkingsEenheid' => 'decimal:2',
            'AantalAanwezig' => 'integer',
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    /**
     * Het product waarop deze voorraadregel betrekking heeft.
     *
     * @return BelongsTo<Product, Magazijn>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    /**
     * Of er op dit moment voorraad aanwezig is.
     */
    public function heeftVoorraad(): bool
    {
        return $this->AantalAanwezig !== null && $this->AantalAanwezig > 0;
    }
}
