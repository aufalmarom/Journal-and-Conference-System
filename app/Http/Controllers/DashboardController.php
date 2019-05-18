<?php

namespace App\Http\Controllers;

use Hash;
use Mail;
use DB;
use Session;
use Input;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Model\AuthorCategories;
use App\Model\User;
use App\Model\Welcome;
use App\Model\Topics;
use App\Model\ImportantDates;
use App\Model\KeyNotes;
use App\Model\Publication;
use App\Model\ScientificCommitte;
use App\Model\OrganizingCommitte;
use App\Model\Sponsorship;
use App\Model\Subscriber;
use App\Model\FAQ;
use App\Model\ContactUs;
use App\Model\RegistrationFee;
use App\Model\InvoiceParticipant;
use App\Model\AuthorInfo;
use App\Model\Evaluation;
use App\Model\Scores;
use App\Model\Reviewer;
use App\Model\Submissions;
use App\Model\Team;
use App\Model\AssignedAbstract;
use App\Model\AbstractScore;

class DashboardController extends Controller
{

    public $input;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function ReadUnauthorized()
    {
        return view('layouts/dashboard/401');
    }

    public function ReadProfile()
    {
        return view('layouts/dashboard/profile');
    }

    public function PostProfile(Request $request)
    {
        $post = $request->request->all();
        $photo = $request->file('photo');
        $rules = array(
			'photo' => 'max:100|mimes:jpeg, jpg, png',
        );
        $simpan = User::find($post['id']);
        if ($photo == NULL) {
            $simpan->name = $post['name'];
            $simpan->email = $post['email'];
            $simpan->phone = $post['phone'];
            $simpan->address = $post['address'];
            $simpan->country = $post['country'];
            $simpan->affiliation = $post['affiliation'];
            $simpan->description = $post['description'];
            $simpan->save();
            return back()->with('success', 'Data Berhasil Disimpan');
        }else{
            $namephoto = "ava-".$post['name'].".".$photo->extension();
            $simpan->photo = $namephoto;
            $simpan->name = $post['name'];
            $simpan->email = $post['email'];
            $simpan->phone = $post['phone'];
            $simpan->address = $post['address'];
            $simpan->country = $post['country'];
            $simpan->affiliation = $post['affiliation'];
            $simpan->description = $post['description'];
            $simpan->save();
            $validator = Validator::make(Input::all(), $rules);
            if($photo != null){
                if ($validator->fails()) {
                    return back()->with('danger','Format atau ukuran photo tidak sesuai');
                }
                else{
                    $photo->storeAs("/public/user",$namephoto);
                    return back()->with('success', 'Data Berhasil Disimpan');
                }
            }
        }
    }

    public function ReadChangePassword()
    {
        return view('/layouts/dashboard/changepassword');
    }

    public function PostChangePassword(Request $request)
    {
        $post = $request->request->all();
        $current_password = Auth::user()->password;
        if(Hash::check($post['current_password'], $current_password)) {
            $new_password = $post['new_password'];
            $confirm_password = $post['confirm_password'];
            if ($new_password == $confirm_password) {
                $simpan = User::find($post['id']);
                $simpan->password = Hash::make($post['new_password']);
                $simpan->save();
                return back()->with('success', 'Password Berhasil Diubah');
            }else {
                return back()->with('fail', 'Password Baru Tidak Cocok');
            }
        }
        else{
            return back()->with('fail', 'Password Lama Salah');
        }
    }

    public function ReadDashboard()
    {
        if(CekRole() == 'administrator'){
            return view('layouts/dashboard/administrator');
        }elseif(CekRole() == 'reviewer'){
            return view('layouts/dashboard/reviewer');
        }elseif(CekRole() == 'author'){
            $datas_importantdates = ImportantDates::get();
            return view('layouts/dashboard/author', compact('datas_importantdates'));
        }elseif(CekRole() == 'participant'){
            return view('layouts/dashboard/participant');
        }else{
            return view('404');
        }
    }

    // Controller Administrator - Start

