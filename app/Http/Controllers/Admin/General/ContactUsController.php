<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Events\Event;
use app\Models\General\ContactUs;



class ContactUsController extends AdminController
{
    public function index()
    {
        $contact_us = ContactUs::first();

        return view('admin.page.general.contactus.edit')->with([
            'contact_us' => $contact_us,
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    public function update(Request $request, $id)
    {
        $contact_us = ContactUs::findOrFail($id);
        
        $contact_us->Email = $request->Email;
        $contact_us->Phone = $request->Phone;
        $contact_us->Address = $request->Address;
        $contact_us->Text = $request->Text;

        $contact_us->save();

        $request->session()->flash('alert-success', 'Contact us page updated');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $contact_us = new ContactUs;

        $contact_us->Email = $request->Email;
        $contact_us->Phone = $request->Phone;
        $contact_us->Address = $request->Address;

        $contact_us->save();

        $request->session()->flash('alert-success', 'About us data created');
        return redirect()->back();
    }
}
