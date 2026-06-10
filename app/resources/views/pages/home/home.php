<?php

use Livewire\Component;

new class extends Component
{
    public $title = "Home";
    
    public function render()
    {
        return $this->view()
            ->title('Home'); 
    }
};
