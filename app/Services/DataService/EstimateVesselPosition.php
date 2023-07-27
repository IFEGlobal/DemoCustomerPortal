<?php

namespace App\Services\DataService;

class EstimateVesselPosition
{
    public ?array $polyline;

    public $arrival;

    public $departure;

    public function __construct($polyline, $arrival, $departure)
    {
        $this->polyline = $polyline;

        $this->arrival = $arrival;

        $this->departure = $departure;
    }

    public function AssessDays()
    {
        if(isset($this->polyline) && isset($this->arrival) && isset($this->departure)) {

            if($this->departure > now())
            {
                return $this->HasNotLeft();
            }

            if($this->arrival < now())
            {
                return $this->HasAlreadyArrived();
            }

            return $this->CalculatePosition();
        }

        return null;
    }

    public function HasNotLeft()
    {
        $position = $this->polyline[array_key_first($this->polyline)];

        return $this->ReturnPositionCoordinates($position);
    }

    public function HasAlreadyArrived()
    {
        $position = $this->polyline[array_key_last($this->polyline)];

        return $this->ReturnPositionCoordinates($position);
    }

    public function CalculatePosition()
    {
        $hours = $this->departure->diffInHours($this->arrival);

        $remaining = now()->diffInHours($this->arrival);

        $totalCoordinates = count($this->polyline);

        if($remaining > 0)
        {
            $coordinates = $this->polyline[round(($totalCoordinates/$hours)*($hours - $remaining))];
        }

        if(isset($coordinates))
        {
            return $this->ReturnPositionCoordinates($coordinates);
        }

        return null;
    }

    public function ReturnPositionCoordinates($position)
    {
        $coordinates[0] = $position["lat"] ?? null;
        $coordinates[1] = $position["lng"] ?? null;

        return $coordinates;
    }
}
