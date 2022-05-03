<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("index", ["contacts" => Contact::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "phone" => 'required|regex:/(0)[0-9]{9}/',
            "photo" => "nullable|mimes:png,jpeg",
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        if ($request->hasFile("photo")) {
            $fileName = uniqid() . "-photo." . $request->file("photo")->extension();
            $request->file('photo')->storeAs("public/photo/", $fileName);
            $contact->photo = $fileName;
        };
        $contact->save();
        return redirect()->route("contact.index")->with("status", "$request->name is created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view("show", compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view("edit", ["contact" => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        if ($request->hasFile("photo")) {
            Storage::delete("public/photo/" . $contact->photo);
            $fileName = uniqid() . "-photo." . $request->file("photo")->extension();
            $request->file('photo')->storeAs("public/photo/", $fileName);
            $contact->photo = $fileName;
        };
        $contact->update();
        return redirect()->route("contact.index")->with("status", "$request->name is edit successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        Storage::delete("public/photo/" . $contact->photo);
        $contact->delete();
        return redirect()->route("contact.index")->with("status", "Contact is deleted successfully");
    }
}