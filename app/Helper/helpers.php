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
use App\Model\InvoicePaper;
use App\Model\Powerpoint;

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


function CountAllPaper()
{
    $data = count(Submissions::get());
    return $data;
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
    $data = count(Submissions::where('date_assigned', '<>', NULL)->where('date_score', '<>', NULL)->where('status_paper', NULL)->get());
    return $data;
}

function CountAbstractRejected()
{
    $data = count(Submissions::where('date_assigned', '<>', NULL)->where('date_score', '<>', NULL)->where('status_paper', 'reject')->get());
    return $data;
}

function CountAbstractAcceptedWaitingInvoice()
{
    $data = count(Submissions::where('date_decide', '<>', NULL)->where('date_invoice', NULL)->get());
    return $data;
}

function CountAbstractGotInvoiceUnpaid()
{
    $data = count(InvoicePaper::where('no_invoice', '<>', NULL)->where('status_payment', NULL)->get());
    return $data;
}

function CountPaperWaitingConfirm()
{
    $data = count(InvoicePaper::where('file_proof', '<>', NULL)->where('status_payment', NULL)->get());
    return $data;
}

function CountPaperPaid()
{
    $data = count(InvoicePaper::where('status_payment', 1)->get());
    return $data;
}

function CountAbstractUnreview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_abstract_review', NULL)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', NULL)->where('date_abstract_final', NULL)->where('date_abstract_final', NULL)->get());
    return $data;
}

function CountAbstractReview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_abstract_review', '<>', NULL)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', NULL)->where('date_abstract_final', NULL)->where('date_abstract_final', NULL)->get());
    return $data;
}

function CountAbstractReviewedUnreview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', NULL)->where('date_abstract_final', NULL)->where('date_abstract_final', NULL)->get());
    return $data;
}


function CountAbstractReviewedReview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', NULL)->where('date_presentation', NULL)->get());
    return $data;
}


function CountAbstractFinalUndecideReviewer()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', NULL)->where('date_decide_presentation', NULL)->get());
    return $data;
}

function CountAbstractFinalUndecideAdministrator()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', NULL)->get());
    return $data;
}

function CountAbstractFinalDecided()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->get());
    return $data;
}

function CountPaperUnreview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', NULL)->where('date_paper_underview', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get());
    return $data;
}

function CountPaperReviewed()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get());
    return $data;
}

function CountPaperUnderviewUnreview()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get());
    return $data;
}


function CountPaperUnderviewReviewed()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', NULL)->get());
    return $data;
}

