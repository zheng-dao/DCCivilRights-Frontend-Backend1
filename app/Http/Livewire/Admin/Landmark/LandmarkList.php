<?php

namespace App\Http\Livewire\Admin\Landmark;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Landmark;
use App\Models\LandmarkImage;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class LandmarkList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchTitle, $searchLat, $searchLng, $searchAddress, $searchStatus = -1, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

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
        $this->searchTitle = "";
        $this->searchLat = "";
        $this->searchLng = "";
        $this->searchAddress = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $landmarkQuery = Landmark::query();

        if ($this->searchTitle)
            $landmarkQuery->where('title', 'like', '%' . trim($this->searchTitle) . '%');
        if ($this->searchLat)
            $landmarkQuery->where('lat', 'like', '%' . trim($this->searchLat) . '%');
        if ($this->searchLng)
            $landmarkQuery->where('lng', 'like', '%' . trim($this->searchLng) . '%');
        if ($this->searchAddress)
            $landmarkQuery->where('address', 'like', '%' . trim($this->searchAddress) . '%');
        if ($this->searchStatus >= 0)
            $landmarkQuery->where('is_active', $this->searchStatus);
        return view('livewire.admin.landmark.landmark-list', [
            'landmarks' => $landmarkQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $path = public_path('/upload/landmark');
        $images = LandmarkImage::where('landmark_id',$id)->get();
        foreach ($images as $image){
            if(file_exists($path.'/'.$image->image)){
                unlink($path.'/'.$image->image);
            }
        }

        LandmarkImage::where('landmark_id',$id)->delete();

        $landmark_details = Landmark::where('id',$id)->first();
        if(file_exists($path.'/'.$landmark_details->audio)){
            unlink($path.'/'.$landmark_details->audio);
        }
        Landmark::destroy($id);
        $this->showModal('success', 'Success', 'Landmark has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this user!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(Landmark $landmark)
    {
        $landmark->fill(['is_active' => ($landmark->is_active == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Landmark status has been changed successfully');
    }
}
