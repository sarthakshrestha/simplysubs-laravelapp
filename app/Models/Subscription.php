<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['title', 'description', 'image', 'price'];
    protected $casts = [
        'image' => 'string',
    ];
    use HasFactory;

    /**
     * Find a subscription by its ID.
     *
     * @param  int  $subscriptionId
     * @return \App\Models\Subscription|null
     */
    public static function findById($subscriptionId)
    {
        // Use the built-in find method
        return self::find($subscriptionId);
    }
}
