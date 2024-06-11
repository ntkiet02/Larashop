<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class ChuDe extends Model
{
    use HasFactory;
    protected $table = 'chude';
    public function BaiViet(): HasMany
    {
        return $this->hasMany(BaiViet::class, 'chude_id', 'id');
    }
}
