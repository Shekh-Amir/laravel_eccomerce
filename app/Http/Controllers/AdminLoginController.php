<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\admin;
use Session;
use Illuminate\Support\Facades\Hash;


class AdminLoginController extends Controller
{
    public function login(Request $request ){

    	if ($request->isMethod('post')) {
    		$data=$request->input();
             $adminCount=admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count(); 
    		if($adminCount >0){
                Session::put('adminSession',$data['username']);
    			return redirect('/dashboard');
    			
    		}else{

                return redirect('/admin')
                ->with('message','Username OR Password is Invalid');
    			
    		}
    		
    	}

    	return view('/admin.admin_login');
    }

    public function dashboard(){
        /*if (Session::has('admin_session')) {
           
        }else{
            return redirect('/admin')
            ->with('message','please login to access');
        }*/
    	return view('admin.dashboard');
    }
     public function logout(){

        Session::flush();
         return redirect('/admin')
         ->with('success','logout done successfully');
         
    }
     public function setting(){
        $adminDetails=admin::where(['username'=>Session::get('adminSession')])->first();
        $adminDetails=json_decode(json_encode($adminDetails));
       /* echo "<pre>"; print_r($adminDetails); die;*/

        return view('admin.setting')->with(compact('adminDetails'));

      
    }

      public function chkPassword(Request $request){
        $data = $request->all();  
        $current_password = $data['current_pwd'];

         $adminCount=admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if($adminCount == 1){
            echo "true"; die;
        }else {
            echo "false"; die;
        }
    }


      public function updatePassword(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
          

            $adminCount=admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();

             if($adminCount == 1){
                $password = md5($data['new_pwd']);
                admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin_setting')->with('success','Password updated Successfully!');
            }else {
                return redirect('/admin_setting')->with('message','Incorrect Current Password!');
            }
        }
    }



}
