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
            Contact::onlyTrashed()->whereIn("id", $request->bulkChecks)->forceDelete();
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
        if (is_null($receiver_user)) {
            return redirect()->route("contact.index")->with(["status" => "No user with such email address", "icon" => "error"]);
        }
        Contact::whereIn("id", request("contact_id"))->update(["user_id" => $receiver_user->id]);
        // $contact->user_id = $receiver_user->id;
        // $contact->update();
        return redirect()->route("contact.index")->with("status", "Contact sent successfully");
    }
}
