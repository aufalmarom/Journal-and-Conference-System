<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/home', '/dashboard');
//Profile
Route::get('/profile', 'DashboardController@ReadProfile')->name('profile.read');
Route::post('/profile/post', 'DashboardController@PostProfile')->name('profile.post');
Route::get('/changepassword', 'DashboardController@ReadChangePassword')->name('changepassword.read');
Route::post('/changepassword/post', 'DashboardController@PostChangePassword')->name('changepassword.post');
//LandingPage
Route::get('/', 'LandingPageController@ReadLandingPage')->name('landingpage.read');
//login, reset, logout, forget
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Dashboard
Route::get('/dashboard', 'DashboardController@ReadDashboard')->name('dashboard');
//Dashboard-Administrator-Participant-Register


Route::get('/sidebarparticipant', 'DashboardController@ReadSidebarParticipant')->name('sidebarparticipant');
Route::get('/allparticipant', 'DashboardController@ReadAllParticipant')->name('allparticipant');
Route::get('/participantunverified', 'DashboardController@ReadParticipantUnverified')->name('participant.unverified');
Route::get('/participantverifiedwaitinginvoice', 'DashboardController@ReadParticipantVerifiedWaitingInvoice')->name('participant.verifiedwaitinginvoice');
Route::post('/participantverifiedwaitinginvoice/form', 'DashboardController@ReadFormSendInvoice')->name('formsendinvoiceparticipant');

Route::get('/participantverifiedunpaid', 'DashboardController@ReadParticipantVerifiedUnpaid')->name('participant.verifiedunpaid');
Route::get('/participantwaitingconfirmation', 'DashboardController@ReadParticipantWaitingConfirmation')->name('participant.waitingconfirmation');
Route::get('/participantconfirmed', 'DashboardController@ReadParticipantConfirmed')->name('participant.confirmed');
Route::post('/formsendinvoice/post', 'DashboardController@PostFormInvoice')->name('invoice.post');
Route::post('/formsendinvoice/send', 'DashboardController@PostFileProof')->name('fileproof.post');
Route::get('/fileproof/download', 'DashboardController@DownloadFileProof')->name('fileproof.download');
Route::post('/participantwaitingconfirmation/post', 'DashboardController@ConfirmParticipant')->name('participant.confirm');
Route::get('/recap', 'DashboardController@ExportRecapDataParticipant')->name('recap');

Route::get('/recapauthor', 'SubmissionController@ExportRecapDataAuthor')->name('recapauthor');


Route::get('/recapabstractfinal', 'SubmissionController@ViewRecapDataAbstract');
Route::get('/recapabstract', 'SubmissionController@ExportRecapDataAbstract')->name('recapabstract');

//Dashboard-Reviewer
Route::get('/allreviewer', 'DashboardController@ReadAllReviewer')->name('allreviewer.read');
Route::post('/allreviewer/post', 'DashboardController@PostAddReviewer')->name('reviewer.post');
Route::post('/allreviewer/delete', 'DashboardController@DeleteReviewer')->name('reviewer.delete');
Route::get('/reviewabstract', 'DashboardController@ReadReviewAbstract')->name('reviewabstract.read');
Route::post('/reviewabstract/post', 'DashboardController@PostReviewAbstract')->name('reviewabstract.post');
Route::post('/reviewabstract/send', 'DashboardController@SendReviewAbstract')->name('reviewabstract.send');
Route::get('/reviewabstractreviewed', 'DashboardController@ReadReviewAbstractReviewed')->name('reviewabstractreviewed.read');
Route::get('/reviewabstractfinal', 'DashboardController@ReadReviewAbstractFinal')->name('reviewabstractfinal.read');

Route::get('/reviewfullpaper', 'DashboardController@ReadReviewFullPaper')->name('reviewfullpaper.read');
Route::post('/formreviewfullpaper', 'DashboardController@FormReviewFullPaper')->name('reviewfullpaper.form');
Route::post('/reviewfullpaper/post', 'DashboardController@PostReviewFullPaper')->name('reviewfullpaper.post');


