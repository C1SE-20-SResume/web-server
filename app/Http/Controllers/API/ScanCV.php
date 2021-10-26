<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * Import the PDF Parser class
 */
use Smalot\PdfParser\Parser;

class ScanCV extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file('file');
        $file->move('uploads', $file->getClientOriginalName());
        $pdfFilePath  = 'uploads/'.$file->getClientOriginalName();
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFilePath);
        $pages  = $pdf->getPages();
         $totalPages = count($pages);
          $currentPage = 1;
          $text = "";
            foreach ($pages as $page) {
                $text .= "<h3>Page $currentPage/$totalPages</h3> </br>";
                $text .= $page->getText();
                $currentPage++;
            }
        // $text = str_replace("\n", "</br>", $text);
        // $text = str_replace("\r", "</br>", $text);
        $text = str_replace("\t", "", $text);
        $text = str_replace("  ", "", $text);
        return response()->json(['data' => $text]);
    }
}