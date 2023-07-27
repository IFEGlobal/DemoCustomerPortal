<?php

namespace App\Main;


class SidebarPanel
{
    public static function analytics()
    {
        return [
            'title' => 'Analytics',
            'items' => [
                [
                    'shipment_analytics' => [
                        'title' => 'Shipment Analytics',
                        'route_name' => 'analytics'
                    ],
                ],
            ],
        ];
    }

    public static function dashboards()
    {
        return [
            'title' => 'Dashboards',
            'items' => [
                [
                    'live_dashboard' => [
                        'title' => 'Live Dashboard',
                        'route_name' => 'dashboard'
                    ],
                    'calendar_dashboard' => [
                        'title' => 'Calendar Dashboard',
                        'route_name' => 'calendar'
                    ],
                    'favorites_dashboard' => [
                        'title' => 'Favorites Dashboard',
                        'route_name' => 'favorites'
                    ],
                    'priorities_dashboard' => [
                        'title' => 'Priorities Dashboard',
                        'route_name' => 'priorities'
                    ],
                ],
            ],
        ];
    }

    public static function shipments()
    {
        return [
            'title' => 'Shipments',
            'items' => [
                [
                    'shipments' => [
                        'title' => 'My Shipments',
                        'route_name' => 'shipments'
                    ],
                    'containers' => [
                        'title' => 'My Containers',
                        'route_name' => 'containers'
                    ],
                ],
            ],
        ];
    }

    public static function transport()
    {
        return [
            'title' => 'Transport & Deliveries',
            'items' => [
                [
                    'container_deliveries' => [
                        'title' => 'My Deliveries',
                        'route_name' => 'deliveries'
                    ],
                ],
            ],
        ];
    }

    public static function control()
    {
        return [
            'title' => 'Control Center',
            'items' => [
                [
                    'user_accounts' => [
                        'title' => 'User Accounts',
                        'route_name' => 'accounts'
                    ],
                    'organisation' => [
                        'title' => 'Organisation',
                        'route_name' => 'organisations'
                    ],
                ],
            ],
        ];
    }

    public static function documents()
    {
        return [
            'title' => 'Documents',
            'items' => [
                [
                    'documents' => [
                        'title' => 'My Documents',
                        'route_name' => 'documents'
                    ],
                ],
            ],
        ];
    }

    public static function invoicing()
    {
        return [
            'title' => 'Invoicing',
            'items' => [
                [
                    'invoices' => [
                        'title' => 'My Invoices',
                        'route_name' => 'invoices'
                    ],
                ],
            ],
        ];
    }

    public static function all(){
        return [self::dashboards(),self::analytics(), self::shipments(), self::transport(), self::control(), self::documents(), self::invoicing()];
    }
}
