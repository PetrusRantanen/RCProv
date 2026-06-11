<?php

use App\Models\Cmlog;
use Livewire\Component;

new class extends Component
{
    public $log;

    public function render()
    {
        $this->log = Cmlog::orderBy('id', 'desc')->limit(100)->get();

        return $this->view();
    }
};
