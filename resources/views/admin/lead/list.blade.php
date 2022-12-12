<x-admin-layout title="Lead Gen Form Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Lead Gen List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('lead-form.index') }}" value="Lead Gen List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<!-- <a href="{{route('landmarks.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Landmark
					</a> -->
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.lead.lead-list/>
</x-admin-layout>
