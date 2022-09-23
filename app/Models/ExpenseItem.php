<?php

namespace App\Models;

use App\Constants\TransCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $exp_cat_id
 * @property string $description
 * @property boolean $is_active
 * @property double $total_price
 * @property string $bond_no
 * @property string $transaction_date
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property ExpenseCategory $expenseCategory
 */
class ExpenseItem extends Model
{
    const CODE = [];
    /**
     * @var array
     */
    protected $fillable = ['exp_cat_id', 'description', 'provider_id', 'is_active', 'transaction_date', 'code', 'total_price', 'bond_no','beneficiary_id','beneficiary_name','beneficiary_type','beneficiary_mobile','seq', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenseCategory()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'exp_cat_id');
    }
    // beneficiary_name,beneficiary_type
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary()
    {
        switch ($this->beneficiary_type) {
            case TransCode::BENEFICIARY_SUPPLIER:
                return $this->belongsTo('App\Models\Supplier', 'beneficiary_id');

                break;
            case TransCode::BENEFICIARY_CUSTOMER:
                return $this->belongsTo('App\Models\Customer', 'beneficiary_id');

                break;
            case TransCode::BENEFICIARY_EMPLOYEE:
                return $this->belongsTo('App\Models\ProvidersEmployee', 'beneficiary_id');

                break;
            case TransCode::BENEFICIARY_OTHER:
                return null;
                break;
        }
    }


    public function setTransactionDateAttribute($value)
    {
        $this->attributes['transaction_date'] = date('Y-m-d', strtotime($value));
    }
    public function getTransactionDateAttribute($value)
    {
        // dd(date('Y-m-d', $value));
        $this->attributes['transaction_date'] = strtotime($value);
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
        return $query->whereBetween('created_at', [$from." 00:00:00", $to." 23:59:59"]);
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
