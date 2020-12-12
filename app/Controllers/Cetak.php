<?php

namespace App\Controllers;

use Mpdf\Mpdf;

class Cetak extends BaseController
{
    public function index()
    {
        require_once './vendor/autoload.php';
        // Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf();

        // Write some HTML code:
        $mpdf->WriteHTML('Hello World');
        ob_get_clean();
        // Output a PDF file directly to the browser
        $mpdf->Output();
    }
}
