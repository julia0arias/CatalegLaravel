<?php

namespace App\Http\Controllers;

use TCPDF;

class CompraRealizadaController extends Controller
{

    public function show()
    {
        // Inicializar una sesión temporal de los datos de la factura
        $datosFactura = session('datosFactura', ['carrito' => [], 'totalCompra' => 0]);

        // Copiar los datos de la sesión 'factura' a la sesión temporal
        if (!empty(session('factura'))) {
            $datosFactura['carrito'] = session('factura')['carrito'];
            $datosFactura['totalCompra'] = session('factura')['totalCompra'];
            session()->forget('factura');
        }

        $carrito = $datosFactura['carrito'];
        $totalCompra = 0;

        foreach ($carrito as $producto) {
            $totalCompra += $producto['precio'] * $producto['cantidad'];
        }

        $datosFactura['totalCompra'] = $totalCompra;
        session(['datosFactura' => $datosFactura]);

        $this->borrarSesion();

        // Creo esta sesión temporal para poder imprimir la factura
        session(['carrito' => $carrito]);
        session(['totalCompra' => $totalCompra]);

        return view('/compraRealizada', compact('carrito', 'totalCompra'));
    }

    public function imprimirFactura()
    {
        $carrito = session('carrito', []);
        $totalCompra = session('totalCompra', 0);

        $html = view('factura', compact('carrito', 'totalCompra'))->render();

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->writeHTML($html);

        $pdfContent = $pdf->Output('', 'S');

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="factura.pdf"'
        ]);
    }

    public function borrarSesion()
    {
        session()->forget('datosFactura');
        session(['cart' => []]);
        session(['totalProductos' => 0]);
    }
}
