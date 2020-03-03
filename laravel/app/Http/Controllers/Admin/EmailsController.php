<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Emails\EmailsStoreRequest;
use App\Http\Requests\Emails\EmailsUpdateRequest;
use App\Http\Requests\Emails\EmailsAssignTemplateRequest;
use Auth;
use App\Email;
use App\EmailTemplate;
use DB;
use Session;
use App\Functions\Functions;
use App\User;
use App\Template;

class EmailsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   // private $aEmailsTypes;

    public function __construct() {
        parent::__construct();
        //$this->aEmailsTypes = config('constants.Emails_types');
    }

    public function index() {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['emails'])) {
            $aData['emails'] = $_GET['emails'];
        }
        // if (isset($_GET['status'])) {
        //     $aData['iStatus'] = $_GET['status'];
        // }
        $aData['iPage'] = $iPage;
        return view('admin.emails.index', $aData);
    }

    public function listing(Request $request) {
        $aData['aSearch'] = $request->all();
        $aData['oModel'] = Email::searchEmail($aData['aSearch']);
        return view('admin.emails.ajax.list', $aData);
    }

    public function show($iId) {
        $aData = array();
        $aData['oEmails'] = Email::find($iId);
        return view('admin.emails.details', $aData);
    }

    public function create() {
        $aData = array();
        return view('admin.emails.create', $aData);
    }

    public function save(EmailsStoreRequest $request) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                Email::insert($aValidated);
                DB::commit();
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect('admin/emails');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function edit($iId) {
        $aData['oEmail'] = Email::findOrFail($iId);
        return view('admin.emails.edit', $aData);
    }

    public function update(EmailsUpdateRequest $request, $iId) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                Email::where('id', '=', $iId)->update($aValidated);
                DB::commit();
                Session::flash('success', 'Successfully Updated!');
                return redirect('admin/emails');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function delete($iId)     
    {
        DB::beginTransaction();
        try {
            Email::where('id', '=', $iId)->delete();
            EmailTemplate::where('email_id', '=', $iId)->delete();
            DB::commit();
            Session::flash('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }

    public function showAssign()
    {
        $aData = array();
        $aData['aEmails'] = Email::where('status', '=', 1)
        ->select('email', 'id')
        ->orderBy('email', 'asc')
        ->pluck('email', 'id')->toArray();
        $aData['aTemplates'] = Template::where('status', '=', 1)
        ->select('title', 'id')
        ->orderBy('title', 'asc')
        ->pluck('title', 'id')->toArray();
        return view('admin.emails.assign', $aData);
    }

    public function saveAssign(EmailsAssignTemplateRequest $request)
    {
        $aValidated = $request->validated();        
        if ($aValidated) {
            DB::beginTransaction();
            try {
                $aInsert = array();
                foreach ($aValidated['template_id'] as $value) {
                    if (!EmailTemplate::where('email_id', $aValidated['email_id'])->where('template_id', $value)->exists()) {
                        $aInsert[] = array(
                            'template_id' => $value,
                            'email_id' => $aValidated['email_id']
                        );
                    }
                }
                if (!empty($aInsert)) {
                    EmailTemplate::insert($aInsert);
                    DB::commit();
                    Session::flash('success', 'Successfully Assigned!');
                } else {
                    Session::flash('danger', 'Oops! Something went wrong, No Data found to assign.');
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                Session::flash('danger', $ex->getMessage());
            }
            return redirect()->back();
        }
    }
    public function view(int $iId)
    {
        $aData = array();
        $aData['oEmail'] = Email::find($iId);
        $aData['aEmailTemplates'] = EmailTemplate::join('templates as t', 't.id', '=', 'email_templates.template_id')
        ->select('t.title', 'email_templates.id as email_template_id', 'email_templates.created_at')
        ->where('email_id', $iId)
        ->get();
        return view('admin.emails.view', $aData);
    }
    public function deleteAssignEmailTemplate(int $iId)
    {
        DB::beginTransaction();
        try {
            EmailTemplate::where('id', '=', $iId)->delete();
            DB::commit();
            Session::flash('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }



    
}