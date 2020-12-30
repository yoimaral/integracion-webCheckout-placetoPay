<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const APROBADO = 'APROBADO';
    public const RECHAZADO = 'RECHAZADO';
    public const PENDIENTE = 'PENDIENTE';
    public const PROCESANDO = 'PROCESANDO';

     /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id',
        'requestId',
        'processUrl'
    ];

     /**
     * Se indica que una orden 
     * tiene un solo pago
     *
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Se crea la relacion de order y users
     * indicando que order es la llave foranea de users
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Se crea la relacion polimorfica de order y product 
     * de muchos a muchos con morphToMany y se pasa
     * el nombre de la relacion polimorfica que es productable
     *
     * @return void
     */
    public function products()
    {

        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTotalAttribute()
    {

        return $this->products->pluck('total')->sum();
    }

    public function scopeDateToDate(Builder $query, $initDate, $finalDate){
        if ($initDate && $finalDate) {
            $finalDate = (new Carbon($finalDate))->addDay();
        return $query->whereBetween('created_at',[$initDate,$finalDate]);
        }
        return $query;
    }
}
