<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\EmailConfigurations\EmailConfigurationsStoreRequest;
use App\Http\Requests\EmailConfigurations\EmailConfigurationsUpdateRequest;
use Auth;
use App\EmailConfiguration;
use DB;
use Session;
use App\Functions\Functions;
use App\User;
use App\Template;

class EmailConfigurationsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['host'])) {
            $aData['sHost'] = $_GET['host'];
        }
        if (isset($_GET['username'])) {
            $aData['sUsername'] = $_GET['username'];
        }
        $aData['iPage'] = $iPage;
        return view('admin.email_configurations.index', $aData);
    }

    public function listing(Request $request) {
        $aData['aSearch'] = $request->all();
        $aData['oModel'] = EmailConfiguration::searchEmailConfiguration($aData['aSearch']);
        return view('admin.email_configurations.ajax.list', $aData);
    }

    public function show($iId) {
        $aData = array();
        $aData['oEmailConfiguration'] = EmailConfiguration::find($iId);
        return view('admin.email_configurations.details', $aData);
    }

    public function create() {
        $aData = array();
        return view('admin.email_configurations.create', $aData);
    }

    public function save(EmailConfigurationsStoreRequest $request) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                EmailConfiguration::insert($aValidated);
                DB::commit();
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect('admin/email-configurations');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function edit($iId) {
        $aData['oEmailConfiguration'] = EmailConfiguration::findOrFail($iId);
        return view('admin.email_configurations.edit', $aData);
    }

    public function update(EmailConfigurationsUpdateRequest $request, $iId) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                EmailConfiguration::where('id', '=', $iId)->update($aValidated);
                DB::commit();
                Session::flash('success', 'Successfully Updated!');
                return redirect('admin/email-configurations');
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
            EmailConfiguration::where('id', '=', $iId)->delete();
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