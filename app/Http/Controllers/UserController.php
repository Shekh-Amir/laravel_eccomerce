<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\country;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{
	public function UserloginRegister(){
		return view('users.login_register');

	}

	public function login(Request $request){
		if($request->isMethod('post')){
			$data=$request->all();		
			/*echo "<pre>"; print_r($data); echo "</pre>"; die;*/
			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){

                $userStatus=User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    return redirect()->back()->with('flash_message_error','Your Account is not activated. please confirm your account to activate.');

                }
				Session::put('frontSession',$data['email']);
              
                if(!empty(Session::get('session_id'))){
                    $session_id=Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                   }
                
    			return redirect('/cart');

    		}else{
    			return redirect()->back()->with('flash_message_error','Invalid email or Password');
    		}

		}
	}
    public function register(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->all();
    		/*echo "<pre>"; print_r($data); echo "</pre>"; die;*/
    		if (empty($data['address'])) {
    			$data['address']='';
    	  			
    		}
    		if (empty($data['city'])) {
    		$data['city']='';
    		}
    		if (empty($data['state'])) {
    		$data['state']='';  			
    		}
    		if (empty($data['country'])) {
    		$data['country']="";  			
    		}
    		if (empty($data['pincode'])) {
    		$data['pincode']='';  			
    		}
    		if (empty($data['mobile'])) {
    		$data['mobile']='';
    		}
    	
    		//check if user is exists..........
    		$userCount=User::where('email',$data['email'])->count();
    		/*echo "<pre>"; print_r($userCount); echo "</pre>"; die;*/

    		if($userCount>0){
    			return redirect()->back()->with('flash_message_error','Email already exists');

    		}else{
    		$user=new User;
    		$user->name=$data['name'];
    		$user->address=$data['address'];
    		$user->city=$data['city'];
    		$user->state=$data['state'];
    		$user->country=$data['country'];
    		$user->pincode=$data['pincode'];
    		$user->mobile=$data['mobile'];
    		$user->email=$data['email'];
    		$user->password=bcrypt($data['password']);
    		$user->save();

           //Send register Email.........................
         /*   $email=$data['email'];
            $messageData=['email'=>$data['email'],'name'=>$data['name']];
            Mail::send('emails.register',$messageData,function($message) use($email){
            $message->to($email)->subject('Registration with E-com website!');

          });*/

          //Send confirmation Email.........................

          $email=$data['email'];
          $messageData=['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
          Mail::send('emails.confirmation',$messageData,function($message) use($email){
            $message->to($email)->subject('Confirmation with E-com Account!');
            });
          return redirect()->back()->with('flash_message_success',' please confirm your email to activate your account ');

    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    			Session::put('frontSession',$data['email']);
                 if(!empty(Session::get('session_id'))){
                    $session_id=Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                   }
    			return redirect('/cart');

    		}
    	   }  		
    	}  	
    }

    public function confirmAccount($email){
         $email=base64_decode($email);
         $userCount=User::where('email',$email)->count();
         if($userCount>0){
             $userDetails=User::where('email',$email)->first();
             if($userDetails->status == 1){
                return redirect('login-register')->with('flash_message_success',' please your account is already to activated.You can login now ');

             }else{
                User::where('email',$email)->update(['status'=>1]);

                  //Send welcome Email.........................
           
            $messageData=['email'=>$email,'name'=>$userDetails->name];
            Mail::send('emails.welcome',$messageData,function($message) use($email){
            $message->to($email)->subject('welcome to E-com website!');

          });

                return redirect('login-register')->with('flash_message_success',' please account is already to activated.You can login now ');
             }

         }else{
          /*  abort(404);*/
            return view('404');
         }
    }
    public function account(Request $request){
    	$user_id=Auth::User()->id;
    	$userDetails=User::find($user_id);
    	/*echo "<pre>"; print_r($userDetails); echo "</pre>"; die;*/
    	$countries=country::get();

    	if($request->isMethod('post')){
    		$data=$request->all();

    		if (empty($data['name'])) {
    			return redirect()->back()->with('flash_message_error',' please enter your name to update your account details');
    			
    		}
    		if (empty($data['address'])) {
    			$data['address']='';
    	  			
    		}
    		if (empty($data['city'])) {
    		$data['city']='';
    		}
    		if (empty($data['state'])) {
    		$data['state']='';  			
    		}
    		if (empty($data['country'])) {
    		$data['address']="";  			
    		}
    		if (empty($data['pincode'])) {
    		$data['country']='';  			
    		}
    		if (empty($data['mobile'])) {
    		$data['mobile']='';
    		}
    		/*echo "<pre>"; print_r($data); echo "</pre>"; die;*/
    		$user=User::find($user_id);
    		$user->name=$data['name'];
    		$user->address=$data['address'];
    		$user->city=$data['city'];
    		$user->state=$data['state'];
    		$user->country=$data['country'];
    		$user->pincode=$data['pincode'];
    		$user->mobile=$data['mobile'];
    		$user->save();
    		return redirect()->back()->with('flash_message_success',' Your Account Details has been updated successfully');
    	}
    	return view('users.account')->with(compact('userDetails','countries'));
    }
    public function chkUserPassword(Request $request){
    	//check if user is already exists
    	$data=$request->all();
    	/*echo "<pre>"; print_r($data); echo "</pre>"; die;*/
    	$current_password=$data['current_pwd'];
    	$user_id=Auth::User()->id;
    	$check_password=User::where('id',$user_id)->first();
    	if(Hash::check($current_password,$check_password->password)){
    		echo "true";die;
    	}else{
    		echo "false";die;
    	}
    }
    public function updateUserPassword(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->all();
    		/*echo "<pre>"; print_r($data); echo "</pre>"; die;*/
    		$old_pwd=User::where('id',Auth::User()->id)->first();
    		$current_pwd=$data['current_pwd'];
    	if(Hash::check($current_pwd,$old_pwd->password)){
    		//update password
    		$new_pwd=bcrypt($data['new_pwd']);
    		/*echo "<pre>"; print_r($new_pwd); echo "</pre>"; die;*/

    		User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
    		return redirect()->back()->with('flash_message_success','password is updated');

    	   }else{
    	return redirect()->back()->with('flash_message_error',' current password is incorrect');
    	}

    	}

    }
    public function logout(){
    	Auth::logout();
        Session::forget('frontSession');
    	Session::forget('session_id');
    	return redirect('/');
    }

    public function checkEmail(Request $request){
    	$data=$request->all();
    	//check if user is exists..........
    	$userCount=User::where('email',$data['email'])->count();
    		/*echo "<pre>"; print_r($userCount); echo "</pre>"; die;*/

    	if($userCount>0){
    	echo "false";

    	}else{
    			echo "true";die;
    	}


    }

    public function viewUsers(){

        $users=User::get();
        return view('admin.users.view_users')->with(compact('users'));
    }
}
