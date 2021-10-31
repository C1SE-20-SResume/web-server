<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\JobKeyword;
use App\Models\JobDetail;

/*
* Import scan file class
*/
use Smalot\PdfParser\Parser;
use LukeMadhanga\DocumentParser;

class JobApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobDetail::all();
        if ($jobs != null) {
            $applies = [];
            foreach ($jobs as $job) {
                $apply = $job->apply->count();
                $company = $job->company;
                $applies[] = json_decode(json_encode([
                    'id' => $job->id,
                    'company_name' => $company->company_name,
                    'logo_url' => $company->logo_url,
                    'job_title' => $job->job_title,
                    'job_place' => $job->job_place,
                    'apply_count' => $apply,
                    'created_at' => $job->created_at,
                    'updated_at' => $job->updated_at,
                ]));
            }
            return response()->json([
                'status' => 1,
                'data' => $applies,
            ]);
        }
        return response()->json([
            'status' => 0,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'cv_file' => 'required|mimes:txt,doc,docx,pdf,png,jpg,jpeg'
        ]);
        $request = $request->only('user_id', 'job_id', 'cv_file');
        if(isset($request['user_id']) && isset($request['job_id']) && $request->hasFile('cv_file')) {
            $filenameWithExt = $request->file('cv_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cv_file')->getClientOriginalExtension();
            $fileNameToStore = time().uniqid().'_'.$filename.'.'.$extension;
            $request->file('cv_file')->move('cv_uploads', $fileNameToStore);
            $filePath = 'cv_uploads/'.$fileNameToStore;
            $text = "";
            $mimetype = $request->file('cv_file')->getClientMimeType();
            // PDF files
            if($mimetype == 'application/pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                $text = str_replace("\t", "", $text);
                $text = str_replace("  ", " ", $text);
            }
            // TXT, DOC, DOCX files
            else if($mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
            || $mimetype == 'application/msword' || $mimetype == 'text/plain') {
                $parser = new DocumentParser();
                $text = $parser->parseFromFile($filePath, $mimetype);
                $text = str_replace("<em>", "", $text);
                $text = str_replace("</em>", "", $text);
            }
            // $text = Str::lower($text); utf-8
            $text = strtolower($text);
            $keywords = JobKeyword::where('job_id', $request['job_id'])->get();
            $minimum_weight = 0;
            $cv_weight = 0;
            foreach($keywords as $keyword){
                $word = strtolower($keyword->keyword);
                if($keyword->priority_weight == 1) {
                    $minimum_weight = $minimum_weight + 0.3;
                    // $contains = Str::contains($text, 'keyword');
                    if(str_contains($text, $word) == true)
                        $cv_weight = $cv_weight + 0.5; 
                }  
                else if($keyword->priority_weight == 2) {
                    $minimum_weight = $minimum_weight + 0.7;
                    if(str_contains($text, $word) == true)
                        $cv_weight = $cv_weight + 1;
                } 
                else if($keyword->priority_weight == 3) {
                    $minimum_weight = $minimum_weight + 1.15;
                    if(str_contains($text, $word) == true)
                        $cv_weight = $cv_weight + 1.5;
                }  
                else if($keyword->priority_weight == 4) {
                    $minimum_weight = $minimum_weight + 1.6;
                    if(str_contains($text, $word) == true)
                        $cv_weight = $cv_weight + 2;
                }
                else if($keyword->priority_weight == 5) {
                    $minimum_weight = $minimum_weight + 2;
                    if(str_contains($text, $word) == true)
                        $cv_weight = $cv_weight + 2.5;
                }
            }
            if($cv_weight >= $minimum_weight) $pass_status = 1;
            else $pass_status = 0;
            JobApply::create([
                    'user_id' => $request['user_id'],
                    'job_id' => $request['job_id'],
                    'cv_file' => $filePath,
                    'cv_score' => $cv_weight.'/'.$minimum_weight,
                    'pass_status' => $pass_status,
            ]);
            return response()->json([
                'status' => true,
                'cv_score' => $cv_weight.'/'.$minimum_weight,
                'cv_pass' => $pass_status,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($job_id)
    {
        $applies = JobApply::where('job_id', $job_id)->get();
        if ($applies->count() != 0) {
            $applies_user = [];
            $job = $applies->first()->job;
            foreach ($applies as $apply) {
                $user = $apply->user;
                $applies_user[] = json_decode(json_encode([
                    'user_id' => $user->id,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'cv_file' => $apply->cv_file,
                    'cv_score' => $apply->cv_score,
                    'pass_status' => $apply->pass_status,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'created_at' => $apply->created_at,
                    'updated_at' => $apply->updated_at,
                ]));
            }
            return response()->json([
                'status' => 1,
                'job_id' => $job_id,
                'job_title' => $job->job_title,
                'job_place' => $job->job_place,
                'data' => $applies_user,
            ]);
        }
        return response()->json([
            'status' => 0,
        ]);
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
