<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin=Admin::all();
        return response()->json([
            'message'=>true,
            'admin'=>$admin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),
            [
            'name'=>'required|min:5',
            'email'=>'email:rfc,dns|unique:admins,email',
            'image'=>'image',
        ]
        );

        $message=$validator->messages();
        if ($validator->fails()){
            return response()->json([
                'message'=>$message,
                'success'=>false,
            ]);
        }

        $admin = new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;

        if ($request->hasFile('image')){
            $image=$request->file('image');
            $img_name=$image->hashName();
            $path=$image->storeAs('/images',$img_name);
            $admin->image=$path;
            $admin->image=$img_name;
            $admin->save();
            return response()->json([
                'success'=>true,
                'admin'=>$admin,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin=Admin::find($id);
        if ($admin) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $img_name = $image->hashName();
                $path = $image->storeAs('/images', $img_name);
                $admin->image = $path;
                $admin->image = $img_name;
                $admin->save();
                return response()->json([
                    'success' => true,
                    'admin' => $admin,
                ]);
            }

        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>'There is no data',
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $admin=Admin::find($id);
        if ($admin){
            $admin->delete();
            return response()->json([
                'success'=>true,
                'admin'=>$admin,
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'There is no data',
                ]);

        }


    }
}
