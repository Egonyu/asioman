<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App;
use App\Settings;
use App\QuizResult;
use App\User;

class CertificatesController extends Controller
{
	 public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * This method generates the certificates based on the sent slug
     * The certificate can be generated by the same user or by admin user
     * Based on the provided slug, verify the current user is the same user or parent user or admin
     * If any other tries to access the record we restrict that user to view the record
     * @param  [type] $result_slug [description]
     * @return [type]              [description]
     */
    public function getCertificate($result_slug)
    {


    	if(!getSetting('certificate','module'))
    	{
    		pageNotFound();
    		return back();
    	}

    	$record = QuizResult::where('slug', $result_slug)->get()->first();
    	

       
        if($isValid = $this->isValidRecord($record))
         return redirect($isValid);
    	
     	$user = getUserRecord($record->user_id);

     	$quiz_record = App\Quiz::where('id','=',$record->quiz_id)->first();
     	
     	 
     	    /**
         * Make sure the Admin or staff cannot edit the Admin/Owner accounts
         * Only Owner can edit the Admin/Owner profiles
         * Admin can edit his own account, in that case send role type admin on condition
         */
        $current_user = \Auth::user();
          $UserOwnAccount = FALSE;
     if($current_user->id == $user->id)
      $UserOwnAccount = TRUE;
    
      if(!$UserOwnAccount)  {
        $current_user_role = getRoleData($$current_user->role_id);

        if((($current_user_role=='admin' || $current_user_role == 'owner') ))
        {
          if(!checkRole(getUserGrade(1))) {
            prepareBlockUserMessage();
            return back();
          }
        }
      }
 
    
        $data['active_class']       = 'analysis';
        $data['result']       		= $record;
        $data['user']       		= $user;

        $certificate_data = [];
        $certificate_data['username'] = ucfirst($user->name);
        $certificate_data['course_name'] = ucfirst($quiz_record->title);
        $certificate_data['marks'] = $record->marks_obtained.' ('.$record->percentage.'%)';

        $content = \Blade::compileString($this->getContentTemplate());

        $result = $this->render($content, $certificate_data);

 
        $data['content']       		= $result;

        $data['title']              = getPhrase('certificate_generation');

    	// return view('exams.certificates.template', $data);
         $view_name = getTheme().'::exams.certificates.template';
        return view($view_name, $data);
    }

    	/**
	 * Returns the template html code by forming header, body and footer
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function getContentTemplate()
	{
		
    	$content = getSetting('content','certificate');
    	
    	$view = \View::make('exams.certificates.content-template', [
    											'content' => $content, 
    											]);

		return $view->render();
	}

		/**
	 * Prepares the view from string passed along with data
	 * @param  [type] $__php  [description]
	 * @param  [type] $__data [description]
	 * @return [type]         [description]
	 */
    public function render($__php, $__data)
	{
	    $obLevel = ob_get_level();
	    ob_start();
	    extract($__data, EXTR_SKIP);
	    try {
	        eval('?' . '>' . $__php);
	    } catch (Exception $e) {
	        while (ob_get_level() > $obLevel) ob_end_clean();
	        throw $e;
	    } catch (Throwable $e) {
	        while (ob_get_level() > $obLevel) ob_end_clean();
	        throw new FatalThrowableError($e);
	    }
	    return ob_get_clean();
	}

    public function isValidRecord($record)
    {
      if ($record === null) {
        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
    }

    return FALSE;
    }

    public function getReturnUrl()
    {
      return PREFIX;
    }
}
