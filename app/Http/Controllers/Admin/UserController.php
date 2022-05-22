<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Project;
use App\Models\ProjectUser;
use Hash;
Use Auth;
Use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class UserController extends Controller

{
    public function index()
    {
		$users = User::withTrashed()->get();
    	return view('admin.users.index')->with(compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
    		'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            	
    	];
    	$messages = [
    		'name.required' => 'Es necesario ingresar el nombre del usuario.',
    		'name.max' => 'El nombre es demasiado extenso.',
    		'email.required' => 'Es indispensable ingresar el e-mail del usuario.',
    		'email.email' => 'El e-mail ingresado no es válido.',
    		'email.max' => 'El e-mail es demasiado extenso.',
    		'email.unique' => 'Este e-mail ya se encuentra en uso.',
    		'password.required' => 'Olvidó ingresar una contraseña.',
    		'password.min' => 'La contraseña debe presentar al menos 6 caracteres.'
    	];
        
    	$this->validate($request, $rules, $messages);

		
    	$user = new User();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('password'));
    	$user->role = 1;    	
    	$user->save();

    	return back()->with('notification', 'Usuario registrado exitosamente.');
    }
    public function edit($id)
    {
    	$user = User::find($id);
        $projects = Project::all();

        $projects_user = ProjectUser::where('user_id', $user->id)->get();

		$dt = Carbon::now();
		$todayDate = $dt->toDayDateTimeString();
		$full_name = $user->name;
		$responsable = Auth::User();
		
		$activityLog = [
			'responsable'	=> $responsable->name,
			'name'			=> $full_name,
			'email'			=> $user->email,
			'modyfy_user'	=> 'EDIT_USER',
			'date_time'		=> $todayDate,

		];
		DB::table('user_activity_logs')->insert($activityLog);

    	return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user'));
    }
    public function update($id, Request $request)
    {
    	$rules = [
    		'name' => 'required|max:255',
            'password' => 'min:6'
    	];
    	$messages = [
    		'name.required' => 'Es necesario ingresar el nombre del usuario.',
    		'name.max' => 'El nombre es demasiado extenso.',
    		'password.min' => 'La contraseña debe presentar al menos 6 caracteres.'
    	];
    	$this->validate($request, $rules, $messages);

    	$user = User::find($id);
    	$user->name = $request->input('name');

    	$password = $request->input('password');
    	if ($password)
    		$user->password = bcrypt($password);

    	$user->save();

		//$dt = Carbon::now();
		//$todayDate = $dt->toDayDateTimeString();

		$dt = Carbon::now();
		$todayDate = $dt->toDayDateTimeString();
		$full_name = $user->name;
		$responsable = Auth::User();
		
		$activityLog = [
			'responsable'	=> $responsable->name,
			'name'			=> $full_name,
			'email'			=> $user->email,
			'modyfy_user'	=> 'UPDATE_USER',
			'date_time'		=> $todayDate,

		];
		DB::table('user_activity_logs')->insert($activityLog);

		return back()->with('notification', 'Usuario modificado exitosamente.');
    }
    public function delete($id,Request $request )
	{
		$user = User::find($id);
        $user->delete();

		$dt = Carbon::now();
		$todayDate = $dt->toDayDateTimeString();
		$full_name = $user->name;
		$responsable = Auth::User();
		
		$activityLog = [
			'responsable'	=> $responsable->name,
			'name'			=> $full_name,
			'email'			=> $user->email,
			'modyfy_user'	=> 'DELETE_USER',
			'date_time'		=> $todayDate,

		];
		DB::table('user_activity_logs')->insert($activityLog);

        return back()->with('notification', 'El usuario se ha dado de baja correctamente.');
    }
	public function change_password($id, Request $request)
    {

    	$user = User::find($id);

		$dt = Carbon::now();
		$todayDate = $dt->toDayDateTimeString();
		$full_name = $user->name;
		$responsable = Auth::User();
		
		$activityLog = [
			'responsable'	=> $responsable->name,
			'name'			=> $full_name,
			'email'			=> $user->email,
			'modyfy_user'	=> 'CHANGE_UPDATE_PASSWORD_USER',
			'date_time'		=> $todayDate,

		];
		DB::table('user_activity_logs')->insert($activityLog);

		return view('admin.users.change_password')->with(compact('user'));
	}

    public function update_password($id, Request $request)
    {
    	$rules = [
    		'name' => 'required|max:255',
            'password' => 'min:6'
    	];
    	$messages = [
    		'name.required' => 'Es necesario ingresar el nombre del usuario.',
    		'name.max' => 'El nombre es demasiado extenso.',
    		'password.min' => 'La contraseña debe presentar al menos 6 caracteres.'
    	];
    	$this->validate($request, $rules, $messages);
		

    	$user = User::find($id);
    	$user->name = $request->input('name');

    	$password = $request->input('password');
    	if ($password)
    		$user->password = bcrypt($password);
		
    	$user->save();
		return back()->with('notification', 'Usuario modificado exitosamente.');
    }

	public function restore($id, Request $request)
    {
		$user = User::find($id);
		User::withTrashed()->find($id)->restore();
		
        return back()->with('notification', 'El usuario se habilitado correctamente.');
    }

	public function activityLog(Request $request){

		$name = $request->name;

		$activityLog = DB::table('user_activity_logs')
		->where('name', 'like', '%' .$name. '%')
		->orWhere('email', 'like', '%' .$name. '%')
		->orWhere('responsable', 'like', '%' .$name. '%')
		->orWhere('modyfy_user', 'like', '%' .$name. '%')
		->orWhere('date_time', 'like', '%' .$name. '%')
		->get();

		return view('Admin.users.user_activity_log', compact('activityLog'));
	}
}


