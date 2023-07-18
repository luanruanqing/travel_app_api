<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

class UserOtp extends Model
{
    use HasFactory;

    protected $table = 'user_otps';

    protected $fillable = ['user_id', 'otp', 'expire_date'];

    function formatPhoneNumber($phoneNumberString)
    {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        $phoneNumber = $phoneNumberUtil->parse($phoneNumberString, 'VN');
        $formattedPhoneNumber = $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164);

        return $formattedPhoneNumber;
    }

    public function sendSMS($receiverNumber)
    {
        $message = "Login OTP is ".$this->otp;
        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $phoneNumber = $this->formatPhoneNumber($receiverNumber);

            $client = new Client($account_sid, $auth_token);

            $client->messages->create($phoneNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            info('SMS Sent Successfully.');

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