Route::get('/reviewfullpaperunderview', 'DashboardController@ReadReviewFullPaperUnderview')->name('reviewfullpaperunderview.read');
Route::post('/reviewfullpaperunderview', 'DashboardController@FormReviewFullPaperUnderview')->name('reviewfullpaperunderview.form');
Route::post('/reviewfullpaperunderview/post', 'DashboardController@PostReviewFullPaperUnderview')->name('reviewfullpaperunderview.post');

Route::get('/reviewerfullpapercameraready', 'DashboardController@ReadReviewFullPaperCameraReady')->name('reviewerfullpapercameraready.read');



Route::get('/abstract', 'DashboardController@ReadAbstract')->name('abstract.read');
Route::get('/reviewsform', 'DashboardController@ReadReviewsForm')->name('reviewsform.read');
Route::get('/abstractunassigned', 'DashboardController@ReadAbstractUnassigned')->name('abstractunassigned.read');
Route::post('/assigntoreviewer/form', 'DashboardController@ReadAssignToReviewer')->name('assigntoreviewer.read');
Route::post('/assigntoreviewer/post', 'DashboardController@PostAssignToReviewer')->name('assigntoreviewer.post');
Route::get('/abstractunscored', 'DashboardController@ReadAbstractUnscored')->name('abstractunscored.read');
Route::post('/abstractunscored/post', 'DashboardController@EditAssignToReviewer')->name('abstractunscored.edit');
Route::post('/editabstractunscored/post', 'DashboardController@PostEditAssignToReviewer')->name('editassigned.post');
Route::get('/abstractunscored', 'DashboardController@ReadAbstractUnscored')->name('abstractunscored.read');
Route::get('/logactivityreviwer', 'DashboardController@ReadLogActivityReviewer')->name('logactivityreviwer.read');
Route::get('/abstracttoscore', 'DashboardController@ReadAbstractToScore')->name('abstracttoscore.read');
Route::post('/abstracttoscore/form', 'DashboardController@ReadFormScore')->name('abstracttoscore.getid');
Route::post('/abstracttoscore/post', 'DashboardController@PostFormScore')->name('abstracttoscore.post');
Route::get('/abstracttodecide', 'DashboardController@ReadAbstractToDecide')->name('abstracttodecide.read');
Route::post('/abstracttodecide/form', 'DashboardController@ReadFormDecide')->name('formdecide.read');
Route::post('/abstracttodecide/post', 'DashboardController@PostFormDecide')->name('formdecide.post');
Route::get('/abstractrejected', 'DashboardController@ReadAbstractRejected')->name('abstractrejected.read');
Route::get('/abstractacceptedwaitinginvoice', 'DashboardController@ReadAbstractAcceptedWaitingInvoice')->name('abstractacceptedwaitinginvoice.read');
Route::post('/forminvoicepaper/form', 'DashboardController@ReadFormInvoicePaper')->name('forminvoicepaper.read');
Route::post('/forminvoicepaper/post', 'DashboardController@PostFormInvoicePaper')->name('invoicepaper.post');
Route::post('/fileproof/post', 'DashboardController@PostFileProofPaper')->name('fileproofpaper.post');
Route::get('/paperwaitingconfirmation', 'DashboardController@ReadPaperWaitingConfirmation')->name('paperwaitingconfirmation.read');
Route::get('/papergotinvoiceunpaid', 'DashboardController@ReadPaperGotInvoiceUnpaid')->name('papergotinvoiceunpaid.read');
Route::post('/paperwaitingconfirmation/post', 'DashboardController@PostIDPaperWaitingConfirmation')->name('paperwaitingconfirmation.ID');
Route::get('/abstractunreview', 'DashboardController@ReadAbstractUnreview')->name('abstractunreview.read');
Route::get('/abstractreview', 'DashboardController@ReadAbstractReview')->name('abstractreview.read');
//author
Route::get('/abstractafterreview', 'SubmissionController@ReadAbstractAfterReview')->name('abstractafterreview.read');
Route::post('/abstractafterreview/post', 'SubmissionController@PostAbstractAfterReview')->name('abstractafterreview.post');
Route::post('/abstractreviewed/post', 'SubmissionController@PostAbstractReviewed')->name('abstractreviewed.post');
Route::post('/abstractreviewed/submit', 'SubmissionController@SubmitAbstractReviewed')->name('submitabstractreviewed.post');
Route::get('/abstractreviewedunreview', 'SubmissionController@ReadAbstractReviewedUnreview')->name('abstractreviewedunreview.read');
//reviewer
Route::get('/reviewabstractreviewed', 'SubmissionController@ReadReviewAbstractReviewed')->name('reviewabstractreviewed.read');
Route::post('/reviewabstractreviewed/post', 'SubmissionController@PostReviewAbstractReviewed')->name('reviewabstractreviewed.post');
Route::post('/reviewabstractreviewed/send', 'SubmissionController@SendReviewAbstractReviewed')->name('reviewabstractreviewed.send');
Route::get('/abstractreviewedreview', 'SubmissionController@ReadAbstractReviewedReview')->name('abstractreviewedreview.read');
//author
Route::get('/abstractreviewedreviewauthor', 'SubmissionController@ReadAbstractReviewedReviewAuthor')->name('abstractreviewedreviewauthor.read');
Route::post('/abstractreviewedreview/post', 'SubmissionController@PostAbstractReviewedReviewAuthor')->name('abstractreviewedreview.post');
Route::post('/abstractfinal/post', 'SubmissionController@PostAbstractFinal')->name('abstractfinal.post');
Route::post('/abstractfinal/send', 'SubmissionController@SendAbstractFinal')->name('abstractfinal.send');
//reviewer
Route::get('/reviewabstractfinal', 'SubmissionController@ReadReviewAbstractFinal')->name('reviewabstractfinal.read');
Route::post('/reviewabstractfinal/post', 'SubmissionController@PostReviewAbstractFinal')->name('reviewabstractfinal.post');
Route::post('/reviewabstractfinal/send', 'SubmissionController@SendReviewAbstractFinal')->name('reviewabstractfinal.send');
//dash
Route::get('/abstractfinalundecidereviewer', 'SubmissionController@ReadAbstractFinalUndecideReviewer')->name('abstractfinalundecidereviewer.read');
Route::get('/abstractfinalundecideadministrator', 'SubmissionController@ReadAbstractFinalUndecideAdministrator')->name('abstractfinalundecideadministrator.read');
Route::post('/abstractfinalundecideadministrator/post', 'SubmissionController@PostAbstractFinalUndecideAdministrator')->name('abstractfinalundecideadministrator.post');
Route::post('/abstractfinalundecideadministrator/send', 'SubmissionController@SendAbstractFinalUndecideAdministrator')->name('abstractfinalundecideadministrator.send');

