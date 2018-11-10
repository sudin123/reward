<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = ['customer_id' ,'reward', 'sale_amount', 'sale_details'];

    public function customer(){
        $this->belongsTo(Customer::class);
    }

    public function saveTransaction()
    {
        $transactionId = request()->get('transaction_id') ?? 0;
        $transaction = self::firstOrNew(['id' => $transactionId]);
        foreach (request()->except(['_token', 'transaction_id']) as $key => $value)
        {
            $transaction->$key = $value;
        }
        $transaction->reward_amount = round($this->calculateRewardAmount(request()->get('reward'), request()->get('sale_amount')), 2);
        if($transaction->save()){
            (new Customer)->updateRewards(request()->get('customer_id'), request()->get('reward'), $transaction->reward_amount);
            return true;
        }
        return false;
    }

    public function calculateRewardAmount($rewardPercentage, $saleAmount)
    {
        return round(($rewardPercentage/100) * $saleAmount, 2);
    }
}
