<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Import the file parser class
 */
use Smalot\PdfParser\Parser;
use LukeMadhanga\DocumentParser;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ScanCV extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'file_cv' => 'required|mimes:txt,doc,docx,pdf,png,jpg,jpeg'
        ]);
        // $request = $request->only('job_id', 'cv_file');
        if ($request->hasFile('file_cv')) {
            $filePath = $request->file('file_cv');
            $text = "";
            $mime = $request->file('file_cv')->getClientMimeType();
            // Scan PDF file
            if ($request->file('file_cv')->getClientMimeType() == 'application/pdf') {
                $parser = new Parser();
                $pdf = $parser->parseFile($filePath);
                $text = $pdf->getText();
                $text = str_replace("\t", "", $text);
                $text = str_replace("  ", " ", $text);
            }
            // Scan TXT, DOC, DOCX file
            else if (
                $mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                || $mime == 'application/msword' || $mime == 'text/plain'
            ) {
                $parser = new DocumentParser();
                $text = $parser->parseFromFile($filePath, $mime);
                $text = str_replace("<em>", "", $text);
                $text = str_replace("</em>", "", $text);
            }
            // Scan PNG, JPG, JPEG
            // Require: install Tesseract (https://github.com/UB-Mannheim/tesseract/wiki)
            else if ($mime == 'image/png' || $mime == 'image/jpeg') {
                $ocr = new TesseractOCR();
                $ocr->image($filePath);
                if ($request['lang'] == 'en') {
                    $ocr->lang('eng');
                } else if ($request['lang'] == 'vi') {
                    $ocr->lang('vie');
                } else $ocr->lang('vie', 'eng');
                // If the command 'tesseract' was not found (Postman error), define a custom path of the tesseract executable
                // $ocr->executable('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tesseract.exe');
                // $ocr->tessdataDir('C:\Users\Ngoc Thanh\AppData\Local\Programs\Tesseract-OCR\tessdata');
                $text = $ocr->run();
                $text = str_replace("\n", " ", $text);
            }
            $text = strtolower($text);
            // $text = mb_convert_encoding($text, "UTF-8", "auto");
            // return response($text);
            return response()->json([
                'success' => true,
                'data' => $text,
            ]);
        }
    }
}