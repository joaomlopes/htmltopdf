<?php

namespace joaomlopes\HtmlToPDFBundle\Entity;

use \TCPDF;

class JLHTMLToPDF
{
//    protected $className;
    protected $tcpdf;

    /**
     * Class constructor
     *
     * @param string $className The class name to use. Default is TCPDF. Must be based on TCPDF
     */
    public function __construct($tcpdf)
    {
//        $this->className = $className;
        $this->tcpdf = $tcpdf;
    }

    /**
     * @param $html
     * @param $output
     * @param array $options
     */
    public function generateFromHTML($html, $output, $options = [])
    {

        if(!$this->tcpdf) {
            return;
        }

        $config = $this->tcpdf;


//         create new PDF document
        $pdf = new TCPDF($config['pdf_page_orientation'], $config['pdf_unit'], $config['pdf_page_format'], true, 'UTF-8', false);

//         set document information
        $pdf->SetCreator($config['pdf_creator']);
        $pdf->SetAuthor($config['pdf_author']);
        $pdf->SetTitle($config['pdf_title']);
        $pdf->SetSubject($config['pdf_subject']);
        $pdf->SetKeywords($config['pdf_keywords']);

        // set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,
//          PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255),
//          array(0, 64, 128));
//        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
//
//         set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//         set default monospaced font
        $pdf->SetDefaultMonospacedFont($config['pdf_font_monospaced']);

//         set margins
        $pdf->SetMargins($config['pdf_margin_left'], $config['pdf_margin_top'], $config['pdf_margin_right']);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, $config['pdf_margin_bottom']);

        // set image scale factor
        $pdf->setImageScale($config['pdf_image_scale_ratio']);

        // set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }

        // ---------------------------------------------------------

        // set default font subsetting mode
//        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont($config['pdf_font_name_main'], '', $config['pdf_font_size_main'], '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
//        $pdf->setTextShadow(array(
//          'enabled' => true,
//          'depth_w' => 0.2,
//          'depth_h' => 0.2,
//          'color' => array(196, 196, 196),
//          'opacity' => 1,
//          'blend_mode' => 'Normal'
//        ));

        // Set some content to print


        // Print text using writeHTMLCell()
        $pdf->writeHTML($html, true, false, true, false, '');

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output($output, 'I');

    }
}
