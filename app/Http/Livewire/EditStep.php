<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditStep extends Component
{
    public $steps=[];

    public function mount($steps){
        $this->steps=$steps->toArray();
    }

    public function increment(){
        $this->steps[] = ["wireId"=>abs(crc32(uniqid())),"name"=>""];
    }

    public function remove($index){
        unset($this->steps[$index]);
    }

    public function render()
    {
        return view('livewire.edit-step');
    }
}

