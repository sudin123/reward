<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    protected $table = "point_histories";

    protected $fillable = ["customer_id", "details", "point_used"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saveHistory()
    {
        $history = new self;
        foreach (request()->except('_token') as $key => $value)
        {
            $history->$key = $value;
        }
        if($history->save())
        {
            return true;
        }
        return false;
    }
}
