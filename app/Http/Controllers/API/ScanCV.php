<?php



namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
* Import the file parser class
*/
require_once "../vendor/autoload.php";
use Smalot\PdfParser\Parser;
use LukeMadhanga\DocumentParser;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ScanCV extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|mimes:txt,doc,docx,pdf,png,jpg,jpeg'
        ]);
        //$request = $request->only('job_id', 'cv_file');
        if($request->hasFile('cv_file')) {
            // $filenameWithExt = $request->file('cv_file')->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file('cv_file')->getClientOriginalExtension();
            // $fileNameToStore = time().uniqid().'_'.$filename.'.'.$extension;
            // $request->file('cv_file')->move('cv_uploads', $fileNameToStore);
            // $filePath = 'cv_uploads/'.$fileNameToStore;
            $text = "";
            $mime = $request->file('cv_file')->getClientMimeType();
            // Scan PDF file
            if($request->file('cv_file')->getClientMimeType() == 'application/pdf'){
                $parser = new Parser();
                $pdf = $parser->parseFile($request->file('cv_file'));
                $text = $pdf->getText();
                $text = str_replace("\t", "", $text);
                $text = str_replace("  ", " ", $text);
            } 
            // Scan TXT, DOC, DOCX file
            else if($mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            || $mime == 'application/msword' || $mime == 'text/plain') {
                $parser = new DocumentParser();
                $text = $parser->parseFromFile($request->file('cv_file'), $mime);
                $text = str_replace("<em>", "", $text);
                $text = str_replace("</em>", "", $text);
            }
            // Scan PNG, JPG, JPEG
            // Require: install Tesseract (https://github.com/UB-Mannheim/tesseract/wiki)
            else if($mime == 'image/png' || $mime == 'image/jpeg') {
                $ocr = new TesseractOCR();
                $ocr->image($request->file('cv_file'));
                $ocr->lang('eng');
                $ocr->executable('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tesseract.exe');
                //$ocr->tessdataDir('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tessdata');
                $text = $ocr->run(500);
            }
            $text = strtolower($text);
            //$contains = str_contains($text, 'C#');
            // $text = mb_convert_encoding($text, "UTF-8", "auto");
            return response($text);
        }  
    }
}