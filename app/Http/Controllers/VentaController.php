<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use compusystem\Http\Requests\VentaFormRequest;
use compusystem\Venta;
use compusystem\DetalleVenta;
use DB;
use Fpdf;

use compusystem\Libraries\ControlCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
           $query=trim($request->get('searchText'));
           $ventas=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('sucursal as s','v.idsucursal','=','s.idsucursal')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','s.sucursal','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.num_comprobante','LIKE','%'.$query.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
            ->paginate(7);
            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);

        }
    }



    public function create()
    {
        $ventas =DB::table('venta')->where('estado','=','A')->get();
    	$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
        $sucursal=DB::table('sucursal')->where('estado','=','Activo')->get();
    	$articulos = DB::table('articulo as art')
    		->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','art.stock', 'art.stock_minimo' ,DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('articulo','art.idarticulo','art.stock')
            ->get();
        return view("ventas.venta.create",["personas"=>$personas,"sucursal"=>$sucursal,"articulos"=>$articulos, "ventas"=>$ventas]);
    }

     public function store (VentaFormRequest $request)
    {
//    	try{
  //      	DB::beginTransaction();
        	$venta=new Venta;
	        $venta->idcliente=$request->get('idcliente');
            $venta->idsucursal=$request->get('idsucursal');

	        $venta->tipo_comprobante=$request->get('tipo_comprobante');
	        $venta->serie_comprobante=$request->get('serie_comprobante');
	        $venta->num_comprobante=$request->get('num_comprobante');
	        $venta->total_venta=$request->get('total_venta');

	        $mytime = Carbon::now('America/La_Paz');
	        $venta->fecha_hora=$mytime->toDateTimeString();
	       

        
            $newDate = date("d/m/Y", strtotime($venta->fecha_hora));


            $codigo = new ControlCode();
         
            $authorizationNumber = '7904006306693';    //Nro Autorizacion
            $invoiceNumber = $venta->num_comprobante; //Nro Factura
            $nitci = '4785644018';  // nit ci
            $dateOfTransaction = $newDate; // fecha
            $transactionAmount =  $venta->total_venta;  //monto
            $dosageKey = 'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS'; //llave


            $code  = $codigo->generatee($authorizationNumber,
                                            $invoiceNumber,
                                            $nitci,
                                            $this->minimizeDate($dateOfTransaction),
                                            $transactionAmount,
                                            $dosageKey);


            $venta->codigo_control= $code;


            $contentQR= $nitci.'|'. //Numero de Identificacion Tributaria o Carnet de Identidad
                $invoiceNumber.'|'.//Numero de Factura
                $authorizationNumber.'|'.//Numero de autorizacion
                $dateOfTransaction.'|'.//fecha de transaccion de la forma DD/MM/AA
                str_replace('', '', $transactionAmount).'|'.//Monto de la transaccion 
                '0'.'|'.//Importe base para el Credito Fiscal
                $code.'|'.//Codigo de control
                '0'.'|'.//NIT/CI/CEX Comprador (Numero de Identificacion Tributaria o Documento de Identidad)
                '0'.'|'.//Importe ICE/ IEHD/ tasas
                '0'.'|'.//Importe por ventas no Gravadas o Gravadas a Tasa Cero
                '0'.'|'.//Importe no Sujeto a Credito Fiscal
                '0';//Descuentos, Bonificaciones y Rebajas Obtenidas

            QrCode::format('png');

            QrCode::size(200);

            QrCode::errorCorrection('Q');

            $nombre_qr = 'qrcode'.rand();

            QrCode::generate($contentQR, '../public/imagenes/qrcodes/'.$nombre_qr.'.png');



            $venta->qr= $nombre_qr;


            if ($request->get('impuesto')=='1')
            {
                $venta->impuesto='13';
            }
            else
            {
                $venta->impuesto='0';
            } 
	        $venta->estado='A';
	        $venta->save();

	        $idarticulo = $request->get('idarticulo');
	        $cantidad = $request->get('cantidad');
	        $descuento = $request->get('descuento');
	        $precio_venta = $request->get('precio_venta');

	        $cont = 0;

	        while($cont < count($idarticulo)){
	            $detalle = new DetalleVenta();
	            $detalle->idventa= $venta->idventa; 
	            $detalle->idarticulo= $idarticulo[$cont];
	            $detalle->cantidad= $cantidad[$cont];
	            $detalle->descuento= $descuento[$cont];
	            $detalle->precio_venta= $precio_venta[$cont];
	            $detalle->save();
	            $cont=$cont+1;            
	        }



   




        	DB::commit();



   //     }catch(\Exception $e)
     //   {
        //  	DB::rollback();
      //  }

        return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
    	$venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();
        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }

    public function destroy($id)
    {
    	$venta=Venta::findOrFail($id);
        $venta->Estado='C';
        $venta->update();
        return Redirect::to('ventas/venta');
    }

     public function minimizeDate($value)
    {
            $array = explode("/", $value);
            return $array[2].$array[1].$array[0];
    }

 public function codigo($value) 
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

    echo $code;
   
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


    return $code;

    }


    public function reportec($id){
         //Obtengo los datos



        
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->join('sucursal as s', 'v.idsucursal','=','s.idsucursal')
            ->join('empresa as e', 'e.idempresa','=','s.idempresa')
            ->join('dosificacion as d','d.iddosificacion','=','e.iddosificacion')
            ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','e.nit','e.actividad_economica','s.departamento','d.nro_autorizacion','d.fecha_limite_emision','p.num_documento','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta', 'v.codigo_control', 'v.qr')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();






        $pdf = new Fpdf();
        //Primera página
        $pdf::AddPage();


        //IMAGEN
        $pdf::SetXY(20,20);
        $pdf::Image('../public/imagenes/empresa/CompuSistem.png',10,8,80);


        //$pdf::Image($venta->imagen , 80 ,22, 35 , 38,'JPG');
        //DERECHA

        $pdf::SetFont('Arial','B',9);
        $pdf::SetXY(160,20);
        $pdf::Cell(0,0,utf8_decode('NIT:'));
        $pdf::SetXY(170,20);
        $pdf::Cell(0,0,utf8_decode($venta->nit));

        $pdf::SetXY(145,23);
        $pdf::Cell(0,0,utf8_decode('FACTURA Nº:'));
        $pdf::SetXY(170,23);
        $pdf::Cell(0,0,utf8_decode($venta->num_comprobante));

        $pdf::SetXY(136,26);
        $pdf::Cell(0,0,utf8_decode('AUTORIZACION Nº:'));
        $pdf::SetXY(170,26);
        $pdf::Cell(0,0,utf8_decode($venta->nro_autorizacion));

        $pdf::SetXY(155,35);
        $pdf::Cell(0,0,utf8_decode('ORIGINAL'));

        $pdf::SetXY(128,40);
        $pdf::Cell(0,0,utf8_decode('Actividad Economica:'));

        $pdf::SetXY(163,40);
        $pdf::Cell(0,0,utf8_decode($venta->actividad_economica));

        //IZQUIERDA

        $pdf::SetXY(20,60);
        $pdf::Cell(0,0,utf8_decode('Lugar y fecha:'));
   
        $pdf::SetXY(45,60);
        $pdf::Cell(0,0,utf8_decode($venta->departamento));

        $pdf::SetXY(60,60);
        $pdf::Cell(0,0,substr($venta->fecha_hora,0,10));

        $pdf::SetXY(20,65);
        $pdf::Cell(0,0,utf8_decode('Señor(a):'));
        $pdf::SetXY(37,65);
        $pdf::Cell(0,0,utf8_decode($venta->nombre));
        //Inicio con el reporte
        $pdf::SetFont('Arial','B',20);

        $pdf::SetXY(95,50);
        $pdf::Cell(0,0,utf8_decode($venta->tipo_comprobante));

        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
       
        $pdf::SetFont('Arial','B',10);


        //***Parte de la derecha
        $pdf::SetXY(160,65);
        $pdf::Cell(0,0,utf8_decode('NIT/CI:'));
        $pdf::SetXY(172,65);
        $pdf::Cell(0,0,utf8_decode($venta->num_documento));

        

        $pdf::SetXY(20,83);
        $pdf::Cell(0,0,utf8_decode('CANTIDAD'));
        $pdf::SetXY(65,83);
        $pdf::Cell(0,0,utf8_decode('CONCEPTO'));
        $pdf::SetXY(130,83);
        $pdf::Cell(0,0,utf8_decode('P. UNIDAD'));
        $pdf::SetXY(168,83);
        $pdf::Cell(0,0,utf8_decode('SUB TOTAL'));



        $total=0;

        //Mostramos los detalles
        $y=89;
        foreach($detalles as $det){
            $pdf::SetXY(30,$y);
            $pdf::MultiCell(10,0,$det->cantidad);

            $pdf::SetXY(50,$y);
            $pdf::MultiCell(120,0,utf8_decode($det->articulo));

            $pdf::SetXY(135,$y);
            $pdf::MultiCell(25,0,$det->precio_venta-$det->descuento);

            $pdf::SetXY(171,$y);
            $pdf::MultiCell(25,0,sprintf("%0.2F",(($det->precio_venta-$det->descuento)*$det->cantidad)));

            $total=$total+($det->precio_venta*$det->cantidad);
            $y=$y+7;
        }
        $pdf::SetXY(130,105);
        $pdf::Cell(0,0,utf8_decode('Total:                    Bs.-'));
        $pdf::SetXY(170,105);
        $pdf::MultiCell(15,0,sprintf("%0.2F", $venta->total_venta-($venta->total_venta*$venta->impuesto/($venta->impuesto+100))));
        $pdf::SetXY(130,110);
        $pdf::Cell(0,0,utf8_decode('Total impuesto:   Bs.-'));
        $pdf::SetXY(170,110); 
        $pdf::MultiCell(15,0,sprintf("%0.2F", ($venta->total_venta*$venta->impuesto/($venta->impuesto+100))));
        $pdf::SetXY(130,115);
        $pdf::Cell(0,0,utf8_decode('Total pagar:         Bs.-'));
        $pdf::SetXY(170,115);
        $pdf::MultiCell(15,0,sprintf("%0.2F", $venta->total_venta));
        
        $pdf::SetXY(132,130);
        $pdf::Cell(0,0,utf8_decode('Fecha limite emision:'));
        $pdf::SetXY(170,130);
        $pdf::Cell(0,0,substr($venta->fecha_limite_emision,0,10));
        
        $pdf::SetXY(20,130);
        $pdf::Cell(0,0,utf8_decode('Código de control:'));
        $pdf::SetXY(55,130);
        $pdf::Cell(0,0,utf8_decode($venta->codigo_control));

        $pdf::SetFont('Arial','B',7);
        $pdf::SetXY(25,135);
        $pdf::Cell(0,0,utf8_decode('"ESTA FACTURA CONTRIBUYE AL DESARROLLO DE PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LEY"'));

        $pdf::Image('../public/imagenes/qrcodes/'.$venta->qr.'.png',165,138,25);



        $pdf::Output();
        exit;



    }
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
            ->get();

         //Ponemos la hoja Horizontal (L)
         $pdf = new Fpdf('L','mm','A4');
         $pdf::AddPage();


        $pdf::Image('../public/imagenes/empresa/CompuSistem.png',10,8,50);




         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Ventas"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(35,8,utf8_decode("Fecha"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Cliente"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Comprobante"),1,"","L",true);
         $pdf::cell(10,8,utf8_decode("Imp"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","R",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(35,8,utf8_decode($reg->fecha_hora),1,"","L",true);
            $pdf::cell(80,8,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(45,8,utf8_decode($reg->tipo_comprobante.': '.$reg->serie_comprobante.'-'.$reg->num_comprobante),1,"","L",true);
            $pdf::cell(10,8,utf8_decode($reg->impuesto),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->total_venta),1,"","R",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
}
