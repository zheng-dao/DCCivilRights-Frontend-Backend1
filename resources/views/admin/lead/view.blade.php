<x-admin-layout title="Lead Gen Form Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Lead Gen view">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('lead-form.index') }}" value="Lead Gen List" />
                        <x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="" value="Lead Gen view" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<!-- <a href="{{route('landmarks.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Landmark
					</a> -->
				</x-slot>
			</x-admin.sub-header>
    </x-slot>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Lead Gen From Details
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">            
                        <tr>
                        <th>First Name :</th>
                        <td>{{$leadgen->first_name}}</td>
                        </tr>
                        <tr>
                        <th>Last Name :</th>
                        <td>{{$leadgen->last_name}}</td>
                        </tr>
                        <tr>
                        <th>Email :</th>
                        <td>{{$leadgen->email}}</td>
                        </tr>
                        <tr>
                        <th>Phone :</th>
                        <td>{{$leadgen->phone}}</td>
                        </tr>
                        <tr>
                        <th class='text-center' colspan="2">Locations </th>
                        </tr>
                        @foreach($leadgen->leadgenLocation as $key => $locations)
                        <tr>
                        <td colspan="2">{{$key+1}}. {{$locations->landmark->title}} </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>