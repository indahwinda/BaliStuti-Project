<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $guarded = [];

    public function getCompanyData()
    {
        $data = $this::find(1);
        $name = $data->name;
        $email = $data->email;
        $phone = $data->phone;
        $address = $data->address;
        $logo = $data->logo;
        $facebook = $data->facebook;
        $twitter = $data->twitter;
        $instagram = $data->instagram;
        $city = $data->city;
        $province = $data->province;
        $country = $data->country;
        $postal_code = $data->postal_code;
        $description = $data->description;
        
        return [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'logo' => $logo,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'postal_code' => $postal_code,
            'description' => $description
        ];
    }


}
