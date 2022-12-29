<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserApiController extends Controller
{
    public function showUser($id=null){
        if($id==''){
            $users = User::get();
            return response()->json(['user'=>$users],200);
        }
        else{
            $users = User::find($id);
            return response()->json(['user'=>$users],200);
        }

       
    }
    public function addUser(Request $request){

        if($request->ismethod('post')){
            $data = $request->all();
            //return $data;

            $rules =[

                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
            ];
            $customMessage =[
                'name.required'=>'Name is required',
                'email.email'=>'email is required',
                'password.required'=>'password is required',
            ];

            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

           

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User Succesfully Added';
            return response()->json(['message'=>$message],201);

        } 
        }

      
        public function addMultipleUser(Request $request){

            if($request->ismethod('post')){
                $data = $request->all();
                //return $data;
    
                $rules =[
    
                    'user.*.name'=>'required',
                    'user.*.email'=>'required|email|unique:users',
                    'user.*.password'=>'required',
                ];
                $customMessage =[
                    'user.*.name.required'=>'Name is required',
                    'user.*.email.email'=>'email is required',
                    'user.*.password.required'=>'password is required',
                ];
    
                $validator = Validator::make($data,$rules,$customMessage);
                if($validator->fails()){
                    return response()->json($validator->errors(),422);
                }
    
               
                foreach ($data['users']as $adduser){
                    $user = new User();
                $user->name = $adduser['name'];
                $user->email = $adduser['email'];
                $user->password = bcrypt($adduser['password']);
                $user->save();
                $message = 'User Succesfully Added';
                
                }
                return response()->json(['message'=>$message],201);
    
            }
            
            }
    

        //update many
            public function updateUser(Request $request,$id){

                if($request->ismethod('put')){
                    $data = $request->all();
                    //return $data;
        
                    $rules =[
        
                        'name'=>'required',
                        'password'=>'required',
                    ];
                    $customMessage =[
                        'name.required'=>'Name is required',
                        'password.required'=>'password is required',
                    ];
        
                    $validator = Validator::make($data,$rules,$customMessage);
                    if($validator->fails()){
                        return response()->json($validator->errors(),422);
                    }
        
                   
        
                    $user = User::findOrFail($id);
                    $user->name = $data['name'];
                    $user->password = bcrypt($data['password']);
                    $user->save();
                    $message = 'User Succesfully Upadated';
                    return response()->json(['message'=>$message],202);
        
                } 
                }

                // update one

                public function updateSingleRecord(Request $request,$id){

                    if($request->ismethod('patch')){
                        $data = $request->all();
                        //return $data;
            
                        $rules =[
            
                            'name'=>'required',
                            
                        ];
                        $customMessage =[
                            'name.required'=>'Name is required',
                            
                        ];
            
                        $validator = Validator::make($data,$rules,$customMessage);
                        if($validator->fails()){
                            return response()->json($validator->errors(),422);
                        }
            
                       
            
                        $user = User::findOrFail($id);
                        $user->name = $data['name'];
                        $user->save();
                        $message = 'User Succesfully Upadated';
                        return response()->json(['message'=>$message],202);
            
                    } 
                    }
    
                        //delete single parameter

                    public function deleteSingleUser($id=null){
                        User::findOrFail($id)->delete();
                        $message = 'User Succesfully Deleted';
                        return response()->json(['message'=>$message],200);
                    }

                    //delete multiple user

                    public function deleteMultipleUser($ids){
                        $ids = explode(',',$ids);
                        User::whereIn('id',$ids)->delete();
                        $message = 'User Succesfully Deleted';
                        return response()->json(['message'=>$message],200);
                    }
    
        }
