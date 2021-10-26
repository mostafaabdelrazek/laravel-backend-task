<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
class UsersController extends Controller
{
    
    protected function register(Request $request){
        $arrRules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ];
        $objValidator = Validator::make($request->all(),$arrRules);
        
        if ($objValidator->fails()) {
            $arrMessage = $objValidator->errors();         
            return response(['Invalid or missing arguments' , $arrMessage],400);
        }
        
        $objUser = new User();
        $objUser->name = $request->input('name');
        $objUser->email = $request->input('email');
        $objUser->phone = $request->input('phone');
        $objUser->password = Hash::make($request->input('password'));
        $boolResult = $objUser->save();
        if($boolResult){
            return response($objUser , 200);
        }else{
            return response($boolResult , 400);
        }
    }

    protected function update(Request $request) {

    }

    protected function login(){

    }

    protected function getAll(){
        $objUser = new User();
        $arrUsers = $objUser->all();
        return response($arrUsers , 200);
    }

    protected function getUsersPaginate(Request $request ,int $intNumbersDisplayedUsers = 10){
        $arrUsers =  User::paginate($intNumbersDisplayedUsers);
        return response($arrUsers, 200);
    }

    protected function delete(Request $request){
        $arrRules = [
            'id' => 'required|numeric'
        ];
        $objValidator = Validator::make($request->all(),$arrRules);
        
        if ($objValidator->fails()) {
            $arrMessage = $objValidator->errors();         
            return response(['Invalid or missing arguments' , $arrMessage],400);
        }
        $intUserID = $request->input('id');
        $objUser = User::find($intUserID);
        if($objUser){
            $objUser->delete();
            return response("User Deleted Successfully" , 200);
        } else {
            return response("can't Delete User" , 400);
        }
    }

}
