<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Http\Request;

class DownloadInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Order $order, InvoicesServiceContract $invoicesService)
    {
        return $invoicesService->generate($order)->download();
    }
}
