<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $domPdf;
    
    public function __construct()
    {
        $this->domPdf = new DomPdf();
        
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->setIsRemoteEnabled(true);
        
        $this->domPdf->setOptions($options);
    }
    
    public function generatePdf($html, $filename = 'document.pdf', $stream = true)
    {
        $this->domPdf->loadHtml($html);
        $this->domPdf->setPaper('A4', 'portrait');
        $this->domPdf->render();
        
        if ($stream) {
            $this->domPdf->stream($filename, [
                'Attachment' => false
            ]);
        } else {
            return $this->domPdf->output();
        }
    }
}