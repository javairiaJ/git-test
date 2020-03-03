<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UsersStoreRequest;
use App\Http\Requests\Users\UsersUpdateRequest;
use Auth;
use App\User;
use App\Role;
use DB;
use Excel;
use Session;
use App\Functions\Functions;
use App\Template;
use App\UserTemplate;

class UsersController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $aUserTypes;
    private $aRoles;

    public function __construct() {
        parent::__construct();
        $this->aUserTypes = config('constants.user_types');
        $this->aRoles = Role::orderBy('role', 'asc')->pluck('role', 'id')->toArray();
    }

    public function index() {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['firstName'])) {
            $aData['sFirstName'] = $_GET['firstName'];
        }
        if (isset($_GET['lastName'])) {
            $aData['sLastName'] = $_GET['lastName'];
        }
        if (isset($_GET['email'])) {
            $aData['sEmail'] = $_GET['email'];
        }
        if (isset($_GET['status'])) {
            $aData['iStatus'] = $_GET['status'];
        }
        $aData['iPage'] = $iPage;
        return view('admin.users.index', $aData);
    }

    public function listing(Request $request) {
        // d($request->all(),1);
        $aData['aSearch'] = $request->all();
        $aData['oModel'] = User::searchUser($aData['aSearch']);
        $aData['aUserTypes'] = $this->aUserTypes;
        $aData['aRoles'] = $this->aRoles;
        return view('admin.users.ajax.list', $aData);
    }

    public function show($iId) {
        $aData = array();
        $aData['oUser'] = User::find($iId);
        $aData['aUserTypes'] = $this->aUserTypes;
        $aData['aRoles'] = $this->aRoles;
        return view('admin.users.details', $aData);
    }

    public function create() {
        $aData = array();
        $aData['iUserId'] = Auth::user()->id;
        $aData['aUserTypes'] = $this->aUserTypes;
        $aData['aRoles'] = $this->aRoles;
        $aData['aTemplates'] = Template::where('status', '=', 1)
        ->select('title', 'id')
        ->orderBy('title', 'asc')
        ->pluck('title', 'id')->toArray();
        $aData['oUserTemplate'] = null;
        return view('admin.users.create', $aData);
    }

    public function save(UsersStoreRequest $request) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                $sConfirmationCode = str_random(30);
                //$aValidated['role_id'] = 2;
                $aValidated['password'] = bcrypt($sConfirmationCode);
                $aValidated['key'] = $sConfirmationCode;
                $iLastInsertedUserId = User::insertGetId($aValidated);

                $aInsert = array();
                if(!empty($request->template_id)){
                    foreach ($request->template_id as $value) {
                        if (!UserTemplate::where('user_id', $iLastInsertedUserId)->where('template_id', $value)->exists()) {
                            $aInsert[] = array(
                                'template_id' => $value,
                                'user_id' => $iLastInsertedUserId
                            );
                        }
                    }
                    if (!empty($aInsert)) {
                        UserTemplate::insert($aInsert);
                    }
                }

                $sEmail = $aValidated['email'];
                $subject = view('emails.confirm_email.subject');
                $body = view('emails.confirm_email.body', compact('sConfirmationCode', 'sEmail'));
                Functions::sendEmail($sEmail, $subject, $body);

                DB::commit();
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect('admin/users');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function edit($iId) {
        $aData['oUser'] = User::findOrFail($iId);
        if (isset($data['user']->dob)) {
            list($year, $month, $date) = explode('-', $aData['user']->dob);
            $aData['user']->date = $date;
            $aData['user']->month = $month;
            $aData['user']->year = $year;
        }
        $aData['aUserTypes'] = $this->aUserTypes;
        $aData['aRoles'] = $this->aRoles;
        $aData['aTemplates'] = Template::where('status', '=', 1)
        ->select('title', 'id')
        ->orderBy('title', 'asc')
        ->pluck('title', 'id')->toArray();
        $aParams['iUserId'] = $iId;
        $aData['oUserTemplate'] = UserTemplate::getUserTemplate($aParams)->pluck('id')->toArray();
        return view('admin.users.edit', $aData)->with('user_id', $iId);
    }

    public function update(UsersUpdateRequest $request, $iId) {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                User::where('id', '=', $iId)->update($aValidated);

                $aInsert = array();
                if(!empty($request->template_id)){
                    UserTemplate::where('user_id', $iId)->delete();
                    foreach ($request->template_id as $value) {
                        if (!UserTemplate::where('user_id', $iId)->where('template_id', $value)->exists()) {
                            $aInsert[] = array(
                                'template_id' => $value,
                                'user_id' => $iId
                            );
                        }
                    }
                    if (!empty($aInsert)) {
                        UserTemplate::insert($aInsert);
                    }
                }

                DB::commit();
                Session::flash('success', 'Successfully Updated!');
                return redirect('admin/users');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function delete($iId) {
        User::where('id', '=', $iId)->delete();
        Session::flash('success', 'Successfully Deleted!');
        return redirect()->back();
    }

    public function accept(Request $request, $iId) {
        DB::table('users')->where('id', $iId)->update([
            'status' => 1,
            'updated_at' => date('Y-m-d'),
        ]);
        $request->session()->flash('alert-success', 'Successfully Approved!');
        return back();
    }

    public function reject(Request $request, $iId) {
        DB::table('users')->where('id', $iId)->update([
            'status' => 0,
            'updated_at' => date('Y-m-d'),
        ]);
        $request->session()->flash('alert-success', 'Successfully Disapproved!');
        return back();
    }

    public function downloadExcel($type) {
        $sql = "SELECT u.firstName FirstName,u.`lastName` LastName,u.`email`Email,u.`phone`Phone,u.`location`Location,
       GROUP_CONCAT(DISTINCT l.title) Languages, 
       GROUP_CONCAT(DISTINCT s.title) Skills,
       COUNT(DISTINCT t1.id) TasksPosted,
       COUNT(DISTINCT t2.id) TasksCompleted,
       AVG(r.`rating`) AverageRating
FROM   users u 
       LEFT JOIN users_languages ul 
               ON  ul.user_id = u.id
       LEFT  JOIN languages l 
               ON ul.language_id = l.id
       LEFT JOIN users_skills us 
               ON us.user_id = u.`id`
       LEFT  JOIN skills s 
               ON s.id = us.`skill_id`
       LEFT JOIN tasks t1 ON t1.user_id = u.id
       LEFT JOIN (SELECT * FROM tasks WHERE taskStatus='completed')t2 ON t2.user_id = u.id
       LEFT JOIN reviews r ON r.rate_to = u.id
GROUP  BY u.`id`";
        $result = DB::select($sql);
        $data = array_map(function($object) {
            return (array) $object;
        }, $result);
        return Excel::create('users_data', function($excel) use ($data) {
                    $excel->sheet('mySheet', function($sheet) use ($data) {
                        $sheet->fromArray($data);
                    });
                })->download($type);
    }

//    public function importExcel() {
//        if (Input::hasFile('import_file')) {
//            $path = Input::file('import_file')->getRealPath();
//            $data = Excel::load($path, function($reader) {
//                        
//                    })->get();
//            if (!empty($data) && $data->count()) {
//                foreach ($data as $key => $value) {
//                    $insert[] = ['title' => $value->title, 'description' => $value->description];
//                }
//                if (!empty($insert)) {
//                    DB::table('users')->insert($insert);
//                    dd('Insert Record successfully.');
//                }
//            }
//        }
//        return back();
//    }
}
