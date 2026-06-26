<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        // Get IDs from the request - works for both POST and DELETE
        $ids = $request->input('ids', []);
        
        // If no IDs found, try getting from the request directly
        if (empty($ids)) {
            $ids = $request->ids;
        }
        
        if (empty($ids)) {
            return redirect()->route('admin.contacts')->with('error', 'No items selected.');
        }
        
        $count = Contact::whereIn('id', $ids)->count();
        Contact::whereIn('id', $ids)->delete();
        
        return redirect()->route('admin.contacts')->with('success', $count . ' message(s) deleted successfully.');
    }
}