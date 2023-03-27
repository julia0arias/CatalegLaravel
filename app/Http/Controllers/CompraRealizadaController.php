<?php

namespace App\Http\Controllers;

use TCPDF;

class CompraRealizadaController extends Controller
{

    public function show()
    {
        // Inicializar una sesión temporal de los datos de la factura
        $datosFactura = session('datosFactura', ['carrito' => [], 'subtotalCompra' => 0, 'ivaCompra' => 0, 'totalCompra' => 0]);

        // Copiar los datos de la sesión 'factura' a la sesión temporal
        if (!empty(session('factura'))) {
            $datosFactura['carrito'] = session('factura')['carrito'];
            $datosFactura['subtotalCompra'] = session('factura')['subtotalCompra'];
            $datosFactura['ivaCompra'] = session('factura')['ivaCompra'];
            $datosFactura['totalCompra'] = session('factura')['totalCompra'];
            session()->forget('factura');
        }

        $carrito = $datosFactura['carrito'];
        $subtotalCompra = 0;
        $ivaCompra = 0;
        $totalCompra = 0;

        foreach ($carrito as $producto) {
            $subtotalCompra += number_format($producto['precio'] * $producto['cantidad'], 2, '.', '');
        }

        $ivaCompra = number_format($subtotalCompra * 0.21, 2, '.', '');
        $totalCompra = number_format($subtotalCompra + $ivaCompra, 2, '.', '');

        $datosFactura['subtotalCompra'] = $subtotalCompra;
        $datosFactura['ivaCompra'] = $ivaCompra;
        $datosFactura['totalCompra'] = $totalCompra;
        session(['datosFactura' => $datosFactura]);

        $this->borrarSesion();

        // Creo esta sesión temporal para poder imprimir la factura
        session(['carrito' => $carrito]);
        session(['subtotalCompra' => $subtotalCompra]);
        session(['ivaCompra' => $ivaCompra]);
        session(['totalCompra' => $totalCompra]);

        return view('/compraRealizada', compact('carrito', 'subtotalCompra', 'ivaCompra', 'totalCompra'));
    }

    public function imprimirFactura()
    {
        $carrito = session('carrito', []);
        $subtotalCompra = session('subtotalCompra', 0);
        $ivaCompra = session('ivaCompra', 0);
        $totalCompra = session('totalCompra', 0);

        $html = view('factura', compact('carrito', 'subtotalCompra', 'ivaCompra', 'totalCompra'))->render();

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
        session()->forget('subtotalCompra');
        session()->forget('ivaCompra');
        session()->forget('totalCompra');
        session()->forget('datosFactura');
        session(['cart' => []]);
        session(['totalProductos' => 0]);
    }
}
