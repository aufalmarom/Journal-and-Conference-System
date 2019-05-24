<?php

namespace App\Http\Controllers;


use App\Exports\AbstractsExport;
use App\Exports\AuthorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\InvoiceParticipant;
use App\Model\Submissions;
use App\Model\AssignedAbstract;
use App\Model\AbstractAfterReview;
use App\Model\AbstractReviewRevision;
use App\Model\AbstractFinal;
use App\Model\AbstractFinalDecision;
use App\Model\Paper;
use Storage;
use App\Model\PaperReview;
use App\Model\PaperUnderview;
use App\Model\PaperUnderviewReview;
use App\Model\PaperCameraReady;
use App\Model\Powerpoint;
use App\Model\PublicationSubmissions;

class SubmissionController extends Controller
{
    public function ReadAbstractAfterReview()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('date_abstract_review', '<>', NULL)->wherein('team_code', ArrayTeam())->get();
            return view('/layouts/submission/abstractafterreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostAbstractAfterReview(Request $request)
    {
        $post = $request->request->all();
        $abstract = AssignedAbstract::where('assigned_abstract.id_paper', $post['id'])->leftjoin('abstract_review', 'assigned_abstract.id_reviewer', '=', 'abstract_review.id_reviewer')->select('assigned_abstract.*', 'abstract_review.comments', 'abstract_review.abstract_review')->get();

        return view('layouts/submission/formabstractafterreview', compact('abstract'));
    }

    public function PostAbstractReviewed(Request $request)
    {
        $post = $request->request->all();
        $reviewed = Submissions::find($post['id']);

        return view('layouts/submission/submitabstractreviewed', compact('reviewed'));
    }

    public function SubmitAbstractReviewed(Request $request)
    {
        $post = $request->request->all();
        $simpan = new AbstractAfterReview();
        $simpan->id_paper = $post['id'];
        $simpan->abstract_after_review = $post['ck_input'];
        $simpan->save();

        $submission = Submissions::find($post['id']);
        $submission->date_after_review = date('Y-m-d H:i:s');
        $submission->save();

        return redirect(route('abstractafterreview.read'));
    }

    public function ReadAbstractReviewedUnreview()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', NULL)->where('date_abstract_final', NULL)->where('date_abstract_final', NULL)->get();
            return view('/layouts/administratorset/abstractreviewedunreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadReviewAbstractReviewed()
    {
        if (RoleReviewer() == 1){
            $datas = Submissions::where('status_paper', 'accept')->leftjoin('assigned_abstract', 'submissions.id', '=', 'assigned_abstract.id_paper' )->where('assigned_abstract.id_reviewer', Auth::user()->id)->select('submissions.*', 'assigned_abstract.id_reviewer', 'abstract_review_revision.abstract_after_review_revision')->leftjoin('abstract_review_revision', 'abstract_review_revision.id_reviewer', '=', 'assigned_abstract.id_reviewer')->where('abstract_after_review_revision', NULL)->get();
            return view('/layouts/review/reviewabstractreviewed', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostReviewAbstractReviewed(Request $request)
    {
        $post = $request->request->all();
        $abstract = AbstractAfterReview::where('id_paper', $post['id'])->first();
        return view('layouts/review/formreviewabstractreviewed', compact('abstract'));
    }

    public function SendReviewAbstractReviewed(Request $request)
    {
        $post = $request->request->all();
        $simpan = new AbstractReviewRevision();
        $simpan->id_paper = $post['id'];
        $simpan->id_reviewer = Auth::user()->id;
        $simpan->abstract_after_review_revision = $post['ck_input'];
        $simpan->comments = $post['comments'];
        $simpan->save();

        $submission = Submissions::find($post['id']);
        $submission->date_abstract_review_revision = date('Y-m-d H:i:s');
        $submission->save();

        return redirect(route('reviewabstractreviewed.read'))->with('success', 'Abstract Reviewed was reviewed');
    }

    public function ReadAbstractReviewedReview()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', NULL)->get();
            return view('/layouts/administratorset/abstractreviewedreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAbstractReviewedReviewAuthor()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('date_abstract_review_revision', '<>', NULL)->wherein('team_code', ArrayTeam())->get();
            return view('/layouts/submission/abstractreviewedreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostAbstractReviewedReviewAuthor(Request $request)
    {
        $post = $request->request->all();
        $abstract = AbstractReviewRevision::where('id_paper', $post['id'])->get();

        return view('layouts/submission/formabstractreviewedreview', compact('abstract'));
    }

    public function PostAbstractFinal(Request $request)
    {
        $post = $request->request->all();
        $reviewed = Submissions::find($post['id']);

        return view('layouts/submission/submitabstractfinal', compact('reviewed'));
    }

    public function SendAbstractFinal(Request $request)
    {
        $post = $request->request->all();
        $simpan = new AbstractFinal();
        $simpan->id_paper = $post['id'];
        $simpan->id_reviewer = Auth::user()->id;
        $simpan->abstract_final = $post['ck_input'];
        $simpan->save();

        $submission = Submissions::find($post['id']);
        $submission->date_abstract_final = date('Y-m-d H:i:s');
        $submission->save();

        return redirect(route('abstractreviewedreviewauthor.read'))->with('success', 'Abstract Final was reviewed');
    }

    public function ReadReviewAbstractFinal()
    {
        if (RoleReviewer() == 1){
            $datas = Submissions::where('status_paper', 'accept')->leftjoin('assigned_abstract', 'submissions.id', '=', 'assigned_abstract.id_paper' )->where('assigned_abstract.id_reviewer', Auth::user()->id)->select('submissions.*', 'assigned_abstract.id_reviewer', 'abstract_final.abstract_final')->leftjoin('abstract_final', 'abstract_final.id_reviewer', '=', 'assigned_abstract.id_reviewer')->where('date_presentation', NULL)->get();
            return view('/layouts/review/reviewabstractfinal', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostReviewAbstractFinal(Request $request)
    {
        $post = $request->request->all();
        $abstract = AbstractFinal::where('id_paper', $post['id'])->first();
        return view('layouts/review/formreviewabstractfinal', compact('abstract'));
    }

    public function ReadAbstractFinalUndecideReviewer()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', NULL)->where('date_decide_presentation', NULL)->get();
            return view('/layouts/administratorset/abstractfinalundecidereviewer', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }


    public function SendReviewAbstractFinal(Request $request)
    {
        $post = $request->request->all();
        $simpan = new AbstractFinalDecision();
        $simpan->id_paper = $post['id'];
        $simpan->id_reviewer = Auth::user()->id;
        $simpan->presentation = $post['presentation'];
        $simpan->save();

        $sub = Submissions::find($post['id']);
        $sub->date_presentation = date('Y-m-d H:i:s');
        $sub->save();

        return redirect(route('reviewabstractfinal.read'))->with('success', 'Abstract Final was reviewed');
    }

    public function ReadAbstractFinalUndecideAdministrator()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', NULL)->get();
            return view('/layouts/administratorset/abstractfinalundecideadministrator', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostAbstractFinalUndecideAdministrator(Request $request)
    {
        $post = $request->request->all();
        $abstract_final = AbstractFinal::where('id_paper', $post['id'])->first();
        $data_assigned = AssignedAbstract::where('id_paper', $post['id'])->get();
        return view('layouts/administratorset/formdecideabstractfinal', compact('data_assigned', 'abstract_final'));
    }

    public function SendAbstractFinalUndecideAdministrator(Request $request)
    {
        $post = $request->request->all();
        $data = Submissions::where('id', $post['id_paper'])->first();
        $data->presentation = $post['presentation'];
        $data->date_decide_presentation = date('Y-m-d H:i:s');
        $data->save();
        return redirect(route('abstractfinalundecideadministrator.read'))->with('success', 'Abstract Final Presentation was decided');;
    }

    public function ReadAbstractFinalDecided()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->get();
            return view('/layouts/administratorset/abstractfinaldecided', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadAbstractFinalAuthor()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->get();
            return view('/layouts/submission/abstractfinalauthor', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFullPaper()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->get();
            return view('/layouts/submission/fullpaperauthor', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormFullPaper(Request $request)
    {
        $post = $request->request->all();
        if(RoleAuthor() == 1){
            $data = Submissions::find($post['id_paper']);
            return view('/layouts/submission/submitfullpaper', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFullPaper(Request $request)
    {
        $post = $request->request->all();
        $file = $request->file('file');
        $maxSize = 5000000;
        $fileType = ['docx', 'doc'];
        $data = new Paper();
        $explode = explode(" ",$post['title']);
        $title = $explode[0]." ".$explode[1]." ".$explode[2];
        $fileName = $post['topic']."-".$post['id']."-".$title.".".$file->extension();
        if($file->getSize() < $maxSize && in_array($file->extension(), $fileType)){
            $file->storeAs("public/paper/",$fileName);
        }else{
            return redirect(route('abstractfinalauthor.read'))->with('danger', 'File Paper failed to upload');
        }
        $data->file = $fileName;
        $data->id_paper = $post['id'];
        $data->comments = $post['comments'];
        $data->save();

        $sub = Submissions::find($post['id']);
        $sub->date_paper = date('Y-m-d H:i:s');
        $sub->save();

        return redirect(route('fullpaper.read'))->with('success', 'Full Paper was Uploaded');
    }

    public function getDownloadPaper($id)
    {
        $data = Paper::where('id_paper', $id)->first();
        $file_path = "storage/app/public/paper/".$data->file;
        return response()->download($file_path);
    }

    public function ReadPaperUnreview()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', NULL)->where('date_paper_underview', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get();
            return view('/layouts/administratorset/paperunreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPaperReviewed()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get();
            return view('/layouts/administratorset/paperunreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormFullPaperUnderview(Request $request)
    {
        $post = $request->request->all();
        if(RoleAuthor() == 1){
            $data = PaperReview::where('id_paper', $post['id_paper'])->first();
            return view('/layouts/submission/submitfullpaperunderview', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFullPaperUnderview()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->get();
            return view('/layouts/submission/fullpaperunderviewauthor', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFullPaperUnderview(Request $request)
    {
        $post = $request->request->all();
        $file = $request->file('file');
        $maxSize = 5000000;
        $fileType = ['docx', 'doc'];
        $data = new PaperUnderview();
        $explode = explode(" ",$post['title']);
        $title = $explode[0]." ".$explode[1]." ".$explode[2];
        $fileName = $post['topic']."-".$post['id']."-".$title.".".$file->extension();
        if($file->getSize() < $maxSize && in_array($file->extension(), $fileType)){
            $file->storeAs("public/paperunderview/",$fileName);
        }else{
            return redirect(route('fullpaper.read'))->with('danger', 'File Paper Underview failed to upload');
        }
        $data->file = $fileName;
        $data->id_paper = $post['id'];
        $data->comments = $post['comments'];
        $data->save();

        $sub = Submissions::find($post['id']);
        $sub->date_paper_underview = date('Y-m-d H:i:s');
        $sub->save();

        return redirect(route('fullpaperunderview.read'))->with('success', 'Full Paper Underview was Uploaded');
    }

    public function ReadPaperUnderviewUnreview()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review', NULL)->where('date_paper_camera_ready', NULL)->get();
            return view('/layouts/administratorset/paperunderviewunreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPaperUnderviewReviewed()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', NULL)->get();
            return view('/layouts/administratorset/paperunderviewreview', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPaperCameraReady()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', '<>', NULL)->get();
            return view('/layouts/administratorset/papercameraready', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormFullPaperCameraReady(Request $request)
    {
        $post = $request->request->all();
        if(RoleAuthor() == 1){
            $data = PaperUnderviewReview::where('id_paper', $post['id_paper'])->first();;
            return view('/layouts/submission/submitfullpapercameraready', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostFullPaperCameraReady(Request $request)
    {
        $post = $request->request->all();
        $file = $request->file('file');
        $maxSize = 5000000;
        $fileType = ['docx', 'doc'];
        $data = new PaperCameraReady();
        $explode = explode(" ",$post['title']);
        $title = $explode[0]." ".$explode[1]." ".$explode[2];
        $fileName = $post['topic']."-".$post['id']."-".$title.".".$file->extension();
        if($file->getSize() < $maxSize && in_array($file->extension(), $fileType)){
            $file->storeAs("public/papercameraready/",$fileName);
        }else{
            return redirect(route('fullpaperunderview.read'))->with('danger', 'File Paper Camera Ready failed to upload');
        }
        $data->file = $fileName;
        $data->id_paper = $post['id'];
        $data->comments = $post['comments'];
        $data->save();

        $sub = Submissions::find($post['id']);
        $sub->date_paper_camera_ready = date('Y-m-d H:i:s');
        $sub->save();

        return redirect(route('fullpaperunderview.read'))->with('success', 'Full Paper Camera Ready was Uploaded');
    }

    public function ReadFullPaperCameraReady()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', '<>', NULL)->get();
            return view('/layouts/submission/fullpapercameraready', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadPowerPoint()
    {
        if (RoleAuthor() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->where('date_paper', '<>', NULL)->where('date_paper_review', '<>', NULL)->where('date_paper_underview', '<>', NULL)->where('date_paper_underview_review','<>', NULL)->where('date_paper_camera_ready', '<>', NULL)->where('date_ppt', '<>', NULL)->get();
            return view('/layouts/submission/powerpoint', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ReadFormPowerPoint(Request $request)
    {
        $post = $request->request->all();
        if(RoleAuthor() == 1){
            $data = PaperUnderviewReview::where('id_paper', $post['id_paper'])->first();
            return view('/layouts/submission/submitpowerpoint', compact('data'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostPowerPoint(Request $request)
    {
        $post = $request->request->all();
        $file = $request->file('file');
        $maxSize = 5000000;
        $fileType = ['pptx', 'ppt'];
        $data = new Powerpoint();
        $explode = explode(" ",$post['title']);
        $title = $explode[0]." ".$explode[1]." ".$explode[2];
        $fileName = $post['topic']."-".$post['id']."-".$title.".".$file->extension();
        if($file->getSize() < $maxSize && in_array($file->extension(), $fileType)){
            $file->storeAs("public/ppt/",$fileName);
        }else{
            return redirect(route('fullpaperunderview.read'))->with('danger', 'File Powerpoint failed to upload');
        }
        $data->file = $fileName;
        $data->id_paper = $post['id'];
        $data->save();

        $sub = Submissions::find($post['id']);
        $sub->date_ppt = date('Y-m-d H:i:s');
        $sub->save();

        return redirect(route('powerpoint.read'))->with('success', 'File Powerpoint was Uploaded');
    }

    public function PostReregistration(Request $request)
    {
        $post = $request->request->all();
        $sub = Submissions::find($post['id']);
        $sub->date_reregist = date('Y-m-d H:i:s');
        $sub->save();

        return back()->with('success', 'Paper / Author was reregistered');
    }

    public function PostReregistrationParticipant(Request $request)
    {
        $post = $request->request->all();
        $data = InvoiceParticipant::find($post['id']);
        $data->date_reregist = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('success', 'Participant was reregistered');
    }


    public function ExportRecapDataAuthor()
    {
        return Excel::download(new AuthorsExport, 'authorconfirmed.xlsx');
    }

    public function ViewRecapDataAbstract()
    {
        if (RoleAdministrator() == 1){
            $datas = Submissions::where('status_paper', 'accept')->where('status_payment', 1)->where('date_after_review', '<>', NULL)->where('date_abstract_review_revision', '<>', NULL)->where('date_abstract_final', '<>', NULL)->where('date_presentation', '<>', NULL)->where('date_decide_presentation', '<>', NULL)->get();
            return view('/layouts/administratorset/recapabstract', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function ExportRecapDataAbstract()
    {
        return Excel::download(new AbstractsExport, 'abstracts.xlsx');
    }

    public function getDownloadPaperReview($id)
    {
        $data = PaperReview::where('id_paper', $id)->first();
        $file_path = "storage/app/public/paperreview/".$data->file;
        return response()->download($file_path);
    }

    public function getDownloadPaperUnderview($id)
    {
        $data = PaperUnderview::where('id_paper', $id)->first();
        $file_path = "storage/app/public/paperunderview/".$data->file;
        return response()->download($file_path);
    }

    public function getDownloadPaperUnderviewReview($id)
    {
        $data = PaperUnderviewReview::where('id_paper', $id)->first();
        $file_path = "storage/app/public/paperunderviewreview/".$data->file;
        return response()->download($file_path);
    }

    public function getDownloadPaperCameraReady($id)
    {
        $data = PaperCameraReady::where('id_paper', $id)->first();
        $file_path = "storage/app/public/papercameraready/".$data->file;
        return response()->download($file_path);
    }
    public function getDownloadPPT($id)
    {
        $data = Powerpoint::where('id_paper', $id)->first();
        $file_path = "storage/app/public/ppt/".$data->file;
        return response()->download($file_path);
    }

    public function ReadPublicationSetup()
    {
        $datas = PublicationSubmissions::get();
        if (RoleAdministrator() == 1){
            return view('layouts/administratorset/publicationsetup', compact('datas'));
        }
        else{
            return redirect(route('unauthorized.read'));
        }
    }

    public function PostPublicationSetup(Request $request)
    {
        $post = $request->request->all();
        $simpan = new PublicationSubmissions();
        $simpan->publication_name = $post['publication_name'];
        $simpan->save();
        return back()->with('success', 'Data was added');
    }

    public function DeletePublicationSetup(Request $request)
    {
        $post = $request->request->all();
        $model = PublicationSubmissions::find($post['id']);
        $model->delete();
        return back()->with('danger', 'Data was deleted');
    }






























}
