<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Mail\NewContact;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailable\Envelope;
use Illuminate\Mail\Mailable\Content;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $success = true;

        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required|email',
            ],
            [
                'name.required' => 'campo obbligatorio',
                'email.required' => 'campo obbligatorio'
            ]
        );

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        //salviamo il messaggio nel Db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $id_r = $data['cart'][0]['restaurant_id'];
        $new_lead->restaurant_id = $id_r;
        $new_lead->save();

        // inviare una mail al ristoratore
        $restaurantMail = $new_lead->restaurant->user->email;
        $message = 'hai un nuovo ordine';
        Mail::to($restaurantMail)->send(new NewContact($new_lead, $message));


        //inviamo la mail
        Mail::to($new_lead->email)->send(new NewContact($new_lead));
        return response()->json(compact('success', 'data', 'id_r'));
    }
}
