<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('admin.properties.index');
        } else {
            $data = Property::when(!auth()->user()->is_admin, function ($q){
                $q->whereHas('broker',function ($q1){
                    $q1->where('users.id',auth()->id());
                });
            })->select('id', 'name', 'contact', 'address', 'city', 'zip_code', 'kind_of_property', 'area', 'total_valuation', 'property_status');
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
            'action'    => route('properties.store'),
            'roles'     => $roles,
            'method' => 'POST',
        );
        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => 'AjaxModal Loaded',
            'data'       => view('admin.properties.ajaxModal', $data)->render()
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
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'name'     => "required",
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
        Property::create($postData);
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
        $userModel = Property::find($id);
        $data = array(
            'action'    => route('properties.update', ['property' => $id]),
            'data' => $userModel,
            'method' => 'PUT',
        );
        return response()->json([
            'status'     => true,
            'statusCode' => 200,
            'message'    => 'AjaxModal Loaded',
            'data'       => view('admin.properties.ajaxModal', $data)->render()
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
        $validator = Validator::make($postData, [
            'name'     => "required",
            'email'    => "required|unique:users,email," . $id,
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


        if (!empty($postData['password'])) {
            $postData['password'] = Hash::make($postData['password']);
        } else {
            $postData['password'] = Hash::make(12345678);
        }

        $userModel = Property::find($id);
        if (!$userModel) {
            return response()->json([
                'status'     => false,
                'statusCode' => 419,
                'message'    => "Opps! user does not exist."
            ]);
        }

        $userModel->update($postData);
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
        $user = Property::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'statusCode' => 419, 'message' => 'Not Found']);
        }
        $user->delete();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => 'Deleted Successfully',], 200);
    }

    public function getActions($row)
    {
        $action = '<div class="action-btn-container">';

        if (auth()->user()->is_admin) {
            $action .= '<a href="' . route('properties.edit', ['property' => $row->id]) . '" class="btn btn-sm btn-warning ajaxModalPopup" data-modal_title="Update Property"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
            $action .= '<a href="' . route('properties.destroy', ['property' => $row->id]) . '" data-id="' . $row->id . '" class="btn btn-sm btn-danger ajaxModalDelete" data-modal_title="Delete City"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
        }
        $action .= '</div>';

        return $action;
    }
}
