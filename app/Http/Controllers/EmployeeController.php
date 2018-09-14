<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Role;
use App\Department;
use App\Payroll;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index', ['employees'=>Employee::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
		if($roles->count()==0){
			Session::flash('Success', 'you must have at least 1 role created before attempting to create an employee');
			return redirect()->back();
		}
        return view('employee.create')->with('roles',$roles);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
			'name' => 'required|max:255',
			'idnum' => 'required',
			'email' => 'required|email',
			'salary' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'datestarted' => 'required',
			'full_time' => 'required',
			'password' => 'required',
			'role_id' => 'required'
		]);

        $userDuplicate = User::where('email', '=', $request->email)->get();

		if($userDuplicate->count() > 0){
				return redirect()->route('employees.index')->with('error', "Email Address exists.");
		}else{

				$users = new User;
				$users ->name = $request->name;
				$users ->email = $request->email;
				$users ->password = bcrypt($request->password);
				$users ->role = 'employee';	
				$users->save();
				
				$employee = Employee::create([
					'fk_employee' => $users->id,
					'name' => $request->name,
					'slug' =>str_slug($request->name),
					'idnum' => $request->idnum,
					'email' => $request->email,
					'salary' => $request->salary,
					'phone' => $request->phone,
					'address' => $request->address,
					'datestarted' => $request->datestarted,
					'full_time' => $request->full_time,
					'password' => bcrypt($request->password),
					'role_id' => $request->role_id,	
				]);
				
				$payroll = new Payroll;
				$payroll->employee_id = $employee->id;
				$payroll->save();
				$employee->save();

				$request->session()->flash('status', 'New Employee created');

				return redirect()->route('employees.index');
			}
	

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employee.show',['employee'=>Employee::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employee.edit', ['employee'=>Employee::where('fk_employee', $id)->first(),
											'roles'=>Role::all()]);
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
        $employee=Employee::findOrFail($id);
		$this->validate($request,[
			'name' => 'required|max:255',
			'slug' =>str_slug($request->name),
			'idnum' => 'required',
			'email' => 'required|email',
			'salary' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'datestarted' => 'required',
			'full_time' => 'required',
			'password' => 'required',
			'role_id' => 'required'
		]);
				
		
		if(Auth::user()->role == 'admin'){

			$employee->name = $request->name;
			$employee->slug = str_slug($request->name);
			$employee->idnum = $request->idnum;
			$employee->email = $request->email;
			$employee->salary = $request->salary;
			$employee->phone = $request->phone;
			$employee->address = $request->address;
			$employee->datestarted = $request->datestarted;
			$employee->full_time = $request->full_time;
			
			if($employee->password == $request->password){				
				$employee->password = $request->password;
			}else{
				$employee->password = bcrypt($request->password);
			}

			$employee->role_id  = $request->role_id;		
			$employee->save();


			$user = User::findOrFail($employee->fk_employee);
			$user->name = $employee->name;
			$user->email = $employee->email;
			$user->password = $employee->password;
			$user->role = 'employee';	
			$user->save();

	}else{

			$employee->name = $request->name;
			$employee->slug = str_slug($request->name);
			$employee->idnum = $request->idnum;
			$employee->email = $request->email;
			$employee->salary = $request->salary;
			$employee->phone = $request->phone;
			$employee->address = $request->address;
			$employee->datestarted = $request->datestarted;
			$employee->full_time = $request->full_time;

			if($employee->password == $request->password){
				$employee->password = $request->password;
			}else{
				$employee->password = bcrypt($request->password);
			}
			
			$employee->role_id  = $request->role_id;		
			$employee->save();


			$user = Auth::user();
			$user->name = $employee->name;
			$user->email = $employee->email;
			$user->password = $employee->password;
			$user->role = 'employee';	
			$user->save();
	}

		$request->session()->flash('status', 'New Employee created');
	
		return (Auth::user()->role == "admin" ) ? redirect()->route('employees.index') : view('/userhome', [
                    'user_employee' => $employee
            ]);
    }

    public function updatePassword(){
    	$passwordData = $_POST['data'];

    	$employee = Employee::findOrFail($passwordData['id']);
    	$employee->password = bcrypt($passwordData['new']);
    	$employee->save();

    	$user = User::findOrFail($employee->fk_employee);
    	$user->password = $employee->password;
    	$user->save();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
    {
        $employee=Employee::findOrFail($id);
		$employee->delete();
		
		Session::flash('success','Employee deleted');
		return redirect()->route('employees.index');
    }
	
	public function bin(){
		$employees=Employee::onlyTrashed()->get();
		return view('employee.bin')->with('employees', $employees);
	}
	
	public function restore($id){
		$employee=Employee::withTrashed()->where('id', $id)->first();
		$employee->restore();
		
		Session::flash('success', 'The employee user account is restored.');
		return redirect()->route('employees.index');
	}
	
	public function kill($id){
		$employee=Employee::withTrashed()->where('id', $id)->first();
		foreach($employee->payrolls as $payroll):
			$payroll->delete();
		endforeach;
		
		$employee->forceDelete();
		
		Session::flash('success', 'The employee account has been permanently destroyed.');
		return redirect()->route('employees.index');
	}
}
