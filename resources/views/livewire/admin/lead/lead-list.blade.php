<x-admin.table>
    {{-- <x-slot name="search">
        <x-admin.input type="search" class="form-control form-control-sm" wire:model.debounce.500ms="search"
            aria-controls="kt_table_1" id="generalSearch" />
    </x-slot> --}}
    <x-slot name="perPage">
        <label>Show
            <x-admin.dropdown wire:model="perPage" class="custom-select custom-select-sm form-control form-control-sm">
                @foreach ($perPageList as $page)
                    <x-admin.dropdown-item :value="$page['value']" :text="$page['text']" />
                @endforeach
            </x-admin.dropdown> entries
        </label>
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">First Name <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('first_name')"></i>
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Agent: activate to sort column ascending">Last Name <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('last_name')"></i>
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Email: activate to sort column ascending">Email <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('email')"></i></th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Agent: activate to sort column ascending">Phone<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('phone')"></i></th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchFirstName" placeholder="" autocomplete="off"
                               class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchLastName" placeholder="" autocomplete="off"
                               class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchEmail" placeholder="" autocomplete="off"
                               class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchPhone" placeholder="" autocomplete="off"
                               class="form-control-sm form-filter" />
            </th>
            <th>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-brand kt-btn btn-sm kt-btn--icon" wire:click="search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon" wire:click="resetSearch">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </th>
        </tr>
    </x-slot>

    <x-slot name="tbody">
        @forelse($lead_gens as $val)
            <tr role="row" class="odd">
                <td>{{ $val->first_name }}</td>
                <td>{{ $val->last_name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->phone }}</td>
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('lead-form.show', [$val->id]) }}"><i
                            class="la la-eye"></i> View</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $val->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse
    </x-slot>
    <x-slot name="pagination">
        {{ $lead_gens->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $lead_gens->firstitem() ?? 0 }} to {{ $lead_gens->lastitem() ?? 0 }} of {{ $lead_gens->total() }} entries
    </x-slot>
</x-admin.table>
