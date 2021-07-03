<?php

namespace App\PDF;

class HtmlGenerator
{
    public function ProductToHTML(array $product): string
    {
        $material     = $product['material'];
        $name         = $product['name'];
        $windowAmount = $product['windowAmount'];
        $size         = $product['size'];
        $isGarage     = $product['isGarage'] ? 'With Garage' : 'Without Garage';
        $floors       = $product['floors'];

        return $this->div(
                $this->p("Yaaay, You bought house."),
                $this->ul(
                        $this->li("Name: $name"),
                        $this->li("Material: $material"),
                        $this->li("Windows: $windowAmount"),
                        $this->li("Size: $size"),
                        $this->li("Floors: $floors"),
                        $this->li($isGarage)));
    }

    public function paymentToHTML(array $payment): string
    {
        $type   = $payment['type'];
        $tax    = $payment['tax'];
        $amount = $payment['amount'];
        $total  = $payment['tax'] + $payment['total'];

        return $this->div(
                $this->div(
                        $this->p("Payment for house."),
                        $this->ul(
                                $this->li("Payment Method: $type"),
                                $this->li("Tax: $tax"),
                                $this->li("Price without tax: $amount"),
                                $this->li($this->spanBold("Total: $total")))),
                $this->div($this->p($this->spanBold("Enjoy Your new Home!")))
        );
    }

    private function li($content)
    {
        return "<li>$content</li>";
    }

    private function spanBold($content)
    {
        return "<span style='font-weight: bold'>$content</span>";
    }

    private function ul()
    {
        $args = func_get_args();

        $html = '<ul>';
        foreach ($args as $value) {
            $html .= "<li>$value</li>";
        }

        $html .= '</ul>';

        return $html;
    }

    private function a($url, $content)
    {
        return "<a href='$url'>$content</a>";
    }

    private function p($content)
    {
        return "<p>$content</p>";
    }

    private function div()
    {
        $args = func_get_args();

        $html = '<div>';
        foreach ($args as $value) {
            $html .= "<li>$value</li>";
        }

        $html .= '</div>';

        return $html;
    }
}