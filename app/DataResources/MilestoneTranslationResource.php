<?php

namespace App\DataResources;

use App\Models\Container;

class MilestoneTranslationResource
{
    public static function VesselLoadedArray()
    {
        return [
            'Vessel arrived at origin port',
            'Loaded on vessel at transshipment port',
            'Loaded on barge',
            'Loaded on feeder',
            'Loaded on vessel',
            'Loaded on vessel at origin port',
            'Loaded on vessel at transshipment port',
            'Loaded transshipment',
        ];
    }

    public static function VesselDepartingArray()
    {
        return [
            'Vessel departed',
            'Vessel departure from origin port',
            'Vessel departure from transshipment port',
            'Estimated vessel departure',
            'Feeder departed',
        ];

    }

    public static function VesselUnloadedArray()
    {
        return [
            'Discharged from vessel',
            'Discharged from barge',
            'Discharged from feeder',
            'Discharged from vessel',
            'Discharged from vessel at destination port',
            'Discharged from vessel at transshipment port',
            'Discharged transshipment',
            'Vessel unloading at destination port',
            'Vessel unloading at transshipment port',
        ];
    }

    public static function VesselArrivingArray()
    {
        return [
            'Estimated arrival at destination',
            'Estimated vessel arrival',
            'Vessel arrival at transshipment port',
            'Vessel arrived',
            'Feeder arrived',
            'Vessel arrived at destination port',
            'Vessel berthed at destination port',
            'Vessel berthed at transshipment port',
            'Vessel berthed in port',
        ];
    }

    public static function RailLoadedArray()
    {
        return [
            'Loaded on rail',
            'Loaded on rail at inbound rail origin',
            'Inbound Rail Departure',
            'Rail departed from inland origin',
            'Rail departed',
        ];
    }

    public static function RailUnloadedArray()
    {
       return [
           'Rail arrived',
           'Inbound Rail Arrival',
           'Discharged from rail',
           'Unloaded from rail at inbound rail destination',
       ];
    }

    public static function TruckLoadedArray()
    {
        return [
            'Loaded on truck',
            'Truck loaded',
            'Truck departed',
        ];
    }

    public static function TruckUnloadedArray()
    {
        return [
            'Truck departed',
            'Truck arrived',
        ];
    }

    public static function ContainerArrivedAtPort()
    {
        return [
                'Gate in',
                'Gate in at origin port'
            ];
    }

    public static function ContainerLeavingPort()
    {
        return[
            'Gate out',
            'Gate out at port of destination',
            'Gate out at transhipment port',
            'Gate out from origin port'
        ];
    }

    public static function MergeArrays()
    {
        return array_merge(self::VesselLoadedArray(), self::VesselUnloadedArray(),
            self::RailLoadedArray(), self::VesselUnloadedArray(),
            self::TruckLoadedArray(), self::TruckUnloadedArray(),
            self::ContainerArrivedAtPort(),self::ContainerLeavingPort(),
            self::VesselArrivingArray(),self::VesselDepartingArray());
    }

    public static function TranslateMilestones(Container $container,$milestones)
    {
        $array = $milestones['Milestones'] ?? null;

        if($array !== null) {
            foreach ($array as $key => $milestone) {
                if (in_array($milestone['EventDescription'], self::ContainerArrivedAtPort())) {
                    $array[$key]['EventStandardisation'] = 'Container Arrived At Port';
                }

                if (in_array($milestone['EventDescription'], self::ContainerLeavingPort())) {
                    $array[$key]['EventStandardisation'] = 'Control Transferred';
                }

                if (in_array($milestone['EventDescription'], self::VesselLoadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Vessel Loaded';
                }

                if (in_array($milestone['EventDescription'], self::VesselDepartingArray())) {
                    $array[$key]['EventStandardisation'] = 'Vessel Departed';
                }

                if (in_array($milestone['EventDescription'], self::VesselUnloadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Vessel Unloaded/Arrival';
                }

                if (in_array($milestone['EventDescription'], self::VesselArrivingArray())) {
                    $array[$key]['EventStandardisation'] = 'Vessel Arrived';
                }

                if (in_array($milestone['EventDescription'], self::RailLoadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Rail Loaded/Departure';
                }

                if (in_array($milestone['EventDescription'], self::RailUnloadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Rail Unloaded/Arrival';
                }

                if (in_array($milestone['EventDescription'], self::TruckLoadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Vehicle Loaded/Departure';
                }

                if (in_array($milestone['EventDescription'], self::TruckUnloadedArray())) {
                    $array[$key]['EventStandardisation'] = 'Vehicle Unloaded/Arrival';
                }

                if (!in_array($milestone['EventDescription'], self::MergeArrays())) {
                    $array[$key]['EventStandardisation'] = 'Container Information Event';
                }
            }

            return $array;
        }

        if($container->shipment->estimated_arrival > now()->subDays(10))
        {
            return self::RequestMilestones($container);
        }

        return null;
    }

    public static function RequestMilestones(Container $container)
    {
        $milestones = MilestonesResource::GetMilestones($container);

        if(is_array($milestones) && isset($milestones['Milestones']))
        {
            $container->update(['milestones' => $milestones]);

            return self::TranslateMilestones($container,$milestones);
        }

        return [];
    }
}
