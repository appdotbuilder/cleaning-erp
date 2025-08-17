<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductionRecord
 *
 * @property int $id
 * @property string $batch_number
 * @property int $finished_good_id
 * @property string $production_date
 * @property float $quantity_produced
 * @property float $total_material_cost
 * @property float $labor_cost
 * @property float $overhead_cost
 * @property float $total_production_cost
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\FinishedGood $finishedGood
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereBatchNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereFinishedGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereLaborCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereOverheadCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereProductionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereQuantityProduced($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereTotalMaterialCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereTotalProductionCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionRecord whereUpdatedAt($value)
 * @method static \Database\Factories\ProductionRecordFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ProductionRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'batch_number',
        'finished_good_id',
        'production_date',
        'quantity_produced',
        'total_material_cost',
        'labor_cost',
        'overhead_cost',
        'total_production_cost',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'production_date' => 'date',
        'quantity_produced' => 'decimal:2',
        'total_material_cost' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'overhead_cost' => 'decimal:2',
        'total_production_cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the finished good that owns the production record.
     */
    public function finishedGood(): BelongsTo
    {
        return $this->belongsTo(FinishedGood::class);
    }
}