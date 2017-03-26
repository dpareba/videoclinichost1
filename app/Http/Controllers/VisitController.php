<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;
use App\Visit;
use App\Clinic;
use Session;
use Auth;
use Validator;
use PDF;
use Carbon\Carbon;

class VisitController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visitcreate($id)
    {
        $patient = Patient::find($id);
        return view('visits.create')->withPatient($patient);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function visitstore(Request $request)
    {
        $this->validate($request,[
            'rem_notes'=>'required',
            'rem_complaints'=>'required',
            'rem_history'=>'required'
            ],[
            'rem_notes.required'=>'Doctor Notes cannot be blank!!',
            'rem_complaints.required'=>'Patient Complaints cannot be blank!!',
            'rem_history.required'=>'Patient History cannot be blank!!'
            ]);
        $patient = Patient::find($request->patient_id);
        //dd($patient);
        $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
        $visit = new Visit;
        $visit->rem_notes = $request->rem_notes;
        $visit->rem_complaints = $request->rem_complaints;
        $visit->rem_history = $request->rem_history;
        $visit->patient_id = $patient->id;
        $visit->clinic_id = $clinic->id;
        $visit->nextvisit = Carbon::createFromFormat('m/d/Y','01/01/1900');
        $visit->created_by_name = Auth::user()->name;
        $visit->user_id = Auth::user()->id;
        $visit->save();

        return redirect()->route('reports.create',$visit->id);
    }

    public function visitsstorelocal(Request $request){
        //dd($request);

     if ($request->followuptype == "SOS") {
         $this->validate($request,[
            'followuptype'=>'required',
            'chiefcomplaints'=>'required',
            'examinationfindings'=>'required',
            'patienthistory'=>'required',
            'diagnosis'=>'required',
            'advise'=>'required'
            ],[
            'followuptype.required'=>'Follow up type required',
            'chiefcomplaints.required'=>'Chief Complaints cannot be blank!',
            'examinationfindings.required'=>'Examination Findings cannot be blank!',
            'patienthistory.required'=>'Patient History cannot be blank!',
            'diagnosis.required'=>'Diagnosis cannot be blank!',
            'advise.required'=>'Advise cannot be blank!'
            ]);
     }else{
        $this->validate($request,[
            'followuptype'=>'required',
            'nextvisit'=>'required|date|after:yesterday',
            'chiefcomplaints'=>'required',
            'examinationfindings'=>'required',
            'patienthistory'=>'required',
            'diagnosis'=>'required',
            'advise'=>'required'
            ],[
            'followuptype.required'=>'Follow up type required',
            'nextvisit.required'=>'Follow up Date cannot be left blank',
            'nextvisit.date'=>'Incorrect Date Format',
            'nextvisit.after'=>'The Follow Up Date cannot be a value before today',
            'chiefcomplaints.required'=>'Chief Complaints cannot be blank!',
            'examinationfindings.required'=>'Examination Findings cannot be blank!',
            'patienthistory.required'=>'Patient History cannot be blank!',
            'diagnosis.required'=>'Diagnosis cannot be blank!',
            'advise.required'=>'Advise cannot be blank!'
            ]);
    }


    $patient = Patient::find($request->patient_id);
        //dd($patient);
    $clinic = Clinic::where(['cliniccode'=>Session::get('cliniccode')])->first();
    $visit = new Visit;
    $visit->chiefcomplaints = $request->chiefcomplaints;
    $visit->examinationfindings = $request->examinationfindings;
    $visit->patienthistory = $request->patienthistory;
    $visit->diagnosis = $request->diagnosis;
    $visit->advise = $request->advise;
    if ($request->followuptype == "SOS") {
        $visit->isSOS = true;
        $visit->nextvisit = Carbon::createFromFormat('m/d/Y','01/01/1900');
    }else{
        $visit->isSOS = false;
        $visit->nextvisit = Carbon::createFromFormat('m/d/Y',$request->nextvisit);
    }
    $visit->patient_id = $patient->id;
    $visit->clinic_id = $clinic->id;
    $visit->created_by_name = Auth::user()->name;
    $visit->user_id = Auth::user()->id;
    $visit->save();

    if ($request->has('pathology')) {
        $visit->pathologies()->sync($request->pathology,false);
    }
    

    Session::flash('message','Success!!');
    Session::flash('text','New Consultation Created!!');
    Session::flash('type','success');

    return redirect()->route('patients.show',$request->patient_id);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