Route::get('/abstractfinaldecided', 'SubmissionController@ReadAbstractFinalDecided')->name('abstractfinaldecided.read');

//author
Route::get('/abstractfinalauthor', 'SubmissionController@ReadAbstractFinalAuthor')->name('abstractfinalauthor.read');

Route::post('/formfullpaper', 'SubmissionController@ReadFormFullPaper')->name('formfullpaper.read');
Route::get('/fullpaper', 'SubmissionController@ReadFullPaper')->name('fullpaper.read');
Route::post('/fullpaper/post', 'SubmissionController@PostFullPaper')->name('fullpaper.post');

Route::get('/fullpaper/download/{id}', 'SubmissionController@getDownloadPaper')->name('downloadpaper');
Route::get('/fullpaperreview/download/{id}', 'SubmissionController@getDownloadPaperReview')->name('downloadpaperreview');
Route::get('/fullpaperunderview/download/{id}', 'SubmissionController@getDownloadPaperUnderview')->name('downloadpaperunderview');
Route::get('/fullpaperunderviewreview/download/{id}', 'SubmissionController@getDownloadPaperUnderviewReview')->name('downloadpaperunderviewreview');
Route::get('/fullpapercameraready/download/{id}', 'SubmissionController@getDownloadPaperCameraReady')->name('downloadpapercameraready');
Route::get('/ppt/download/{id}', 'SubmissionController@getDownloadPPT')->name('downloadppt');

