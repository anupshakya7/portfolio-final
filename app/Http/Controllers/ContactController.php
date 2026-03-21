<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaidatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable',
            'subject' => 'required|in:general_inquiry,freelance_project,collaboration,job_opportunity,other',
            'message' => 'nullable',
            'g-recaptcha-response' => 'required'
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);
        $result = $response->json();

        if(!$result['success']){
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed. Try again.']);
        }

        $contact = Contact::create($vaidatedData);

        if($contact){
            return back()->with('success','Contact Submitted Successfully!!!');
        }else{
            return back()->with('error','Failed to submit contact details');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
