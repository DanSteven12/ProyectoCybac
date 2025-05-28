<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'name',
        'description',
        'duration',
    ];

    // RELACIÓN: una membresía pertenece a un estado
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // RELACIÓN: una membresía tiene muchos pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
