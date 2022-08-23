<?php

namespace App\Http\Controllers\Admin\Order\Part;

use App\Http\Controllers\Controller;
use App\Models\Order;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        return view('admin.orders.parts.edit', compact('order'));
    }
}
