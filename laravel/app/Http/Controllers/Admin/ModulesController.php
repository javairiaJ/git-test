<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Modules\ModulesStoreRequest;
use App\Http\Requests\Modules\ModulesUpdateRequest;
use App\Http\Requests\Modules\ModulesAssignUserRequest;
use DB;
use Session;
use App\User;
use App\Module;
use App\UserModule;

class ModulesController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['title'])) {
            $aData['sTitle'] = $_GET['title'];
        }

        $aData['iPage'] = $iPage;
        return view('admin.modules.index', $aData);
    }

    public function listing(Request $request)
    {
        // d($request->all(),1);
        $aData['aSearch'] = $request->all();
        $aData['oModel'] = Module::searchModule($aData['aSearch']);
        $aData['aModules'] = Module::where('status', '=', 1)
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->pluck('title', 'id')->toArray();
        return view('admin.modules.ajax.list', $aData);
    }

    public function create()
    {
        $aData = array();
        $aData['aModules'] = Module::where('status', '=', 1)
            ->where('parent_id', 0)
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->pluck('title', 'id')->toArray();
        //d($aData['modules'],1);
        return view('admin.modules.create', $aData);
    }

    public function show(int $iId)
    {
        $aData = array();
        $aData['oModule'] = Module::find($iId);
        $aData['aSubModules'] = Module::where('status', '=', 1)->where('parent_id', $iId)->get();
        $aData['aUserModules'] = UserModule::join('users as u', 'u.id', '=', 'user_modules.user_id')
            ->select(DB::raw('CONCAT(u.firstName," ",u.lastName) as name'), 'user_modules.id as user_modules_id', 'user_modules.created_at')
            ->where('u.status', '=', 1)
            ->where('module_id', $iId)
            ->get();
        //d($aData['aUserModules'],1);
        return view('admin.modules.details', $aData);
    }

    public function save(ModulesStoreRequest $request)
    {
        $aValidated = $request->validated();
        if ($aValidated) {
            try {
                Module::insert($aValidated);
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect('admin/modules');
            } catch (\Exception $ex) {
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function edit(int $iId)
    {
        $aData = array();
        $aData['oModule'] = Module::findOrFail($iId);
        $aData['aModules'] = Module::where('status', '=', 1)->where('id', '!=', $iId)
            ->where('parent_id', 0)
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->pluck('title', 'id')->toArray();
        return view('admin.modules.edit', $aData);
    }

    public function update(ModulesUpdateRequest $request, int $iId)
    {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                Module::where('id', '=', $iId)->update($aValidated);
                DB::commit();
                Session::flash('success', 'Successfully Updated!');
                return redirect('admin/modules');
            } catch (\Exception $ex) {
                DB::rollBack();
                Session::flash('danger', $ex->getMessage());
                return redirect()->back();
            }
        }
    }

    public function delete(int $iId)
    {
        DB::beginTransaction();
        try {
            Module::where('id', '=', $iId)->delete();
            UserModule::where('module_id', '=', $iId)->delete();
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
        $aData['aModules'] = Module::where('status', '=', 1)->where('parent_id', 0)
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->pluck('title', 'id')->toArray();
        $aData['aUsers'] = User::where('role_id', '!=', 1)->where('status', '=', 1)
            ->select(DB::Raw('CONCAT(firstName, " ", lastName) as name'), 'id')
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')->toArray();
        return view('admin.modules.assign', $aData);
    }

    public function saveAssign(ModulesAssignUserRequest $request)
    {
        $aValidated = $request->validated();
        if ($aValidated) {
            DB::beginTransaction();
            try {
                $aInsert = array();
                foreach ($aValidated['module_id'] as $value) {
                    if (!UserModule::where('user_id', $aValidated['user_id'])->where('module_id', $value)->exists()) {
                        $aInsert[] = array(
                            'module_id' => $value,
                            'user_id' => $aValidated['user_id']
                        );
                    }
                }
                if (!empty($aInsert)) {
                    UserModule::insert($aInsert);
                    DB::commit();
                    Session::flash('success', 'Successfully Assigned!');
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                Session::flash('danger', $ex->getMessage());
            }
            return redirect()->back();
        }
    }

    public function deleteAssignUserModule(int $iId)
    {
        DB::beginTransaction();
        try {
            UserModule::where('id', '=', $iId)->delete();
            DB::commit();
            Session::flash('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }

}
