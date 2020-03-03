<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Templates\TemplatesStoreRequest;
use App\Http\Requests\Templates\TemplatesUpdateRequest;
use App\Http\Requests\Templates\TemplatesAssignUserRequest;
use Auth;
use App\Template;
use App\UserTemplate;
use DB;
use Session;
use App\Functions\Functions;
use App\User;
use App\Role;
use App\Email;
use App\EmailTemplate;
use App\EmailConfiguration;

class TemplatesController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   // private $aTemplateTypes;

    public function __construct() {
        parent::__construct();
        //$this->aTemplateTypes = config('constants.Template_types');
    }

    public function index() {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['title'])) {
            $aData['title'] = $_GET['title'];
        }
        // if (isset($_GET['status'])) {
        //     $aData['iStatus'] = $_GET['status'];
        // }
        $aData['iPage'] = $iPage;
        return view('admin.templates.index', $aData);
    }

    public function listing(Request $request) {
        $aData['aSearch'] = $request->all();
        if (Auth::user()->role->code != 'admin') {
            $aData['aSearch']['iUserId'] = Auth::user()->id;
        }
        $aData['oModel'] = Template::searchTemplate($aData['aSearch']);

        return view('admin.templates.ajax.list', $aData);
    }

    public function show($iId) {
        $aParams = array();
        if (Auth::user()->role->code != 'admin') {
            $aParams['iUserId'] = Auth::user()->id;
            $aParams['iTemplateId'] = $iId;
        }
        $aUserAssignedTemplate = UserTemplate::getUserTemplate($aParams)->pluck('id')->toArray();
        if(empty($aUserAssignedTemplate)){
            die('Unauthorized action.');
        } else {
            $aData = array();
            $aData['oTemplate'] = Template::find($iId);
            $aData['aEmails'] = Email::where('status', '=', 1)
            ->select('email', 'id')
            ->orderBy('email', 'asc')
            ->pluck('email', 'id')->toArray();
            $aData['aEmailConfigurations'] = EmailConfiguration::select('username', 'id')
            ->orderBy('username', 'asc')
            ->pluck('username', 'id')->toArray();
            return view('admin.templates.details', $aData);
        }

    }

    public function create() {
        $aData = array();
        return view('admin.templates.create', $aData);
    }

    public function save(TemplatesStoreRequest $request) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                $aValidated['key'] = str_random(15);
                Template::insert($aValidated);
                DB::commit();
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect('admin/templates');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function edit($iId) {
        $aData['oTemplate'] = Template::findOrFail($iId);
        if (isset($data['Template']->dob)) {
            list($year, $month, $date) = explode('-', $aData['Template']->dob);
            $aData['Template']->date = $date;
            $aData['Template']->month = $month;
            $aData['Template']->year = $year;
        }
        //$aData['aTemplateTypes'] = $this->aTemplateTypes;
        return view('admin.templates.edit', $aData)->with('Template_id', $iId);
    }

    public function update(TemplatesUpdateRequest $request, $iId) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                Template::where('id', '=', $iId)->update($aValidated);
                DB::commit();
                Session::flash('success', 'Successfully Updated!');
                return redirect('admin/templates');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function delete($iId) {
        Template::where('id', '=', $iId)->delete();
        Session::flash('success', 'Successfully Deleted!');
        return redirect()->back();
    }

    public function showAssign()
    {
        $aData = array();
        $aData['aTemplates'] = Template::where('status', '=', 1)
        ->select('title', 'id')
        ->orderBy('title', 'asc')
        ->pluck('title', 'id')->toArray();
        $aData['aRoles'] = Role::where('id', '!=', 1)
        //->where('status', '=', 1)
       //->select(DB::Raw('CONCAT(firstName, " ", lastName) as name'), 'id')
        ->select('role as name', 'id')
        ->orderBy('name', 'asc')
        ->pluck('name', 'id')->toArray();
        return view('admin.templates.assign', $aData);
    }

    public function saveAssign(TemplatesAssignUserRequest $request)
    {
        $aValidated = $request->validated();        
        if ($aValidated) {
            DB::beginTransaction();
            try {
                $aInsert = array();
                foreach ($aValidated['template_id'] as $value) {
                    if (!UserTemplate::where('role_id', $aValidated['role_id'])->where('template_id', $value)->exists()) {
                        $aInsert[] = array(
                            'template_id' => $value,
                            'role_id' => $aValidated['role_id']
                        );
                    }
                }
                if (!empty($aInsert)) {
                    UserTemplate::insert($aInsert);
                    DB::commit();
                    Session::flash('success', 'Successfully Assigned!');
                } else {
                    Session::flash('danger', 'Oops! Something went wrong.');
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
        $aData['oTemplate'] = Template::find($iId);
        $aData['aUserTemplates'] = UserTemplate::join('users as u', 'u.id', '=', 'user_templates.user_id')
        ->select(DB::raw('CONCAT(u.firstName," ",u.lastName) as name'), 'user_templates.id as user_templates_id', 'user_templates.created_at')
        //->where('u.status', '=', 1)
        ->where('template_id', $iId)
        ->get();
        return view('admin.templates.view', $aData);
    }
    public function deleteAssignUserTemplate(int $iId)
    {
        DB::beginTransaction();
        try {
            UserTemplate::where('id', '=', $iId)->delete();
            DB::commit();
            Session::flash('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }




}
