<?php

namespace App\Services\WidgetService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContainerCarrierPie
{
    public function PieChartData()
    {
        $data = $this->GetQuery();

        $chart = $data->mapWithKeys(function ($return) {
            return [$return->carrier => $return->total];
        });

        return $chart ?? null;
    }

    public function PieChartLabels()
    {
        $data = $this->GetQuery();

        $labels = $data->map(function ($return) {
            return  $return->carrier;
        });

        return $labels ?? null;
    }

    public function GetQuery()
    {
        $query = DB::table('containers')
            ->join('shipments', 'shipment_id', '=', 'shipments.id')
            ->select('shipments.carrier', DB::raw('count(*) as total'))
            ->whereIn('consignee_code', Auth::user()->access->pluck('client_code')->toArray())
            ->orWhereIn('consignor_code', Auth::user()->access->pluck('client_code')->toArray())
            ->groupBy('shipments.carrier')
            ->get();

        return $query;
    }
}