//dash
Route::get('/paperunreview', 'SubmissionController@ReadPaperUnreview')->name('paperunreview.read');
Route::get('/paperreviewed', 'SubmissionController@ReadPaperReviewed')->name('paperreviewed.read');



//author
Route::post('/formfullpaperunderview', 'SubmissionController@ReadFormFullPaperUnderview')->name('formfullpaperunderview.read');
Route::get('/fullpaperunderview', 'SubmissionController@ReadFullPaperUnderview')->name('fullpaperunderview.read');
Route::post('/fullpaperunderview/post', 'SubmissionController@PostFullPaperUnderview')->name('fullpaperunderview.post');


//dash
Route::get('/paperunderviewunreview', 'SubmissionController@ReadPaperUnderviewUnreview')->name('paperunderviewunreview.read');
Route::get('/paperunderviewreviewed', 'SubmissionController@ReadPaperUnderviewReviewed')->name('paperunderviewreviewed.read');
Route::get('/papercameraready', 'SubmissionController@ReadPaperCameraReady')->name('papercameraready.read');

//author
Route::post('/formfullpapercameraready', 'SubmissionController@ReadFormFullPaperCameraReady')->name('formfullpapercameraready.read');
Route::get('/fullpapercameraready', 'SubmissionController@ReadFullPaperCameraReady')->name('fullpapercameraready.read');
Route::post('/fullpapercameraready/post', 'SubmissionController@PostFullPaperCameraReady')->name('fullpapercameraready.post');


Route::get('/powerpoint', 'SubmissionController@ReadPowerPoint')->name('powerpoint.read');
Route::post('/formpowerpoint', 'SubmissionController@ReadFormPowerPoint')->name('formpowerpoint.read');
Route::post('/powerpoint/post', 'SubmissionController@PostPowerPoint')->name('powerpoint.post');




Route::post('/reregistration/post', 'SubmissionController@PostReregistration')->name('reregistration.post');
Route::post('/reregistrationparticipant/post', 'SubmissionController@PostReregistrationParticipant')->name('reregistrationparticipant.post');

//Dashboard-Author-Paper-Register
Route::get('/sidebarauthor', 'DashboardController@ReadSidebarAuthor')->name('sidebarauthor');
Route::get('/sidebarpaper', 'DashboardController@ReadSidebarPaper')->name('sidebarpaper');
Route::get('/allpaper', 'DashboardController@ReadAllPaper')->name('paper.total');
Route::get('/allppt', 'DashboardController@ReadAllPPT')->name('ppt.total');
Route::get('/allauthors', 'DashboardController@ReadAllAuthor')->name('author.total');
Route::get('/authorunverified', 'DashboardController@ReadAuthorUnverified')->name('author.unverified');
Route::get('/authorverifiednotyetsendid', 'DashboardController@ReadAuthorVerifiedNotSendID')->name('author.notsendid');
Route::get('/authorverifiedwaitingconfirmid', 'DashboardController@ReadAuthorVerifiedWaitingConfirmID')->name('author.waitingconfirmid');
Route::get('/authorconfirmedid', 'DashboardController@ReadConfirmedID')->name('author.confirmed');
Route::get('/paperpaid', 'DashboardController@ReadPaperPaid')->name('paper.paid');
Route::get('/formverifikasidataauthor', 'DashboardController@ReadVerifikasiAuthor')->name('authorid.verifikasi');
Route::post('/formverifikasidataauthor/post', 'DashboardController@PostVerifikasiAuthor')->name('authorid.post');
Route::get('/authorverifiedwaitingconfirmid/{id}', 'DashboardController@ConfirmID')->name('statusID.post');

