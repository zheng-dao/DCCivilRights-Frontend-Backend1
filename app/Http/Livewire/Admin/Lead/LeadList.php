<?php

namespace App\Http\Livewire\Admin\Lead;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\LeadGen;
use App\Models\LeadGenLocation;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class LeadList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchFirstName, $searchLastName, $searchEmail, $searchPhone, $searchStatus = -1, $perPage = 5;
    protected $listeners = ['deleteConfirm'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchFirstName = "";
        $this->searchLastName = "";
        $this->searchEmail = "";
        $this->searchPhone = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $leadGenQuery = LeadGen::query();
 
        if ($this->searchFirstName)
            $leadGenQuery->where('first_name', 'like', '%' . trim($this->searchFirstName) . '%');
        if ($this->searchLastName)
            $leadGenQuery->where('last_name', 'like', '%' . trim($this->searchLastName) . '%');
        if ($this->searchEmail)
            $leadGenQuery->where('email', 'like', '%' . trim($this->searchEmail) . '%');
        if ($this->searchPhone)
            $leadGenQuery->where('phone', 'like', '%' . trim($this->searchPhone) . '%');
        if ($this->searchStatus >= 0)
            $leadGenQuery->where('is_active', $this->searchStatus);
        return view('livewire.admin.lead.lead-list', [
            'lead_gens' => $leadGenQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        LeadGenLocation::where('lead_gen_id',$id)->delete();
        LeadGen::destroy($id);
        $this->showModal('success', 'Success', 'Lead gen has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this data!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
}
