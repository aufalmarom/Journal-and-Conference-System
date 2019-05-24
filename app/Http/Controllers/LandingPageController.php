<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Welcome;
use App\Model\Topics;
use App\Model\ImportantDates;
use App\Model\KeyNotes;
use App\Model\Publication;
use App\Model\ScientificCommitte;
use App\Model\OrganizingCommitte;
use App\Model\Sponsorship;
use App\Model\Subscriber;
use App\Model\ContactUs;
use App\Model\FAQ;
use App\Model\RegistrationFee;

class LandingPageController extends Controller
{
    public function ReadLandingPage()
    {
        $data = Welcome::first();
        $data1 = Topics::get();
        $data2 = ImportantDates::get();
        $data3 = KeyNotes::get();
        $data4 = Publication::get();
        $data5 = ScientificCommitte::get();
        $data6 = OrganizingCommitte::get();
        $data7 = Sponsorship::get();
        $data8 = FAQ::get();
        $data9 = RegistrationFee::get();

        return view('/layouts/master/landingpage', compact('data', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9'));

    }

    public function Download(){
        $data = Welcome::first();

		$file=storage_path("app/guidelines/".$data->guidelines);
		return response()->download($file);
    }

    public function StoreEmail(Request $request){
        $post = $request->request->all();
        $simpan = new Subscriber();
        $simpan->email = $post['email'];
        $simpan->status = 1;
        $simpan->save();

        return back()->with('success1', 'Thanks for being close to us, see you soon!');
    }

    public function StoreContactUs(Request $request)
    {
        $post = $request->request->all();
        $simpan = new ContactUs();
        $simpan->name = $post['name'];
        $simpan->email = $post['email'];
        $simpan->title = $post['title'];
        $simpan->message = $post['message'];
        $simpan->status = 0;
        $simpan->save();

        return back()->with('success1', 'Thanks for being close to us, see you soon!');
    }
}