Route::get('/sidebarsecretary', 'DashboardController@ReadSideBarSecretary')->name('sidebarsecretary');
Route::get('/sidebarfinance', 'DashboardController@ReadSideBarFinance')->name('sidebarfinance');
Route::get('/sidebarlogactivityreviewer', 'DashboardController@ReadSideBarLogActivityReviewer')->name('sidebarlogactivityreviewer');
Route::get('/sidebarlogactivityauthor', 'DashboardController@ReadSideBarLogActivityAuthor')->name('sidebarlogactivityauthor');
Route::get('/sidebarlogactivityparticipant', 'DashboardController@ReadSideBarLogActivityParticipant')->name('sidebarlogactivityparticipant');
// Dashboard Reviewer Author ganti role
Route::get('/changedashboard', 'DashboardController@ReadDashboardChangeRole')->name('changedashboard.read');
//Reregistration
Route::get('/reregistration', 'DashboardController@ReadReregistration')->name('reregistration.read');
Route::get('/reregistrationpaper', 'DashboardController@ReadReregistrationPaper')->name('reregistrationpaper.read');
Route::get('/reregistrationparticipant', 'DashboardController@ReadReregistrationParticipant')->name('reregistrationparticipant.read');
//Participant
Route::get('/invoiceparticipant', 'DashboardController@ReadInvoice')->name('participant.invoice');
Route::get('/logactivityparticipant', 'DashboardController@ReadLogActivityParticipant')->name('logactivity.read');
//Submission
Route::get('/abstractsubmitted', 'DashboardController@ReadAbstractSubmitted')->name('abstractsubmitted.read');
Route::post('/abstractsubmitted/edit', 'DashboardController@EditAbstractSubmitted')->name('abstractsubmitted.edit');
Route::post('/editabstractsubmitted/post', 'DashboardController@PostEditAbstractSubmitted')->name('editabstractsubmitted.post');
Route::post('/editabstractsubmitted/delete', 'DashboardController@DeleteAbstractSubmitted')->name('abstractsubmitted.delete');
Route::get('/submission', 'DashboardController@ReadSubmission')->name('submission.read');
Route::post('/submission/post', 'DashboardController@PostSubmission')->name('submission.post');
Route::post('/invoicepaper/form', 'DashboardController@ReadInvoicePaper')->name('invoicepaper');
//Dashboard-Evaluation System Reviewer
Route::get('/evaluationsystem', 'DashboardController@ReadEvaluationSystem')->name('evaluationsystem.read');
Route::post('/evaluationsystem/post', 'DashboardController@PostEvaluationSystem')->name('evaluationsystem.post');
Route::get('/scores/{id}', 'DashboardController@ReadScores')->name('score.read');
Route::post('/scores/post', 'DashboardController@PostScores')->name('score.post');
Route::post('/evalscore/delete', 'DashboardController@DeleteEvalScores')->name('evalscore.delete');
//Author Categories
Route::get('/authorcategories', 'DashboardController@ReadAuthorCategoriesSet')->name('ac.read');
Route::post('/authorcategories/post', 'DashboardController@PostAuthorCategories')->name('ac.post');
Route::post('/authorcategories/delete', 'DashboardController@DeleteAuthorCategories')->name('ac.delete');
//Publication Setup
Route::get('/publicationsetup', 'SubmissionController@ReadPublicationSetup')->name('publicationsetup.read');
Route::post('/publicationsetup/post', 'SubmissionController@PostPublicationSetup')->name('publicationsetup.post');
Route::post('/publicationsetup/delete', 'SubmissionController@DeletePublicationSetup')->name('publicationsetup.delete');
//Landing Page
Route::get('/landingpageset', 'DashboardController@ReadLandingPageSet')->name('lp.read');
//welcomesection
Route::get('/welcomesection', 'DashboardController@ReadWelcome')->name('welcome.read');
Route::post('/welcomesection/update', 'DashboardController@UpdateWelcome')->name('welcome.update');
//topics
Route::get('/topicssection', 'DashboardController@ReadTopics')->name('topics.read');
Route::post('/topicssection/post', 'DashboardController@PostTopics')->name('topics.post');
//Important Dates
Route::get('/importantdatessection', 'DashboardController@ReadImportantDates')->name('importantdates.read');
Route::post('/importantdatessection/post', 'DashboardController@PostImportantDates')->name('importantdates.post');
//Keynotes
Route::get('/keynotessection', 'DashboardController@ReadKeyNotes')->name('keynotes.read');
Route::post('/keynotessection/post', 'DashboardController@PostKeyNotes')->name('keynotes.post');
//Guidelines
Route::get('/downloadsection', 'DashboardController@ReadGuidelines')->name('guidelines.read');
Route::post('/downloadsection/upload', 'DashboardController@UploadGuidelines')->name('guidelines.post');
Route::get('/download', 'LandingPageController@Download')->name('guidelines.download');
//Publication
Route::get('/publicationsection', 'DashboardController@ReadPublication')->name('publication.read');
Route::post('/publicationsection/post', 'DashboardController@PostPublication')->name('publication.post');
//ScientificCommitte
Route::get('/scientificcommittesection', 'DashboardController@ReadScientificCommitte')->name('scientificcommitte.read');
Route::post('/scientificcommittesection/post', 'DashboardController@PostScientificCommitte')->name('scientificcommitte.post');
//OrganizingCommitte
Route::get('/organizingcommittesection', 'DashboardController@ReadOrganizingCommitte')->name('organizingcommitte.read');
Route::post('/organizingcommittesection/post', 'DashboardController@PostOrganizingCommitte')->name('organizingcommitte.post');
//Sponsorship
Route::get('/sponsorshipsection', 'DashboardController@ReadSponsorship')->name('sponsorship.read');
Route::post('/sponsorshipsection/post', 'DashboardController@PostSponsorship')->name('sponsorship.post');
//Newsletter
Route::post('/newsletter/create', 'LandingPageController@StoreEmail')->name('newsletter.create');
Route::get('/newsletter', 'DashboardController@ReadEmail')->name('newsletter.read');
Route::post('/newsletter/blast', 'DashboardController@BlastEmail')->name('newsletter.blast');
//FAQs
Route::get('/faq', 'DashboardController@ReadFAQ')->name('faq.read');
Route::post('/faq/post', 'DashboardController@PostFAQ')->name('faq.post');
//Contactus
Route::post('/message', 'DashboardController@ReadMessage')->name('contactus.readmessage');
Route::post('/message/answer', 'DashboardController@ReplyMessage')->name('contactus.reply');
Route::post('/contactus/create', 'LandingPageController@StoreContactUs')->name('contactus.create');
Route::get('/contactus', 'DashboardController@ReadContactUs')->name('contactus.read');
//Registration Fee
Route::get('/registrationfee', 'DashboardController@ReadRegistrationfee')->name('registrationfee.read');
Route::post('/registrationfee/post', 'DashboardController@PostRegistrationFee')->name('registrationfee.post');
//Event Registration
Route::get('/participant', 'EventRegistrationController@ReadDashboardParticipant')->name('participant.read');
Route::get('/author', 'EventRegistrationController@ReadDashboardAuthor')->name('author.read');
//Verification
Auth::routes(['verify' => true]);
Route::get('/unauthorized', 'DashboardController@ReadUnauthorized')->name('unauthorized.read');
