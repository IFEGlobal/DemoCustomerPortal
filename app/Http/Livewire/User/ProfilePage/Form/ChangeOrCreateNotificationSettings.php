<?php

namespace App\Http\Livewire\User\ProfilePage\Form;

use App\DataResources\NotificationSettingsResource;
use App\Models\UserNotificationSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ChangeOrCreateNotificationSettings extends Component
{
    use WireToast;

    public $EmailNewShipments;
    public $EmailNewContainers;
    public $EmailShipmentUpdates;
    public $EmailShipmentArrivalNotices;
    public $EmailNewDeliveries;
    public $EmailDeliveryUpdates;
    public $EmailDeliveryArrivalNotices;
    public $EmailNewDocuments;
    public $EmailNewInvoices;
    public $EmailPaymentNotices;

    public $PushNewShipments;
    public $PushNewContainers;
    public $PushShipmentUpdates;
    public $PushShipmentArrivalNotices;
    public $PushNewDeliveries;
    public $PushDeliveryUpdates;
    public $PushDeliveryArrivalNotices;
    public $PushNewDocuments;
    public $PushNewInvoices;
    public $PushPaymentNotices;


    public function mount()
    {
        $settings = UserNotificationSetting::where('user_id', Auth::user()->id)->first();

        $this->EmailNewShipments = $settings->email_notifications['NewShipments'] ?? false;
        $this->EmailNewContainers = $settings->email_notifications['NewContainers'] ?? false;
        $this->EmailShipmentUpdates = $settings->email_notifications['ShipmentUpdates'] ?? false;
        $this->EmailShipmentArrivalNotices = $settings->email_notifications['ShipmentArrivalNotices'] ?? false;
        $this->EmailNewDeliveries = $settings->email_notifications['NewDeliveries'] ?? false;
        $this->EmailDeliveryUpdates = $settings->email_notifications['DeliveryUpdates'] ?? false;
        $this->EmailDeliveryArrivalNotices = $settings->email_notifications['DeliveryArrivalNotices'] ?? false;
        $this->EmailNewDocuments = $settings->email_notifications['NewDocuments'] ?? false;
        $this->EmailNewInvoices = $settings->email_notifications['NewInvoices'] ?? false;
        $this->EmailPaymentNotices = $settings->email_notifications['PaymentNotices'] ?? false;

        $this->PushNewShipments = $settings->push_notifications['NewShipments'] ?? false;
        $this->PushNewContainers = $settings->push_notifications['NewContainers'] ?? false;
        $this->PushShipmentUpdates = $settings->push_notifications['ShipmentUpdates'] ?? false;
        $this->PushShipmentArrivalNotices = $settings->push_notifications['ShipmentArrivalNotices'] ?? false;
        $this->PushNewDeliveries = $settings->push_notifications['NewDeliveries'] ?? false;
        $this->PushDeliveryUpdates = $settings->push_notifications['DeliveryUpdates'] ?? false;
        $this->PushDeliveryArrivalNotices = $settings->push_notifications['DeliveryArrivalNotices'] ?? false;
        $this->PushNewDocuments = $settings->push_notifications['NewDocuments'] ?? false;
        $this->PushNewInvoices = $settings->push_notifications['NewInvoices'] ?? false;
        $this->PushPaymentNotices = $settings->push_notifications['PaymentNotices'] ?? false;
    }

    public function createUpdateNotificationSettings()
    {
        UserNotificationSetting::UpdateorCreate(['user_id' => Auth::user()->id],[
            'email_notifications' => $this->SetEmailJsonSettings(),
            'push_notifications' => $this->SetPushJsonSettings()
        ]);

        toast()->info('Your notification settings have been changed successfully!', 'Settings Updated')->push();
    }

    public function SetEmailJsonSettings()
    {
        return [
            'NewShipments' => $this->EmailNewShipments,
            'NewContainers' => $this->EmailNewContainers,
            'ShipmentUpdates' => $this->EmailShipmentUpdates,
            'ShipmentArrivalNotices' => $this->EmailShipmentArrivalNotices,
            'NewDeliveries' => $this->EmailNewDeliveries,
            'DeliveryUpdates' => $this->EmailDeliveryUpdates,
            'DeliveryArrivalNotices' => $this->EmailDeliveryArrivalNotices,
            'NewDocuments' => $this->EmailNewDocuments,
            'NewInvoices' => $this->EmailNewInvoices,
            'PaymentNotices' => $this->EmailPaymentNotices
        ];
    }

    public function SetPushJsonSettings()
    {
        return [
            'NewShipments' => $this->PushNewShipments,
            'NewContainers' => $this->PushNewContainers,
            'ShipmentUpdates' => $this->PushShipmentUpdates,
            'ShipmentArrivalNotices' => $this->PushShipmentArrivalNotices,
            'NewDeliveries' => $this->PushNewDeliveries,
            'DeliveryUpdates' => $this->PushDeliveryUpdates,
            'DeliveryArrivalNotices' => $this->PushDeliveryArrivalNotices,
            'NewDocuments' => $this->PushNewDocuments,
            'NewInvoices' => $this->PushNewInvoices,
            'PaymentNotices' => $this->PushPaymentNotices
        ];
    }

    public function render()
    {
        return view('livewire.user.profile-page.form.change-or-create-notification-settings');
    }
}
