<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\UserProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class BrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('admin.brokers.index');
        } else {
            $data = User::where('is_admin',0)->select('id','name','email','contact','city','commission','experience','email_verified_at','password','remember_token','status');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->getActions($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', '1')->get();
        $data = array(
            'properties' => Property::get(),
            'action'    => route('brokers.store'),
            'roles'     => $roles,
            'method' => 'POST',
        );
        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => 'AjaxModal Loaded',
            'data'       => view('admin.brokers.ajaxModal', $data)->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'name'     => "required",
            'email'    => "required|unique:users,email",
        ]);

        //If Validation failed
        if ($validator->fails()) {
            return response()->json([
                'status'     => false,
                'statusCode' => 419,
                'message'    => $validator->errors()->first(),
                'errors'     => $validator->errors()
            ]);
        }
        $postData['password'] = Hash::make(12345678);
        $userModel = User::create($postData);
        foreach($postData['property_ids'] as $property_id){
            UserProperty::create([
                'user_id' => $userModel->id,
                'property_id' => $property_id,
            ]);
        }

        DB::commit();
        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => "Created Successfully."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userModel = User::find($id)->toArray();
        $userModel['property_ids'] = UserProperty::where('user_id',$id)->distinct('property_id')->pluck('property_id');
        $data = array(
            'action'    => route('brokers.update', ['broker' => $id]),
            'properties' => Property::get(),
            'data' => $userModel,
            'method' => 'PUT',
        );
        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => 'AjaxModal Loaded',
            'data'       => view('admin.brokers.ajaxModal', $data)->render()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postData = $request->all();
        $userModel = User::find($id);
        if (!$userModel) {
            return response()->json([
                'status'     => false,
                'statusCode' => 419,
                'message'    => "Opps! user does not exist."
            ]);
        }
        $userModel->update($postData);

        foreach($postData['property_ids'] as $property_id){
            UserProperty::firstOrcreate([
                'user_id' => $userModel->id,
                'property_id' => $property_id,
            ]);
        }

        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => "Updated Successfully."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'statusCode' => 419, 'message' => 'Not Found']);
        }
        $user->delete();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => 'Deleted Successfully',], 200);
    }

    public function getActions($row)
    {
        $action = '<div class="action-btn-container">';
        $action .= '<a href="' . route('brokers.edit', ['broker' => $row->id]) . '" class="btn btn-sm btn-warning ajaxModalPopup" data-modal_title="Update Broker"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
        $action .= '<a href="' . route('brokers.destroy', ['broker' => $row->id]) . '" data-id="' . $row->id . '" class="btn btn-sm btn-danger ajaxModalDelete" data-modal_title="Delete City"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
        $action .= '</div>';
        return $action;
    }
}