    public function ReadLandingPageSet()
    {
        if (RoleAdministrator() == 1){
            return view('/layouts/landingpageset/content');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadWelcome()
    {
        $data = Welcome::first();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/welcome', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function UpdateWelcome(Request $request)
    {
        $post = $request->request->all();
        $logo = $request->file('logo');
        $rules = array(
			'logo' => 'max:100|mimes:jpeg, jpg, png',
        );
        $from = substr($post['tanggal'],0,10);
        $to = substr($post['tanggal'],13,20);
        $simpan = Welcome::find($post['id']);
        $simpan->brand = $post['brand'];
        $simpan->title = $post['title'];
        $simpan->main_theme = $post['main_theme'];
        $simpan->date_from =  $from;
        $simpan->date_to =  $to;
        $simpan->location = $post['location'];
        $simpan->overview = $post['overview'];
        $simpan->save();
        $validator = Validator::make(Input::all(), $rules);
        if($logo != null){
            if ($validator->fails()) {
                return back()->with('danger','Format atau ukuran logo tidak sesuai');
            }
            else{
                $logolama = "storage/app/public/logo.png";
                unlink($logolama);
                $logo->storeAs("public","logo.png");
            }
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadTopics()
    {
        $datas = Topics::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/topics', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostTopics(Request $request)
    {
        $post = $request->request->all();
        Topics::truncate();
        for ($i=0; $i < count($post['favicon']); $i++) {
            $simpan = new Topics;
            $simpan->favicon = $post['favicon'][$i];
            $simpan->title = $post['title'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadImportantDates()
    {
        $datas = ImportantDates::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/importantdates', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostImportantDates(Request $request)
    {
        $post = $request->request->all();
        ImportantDates::truncate();
        for ($i=0; $i < count($post['favicon']); $i++) {
            $simpan = new ImportantDates;
            $simpan->favicon = $post['favicon'][$i];
            $simpan->title = $post['title'][$i];
            if(strlen($post['tanggal'][$i]) > 10){
                $to = substr($post['tanggal'][$i],13,20);
                $simpan->date_to =  $to;
            }
            else{
                $simpan->date_to =  null;
            }
            $from = substr($post['tanggal'][$i],0,10);
            $simpan->date_from =  $from;
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadKeyNotes()
    {
        $datas = KeyNotes::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/keynotes', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostKeyNotes(Request $request)
    {
        $post = $request->request->all();
        $photo = $request->file('photo');
        $maxSize = 100000;
        $gagal = '';
        $success = 0;
        $fileType=['jpg','png','jpeg'];
        for($a=0; $a<count($post['name']); $a++){
            if($post['id'][$a] != null){
                if($post['status'][$a] == "simpan"){
                    $data = Keynotes::find($post['id'][$a]);
                    $data->name = $post['name'][$a];
                    $data->sector = $post['sector'][$a];
                    $data->description = $post['description'][$a];
                    if(@$photo[$a] != null){
                        if($photo[$a]->getSize() < $maxSize && in_array($photo[$a]->extension(),$fileType)){
                            $FileLama = $data->photo;
                            $explode = explode(".",$data->photo);
                            if($explode[1] != $photo[$a]->extension()){
                                $fileName = $explode[0].".".$photo[$a]->extension();
                            }
                            else {
                                $fileName = $data->photo;
                            }
                            $PhotoLocation = "storage/app/public/keynotes/".$FileLama;
                            if(file_exists($PhotoLocation)){
                                unlink($PhotoLocation);
                            }
                            $photo[$a]->storeAs("public/keynotes",$fileName);
                            $data->photo = $fileName;
                        }
                        else{
                            $gagal .= $data->name.", ";
                        }
                    }
                    $data->save();
                    $success++;
                }
                else{
                    $data = Keynotes::find($post['id'][$a]);
                    $fileName = $data->photo;
                    $PhotoLocation = "storage/app/public/keynotes/".$fileName;
                    if(file_exists($PhotoLocation)){
                        unlink($PhotoLocation);
                    }
                    $data->delete();
                }
            }
            else{
                $data = new KeyNotes;
                $fileName = RandomString().".".$photo[$a]->extension();
                if($photo[$a]->getSize() < $maxSize && in_array($photo[$a]->extension(),$fileType)){
                    $photo[$a]->storeAs("public/keynotes",$fileName);
                }
                else{
                    $gagal .= $post['name'][$a].", ";
                }

                $data->name = $post['name'][$a];
                $data->photo = $fileName;
                $data->sector = $post['sector'][$a];
                $data->description = $post['description'][$a];
                $data->save();
                $success++;
            }
        }
        if($gagal == ''){
            return back()->with('success', $success.' Data Berhasil Disimpan' );
        }
        else{
            return back()->with('success', $success.' Data Berhasil Disimpan')->with('danger', 'Foto Gagal Tersimpan Pada '.$gagal);
        }
    }

    public function ReadPublication()
    {
        $datas = Publication::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/publication', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostPublication(Request $request)
    {
        $post = $request->request->all();
        Publication::truncate();
        for ($i=0; $i < count($post['name']); $i++) {
            $simpan = new Publication;
            $simpan->name = $post['name'][$i];
            $simpan->link = $post['link'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadGuidelines()
    {
        $datas = Welcome::first();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/guidelines', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }

    }

    public function UploadGuidelines(Request $request)
    {
        $post = $request->request->all();
        $pdf = $request->file('guidelines');
        $filetype = 'pdf';
        if ($pdf->extension() == $filetype) {
            $fileName = $_FILES['guidelines']['name'];
            $data = Welcome::first();
            $FileLama = "storage/app/guidelines/".$data->guidelines;
            if(file_exists($FileLama)){
                unlink($FileLama);
            }
            $data->guidelines = $fileName;
            $data->save();
            $pdf->storeAs('guidelines', $fileName);
            return back()->with('success', 'File Berhasil Diupload');
        }else{
            return back()->with('danger', 'File Gagal Diupload');
        }
    }

    public function ReadScientificCommitte()
    {
        $datas = ScientificCommitte::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/scientificcommitte', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostScientificCommitte(Request $request)
    {
        $post = $request->request->all();
        ScientificCommitte::truncate();
        for ($i=0; $i < count($post['name']); $i++) {
            $simpan = new ScientificCommitte;
            $simpan->name = $post['name'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadOrganizingCommitte()
    {
        $datas = OrganizingCommitte::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/organizingcommitte', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostOrganizingCommitte(Request $request)
    {
        $post = $request->request->all();
        OrganizingCommitte::truncate();
        for ($i=0; $i < count($post['name']); $i++) {
            $simpan = new OrganizingCommitte;
            $simpan->name = $post['name'][$i];
            $simpan->position = $post['position'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadSponsorship()
    {
        $datas = Sponsorship::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/sponsorship', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }

    }

    public function PostSponsorship(Request $request)
    {
        $post = $request->request->all();
        $photo = $request->file('photo');
        $maxSize = 100000;
        $gagal = '';
        $success = 0;
        $fileType=['jpg','png','jpeg'];
        for($a=0; $a<count($post['name']); $a++){
            if($post['id'][$a] != null){
                if($post['status'][$a] == "simpan"){
                    $data = Sponsorship::find($post['id'][$a]);
                    $data->name = $post['name'][$a];
                    if(@$photo[$a] != null){
                        if($photo[$a]->getSize() < $maxSize && in_array($photo[$a]->extension(),$fileType)){
                            $FileLama = $data->photo;
                            $explode = explode(".",$data->photo);
                            if($explode[1] != $photo[$a]->extension()){
                                $fileName = $explode[0].".".$photo[$a]->extension();
                            }
                            else {
                                $fileName = $data->photo;
                            }
                            $PhotoLocation = "storage/app/public/sponsorship/".$FileLama;
                            if(file_exists($PhotoLocation)){
                                unlink($PhotoLocation);
                            }
                            $photo[$a]->storeAs("public/sponsorship",$fileName);
                            $data->photo = $fileName;
                        }
                        else{
                            $gagal .= $data->name.", ";
                        }
                    }
                    $data->save();
                    $success++;
                }
                else{
                    $data = Sponsorship::find($post['id'][$a]);
                    $fileName = $data->photo;
                    $PhotoLocation = "storage/app/public/sponsorship/".$fileName;
                    if(file_exists($PhotoLocation) && $fileName != ""){
                        unlink($PhotoLocation);
                    }
                    $data->delete();
                }
            }
            else{
                $data = new Sponsorship;
                $fileName = RandomString().".".$photo[$a]->extension();
                if($photo[$a]->getSize() < $maxSize && in_array($photo[$a]->extension(),$fileType)){
                    $photo[$a]->storeAs("public/sponsorship",$fileName);
                }
                else{
                    $gagal .= $post['name'][$a].", ";
                }

                $data->name = $post['name'][$a];
                $data->photo = $fileName;
                $data->save();
                $success++;
            }
        }
        if($gagal == ''){
            return back()->with('success', $success.' Data Berhasil Disimpan' );
        }
        else{
            return back()->with('success', $success.' Data Berhasil Disimpan')->with('danger', 'Foto Gagal Tersimpan Pada '.$gagal);
        }
    }

    public function ReadEmail()
    {
        $datas = Subscriber::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/newsletter', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }

    }

    public function BlastEmail(Request $request)
    {
        $datas = Subscriber::get();
        for ($i=0; $i < count($datas); $i++) {
            Mail::send('emails.test', compact('datas'), function($message) use ($datas, $i){
			$message->to($datas[$i]['email']);
			$message->subject('Konfirmasi Pembayaran');
		});
        }
        return back()->with('success', 'Email was blasted');
    }

    public function ReadMessage(Request $request)
    {
        $post = $request->request->all();
        $data = ContactUs::find($post['id']);
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/contactusreply', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReplyMessage(Request $request)
    {
        $post = $request->request->all();
        $data = ContactUs::find($post['id']);
        $data->answer = $post['answer'];
        $data->save();
        Mail::raw($data->answer, function($message) use ($data)
        {
            $message->from('ictcred@live.undip.ac.id', 'Administrator ICTCRED');

            $message->to($data->email)->subject('ANSWER');
        });
        return redirect(route('contactus.read'))->with('success', 'Pesan berhasil dibalas');
    }

    public function ReadFAQ()
    {
        $datas = FAQ::get();
        if (RoleAdministrator() == 1){
            return view('/layouts/landingpageset/faq', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFAQ(Request $request)
    {
        $post = $request->request->all();
        FAQ::truncate();
        for ($i=0; $i < count($post['question']); $i++) {
            $simpan = new FAQ;
            $simpan->question = $post['question'][$i];
            $simpan->answer = $post['answer'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadContactUs()
    {
        $datas = ContactUs::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/contactus', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadRegistrationFee()
    {
        $datas = RegistrationFee::get();
        if (RoleAdministrator() == 1){
            return view('layouts/landingpageset/registrationfee', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostRegistrationFee(Request $request)
    {
        $post = $request->request->all();
        RegistrationFee::truncate();
        for ($i=0; $i < count($post['category']); $i++) {
            $simpan = new RegistrationFee;
            $simpan->category = $post['category'][$i];
            $simpan->early_bird = $post['early_bird'][$i];
            $simpan->regular = $post['regular'][$i];
            $simpan->on_site = $post['on_site'][$i];
            $simpan->save();
        }
        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function ReadAuthorCategoriesSet()
    {
        $datas = AuthorCategories::get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/authorcategories', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostAuthorCategories(Request $request)
    {
        $post = $request->request->all();
        $simpan = new AuthorCategories;
        $simpan->categories = $post['categories'];
        $simpan->save();
        return back()->with('success', 'Data Berhasil Ditambah');
    }

    public function DeleteAuthorCategories(Request $request)
    {
        $post = $request->request->all();
        $model = AuthorCategories::find($post['id']);
        $model->delete();
        return back()->with('danger', 'Data was deleted');
    }

    public function ReadAllReviewer()
    {
        $datas = Reviewer::get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/allreviewer', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function DeleteReviewer(Request $request)
    {
        $post = $request->request->all();
        $data = User::find($post['id']);
        $reviewer = Reviewer::where('email', $data->email)->first();
        $reviewer->delete();
        if ($data->role == 2) {
            $data->delete();
        }
        return back()->with('fail', 'Reviewer was deleted');
    }

    protected function PostAddReviewer(Request $request)
    {
        $post = $request->request->all();
        $check = User::where('email', $post['email'])->first();
        if(@$check == NULL){
            $tanggal = date('Y-m-d H:i:s');
            $password = $post['password'];
            $data = new User();
            $data->name = $post['name'];
            $data->email = $post['email'];
            $data->email_verified_at = $tanggal;
            $data->role = $post['role'];
            $data->password = Hash::make($post['password']);
            $data->save();
            Mail::send('emails.reviewer', compact('data', 'password'), function($message) use ($data){
                $message->to($data->email);
                $message->subject('Account Reviewer');
            });
            $reviewer = new Reviewer();
            $reviewer->id_user = $data->id;
            $reviewer->dashboard = 0;
            $reviewer->email = $post['email'];
            $reviewer->save();
        }elseif($check->role == 3){
            $check_reviewer = Reviewer::where('email', $post['email'])->first();
            if(@$check_reviewer == NULL){
                $reviewer = new Reviewer();
                $reviewer->id_user = $check->id;
                $reviewer->email = $post['email'];
                $reviewer->dashboard = 1;
                $reviewer->save();
            }
            else{
                return back()->with('success', 'Email was registered');
            }
        }elseif($check->role == 4){
            $check->delete();
            $tanggal = date('Y-m-d H:i:s');
            $password = $post['password'];
            $data = new User();
            $data->name = $post['name'];
            $data->email = $post['email'];
            $data->email_verified_at = $tanggal;
            $data->role = $post['role'];
            $data->password = Hash::make($post['password']);
            $data->save();
            Mail::send('emails.reviewer', compact('data', 'password'), function($message) use ($data){
                $message->to($data->email);
                $message->subject('Account Reviewer');
            });
            $reviewer = new Reviewer();
            $reviewer->id_user = $data->id;
            $reviewer->dashboard = 0;
            $reviewer->email = $post['email'];
            $reviewer->save();
        }else{
            $check_reviewer = Reviewer::where('email', $post['email'])->first();
            if(@$check_reviewer == NULL){
                $reviewer = new Reviewer();
                $reviewer->id_user = $check->id;
                $reviewer->dashboard = 0;
                $reviewer->email = $post['email'];
                $reviewer->save();
            }
            else{
                return back()->with('success', 'Email was registered');
            }
        }

        return back()->with('success', 'Reviewer was added');
    }

    public function ReadAllPaper()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/allpaper');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSidebarAuthor()
    {
        if (RoleAdministrator() == 1){
            return view('/layouts/administratorset/sidebarauthor');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSidebarPaper()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarpaper');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAllAuthor()
    {
        $datas = User::where('role', 3)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/allauthors', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAuthorUnverified()
    {
        $datas = User::where('email_verified_at', NULL)->where('role', 3)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/authorunverified', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAuthorVerifiedNotSendID()
    {
        $datas = DB::table('users')->select('users.*', 'author_info.id_user')->leftJoin('author_info', 'users.id', '=', 'author_info.id_user')->where('role', 3)->where('email_verified_at', '<>', NULL)->where('id_user', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/authorverifiednotyetsendid', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAuthorVerifiedWaitingConfirmID()
    {
        $datas = AuthorInfo::where('id_user', '<>', NULL)->where('status_verifikasi', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/authorverifiedwaitingconfirmid', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadVerifikasiAuthor()
    {
        $datas = AuthorCategories::get();
        if (RoleAuthor() == 1){
            return view('layouts/author/formverifikasidatadiri', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostVerifikasiAuthor(Request $request)
    {
        $post = $request->request->all();
        $doc_proof = $request->file('doc_proof');
        $maxSize = 1000000;
        $fileType=['jpg','png','jpeg'];
        $simpan = new AuthorInfo();
        $fileName = "DataDiri-".Auth::user()->name.".".$doc_proof->extension();
        if($doc_proof->getSize() < $maxSize && in_array($doc_proof->extension(),$fileType)){
            $doc_proof->storeAs("public/datadiri/",$fileName);
        }
        else{
            return back()->with('danger', 'Dokumen Data Diri Tidak Sesuai');
        }
        $simpan->id_user = $post['id_user'];
        $simpan->id_author_categories = $post['id_author_categories'];
        $simpan->doc_proof = $fileName;
        $simpan->save();
        return back()->with('success', 'Dokumen Data Diri telah diupload');
    }

    public function ConfirmID($id)
    {
        $simpan = AuthorInfo::where('id_user', $id)->first();
        $simpan->status_verifikasi = 1;
        $simpan->save();
        return back()->with('success', 'Data Diri telah diverifikasi');
    }

    public function ReadConfirmedID()
    {
        $datas = AuthorInfo::where('status_verifikasi', '<>', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/authorconfirmedid', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPaperUnpaid()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/paperunpaid');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPaperPaid()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/paperpaid');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAllPPT()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/allppt');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReregistration()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/reregistration');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReregistrationPaper()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/reregistrationpaper');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReregistrationParticipant()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/reregistrationparticipant');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSidebarParticipant()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarparticipant');
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAllParticipant()
    {
        $datas = User::where('role', 4)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/allparticipant', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadParticipantUnverified()
    {
        $datas = User::where('email_verified_at', NULL)->where('role', 4)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/participantunverified', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadParticipantVerifiedWaitingInvoice()
    {
        $datas = DB::table('users')->select('users.*', 'invoice_participants.id_user')->leftJoin('invoice_participants', 'users.id', '=', 'invoice_participants.id_user')->where('role', 4)->where('email_verified_at', '<>', NULL)->where('id_user', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/participantverifiedwaitinginvoice', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormSendInvoice($id)
    {
        $data = InvoiceParticipant::where('id_user', $id)->first();
        $participant = User::find($id);
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/formsendinvoice', compact('data', 'participant'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadParticipantVerifiedUnpaid()
    {
        $datas = InvoiceParticipant::where('file_proof', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/participantverifiedunpaid', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    function PostFileProof(Request $request)
    {
        $post = $request->request->all();
        $file_proof = $request->file('file_proof');
        $maxSize = 100000;
        $fileType=['jpg','png','jpeg'];
        $data = InvoiceParticipant::find($post['id']);
        $fileName = "Invoice-".$post['no_invoice'].".".$file_proof->extension();
        if($file_proof->getSize() < $maxSize && in_array($file_proof->extension(),$fileType)){
            $file_proof->storeAs("public/invoice/",$fileName);
        }else{
            return back()->with('fail', 'File Bukti Pembayaran Tidak Sesuai');
        }
        $data->file_proof = $fileName;
        $data->nominal_transfered = $post['nominal_transfered'];
        $data->save();

        return back()->with('success', 'Invoice Berhasil Dikirim');
    }

    public function DownloadFileProof()
    {
        $data = InvoiceParticipant::first();
		$file = storage_path("app/public/invoice".$data->file_proof);
		return response()->download($file);
    }

    public function ReadParticipantWaitingConfirmation()
    {
        $datas = InvoiceParticipant::where('file_proof', '<>', NULL)->where('status', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/participantwaitingconfirmation', compact('datas'));
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ConfirmParticipant($id)
    {
        $datas = InvoiceParticipant::find($id);
        $datas->status = 1;
        $datas->save();
        return back()->with('success', 'Participant was confirmed');
    }

    public function ReadParticipantConfirmed()
    {
        $datas = InvoiceParticipant::where('status', '<>', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/participantconfirmed', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ExportRecapDataParticipant()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function ReadEvaluationSystem()
    {
        $datas = Evaluation::get();
        $datas_score = Scores::get();

        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/evaluation', compact('datas', 'datas_score'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }

    }

    public function PostEvaluationSystem(Request $request)
    {
        $post = $request->request->all();
        $data = new Evaluation();
        $data->label = $post['label'];
        $data->prompt = $post['prompt'];
        $data->save();
        return back()->with('success', 'Scoring Criteria was added');
    }

    public function ReadScores($id)
    {
        $data = Evaluation::find($id);
        $datas = Scores::where('id_evaluation', $id)->get();

        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/score', compact('data', 'datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }

    }

    public function PostScores(Request $request)
    {
        $post = $request->request->all();
        $check = Scores::where('id_evaluation', $post['id_evaluation'])->get();
        if(@$check[0]->id_evaluation != NULL){
            foreach ($check as $cek) {
                $cek->delete();
            }
        }
        if (@$post['score'][0] != NULL) {
            for ($i=0; $i < count($post['score']); $i++) {
                $data = new Scores();
                $data->id_evaluation = $post['id_evaluation'];
                $data->score = $post['score'][$i];
                $data->note = $post['note'][$i];
                $data->save();
            }
        }

        return back()->with('success_score', 'Scores was set up');
    }

    public function DeleteEvalScores(Request $request)
    {
        $post = $request->request->all();
        $data_eval = Evaluation::find($post['id']);
        $data_score = Scores::where('id_evaluation', $post['id']);
        $data_eval->delete();
        $data_score->delete();

        return back()->with('danger', 'Data was deleted');
    }

    public function ReadReviewsForm()
    {
        return view('layouts/review/reviewsform');
    }

    public function ReadAbstractUnassigned()
    {
        $datas = DB::table('submissions')->select('submissions.id as id','submissions.id_user','submissions.title','submissions.team_code','assigned_abstract.id_paper')->leftJoin('assigned_abstract', 'submissions.id', '=', 'assigned_abstract.id_paper')->where('assigned_abstract.id_paper', NULL)->get();

        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/abstractunassigned', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAssignToReviewer($id)
    {
        $data = Submissions::find($id);
        $data_array = array();
        $data_array[] = $data->team_code;
        $data_topic = Topics::find($id);
        $reviewer1 = Reviewer::leftJoin('team', 'reviewer.id_user', '=', 'team.id_user')->select('reviewer.id', 'reviewer.id_user', 'team.team_code')->whereNull('team_code')->get();
        $reviewer2 = Reviewer::leftJoin('team', 'reviewer.id_user', '=', 'team.id_user')->select('reviewer.id', 'reviewer.id_user', 'team.team_code')->whereNotNull('team_code')->whereNotIn('team_code', $data_array)->get();
        if (RoleAdministrator() == 1){
            return view('/layouts/review/assigntoreviewer', compact('data', 'data_topic', 'reviewer1', 'reviewer2'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostAssignToReviewer(Request $request)
    {
        $post = $request->request->all();
        $submission = Submissions::find($post['id']);
        $submission->date_assigned = date('Y-m-d H:i:s');
        $submission->save();
        for ($i=0; $i < count($post['reviewer']); $i++) {
            $data = new AssignedAbstract();
            $data->id_paper = $post['id'];
            $data->id_reviewer = $post['reviewer'][$i];
            $data->save();
        }
        return redirect(route('abstractunscored.read'));
    }

    public function ReadAbstractUnscored()
    {

        $datas = Submissions::where('date_assigned', '<>', NULL)->where('date_score', NULL)->get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/abstractunscored', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function EditAssignToReviewer($id)
    {
        $data = Submissions::find($id);
        $data_array = array();
        $data_array[] = $data->team_code;
        $data_topic = Topics::find($id);
        $array_assigned = array();
        $assigned = AssignedAbstract::where('id_paper', $id)->get();
        for($i=0; $i < count($assigned); $i++){
            $array_assigned[] = $assigned[$i]->id_reviewer;
        }
        $reviewer1 = Reviewer::leftJoin('team', 'reviewer.id_user', '=', 'team.id_user')->select('reviewer.id', 'reviewer.id_user', 'team.team_code')->whereNull('team_code')->get();
        $reviewer2 = Reviewer::leftJoin('team', 'reviewer.id_user', '=', 'team.id_user')->select('reviewer.id', 'reviewer.id_user', 'team.team_code')->whereNotNull('team_code')->whereNotIn('team_code', $data_array)->get();


        return view('layouts/administratorset/editassigntoreviewer', compact('data', 'data_topic', 'reviewer1', 'reviewer2', 'array_assigned','assigned'));
    }

    public function PostEditAssignToReviewer(Request $request)
    {
        $post = $request->request->all();
        $data = AssignedAbstract::where('id_paper',$post['id'])->get();
        foreach($data as $delete){
            $delete->delete();
        }
        for($i=0; $i<count($post['reviewer']); $i++){
            $simpan = new AssignedAbstract();
            $simpan->id_paper = $post['id'];
            $simpan->id_reviewer = $post['reviewer'][$i];
            $simpan->save();
        }
        return redirect(route('abstractunscored.read'));
    }

    public function ReadSideBarSecretary()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarsecretary');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSideBarFinance()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarfinance');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSideBarLogActivityReviewer()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarlogactivityreviewer');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSideBarLogActivityAuthor()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarlogactivityauthor');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadSideBarLogActivityParticipant()
    {
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/sidebarlogactivityparticipant');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }


    //Functional Administrator - End

    //Functional Reviewer - Start

    public function ReadDashboardChangeRole()
    {
        $check = Reviewer::where('id_user', Auth::user()->id)->first();
        if(@$check->email == NULL){
            return redirect(route('unauthorized.read'));
        }else{
            $user = User::find(Auth::user()->id);
            if($user->role == 2){
                $user->role = 3;
            }else{
                $user->role = 2;
            }
            $user->save();
            return back();
        }
    }

    public function ReadSidebarReviewer()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/administratorset/sidebarreviewer');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAbstractToScore()
    {
        $datas = Submissions::select('submissions.*','assigned_abstract.id_paper','assigned_abstract.id_reviewer','abstract_score.score')->where('date_assigned', '<>', NULL)->leftjoin('assigned_abstract','submissions.id','=','assigned_abstract.id_paper')->leftjoin('abstract_score','assigned_abstract.id_reviewer','=','abstract_score.id_reviewer')->where('assigned_abstract.id_reviewer',Auth::user()->id)->where('abstract_score.score',NULL)->get();

        if (RoleReviewer() == 1){
            return view('/layouts/review/abstracttoscore', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormScore($id)
    {
        if (RoleReviewer() == 1){
            $data = Submissions::find($id);
            $criteria = Evaluation::where('label', '<>', 'recommendation')->get();

            $rekomendasi = Evaluation::where('label', 'recommendation')->first();
            $score_rekomendasi = Scores::where('id_evaluation',$rekomendasi->id)->get();
            $score = Scores::get();
            $array_paper = array();
            for($i=0; $i< count($data->assignedabstract);$i++){
                $array_paper[] = $data->assignedabstract[$i]->id_reviewer;
            }
            if(in_array(Auth::user()->id, $array_paper)){
                return view('/layouts/review/formscore', compact('data', 'criteria', 'score','score_rekomendasi'));
            }else{
                return redirect(route('unauthorized.read'));
            }
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFormScore(Request $request)
    {
        $post = $request->request->all();
        for($i=0; $i<count($post['id_criteria']); $i++){
            $data = new AbstractScore();
            $data->id_paper = $post['id_paper'];
            $data->id_evaluation = $post['id_criteria'][$i];
            $data->score = $post['score_'.$post['id_criteria'][$i]];
            $data->id_reviewer = Auth::user()->id;
            $data->save();
        }
        $submission = Submissions::find($post['id_paper']);
        $submission->date_score = date('Y-m-d H:i:s');
        $submission->save();
        return redirect(route('abstracttoscore.read'));
    }

    public function ReadAbstractToDecide()
    {
        if (RoleAdministrator() == 1){
            $submissions = Submissions::where('date_score', '<>', NULL)->where('status_paper', NULL)->get();
            return view('/layouts/administratorset/abstracttodecide', compact('datas', 'submissions'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormDecide($id)
    {
        if(RoleAdministrator() == 1){
            $submission = Submissions::find($id);
            $score = AbstractScore::where('id_paper', $id)->get();
            $jumlah = 0;
            foreach($score as $data){
                $jumlah += $data->score;
            }
            $nilai_rekomendasi = round($jumlah/4, 0, PHP_ROUND_HALF_DOWN);
            return view('/layouts/administratorset/formdecide', compact('submission', 'score', 'nilai_rekomendasi'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFormDecide(Request $request)
    {
        if (RoleAdministrator() == 1){
            $post = $request->request->all();
            $data = Submissions::where('id', $post['id_paper'])->first();
            $data->status_paper = $post['status_paper'];
            $data->save();
            return redirect(route('abstracttodecide.read'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewAbstract()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/review/reviewabstract');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewAbstractReviewed()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/review/reviewabstractreviewed');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewAbstractFinal()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/review/reviewabstractfinal');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewFullPaper()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/review/reviewfullpaper');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewFullPaperUnderview()
    {
        if (RoleReviewer() == 1){
            return view('/layouts/review/reviewfullpaperunderview');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewFullPaperCameraReady()
    {
            if (RoleReviewer() == 1){
                return view('/layouts/review/reviewfullpapercameraready');
            }
            else{
                return redirect(route('unauthorized.read'));
            }
    }

    public function ReadLogActivityReviewer(){
        if (RoleReviewer() == 1){
            return view('/layouts/review/logactivityreviewer');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    //Functional Reviewer - End

    //Functional Author - Start

    public function ReadSubmission()
    {
        if (RoleAuthor() == 1){
            $data_topics = Topics::get();
            return view('layouts/submission/submission', compact('data_topics'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostSubmission(Request $request)
    {
        $post = $request->request->all();
        $update_telp = User::find(Auth::user()->id);
        $update_telp->phone = $post['phone'];
        $update_telp->save();
        $team_code = RandomString();
        for ($i=0; $i < count($post['email']); $i++) {
            $user = User::where('email', $post['email'][$i])->first();
            $id_user = @$user->id;
            $tanggal = date('Y-m-d H:i:s');
            $password = RandomString();
            if (@$user->role == 4) {
                $user->delete();
                $data = new User();
                $data->name = $post['name'][$i];
                $data->email = $post['email'][$i];
                $data->email_verified_at = $tanggal;
                $data->role = 3;
                $data->password = Hash::make($password);
                $data->save();
                Mail::send('emails.author', compact('data', 'password'), function($message) use ($data){
                    $message->to($data->email);
                    $message->subject('Account Author');
                });
                $id_user = $data->id;
            }elseif(@$user->email == NULL){
                $data = new User();
                $data->name = $post['name'][$i];
                $data->email = $post['email'][$i];
                $data->email_verified_at = $tanggal;
                $data->role = 3;
                $data->password = Hash::make($password);
                $data->save();
                Mail::send('emails.author', compact('data', 'password'), function($message) use ($data){
                    $message->to($data->email);
                    $message->subject('Account Author');
                });
                $id_user = $data->id;
            }
            $team = new Team();
            $team->id_user = $id_user;
            $team->team_code = $team_code;
            $team->save();
        }
        $submission = new Submissions();
        $submission->id_user = Auth::user()->id;
        $submission->team_code = $team_code;
        $submission->title = $post['title'];
        $submission->topic = $post['topic'];
        $submission->presentation = $post['presentation'];
        $submission->keywords = $post['keywords'];
        $submission->abstract = $post['ck_input'];
        $submission->save();

        $update_team = Team::where('team_code', $team_code)->get();
        foreach($update_team as $update){
            $update->id_paper = $submission->id;
            $update->save();
        }

        $first_author_team = new Team();
        $first_author_team->id_user = Auth::user()->id;
        $first_author_team->id_paper = $submission->id;
        $first_author_team->team_code = $team_code;
        $first_author_team->save();

        return redirect(route('abstractsubmitted.read'));
    }

    public function ReadAbstractSubmitted()
    {
        $array_team = array();

        for($i=0; $i<count(Auth::user()->team); $i++){
            $array_team[] = Auth::user()->team[$i]->team_code;
        }
        $datas = Submissions::whereIn('team_code', $array_team)->get();

        if (RoleAuthor() == 1){
            $data_topics = Topics::get();
            return view('layouts/submission/submitted', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function EditAbstractSubmitted($id)
    {
        $data = Submissions::find($id);
        $data_topics = Topics::get();
        if(in_array($data->team_code, ArrayTeam())){
            if (RoleAuthor() == 1){
                $data_topics = Topics::get();
                return view('/layouts/submission/editabstract', compact('data', 'data_topics'));
            }
            else{
                return redirect(route('unauthorized.read'));
            }
        }else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostEditAbstractSubmitted (Request $request)
    {
        $post = $request->request->all();
        $data = Submissions::find($post['id']);
        $data->title = $post['title'];
        $data->topic = $post['topic'];
        $data->presentation = $post['presentation'];
        $data->abstract = $post['ck_input'];
        $data->keywords = $post['keywords'];
        $data->save();

        return redirect(route('abstractsubmitted.read'))->with('success', 'Abstract was edited');
    }

    public function DeleteAbstractSubmitted(Request $request)
    {
        $post = $request->request->all();
        $data = Submissions::find($post['id']);
        $team = Team::where('team_code', $data->team_code)->get();
        foreach($team as $tim){
            $tim->delete();
        }
        $data->delete();

        return back()->with('danger', 'Abstract was deleted');
    }

    public function ReadPaperReviewed()
    {
        if (RoleAuthor() == 1){
            return view('layouts/submission/paperreviewed');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    //Functional Author - End

    //Functional Participant - Start

    public function ReadInvoice()
    {
        $data = InvoiceParticipant::where('id_user', Auth::user()->id)->first();
        if (RoleParticipant() == 1){
            return view('layouts/eventregistration/invoiceparticipant', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    function PostFormInvoice(Request $request)
    {
        $post = $request->request->all();
        $simpan = new InvoiceParticipant;
        $simpan->id_user = $post['id_user'];
        $simpan->price = $post['price'];
        $simpan->va = $post['va'];
        $simpan->no_invoice = RandomString();
        $simpan->expired_at = date("Y-m-d H:i:s");;
        $simpan->save();
        return back()->with('success', 'Invoice Berhasil Dikirim');
    }

    function ReadLogActivityParticipant(){
        if (RoleParticipant() == 1){
            return view('layouts/eventregistration/logactivityparticipant');
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }
    //Functional Participant - End

}
