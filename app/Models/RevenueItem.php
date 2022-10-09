<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rev_cat_id
 * @property integer $provider_id
 * @property string $description
 * @property boolean $is_active
 * @property double $total_price
 * @property string $bond_no
 * @property string $transaction_date
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property RevenueCategory $revenueCategory
 */
class RevenueItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rev_cat_id', 'description','provider_id', 'is_active', 'transaction_date','code','total_price','bond_no','customer_id','seq','source', 'created_at', 'updated_at'];

    const SOURCE = [
        1 => 'Revenue',
        2 => 'Order'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revenueCategory()
    {
        return $this->belongsTo('App\Models\RevenueCategory', 'rev_cat_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function setTransactionDateAttribute($value)
    {
        $this->attributes['transaction_date'] = date('Y-m-d', strtotime($value));
    }
    // public function getTransactionDateAttribute($value)
    // {
    //     // dd(date('Y-m-d', $value));
    //     $this->attributes['transaction_date'] = strtotime($value);
    // }
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
