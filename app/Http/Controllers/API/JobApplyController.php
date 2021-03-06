<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\JobKeyword;
use App\Models\JobDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\QuestionResult;
use Illuminate\Support\Arr;

/*
* Import scan file class
*/
use Smalot\PdfParser\Parser;
use LukeMadhanga\DocumentParser;
use thiagoalessio\TesseractOCR\TesseractOCR;
// Require: install Tesseract (https://github.com/UB-Mannheim/tesseract/wiki)

class JobApplyController extends Controller
{
    // Get all applied jobs by admin
    public function getAppliedJobs(Request $request)
    {
        // check role of user
        if ($request->user()->role_level !== 2) {
            return response()->json([
                'message' => 'You are not authorized to access this resource.'
            ], 403);
        } else {
            $appliedJobs = JobApply::get();
            $count = $appliedJobs->count();
            return response()->json([
                'appliedJobs' => $appliedJobs,
                'count' => $count
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $company = $user->company;
        $jobs = JobDetail::where('company_id', $company->id)->get();
        if ($jobs != null) {
            $applies = [];
            foreach ($jobs as $job) {
                $apply = $job->apply->count();
                $company = $job->company;
                $applies[] = json_decode(json_encode([
                    'job_id' => $job->id,
                    'job_title' => $job->job_title,
                    'work_time' => $job->work_time,
                    'job_place' => $job->job_place,
                    'salary' => $job->salary,
                    'date_expire' => $job->date_expire,
                    'apply_sum' => $apply,
                    'created_at' => $job->created_at->toDateTimeString(),
                    'updated_at' => $job->updated_at->toDateTimeString(),
                ]));
            }
            return response()->json([
                'success' => true,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'data' => $applies,
            ]);
        }
        return response()->json([
            'success' => false,
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
     * .
     *
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $user = Auth::user();
        if (count($user->apply) > 0) {
            return response()->json([
                'success' => true,
                'applied' => true,
            ]);
        }
        return response()->json([
            'success' => true,
            'applied' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request = $request->only('user_id', 'job_id', 'cv_file');
        if (isset($request['job_id'])) {
            // Check job has expired or not
            $currentTime = now();
            $job = JobDetail::where('id', $request['job_id'])->first();
            if ($job->date_expire < $currentTime->toDateTimeString()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job has expired',
                ]);
            }
            // Check candidate have applied or not
            $user = Auth::user();
            $apply = JobApply::where('job_id', $request['job_id'])->where('user_id', $user->id)->first();
            if ($apply != null) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have applied for this job',
                ]);
            }
            // Check candidate have done both quizzes or not
            $results = QuestionResult::select('type_id')->where('user_id', $user->id)->get();
            $types = [];
            if (count($results) > 0) {
                foreach ($results as $result) {
                    $types[] = $result->type_id;
                }
            }
            if (count(array_diff([1, 2, 3, 4, 5, 6, 7, 8], $types)) > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have not done both types of quizzes',
                ]);
            }
            $filePath = null;
            $filePathToStore = null;
            $mimetype = null;
            // Check first time upload or use new cv file
            if ((!isset($request['cv_new']) || $request['cv_new'] == 'true') && $request->hasFile('cv_file')) {
                $request->validate([
                    'cv_file' => 'required|mimes:txt,doc,docx,pdf,png,jpg,jpeg'
                ]);
                // Save cv file
                $filenameWithExt = $request->file('cv_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('cv_file')->getClientOriginalExtension();
                $fileNameToStore = time() . uniqid() . '_' . $filename . '.' . $extension;
                $request->file('cv_file')->move('cv_uploads', $fileNameToStore);
                $filePathToStore = 'cv_uploads/' . $fileNameToStore;
                $filePath = public_path($filePathToStore);
                // $filePath = public_path('cv_uploads\NguyenNgocThanh_CV_Full_1635460356.pdf');
                $mimetype = $request->file('cv_file')->getClientMimeType();
            } else if ($request['cv_new'] == 'false') {
                $apply_latest = JobApply::where('user_id', $user->id)->latest()->first();
                $filePathToStore = $apply_latest->cv_file;
                $filePath = public_path($filePathToStore);
                // $filePath = public_path() . '\\' . $filePath;
                $mimetype = mime_content_type($filePath);
            }
            $text = "";
            // PDF files
            if ($mimetype == 'application/pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                $text = str_replace("\t", "", $text);
                $text = str_replace("  ", " ", $text);
            }
            // TXT, DOC, DOCX files
            else if (
                $mimetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                || $mimetype == 'application/msword' || $mimetype == 'text/plain'
            ) {
                $parser = new DocumentParser();
                $text = $parser->parseFromFile($filePath, $mimetype);
                $text = str_replace("<em>", "", $text);
                $text = str_replace("</em>", "", $text);
            }
            // PNG, JPG, JPEG file
            else if ($mimetype == 'image/png' || $mimetype == 'image/jpeg') {
                $ocr = new TesseractOCR();
                $ocr->image($filePath);
                // Language default: English, if you want to be used during the recognition 
                $ocr->lang('eng');
                // Define a custom location of the tesseract executable, if the command 'tesseract' was not found
                // $ocr->executable('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tesseract.exe');
                // Data trained folder path, if you want specify a custom location for the tessdata directory
                // $ocr->tessdataDir('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tessdata');
                $text = $ocr->run(); // timeout: 500ms
            }
            // $text = Str::lower($text); utf-8
            $text = strtolower($text);
            $keywords = JobKeyword::where('job_id', $request['job_id'])->get();
            // Score for cv file
            $cv_weight = 0;
            $keyword_found = [];
            $keyword_not_found = [];
            foreach ($keywords as $keyword) {
                $word = strtolower($keyword->keyword);
                // $contains = Str::contains($text, 'keyword');
                if (str_contains($text, $word) == true) {
                    if ($keyword->priority_weight == 1) {
                        $cv_weight = $cv_weight + 0.5;
                        array_push($keyword_found, $word.' (0.5/0.3)');
                    } else if ($keyword->priority_weight == 2) {
                        $cv_weight = $cv_weight + 1;
                        array_push($keyword_found, $word.' (1/0.65)');
                    } else if ($keyword->priority_weight == 3) {
                        $cv_weight = $cv_weight + 1.5;
                        array_push($keyword_found, $word.' (1.5/1.05)');
                    } else if ($keyword->priority_weight == 4) {
                        $cv_weight = $cv_weight + 2;
                        array_push($keyword_found, $word.' (2/1.5)');
                    } else if ($keyword->priority_weight == 5) {
                        $cv_weight = $cv_weight + 2.5;
                        array_push($keyword_found, $word.' (2.5/2)');
                    }
                } else {
                    if ($keyword->priority_weight == 1) {
                        array_push($keyword_not_found, $word.' (0/0.3)');
                    } else if ($keyword->priority_weight == 2) {
                        array_push($keyword_not_found, $word.' (0/0.65)');
                    } else if ($keyword->priority_weight == 3) {
                        array_push($keyword_not_found, $word.' (0/1.05)');
                    } else if ($keyword->priority_weight == 4) {
                        array_push($keyword_not_found, $word.' (0/1.5)');
                    } else if ($keyword->priority_weight == 5) {
                        array_push($keyword_not_found, $word.' (0/2)');
                    }
                }
            }
            // Check scan score of cv file is pass or not
            if ($cv_weight >= $job->require_score)
                $pass_status = 1;
            else $pass_status = 0;
            // Save into database
            JobApply::create([
                'user_id' => $user->id,
                'job_id' => $request['job_id'],
                'cv_file' => $filePathToStore,
                'cv_score' => $cv_weight,
                'pass_status' => $pass_status,
                'keyword_found' => implode(', ', $keyword_found),
                'keyword_not_found' => implode(', ', $keyword_not_found),
            ]);
            // Ranking scan score for candidate's apply
            $ranks = JobApply::query()
                ->selectRaw('user_id, RANK() OVER (ORDER BY cv_score DESC) AS rank')
                ->where('job_id', $request['job_id'])
                ->groupBy('user_id')
                ->get();
            return response()->json([
                'success' => true,
                'keyword_found' => $keyword_found,
                'keyword_not_found' => $keyword_not_found,
                'cv_score' => $cv_weight . '/' . $job->require_score,
                'rank' => $ranks->where('user_id', $user->id)->first()->rank . '/' . $ranks->count(),
                'cv_pass' => $pass_status,
            ]);
        }
        return response()->json([
            'success' => false,
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
            $company = $job->company;
            foreach ($applies as $apply) {
                $user = $apply->user;
                $results = $user->result;
                $aptitude_score = 0;
                $personality_score = 0;
                $aptitude_graph = [];
                $personality_graph = [];
                foreach ($results as $result) {
                    $type = $result->type;
                    if ($result->type_id == 1 || $result->type_id == 2 || $result->type_id == 3) {
                        $aptitude_score = $aptitude_score + $result->ques_score;
                        $aptitude_graph = Arr::add($aptitude_graph, $type->type_name, $result->ques_score); 
                    } else {
                        $personality_score = $personality_score + $result->ques_score;
                        $personality_graph = Arr::add($personality_graph, $type->type_name, $result->ques_score);
                    }
                }
                $applies_user[] = json_decode(json_encode([
                    'user_id' => $user->id,
                    'full_name' => $user->full_name,
                    'gender' => $user->gender,
                    'date_birh' => $user->date_birth,
                    'phone_number' => $user->phone_number,
                    'email' => $user->email,
                    'cv_file' => $apply->cv_file,
                    'cv_score' => $apply->cv_score,
                    'keyword_found' => $apply->keyword_found,
                    'keyword_not_found' => $apply->keyword_not_found,
                    'pass_status' => $apply->pass_status,
                    'aptitude_score' => $aptitude_score . '/15',
                    'personality_score' => $personality_score . '/75',
                    'aptitude_graph' => $aptitude_graph,
                    'personality_graph' => $personality_graph,
                    'apply_created_at' => $apply->created_at->toDateTimeString(),
                    'apply_updated_at' => $apply->updated_at->toDateTimeString(),
                ]));
            }
            return response()->json([
                'success' => true,
                'job_id' => $job_id,
                'company_name' => $company->company_name,
                'logo_url' => $company->logo_url,
                'job_title' => $job->job_title,
                'job_place' => $job->job_place,
                'salary' => $job->salary,
                'date_expire' => $job->date_expire,
                'require_score' => $job->require_score,
                'job_created_at' => $job->created_at->toDateTimeString(),
                'job_updated_at' => $job->updated_at->toDateTimeString(),
                'data' => $applies_user,
            ]);
        }
        return response()->json([
            'success' => false,
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

    /**
     * Download CV file API
     *
     */
    public function downCV (Request $request)
    {
        // $request['cv_path'] = 'cv_uploads/16358412516180f4e33f2e8_Capture.png';
        $fileName = substr($request['cv_path'], 35);
        //File is stored under /public/cv_uploads/
        $filePath = public_path($request['cv_path']);
        $mimetype = mime_content_type($filePath);
        $headers = [
            'Content-Type' => $mimetype,
         ];
        return response()->download($filePath, $fileName, $headers);
    }
}