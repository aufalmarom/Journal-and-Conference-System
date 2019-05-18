<?php

use App\Model\Welcome;
use App\Model\ImportantDates;
use App\Model\User;
use App\Model\InvoiceParticipant;
use App\Model\AuthorInfo;
use App\Model\Reviewer;
use App\Model\AssignedAbstract;
use App\Model\Submissions;
use App\Model\Team;
use App\Model\AbstractScore;
use App\Model\Scores;
use App\Model\Evaluation;

function Logo(){
    $data = Welcome::first();
    return $data->logo;
}

function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function Bulan($id)
{
	if($id == '01')
		$bulan="Januari";
	else if($id == '02')
		$bulan="Februari";
	else if($id == '03')
		$bulan="Maret";
	else if($id == '04')
		 $bulan="April";
	else if($id == '05')
		$bulan="Mei";
	else if($id == '06')
		$bulan="Juni";
	else if($id == '07')
		$bulan="Juli";
	else if($id == '08')
		$bulan="Agustus";
	else if($id == '09')
		$bulan="September";
	else if($id == '10')
		$bulan="Oktober";
	else if($id == '11')
		$bulan="November";
	else if($id == '12')
		$bulan="Desember";
	return $bulan;
}

function RangeDate(){
    $data = Welcome::first();
    $from = date('d', strtotime($data->date_from));
    $to = date('d', strtotime($data->date_to));
    $year  = date('Y', strtotime($data->date_to));
    $return = $from."-".$to.", ".$year;
    return $return;
}
function RangeDateImportantDate($id){
    $data = ImportantDates::find($id);
    $month_from = date('m',strtotime($data->date_from));
    $month_to = date('m',strtotime($data->date_to));
    $date_from = date('d',strtotime($data->date_from));
    $date_to = date('d',strtotime($data->date_to));
    $bulan_from = Bulan($month_from);
    $bulan_to= Bulan($month_to);
    if($data->date_to == NULL){
        $return = $bulan_from." ".$date_from;
    }
    else if($month_from == $month_to){
        $return = $bulan_from." ".$date_from."-".$date_to;
    }
    else{
        $return = $bulan_from." ".$date_from." - ".$bulan_to." ".$date_to;
    }

    return $return;
}

function CekRole(){
    if(Auth::user()->role == 1){
        return "administrator";
    }
    elseif(Auth::user()->role == 2){
        return "reviewer";
    }
    elseif(Auth::user()->role == 3){
        return "author";
    }
    elseif(Auth::user()->role == 4){
        return "participant";
    }
}

function PrintRole()
{
    if (Auth::user()->role == 1) {
        echo 'Administrator';
    }
    elseif (Auth::user()->role == 2) {
        echo 'Reviewer';
    }
    elseif (Auth::user()->role == 3) {
        echo 'Author';
    }
    elseif (Auth::user()->role == 4) {
        echo 'Participant';
    }
}


function CountAllParticipant()
{
    $data = User::where('role', 4)->get();
    $total = count($data);
    return $total;
}

function CountParticipantUnverified()
{
    $data = User::where('email_verified_at', NULL)->where('role', 4)->get();
    $total = count($data);
    return $total;
}

function CountParticipantWaitingInvoice()
{
    $data = User::where('email_verified_at', '<>', NULL)->where('role', 4)->get();
    $data_invoice = InvoiceParticipant::get();
    $total = count($data)-count($data_invoice);
    return $total;
}

function CountParticipantVerifiedUnpaid()
{
    $data_unpaid = InvoiceParticipant::where('file_proof', NULL)->get();
    $total = count($data_unpaid);
    return $total;
}

function CountParticipantWaitingConfirmation()
{
    $data_unpaid = InvoiceParticipant::where('file_proof', '<>', NULL)->where('status', NULL)->get();
    $total = count($data_unpaid);
    return $total;
}

function CountParticipantConfirmed()
{
    $data_unpaid = InvoiceParticipant::where('status', '<>', NULL)->get();
    $total = count($data_unpaid);
    return $total;
}

function StatusAllReviewer($id)
{
    $data = User::find($id);

    if ($data->status == NULL) {
        return 'Reviewer not yet login';
    }else{
        return 'Reviewer was logged-in';
    }
}

function CountReviewer()
{
    $data = Reviewer::get();
    $total = count($data);
    return $total;
}

function StatusParticipant()
{
    $data = InvoiceParticipant::where('id_user', Auth::user()->id)->first();

    if ($data == NULL) {
        return 'Waiting payment invoice from Administrator!';
    }
    elseif ($data->file_proof == NULL) {
        return 'Please pay your payment and upload transaction proof on invoice!';
    }
    elseif ($data->status == NULL && $data->file_proof != NULL) {
        return 'Waiting transaction confirm from Administrator!';
    }else{
        return 'Payment Success! Follow instruction on bottom of your invoice!';
    }
}


function StatusParticipantConfirmed()
{
    $data = InvoiceParticipant::first();

    if ($data == NULL) {
        return 'Waiting payment invoice from Administrator!';
    }
    elseif ($data->file_proof == NULL) {
        return 'Waiting payment proof';
    }
    elseif ($data->status == NULL && $data->file_proof != NULL) {
        return 'Waiting confirm from Administrator';
    }else{
        return 'Confirmed Participant';
    }
}

