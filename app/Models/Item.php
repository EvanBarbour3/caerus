<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @author EB
 * @property int $id
 * @property string $description
 * @property int $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class Item extends Model
{
    /**
     * @author EB
     * @var array
     */
    protected $fillable = [
        'description',
        'price',
    ];

    /**
     * @author EB
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @author EB
     * @var array
     */
    protected $visible = [
        'id',
        'description',
        'price',
        'created_at',
        'updated_at',
    ];

    /**
     * @author EB
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_item');
    }
}
