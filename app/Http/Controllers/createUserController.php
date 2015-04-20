<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class createUserController extends Controller {

	//

    public function index()
    {
        $currentUser  = \Auth::user()['name'];
        $currentUserPosition = \Auth::user()['position'];

        return View('addUser',compact('currentUser','currentUserPosition'));
    }

    public function storeUser(Request $request)
    {
        $username = $request::get('userName');
        $email = $request::get('email');
        $password = bcrypt($request::get('password'));
        $psosition = $request::get('position');
        $registeredID = $request::get('registereID');
        $fullname = $request::get('fullname');

      //  $enteredEmail = null;
        $enteredEmailarr = User::where('email',$email)->get();

       /* $enteredEmailarr = DB::table('users')
                        ->select('id')
                        ->whereemail($email)
                        ->get();*/
        $enteredEmail = array_pluck($enteredEmailarr, 'email');
       // return $enteredEmail;


        if(!$enteredEmailarr->count()){
            User::create(['name' =>$username ,'email' => $email, 'password' => $password ,'position' => $psosition , 'registeredID' =>$registeredID ,'fullname' =>$fullname ]);


            return Redirect::back()
                ->with('flash_message', "<Strong>Well done!</Strong> </br>You successfully Created a User Account.")
                ->with('flash_type', 'alert-success');

        }else {

            return Redirect::back()
                ->with('flash_message', "<Strong>Oh Snap! There is a error with your Inputs</Strong> </br> You have entered Email already has a account")
                ->with('flash_type', 'alert-danger');


        }
        }
    public function validateEmail(){

    }
function updateUserindex(){

    $categories1 =  User::lists('email','registeredID');


    //return $categories1;

    $currentUser  = \Auth::user()->name;
    $currentUserPosition = \Auth::user()->position;
    return view('updateUser',compact('currentUser','currentUserPosition','categories1'));
}
    function updateUserindexstore(Request $request){

        $username = $request::get('userName');
        $email = $request::get('email');
        $password = bcrypt($request::get('password'));
        $psosition = $request::get('position');
        $registeredID = $request::get('registereID');
        $fullname = $request::get('fullname');

        //  $enteredEmail = null;
        $enteredEmailarr = User::where('email',$email)->get();

        /* $enteredEmailarr = DB::table('users')
                         ->select('id')
                         ->whereemail($email)
                         ->get();*/
        $enteredEmail = array_pluck($enteredEmailarr, 'email');
        // return $enteredEmail;


      //  if(!$enteredEmailarr->count()){
            User::update(['name' =>$username ,'email' => $email, 'password' => $password ,'position' => $psosition , 'registeredID' =>$registeredID ,'fullname' =>$fullname ]);


            return Redirect::back()
                ->with('flash_message', "<Strong>Well done!</Strong> </br>You successfully Updated a User Account.")
                ->with('flash_type', 'alert-success');

     //   }else {

          // return Redirect::back()
           //     ->with('flash_message', "<Strong>Oh Snap! There is a error with your Inputs</Strong> </br> You have entered Email already has a account")
          //      ->with('flash_type', 'alert-danger');


     //   }
    }
    public function searchUserAccountDetailsByID(){

        $eId = Input::get('id');


        $rows = User::where('registeredID', $eId)->get();

       return  View::make('backend.admin.testResults.index')->with('rows', $rows);




    }

}

