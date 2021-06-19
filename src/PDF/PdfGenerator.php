<?php

namespace App\PDF;

use TCPDF;

class PdfGenerator
{
    private $pdf;

    public function preparePdfBase()
    {
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('kamil Bechta');
        $this->pdf->SetTitle('Invoice');
        $this->pdf->SetSubject('Invoice');

        $this->pdf->SetFont('times', 'BI', 20);
        $this->pdf->AddPage();

        $txt = <<<EOD
Invoice

Invoice for bought product
EOD;

        $this->pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
    }

    public function prepareProduct(string $html)
    {
        $this->pdf->SetFont('dejavusans', '', 10);
        $this->pdf->writeHTML($html, true, false, true, false, '');
    }

    public function preparePayment(string $html)
    {
        $this->pdf->SetFont('dejavusans', '', 10);
        $this->pdf->writeHTML($html, true, false, true, false, '');
    }

    public function download()
    {
        $this->pdf->Output('invoice.pdf', 'D');
    }
}