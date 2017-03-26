<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use App\Patient;
use App\Clinic;
use App\Pathology;
use Session;
use Carbon\Carbon;

class PatientController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$roles = User::find(Auth::user()->id)->roles()->get();

            // $clinicid = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first()->id;
            // $patients = Clinic::find($clinicid)->patients;
        $patients = Patient::all();
        return view('patients.index')->withPatients($patients);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'name'=>'required|max:255',
            'dob'=>'date|before:tomorrow',
            'gender'=>'required|max:6',
            'bloodgroup'=>'required|max:10',
            'allergies'=>'required',
            'address'=>'required',
            'phoneprimary'=>'required|max:15|unique:patients,phoneprimary',
            'phonealternate'=>'max:15',
            'email'=>'email'
            ],[
            'name.required'=>'Full Name is required to be entered',
            'name.alpha'=>'The Name may only contain alphabets',
            'allergies.required'=>'Please enter know allergies.Enter Not known otherwise.',
            'phoneprimary.unique'=>'This Phone Number is already registered.',
            'dob.date'=>'The Date of Birth should be in mm/dd/yyyy format.',
            'dob.before'=>'The Date of Birth cannot be later than the date today.'
            ]);

        //$cliniccode = Session::get('cliniccode');
        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        //dd($clinicid);
        //$clinic = Clinic::find($clinicid);
       // dd($clinic);
        $patient = new Patient;
        $patient->name = $request->name;
        if ($request->dob == "") {
            $input = '01/01/1900';
        }else{
            $input = $request->dob;
        }
        $format = 'm/d/Y';
        $date = Carbon::createFromFormat($format,$input);
        $patient->dob = $date;
        $patient->gender = $request->gender;
        $patient->phoneprimary = $request->phoneprimary;
        $patient->phonealternate = $request->phonealternate;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->allergies = $request->allergies;
        $patient->bloodgroup = $request->bloodgroup;
        $patient->patientcode = rand(1000,9999);
        $patient->created_by = Auth::user()->id;
        $patient->save();
        $patient->clinics()->attach($clinic);

        Session::flash('message','Success!!');
        Session::flash('text','New Patient Added to Clinic successfully!!');
        Session::flash('type','success');
        Session::flash('timer','5000');

        return redirect()->route('patients.index');
    }

    public function showVisits(Request $request){
        $patient = Patient::findOrFail($request->patient_id);
        //dd($patient);
        // $dt1 = Carbon::create($patient->created_at);
        // $dt = Carbon::toDateString($dt1);
        //$dt = $patient->created_at->diffForHumans();
        $user = User::find($patient->created_by);
        //$visits = $patient->visits;
        return view('visits.show')->withPatient($patient)->withUser($user);
    }

    public function createconsult($id){
        $patient = Patient::findOrFail($id);
        $user = User::find($patient->created_by);
        $pathologies = Pathology::all();
        return view('patients.createconsult')->withPatient($patient)->withUser($user)->withPathologies($pathologies);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        //dd($patient);
        return view('patients.show')->withPatient($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patients.edit')->withPatient($patient);
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
        'name'=>'required|max:255',
        'gender'=>'required|max:6',
        'bloodgroup'=>'required|max:10',
        'phoneprimary'=>'max:15',
        'phonealternate'=>'max:15',
        'email'=>'email'
        ],[
        'name.required'=>'Full Name is required to be entered',
        'name.alpha'=>'The Name may only contain alphabets'
        ]);

       $patient = Patient::find($id);
       $patient->name = $request->name;
       $patient->gender = $request->gender;
       $patient->phoneprimary = $request->phoneprimary;
       $patient->phonealternate = $request->phonealternate;
       $patient->email = $request->email;
       $patient->address = $request->address;
       $patient->allergies = $request->allergies;
       $patient->bloodgroup = $request->bloodgroup;
       $patient->save();

       Session::flash('message','Success!!');
       Session::flash('text','Patient Details updated successfully!!');
       Session::flash('type','success');
       Session::flash('timer','5000');

       return redirect()->route('patients.show',$patient->id);

   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
