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
    protected $visible = [
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
    protected $appends = [
        'test_property',
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
     * Testing adding attributes
     *
     * @author EB
     * @return string
     */
    public function getTestPropertyAttribute()
    {
        return $this->attributes['test_property'] = 'property';
    }
}
