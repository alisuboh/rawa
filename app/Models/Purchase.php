<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'provider_id',
        'supplier_id',
        'price',
        'tax',
        'discount',
        'total_price',
        'seq'
    ];

    protected $casts = [];

    /**
     * @return Relation
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasesDetail()
    {
        return $this->hasMany('App\Models\PurchasesDetail', 'purchas_id', 'id');
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = date('Y-m-d', strtotime($value));
    }
    // public function getInvoiceDateAttribute($value)
    // {
    //     // 2022-09-19T17:11:36.000000Z
    //     // dd(date('Y-m-d H:i:s', strtotime($value)));

    //     $this->attributes['invoice_date'] = date('Y-m-d H:i:s', strtotime($value));
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function scopeCreated(Builder $query, $id_date): Builder
    {
        $createdAt = Carbon::parse();
        $to = $createdAt->format('Y-m-d 23:59:59'); 
        switch($id_date){
            case 1:
                $from = $createdAt->format('Y-m-d 00:00:00');
                break;
            case 2:
                $from = Carbon::now()->subDays(7)->format('Y-m-d 00:00:00');
                break;
            case 3:
                $from = Carbon::now()->subDays(30)->format('Y-m-d 00:00:00');
                break;
            default:
            $from = $createdAt->format('Y-m-d 00:00:00');


        }
        return $query->whereBetween('transaction_date', [$from." 00:00:00", $to." 23:59:59"]);
    }
    public function getLastSeq(){
        $last = SELF::where('provider_id',auth()->user()->provider_id)->max('seq')??0;
        return ($last + 1);
    }

    public static function getLastSeqNumber(){
        $last = SELF::where('provider_id',auth()->user()->provider_id)->max('seq')??0;
        return ($last + 1);
    }

}
