<?php

namespace Database\Seeders;

use App\Helpers\Enums\OrderStatuses;
use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = collect(OrderStatuses::cases());
        $statuses->each(fn($status) => OrderStatus::firstOrCreate(['name' => $status->value]));
    }
}
