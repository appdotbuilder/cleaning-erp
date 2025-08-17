<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\FinishedGood
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string|null $description
 * @property float $selling_price
 * @property float $production_cost
 * @property float $current_stock
 * @property float $minimum_stock
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductionRecord> $productionRecords
 * @property-read int|null $production_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesOrderItem> $salesOrderItems
 * @property-read int|null $sales_order_items_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereMinimumStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereProductionCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood active()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedGood lowStock()
 * @method static \Database\Factories\FinishedGoodFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FinishedGood extends Model
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
        'selling_price',
        'production_cost',
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
        'selling_price' => 'decimal:2',
        'production_cost' => 'decimal:2',
        'current_stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the production records for the finished good.
     */
    public function productionRecords(): HasMany
    {
        return $this->hasMany(ProductionRecord::class);
    }

    /**
     * Get the sales order items for the finished good.
     */
    public function salesOrderItems(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    /**
     * Scope a query to only include active finished goods.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include finished goods with low stock.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('current_stock <= minimum_stock');
    }
}