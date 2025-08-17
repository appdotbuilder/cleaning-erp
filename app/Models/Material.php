<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Material
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string|null $description
 * @property string $unit
 * @property float $unit_cost
 * @property float $current_stock
 * @property float $minimum_stock
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PurchaseOrderItem> $purchaseOrderItems
 * @property-read int|null $purchase_order_items_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Material query()
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereMinimumStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Material active()
 * @method static \Illuminate\Database\Eloquent\Builder|Material lowStock()
 * @method static \Database\Factories\MaterialFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Material extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'unit',
        'unit_cost',
        'current_stock',
        'minimum_stock',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_cost' => 'decimal:2',
        'current_stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the purchase order items for the material.
     */
    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    /**
     * Scope a query to only include active materials.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include materials with low stock.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('current_stock <= minimum_stock');
    }
}