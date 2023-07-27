<?php

namespace App\DataResources;

use App\Models\Container;

class FindCurrentVesselResource
{
    public static function FindCurrentVessel(Container $container)
    {
        if($container->milestones == null) {
            $milestones = MilestonesResource::GetMilestones($container);
        }else{
            $milestones = $container->milestones;
        }

        return self::LoopThroughMilestones($milestones, $container);
    }

    public static function LoopThroughMilestones($milestones, Container $container)
    {
        if(is_string($milestones))
        {
            $decode = json_decode($milestones, true);
        } else {
            $decode = $milestones;
        }

        if(isset($decode) && $decode !== null){
            foreach($decode['Milestones'] as $key => $milestone)
            {
                if($milestone['IsEstimate'] === false && $milestone['Vessel'] !== null && $milestone['DataSource'] != 'ais' && $milestone['EventDateTime'] < now())
                {
                    $validMilestones[] = $milestone;
                }
            }

            if(isset($validMilestones))
            {
                return $validMilestones[array_key_last($validMilestones)]['Vessel'] ?? $container->shipment->vessel;
            }

            return $container->shipment->vessel;
        }

        return null;
    }
}
