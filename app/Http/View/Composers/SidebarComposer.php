<?php

namespace App\Http\View\Composers;

use App\Main\SidebarPanel;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $routePrefix = explode('/', $pageName)[0] ?? '';

            switch ($routePrefix) {
                case 'dashboards':
                    $view->with('sidebarMenu', SidebarPanel::dashboards());
                    break;
                case 'analytics':
                    $view->with('sidebarMenu', SidebarPanel::analytics());
                    break;
                case 'shipments':
                    $view->with('sidebarMenu', SidebarPanel::shipments());
                    break;
                case 'transport':
                    $view->with('sidebarMenu', SidebarPanel::transport());
                    break;
                case 'accounts':
                    $view->with('sidebarMenu', SidebarPanel::control());
                    break;
                case 'documents':
                    $view->with('sidebarMenu', SidebarPanel::documents());
                    break;
                case 'invoices':
                    $view->with('sidebarMenu', SidebarPanel::invoicing());
                    break;
                default:
                    $view->with('sidebarMenu', SidebarPanel::dashboards());
            }

            $view->with('allSidebarItems', SidebarPanel::all());
            $view->with('pageName', $pageName);
            $view->with('routePrefix', $routePrefix);
        }
    }
}
