<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use TCPDF;

class CompraRealizadaController extends Controller
{

    public function show(){
        $datosFactura = session('datosFactura');
        $carrito = $datosFactura['carrito'];
        $totalCompra = $datosFactura['totalCompra'];

        return view('/compraRealizada', compact('carrito', 'totalCompra'));
    }
    public function imprimirFactura()
    {
        $datosFactura = session('datosFactura');
        $carrito = $datosFactura['carrito'];
        $totalCompra = $datosFactura['totalCompra'];

        $html = view('factura', compact('carrito', 'totalCompra'))->render();

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($html);

        $pdfContent = $pdf->Output('', 'S');

        session()->forget('datosFactura');
        session(['cart' => []]);
        session(['totalProductos' => 0]);

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="factura.pdf"'
        ]);
    }
}

?>
