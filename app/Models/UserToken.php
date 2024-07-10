<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UserToken extends Model
{
    use HasFactory;
    protected $table = "user_tokens";
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }
    protected $fillable = [
        'id',
        'email',
        'token',
    ];
}