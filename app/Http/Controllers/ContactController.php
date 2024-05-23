<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotification;
use App\Mail\ContactedMessage;
use App\Mail\UserNotification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'product_id' => 'required|exists:products,id',
        ]);

        $user = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        $product = Product::findOrFail($request->product_id);

        // Send email to user
        Mail::to($user['email'])->send(new UserNotification($user));

        // Send email to admin
        Mail::to(config('mail.from.address'))->send(new AdminNotification($user, $product));

        /* return response()->json(['message' => 'Contact successful, emails sent.']) */;
    }
}
