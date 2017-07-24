<?php

namespace App\Models;

use App\Models\Database\Queryable;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contracts\Queryable as QueryableContract;

/**
 * Class Order
 *
 * @author EB
 * @property int $id
 * @property User $user
 * @property string $description
 * @property int $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class Order extends Model implements QueryableContract
{
    use Queryable;

    /**
     * @author EB
     * @var array
     */
    protected $fillable = [
        'user',
        'description',
        'amount',
        'created_at',
        'updated_at',
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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @author EB
     * @var array
     */
    protected $visible = [
        'id',
        'user',
        'description',
        'amount',
        'items',
        'total_amount',
        'created_at',
        'updated_at',
    ];

    /**
     * @author EB
     * @var array
     */
    protected $appends = [
        'items',
        'total_amount',
    ];

    /**
     * @author EB
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @author EB
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getItemsAttribute()
    {
        return $this->attributes['items'] = $this->items()->get();
    }

    /**
     * @author EB
     * @return int
     */
    protected function getTotalAmountAttribute()
    {
        return $this->attributes['total_amount'] = $this->items()->get()->sum('price');
    }

    /**
     * @author EB
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item');
    }
}
