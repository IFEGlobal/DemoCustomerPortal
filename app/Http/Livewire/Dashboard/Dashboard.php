<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\JobInvoicing;
use App\Services\AnalyticsService\ShipmentAnalytics\ShipmentGraph;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Dashboard extends Component
{
    use WireToast;

    protected $listeners = ['switch', 'logout'];

    public function switch()
    {
        Config::set("database.connections.Database", [
            'driver' => 'Database',
            'url' => env('DATABASE_URL_MAIN'),
            'host' => env('DB_HOST_MAIN', '127.0.0.1'),
            'port' => env('DB_PORT_MAIN', '3306'),
            'database' => 'IFEGlobalLogisticsUKLtd',
            'username' => env('DB_USERNAME_MAIN', 'forge'),
            'password' => env('DB_PASSWORD_MAIN', ''),
        ]);
    }

    public function logout()
    {
        dd('user wants to logout');
    }

    public function goToCalendar()
    {
        return redirect()->to('/calendar');
    }

    public function goToFavorites()
    {
        return redirect()->to('/space/favorites');
    }

    public function goToPriorities()
    {
        return redirect()->to('/space/priorities');
    }

    public function goToShipments()
    {
        return redirect()->to('/shipments/shipments');
    }

    public function goToContainers()
    {
        return redirect()->to('/shipments/containers');
    }

    public function render()
    {
        $shipments = new ShipmentGraph();

        $stats = $shipments->CompileStats();

        $forwarders = Auth::user()->access()->orderBy('schema')->get()->pluck('schema')->toArray();

        $currentForwarder = Config::get('database.connections.onthefly.database');

        return view('livewire.dashboard.dashboard', [
            'stats' => $stats,
            'forwarders' => $forwarders,
            'currentForwarder' => $currentForwarder
        ]);
    }
}
