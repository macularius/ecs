<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.12.2018
 * Time: 13:38
 */

class order
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new FPDF('P', 'mm', 'A4');
    }


}