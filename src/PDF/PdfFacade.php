<?php

namespace App\PDF;

class PdfFacade
{
    protected $pdf;
    protected $html;

    public function __construct()
    {
        $this->pdf  = new PdfGenerator();
        $this->html = new HtmlGenerator();
    }

    public function downloadPdf($data)
    {
        $this->pdf->preparePdfBase();
        $html = $this->html->ProductsToHtml();
        $this->pdf->prepareHtml($html);
        $this->pdf->download();
    }
}