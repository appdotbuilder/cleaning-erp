<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PurchaseOrderItem
 *
 * @property int $id
 * @property int $purchase_order_id
 * @property int $material_id
 * @property float $quantity
 * @property float $unit_price
 * @property float $total_price
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PurchaseOrder $purchaseOrder
 * @property-read \App\Models\Material $material
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem wherePurchaseOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseOrderItem whereUpdatedAt($value)
 * @method static \Database\Factories\PurchaseOrderItemFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PurchaseOrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'purchase_order_id',
        'material_id',
        'quantity',
        'unit_price',
        'total_price',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the purchase order that owns the item.
     */
    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    /**
     * Get the material that owns the item.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}