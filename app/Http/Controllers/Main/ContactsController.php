<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Settings;

class ContactsController extends Controller
{
    public function __invoke()
    {
        $settings = Settings::first();
        $companyName = $settings['company_name'];
        $address = $settings['address'];
        $phones = $settings['phones'];
        $email = $settings['email'];

        return view('contacts', compact('companyName', 'address', 'phones', 'email'));
    }
}
