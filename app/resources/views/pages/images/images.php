<?php

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $images;

    public $maxfilesize;

    public $freediskspace;

    public $file;

    public $modalOpen = false;

    public $os32bit = false;

    public function render()
    {
        $this->images = Image::orderBy('filename')->orderBy('id')->get();
        $this->maxfilesize = UploadedFile::getMaxFilesize();
        $this->freediskspace = min(disk_free_space('.'), disk_free_space('/'));
        $this->os32bit = (PHP_INT_MAX == 2147483647);

        return $this->view();
    }

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function delete($id)
    {
        Image::destroy($id);
        session()->flash('message', 'Levykuva poistettu');
    }

    public function create()
    {
        $this->openModal();
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function save()
    {
        sleep(5);
    }
};
