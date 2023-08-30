<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $some;
    public $c = 0;


    protected $rules = [
        'some' => 'required|numeric',
    ];


    protected $messages = [
        'some.numeric' => 'Angka onli',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function doSomething()
    {
        $this->validate();

    }

    public function render()
    {
        return view('livewire.test');
    }
}
