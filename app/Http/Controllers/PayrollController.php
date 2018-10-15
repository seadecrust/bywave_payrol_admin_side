<?php

namespace App\Http\Controllers;

use App\Payroll;
use App\Employee;
use App\Role;
use Session;
use Paginate;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Manila');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        $employee = Employee::findOrFail($id);
		return view('payroll.create')->with('employee',$employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id){
		
	   $this->validate($request,[
            'input_salary'=> 'required',
			'over_time' => 'required|bool'
		]);
		
	    $payroll = Payroll::create([
            'input_salary' => $request->input_salary,
			'hours' => $request->hours,
			'rate' => $request->rate,
			'over_time' => $request->over_time,
            'tax'=> $request->tax,
            'philhealth'=> $request->philhealth,
            'sss'=> $request->sss,
            'pagibig'=> $request->pagibig,
            'laptoprent'=> $request->laptoprent,
            'others'=> $request->others,
			'employee_id' => $id
		]);
		
		$payroll->grossPay();
		$payroll->save();
		
		Session::flash('success', 'Payroll Created');
		return redirect()->route('payrolls.show',['id'=>$id]);	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payrollIndex($id){
		$employee = Employee::findOrFail($id);
        return view('payroll.payroll')->with('employee',$employee);
    }

    public function getPayroll($id, $date){
        $dateStarted = $date." 00:00:00";
        $dateEnd = $date." 23:59:59";
    	$payroll = Payroll::where('employee_id', $id)
    					->whereBetween('created_at', [$dateStarted, $dateEnd])->get();

    	 return $payroll;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $payroll = Payroll::findOrFail($id);
		return view('payroll.edit')->with('payroll',$payroll);
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
        $this->validate($request,[
			'over_time' => 'required|bool'
		]);
		
		$payroll = Payroll::findOrFail($id);
        $payroll->input_salary = $request->input_salary;
		$payroll->hours = $request->hours;
		$payroll->rate= $request->rate;
		$payroll->over_time = $request->over_time;
        $payroll->tax = $request->tax;
        $payroll->philhealth = $request->philhealth;
        $payroll->sss = $request->sss;
        $payroll->pagibig = $request->pagibig;
        $payroll->laptoprent = $request->laptoprent;
        $payroll->others = $request->others;

		$payroll->save();		
		
		$payroll->grossPay();
		$payroll->save();
		
		Session::flash('success', 'Payroll Updated ready for download');
		return redirect()->route('payrolls.show',['id'=>$payroll->employee_id]);			
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payroll=Payroll::findOrFail($id);
		$payroll->delete();
		
		Session::flash('success','Payroll Deleted');
		return redirect()->back();
    }
	public function bin(){
		$payrolls=Payroll::onlyTrashed()->get();
		return view('payroll.bin')->with('payrolls', $payrolls);
	}
	
	public function restore($id){
		$payroll=Payroll::withTrashed()->where('id', $id)->first();
		$payroll->restore();
		
		Session::flash('success', 'payroll row is restored.');
		return redirect()->route('employees.index');
	}
	
	public function kill($id){
		$payroll=Payroll::withTrashed()->where('id', $id)->first();		
		$payroll->forceDelete();
		
		Session::flash('success', 'payroll permanently destroyed.');
		return redirect()->route('employees.index');
	}
}
