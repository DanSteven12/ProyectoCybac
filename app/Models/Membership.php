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
        'price',
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
    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }


    public function getReadableDurationAttribute()
{
    $dias = $this->duration;
    $años = intdiv($dias, 365);
    $meses = intdiv($dias % 365, 30);
    $texto = '';

    if ($años > 0) {
        $texto .= $años . ' ' . ($años == 1 ? 'año' : 'años');
    }

    if ($meses > 0) {
        $texto .= ($texto ? ' y ' : '') . $meses . ' ' . ($meses == 1 ? 'mes' : 'meses');
    }

    if (!$texto) {
        $texto = $dias . ' días';
    }

    return $texto;
}

}
