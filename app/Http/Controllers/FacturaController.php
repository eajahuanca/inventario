<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use compusystem\Libraries\ControlCode;
use compusystem\Facades;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FacturaController extends Controller
{
     public function minimizeDate($value)
    {
            $array = explode("/", $value);
            return $array[2].$array[1].$array[0];
    }


    public function codigo() 
    {
        
    $codigo = new ControlCode();
 
	$authorizationNumber = '7904006306693';    //Nro Autorizacion
    $invoiceNumber = '876814'; //Nro Factura
    $nitci = '1665979';  // nit ci
    $dateOfTransaction = '19/05/2008'; // fecha
    $transactionAmount = '35958,60';  //monto
    $dosageKey = 'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS'; //llave


    $code['codigo'] = $codigo->generatee($authorizationNumber,
                                    $invoiceNumber,
                                    $nitci,
                                    $this->minimizeDate($dateOfTransaction),
                                    $transactionAmount,
                                    $dosageKey);

    echo $code['codigo'];
   
    /* Contenido del Codigo QR */
    $contentQR= $nitci.'|'. //Numero de Identificacion Tributaria o Carnet de Identidad
                $invoiceNumber.'|'.//Numero de Factura
                $authorizationNumber.'|'.//Numero de autorizacion
                $dateOfTransaction.'|'.//fecha de transaccion de la forma DD/MM/AA
                str_replace('', '', $transactionAmount).'|'.//Monto de la transaccion 
                '0'.'|'.//Importe base para el Credito Fiscal
                $code['codigo'].'|'.//Codigo de control
                '0'.'|'.//NIT/CI/CEX Comprador (Numero de Identificacion Tributaria o Documento de Identidad)
                '0'.'|'.//Importe ICE/ IEHD/ tasas
                '0'.'|'.//Importe por ventas no Gravadas o Gravadas a Tasa Cero
                '0'.'|'.//Importe no Sujeto a Credito Fiscal
                '0';//Descuentos, Bonificaciones y Rebajas Obtenidas

    QrCode::format('png');

    QrCode::size(200);

    QrCode::errorCorrection('Q');

    echo QrCode::generate($contentQR, '../public/imagenes/qrcodes/qrcode.png');




    }
}


