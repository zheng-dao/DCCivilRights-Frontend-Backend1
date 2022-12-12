<?php

namespace App\Http\Livewire\Admin\User;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use Storage;
class CreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $first_name, $last_name, $email, $password, $phone, $active, $password_confirmation, $user, $model_id;
    public $address;
    public $isEdit = false;
    public $statusList = [];
    public $photo;
    public $photos = [];
    public $model_image, $imgId, $model_documents;
    protected $listeners = ['refreshProducts' => '$refresh'];
    public function mount($user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->fill($this->user);
            $this->isEdit = true;
        } else
            $this->user = new User;

        $this->statusList = [
            ['value' => '', 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
       
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')],
                'phone' => ['required', Rule::unique('users')],
                'password' => ['required', 'max:255', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'max:255', 'min:6'],
                'active' => ['required'],
                'photo' => ['required'],
                'address' => ['nullable'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'active' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'phone' => ['required', Rule::unique('users')->ignore($this->user->id)],
                'address' => ['nullable'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        if ($this->photo) 
        {

            $profile_pic = $this->photo;
            $filename = time() . '-' . rand(1000, 9999) . '.' . $profile_pic->getClientOriginalExtension();
            Storage::putFileAs('public/profile-photos', $profile_pic, $filename);
            $final_filaname = 'profile-photos/'.$filename;
            if($this->user->profile_photo_path)
            {
                @unlink(storage_path('app/public/profile-photos/' . $this->user->profile_photo_path));
            }
        }
        else
        {
            $final_filaname = $this->user->profile_photo_path;
        }

        $this->user->fill([
            'profile_photo_path' => $final_filaname,
        ])->save();

        if (!$this->isEdit)
            $this->user->assignRole('CLIENT');
        $msgAction = 'User was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('users.index');
    }
    public function deletedocuments($id)
    {
        $item = Media::find($id);
        $item->delete();
        $this->showModal('success', 'Success', 'Document deleted successfully');
        $this->emit('refreshProducts');
    }
    public function render()
    {
        return view('livewire.admin.user.create-edit');
    }
}
