<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = [
        'email',
        'phone',
        'sale_amount',
        'sale_details',
        'reward'
    ];

    public function histories()
    {
        return $this->hasMany(PointHistory::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getCustomers()
    {
        $inputs = request()->except('_token');
        $customers = self::where(function($q)use($inputs) {
           foreach ($inputs as $key => $value){
               if(!empty($value)){
                   $q->where($key, $value);
               }
           }
        })->orderByDesc('created_at')->get();
        return $customers;
    }

    public function saveCustomer()
    {
        $customerId = request()->get('customer_id') ?? 0;
        $customer = self::firstOrNew(['id' => $customerId]);
        foreach (request()->except(['customer_id', '_token']) as $key => $value)
        {
            $customer->$key = $value;
        }
        if($customer->save())
        {
            return true;
        }
        return false;
    }

    public function getTotalUsedRewardAmount(Customer $customer){
        $pointsArray = $customer->histories->pluck('reward_amount')->toArray();
        return array_sum($pointsArray);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function checkCustomerIfExists()
    {
        $customer = self::where('email', request()->get('email'))->orWhere('phone', request()->get('phone'))->first();
        if($customer){
            return true;
        }
        return false;
    }

    public function updatePoints()
    {
        $customerId = request()->get('customer_id');
        $customer = self::find($customerId);
        if(!$customer){
            return false;
        }
        $points = $customer->reward;
        $customer->reward = $points + request()->get('reward');
        $customer->save();
        return true;
    }

    public function updateRewards($customerId, $reward, $rewardAmount)
    {
        $customer = self::find($customerId);
        $customer->reward = $customer->reward+ $reward;
        $customer->reward_amount = $customer->reward_amount + $rewardAmount;
        $customer->save();
        return true;
    }
}
