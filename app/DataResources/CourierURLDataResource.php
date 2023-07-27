<?php

namespace App\DataResources;

class CourierURLDataResource
{
    public static function findCourier($courier,$tracking)
    {
        if($courier == "RLM"){ return self::RoyalMail($tracking); }
        if($courier == "UPS"){ return self::UPS($tracking); }
        if($courier == "PCF"){ return self::ParcelForce($tracking); }
        if($courier == "FDX"){ return self::FDX($tracking); }
        if($courier == "DHL"){ return self::DHL($tracking); }
        if($courier == "TNT"){ return self::TNT($tracking); }
        if($courier == "DPD"){ return self::DPD($tracking); }

        return null;
    }

    public static function RoyalMail($tracking): ?string
    {
        return "http://www.royalmail.com/portal/rm/track?trackNumber=".$tracking;
    }

    public static function ParcelForce($tracking): ?string
    {
        return null;
    }

    public static function FDX($tracking): ?string
    {
        return "https://www.fedex.com/fedextrack/?trknbr=".$tracking;
    }

    public static function DHL($tracking): ?string
    {
        return "https://www.dhl.com/gb-en/home/tracking/tracking-express.html?submit=1&tracking-id=".$tracking;
    }

    public static function UPS($tracking): ?string
    {
        return "https://wwwapps.ups.com/tracking/tracking.cgi?tracknum=".$tracking;
    }

    public static function TNT($tracking): ?string
    {
        return "https://www.tnt.com/express/en_gb/site/shipping-tools/tracking.html?searchType=con&cons=".$tracking;
    }

    public static function DPD($tracking): ?string
    {
        return null;
    }

}
