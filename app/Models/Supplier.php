<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $pic
 * @property string|null $npwp
 * @property float $discount_percentage
 * @property int $payment_terms_days
 * @property string|null $map_link
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PurchaseOrder> $purchaseOrders
 * @property-read int|null $purchase_orders_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereNpwp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePaymentTermsDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier active()
 * @method static \Database\Factories\SupplierFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'pic',
        'npwp',
        'discount_percentage',
        'payment_terms_days',
        'map_link',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'payment_terms_days' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the purchase orders for the supplier.
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * Scope a query to only include active suppliers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}