function StatusAllParticipant()
{

}

function CekDownloadInvoiceParticipant()
{
    $data = InvoiceParticipant::where('id_user', Auth::user()->id)->first();

    return @$data->status;
}

function CountAllAuthor()
{
    $data = User::where('role', 3)->get();
    $total = count($data);
    return $total;
}

function CountAuthorUnverified()
{
    $data = User::where('email_verified_at', NULL)->where('role', 3)->get();
    $total = count($data);
    return $total;
}

function CountAuthorVerifiedEmailNotSendID()
{
    $data = DB::table('users')->select('users.*', 'author_info.id_user')->leftJoin('author_info', 'users.id', '=', 'author_info.id_user')->where('role', 3)->where('email_verified_at', '<>', NULL)->where('id_user', NULL)->get();

    $total = count($data);
    return $total;

}
function CountAuthorVerifiedEmailWaitingVerifiedID()
{
    $data = DB::table('users')->select('users.*', 'author_info.id_user')->leftJoin('author_info', 'users.id', '=', 'author_info.id_user')->where('role', 3)->where('email_verified_at', '<>', NULL)->where('id_user', '<>', NULL)->where('status_verifikasi', NULL)->get();

    $total = count($data);
    return $total;
}

function CountAuthorConfirmedID()
{
    $data = AuthorInfo::where('status_verifikasi', '<>', NULL)->get();
    $total = count($data);
    return $total;
}

function CountAllReviewer()
{
    $data = User::where('role', 2)->get();
    $total = count($data);
    return $total;
}

function CekDocProof()
{
    $data = AuthorInfo::where('id_user', Auth::user()->id)->first();

    return @$data->doc_proof;
}

function CekStatusFormVerif()
{
    $data = AuthorInfo::where('id_user', Auth::user()->id)->first();

    return @$data->id_user;
}
function CekStatusVerifikasiAuthorInfo()
{
    $data = AuthorInfo::where('id_user', Auth::user()->id)->first();

    return @$data->status_verifikasi;
}

function CountAllParticipantsAuthors()
{
    $datas_participants = CountParticipantConfirmed();
    $datas_authors = CountAuthorConfirmedID();
    $total = $datas_participants + $datas_authors;
    return $total;
}

function CountAbstractUnassigned()
{
    $data = count(Submissions::where('date_assigned', NULL)->get());
    return $data;
}

function CountAbstractUnscored()
{
    $data = count(Submissions::where('date_assigned', '<>', NULL)->where('date_score', NULL)->get());
    return $data;
}

function CountAbstractScored()
{
    $data = count(Submissions::where('date_assigned', '<>', NULL)->where('date_score', '<>', NULL)->get());
    return $data;
}

function StatusAuthor()
{

}

// Helper Role Access View - Start
function RoleAdministrator()
{
    $data = User::find(Auth::user()->id);

    if ($data->role == 1) {
        return 1;
    }else{
        return 0;
    }
}

function RoleReviewer()
{
    $data = User::find(Auth::user()->id);

    if ($data->role == 2) {
        return 1;
    }else{
        return 0;
    }
}

function RoleAuthor()
{
    $data = User::find(Auth::user()->id);

    if ($data->role == 3) {
        return 1;
    }else{
        return 0;
    }
}

function RoleParticipant()
{
    $data = User::find(Auth::user()->id);
    if ($data->role == 4) {
        return 1;
    }else{
        return 0;
    }
}


// Helper Role Access View - End

function CekDoubleDashboard()
{
    $reviewer = Reviewer::where('id_user', Auth::user()->id)->first();
    if (@$reviewer->dashboard == 1) {
        return 1;
    }else{
        return 0;
    }
}


// Paper Author Status

function StatusAbstract($id)
{
    $submission = Submissions::find($id);

    if ($submission->date_assigned == NULL) {
        return 'Waiting assigned to Reviewer';
    }
    elseif($submission->date_assigned != NULL && $submission->date_score == NULL ){
        return 'Waiting score from reviewer';
    }
    else{
        return '1';
    }
}

function ArrayTeam(){
    $array_team = array();
    for($i=0; $i < count(Auth::user()->team); $i++){
        $array_team[] = Auth::user()->team[$i]->team_code;
    }

    return $array_team;
}

function TeamPaper($id)
{
    $datas = Team::where('team_code', $id)->get();
    foreach ($datas as $data) {
        echo $data->user->name .'<br>';
    }
}

function CountPaperUnscoredUnreview()
{
    $datas = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $data_review = AbstractScore::where('id_reviewer', Auth::user()->id)->get();
    $total = count($datas)-count($data_review);
    return $total;
}

function Note($id1, $id2){
    $data = Scores::where('id_evaluation', $id1)->where('score', $id2)->first();
    return $data->note;
}

function NoteRecommendation($nilai){
    $data = Evaluation::where('label', 'recommendation')->first();

    return $data->id;
}
