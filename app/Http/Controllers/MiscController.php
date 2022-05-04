<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MiscController extends Controller
{
    public function showTrash()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('showTrash', ["contacts" => $contacts]);
    }

    public function permanentDelete($id)
    {
        $contact = Contact::withTrashed()->find($id);
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

    public function bulkPermanentDelete(Request $request)
    {
        foreach ($request->bulkChecks as $key => $value) {
            $contact = Contact::withTrashed()->find($value);
            Storage::delete("public/photo/" . $contact->photo);
            $contact->forceDelete();
            $contact->delete();
        };
        return redirect()->back()->with("status", "Contact is permanently deleted");
    }
}
