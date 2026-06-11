<?php

use Livewire\Component;
use App\Models\Cmlog;

new class extends Component
{
    public $log;

    public function render()
    {
        $this->log = Cmlog::orderBy('id','desc')->limit(100)->get();
        return $this->view();
    }
};
