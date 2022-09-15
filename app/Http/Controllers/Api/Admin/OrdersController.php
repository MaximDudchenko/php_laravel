<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if (isAdmin($request->user())) {
            return response()->json(OrderResource::collection(Order::all()));
        } else {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'User not admin'
                ]]);
        }
    }
}
