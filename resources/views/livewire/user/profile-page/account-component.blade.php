<div>
    @if($changeTab == "Account")
        <livewire:user.profile-page.form.upload-profile-picture/>
        <livewire:user.profile-page.form.update-account-information/>
    @elseif($changeTab == "Notifications")
        <livewire:user.profile-page.form.change-or-create-notification-settings/>
    @elseif($changeTab == "Security")
        <livewire:user.profile-page.form.change-password/>
        <livewire:user.profile-page.security-component/>
    @elseif($changeTab == "Events")
        <livewire:user.profile-page.event-service/>
    @elseif($changeTab == "Activity")
        <livewire:user.profile-page.activity-component/>
    @endif
</div>
