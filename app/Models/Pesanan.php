<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 't_pesanan';
    protected $fillable = ['no_pesanan', 'tanggal', 'nm_supplier', 'nm_produk', 'total'];
    public $timestamps = false;

    public static function getOrderNumber()
    {
        $year = date('Y');
        $month = date('m');
        $lastOrder = DB::table('t_pesanan')
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderByDesc('tanggal')->first();

        if ($lastOrder) {
            $lastOrderNumber = intval(substr($lastOrder->no_pesanan, -3));
            $orderNumber = $lastOrderNumber + 1;
        } else {
            $orderNumber = 1;
        }

        return sprintf("%04d-%02d-%03d", $year, $month, $orderNumber);
    }
}
