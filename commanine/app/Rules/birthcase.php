<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class birthcase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    // public function __construct()
    // {

    // }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $birth = intval(substr($value,0,4));
        // $nowYear = intval(date("Y-m-d"));
        // $year = $nowYear - $birth;


        // $firstDate  = new DateTime($value);
        // $secondDate = new DateTime();
        // $intvl = $firstDate->diff($secondDate);
        // $result = $intvl->days/365;

        $today = date('Ymd');
        $birthday = date('Ymd',strtotime($value));
        $age = floor(($today - $birthday)/10000);
        
        Log::debug("생일", [$age]);
        return $age >= 18;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '만18세 미만은 가입이 불가능 합니다.';
    }
}
