<?php

namespace App\PDF;

class HtmlGenerator
{
    public function ProductToHTML(array $product): string
    {
        return $this->div(
                $this->ul(
                    $this->li('asd'),
                    $this->li('asdas'),
                    $this->li('asdasda'),
                    $this->li($this->a('http://google.com','content'))));
    }

    public function paymentToHTML(array $payment): string
    {
        return 'html';
    }

    private function li($content)
    {
        return "<li>$content</li>";
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