function CountPaperCameraReady()
{
    $data = count(Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', '<>', NULL)->get());
    return $data;
}

function CountRegistPaper()
{
    $data = count(Submissions::where('status_paper', 'accept')->get());
    return $data;
}


function CountAllPowerpoint()
{
    $data = count(Powerpoint::get());
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

function StatusPaper($id)
{
    $submission = Submissions::find($id);

    if (@$submission->date_assigned == NULL) {
        return 'Waiting assigned to Reviewer';
    }
    elseif(@$submission->date_score == NULL ){
        return 'Waiting score from reviewer';
    }
    elseif(@$submission->status_paper == 'reject' ){
        return 'Rejected';
    }
    elseif(@$submission->status_paper == 'accept' ){
        return 'Accepted';
    }
    elseif(@$submission->date_decide == NULL){
        return 'Waiting Decision from Scientific Committe';
    }
    elseif(@$submission->date_invoice == NULL){
        return 'Waiting Invoice from Administrator';
    }
    elseif(@$submission->status_payment == NULL){
        return 'Please finish Payment';
    }
    elseif(@$submission->date_abstract_review == NULL){
        return 'Waiting Review Abstract';
    }
    elseif(@$submission->date_after_review == NULL){
        return 'Waiting submit Abstract Reviewed';
    }
    elseif(@$submission->date_abstract_review_revision == NULL){
        return 'Waiting Review Abstract Reviewed';
    }
    elseif(@$submission->date_abstract_final == NULL){
        return 'Waiting submit Abstract Final';
    }
    elseif(@$submission->date_presentation == NULL){
        return 'Waiting decide presentation';
    }
    elseif(@$submission->date_decide_presentation == NULL){
        return 'Waiting decide presentation';
    }
    elseif(@$submission->date_paper == NULL){
        return 'Waiting submit Full Paper';
    }
    elseif(@$submission->date_paper_review == NULL){
        return 'Waiting review Full Paper';
    }
    elseif(@$submission->date_paper_underview == NULL){
        return 'Waiting submit Full Paper Underview';
    }
    elseif(@$submission->date_paper_underview_review == NULL){
        return 'Waiting review Full Paper Underview';
    }
    elseif(@$submission->date_ppt == NULL){
        return 'Waiting upload PowerPoint';
    }
    elseif(@$submission->date_paper_camera_ready == NULL){
        return 'Waiting submit Full Paper Camera Ready';
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

function TeamAbstract($id)
{
    $datas = Team::where('team_code', $id)->get();
    foreach ($datas as $data) {
        echo $data->user->name .', ';
    }
}

function CountAbstractToScore()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id','abstract_score.score','abstract_score.id_reviewer')->leftjoin('abstract_score', 'submissions.id', '=', 'abstract_score.id_paper')->groupby('abstract_score.id_reviewer')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountAbstractToReview()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id','abstract_review.abstract_review','abstract_review.id_reviewer')->leftjoin('abstract_review', 'submissions.id', '=', 'abstract_review.id_paper')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountAbstractReviewedToReview()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id','abstract_review_revision.abstract_after_review_revision','abstract_review_revision.id_reviewer')->leftjoin('abstract_review_revision', 'submissions.id', '=', 'abstract_review_revision.id_paper')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountAbstractAbstractFinalToDecide()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id','abstract_final_decision.presentation','abstract_final_decision.id_reviewer')->leftjoin('abstract_final_decision', 'submissions.id', '=', 'abstract_final_decision.id_paper')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountPaperToReview()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id', 'paper_review.id_reviewer')->leftjoin('paper_review', 'submissions.id', '=', 'paper_review.id_paper')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountPaperUnderviewToReview()
{
    $datas_ab = AssignedAbstract::where('id_reviewer', Auth::user()->id)->get();
    $jumlah = count($datas_ab);
    $datas = Submissions::select('submissions.id', 'paper_underview_review.id_reviewer')->leftjoin('paper_underview_review', 'submissions.id', '=', 'paper_underview_review.id_paper')->get();
    foreach($datas as $item){
        if($item->id_reviewer == Auth::user()->id){
            $jumlah = $jumlah - 1;
        }
    }
    return $jumlah;
}

function CountPaperCameraReadyToSee()
{
    $datas = count(Submissions::where('date_paper_camera_ready', NULL)->get());
    return $datas;
}

function Note($id1, $id2){
    $data = Scores::where('id_evaluation', $id1)->where('score', $id2)->first();
    return $data->note;
}

function NoteRecommendation($nilai){
    $data = Evaluation::where('label', 'recommendation')->first();
    $note = Scores::where('id_evaluation', $data->id)->where('score', $nilai)->first();

    return @$note->note;
}

function StatusReregistrationPaper($id){
    $data = Submissions::find($id);

    if($data->date_reregist == NULL){
        return 'Not yet Reregister';
    }
    else{
        return 'Already Reregistered';
    }
}

function StatusReregistrationParticipant($id){
    $data = InvoiceParticipant::find($id);

    if($data->date_reregist == NULL){
        return 'Not yet Reregister';
    }
    else{
        return 'Already Reregistered';
    }
}

function LogSingle($log, $team){
    $log_simpan = new Log();
    $log_simpan->log = $log;
    $log_simpan->by_actor = Auth::user()->id;
    $log_simpan->to_actor = Auth::user()->id;
    $log_simpan->save();
    LogTeam($log, $team);

}

function LogTeam($log, $team){
    $team = Team::where('team_code',$team)->get();
    foreach ($team as $item){
        $log_simpan = new Log();
        $log_simpan->log = $log;
        $log_simpan->by_actor = Auth::user()->id;
        $log_simpan->to_actor = $item->id_user;
        $log_simpan->save();
    }
    LogAdmin($log);
}

function LogAdmin($log){
    $admin = User::where('role',1)->get();
    foreach ($admin as $item){
        $log_simpan = new Log();
        $log_simpan->log = $log;
        $log_simpan->by_actor = Auth::user()->id;
        $log_simpan->to_actor = $item->id;
        $log_simpan->save();
    }
}

function Rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}
