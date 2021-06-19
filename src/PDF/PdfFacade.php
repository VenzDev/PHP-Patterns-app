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

    public function downloadPdf($product, $payment)
    {
        $this->pdf->preparePdfBase();
        $htmlProduct = $this->html->productToHTML($product);
        $htmlPayment = $this->html->paymentToHTML($payment);
        $this->pdf->prepareProduct($htmlProduct);
        $this->pdf->preparePayment($htmlPayment);
        $this->pdf->download();
    }
}