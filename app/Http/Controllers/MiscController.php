<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MiscController extends Controller
{
    public function showTrash()
    {
        $contacts = Contact::onlyTrashed()->where("user_id", auth()->user()->id)->get();
        return view('showTrash', ["contacts" => $contacts]);
    }

    public function permanentDelete($id)
    {
        $contact = Contact::onlyTrashed()->find($id);
        Storage::delete("public/photo/" . $contact->photo);
        $contact->forceDelete();
        return redirect()->back()->with("status", "Contact is permanently deleted");
    }

    public function bulkDelete(Request $request)
    {

        $bulkChecks =  $request->bulkChecks;
        foreach ($bulkChecks as $key => $value) {
            $contact = Contact::find($value);
            $contact->delete();
        };
        return redirect()->route("contact.index")->with("status", "Contacts were moved to trash");
    }

    public function bulkAction(Request $request)
    {

        if (request('action') === "delete") {
            $contacts =  Contact::onlyTrashed()->whereIn("id", $request->bulkChecks);
            foreach ($contacts->get() as $contact) {
                Storage::delete("public/photo/" . $contact->photo);
            }
            $contacts->forceDelete();
            return redirect()->route("showTrash")->with("status", "Contact permanently deleted");
        }
        Contact::onlyTrashed()->whereIn("id", $request->bulkChecks)->restore();
        return redirect()->route("showTrash")->with("status", "Contact restored");
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            "contact_id" => "required",
            "receiver_email" => "required"
        ]);
        $receiver_user = User::where("email", $request->receiver_email)->first();
        $contact_ids = request("contact_id");
        if (is_null($receiver_user)) {
            return redirect()->route("contact.index")->with(["status" => "No user with such email address", "icon" => "error"]);
        }
        foreach ($contact_ids as $contact_id) {
            $contact = Contact::find($contact_id);
            $newPhotoName = uniqid() . "-photo." . pathinfo(asset("storage/photo/" . $contact->photo))["extension"];
            Storage::copy("public/photo/" . $contact->photo, "public/photo/" . $newPhotoName);
            $contact->replicate()->fill(["user_id" => $receiver_user->id, "photo" => $newPhotoName])->save(); //duplicate record with updated user_id
        };
        return redirect()->route("contact.index")->with("status", "Contact sent successfully");
    }
}
