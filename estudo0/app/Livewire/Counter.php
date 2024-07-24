<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $counter = 0;
    public $message = " ";

    public function changeCounter($input)
    {
        $this->message = '';
        $counter = $this->counter + $input; // Calcula o novo valor do contador
        
        // Verificações se é maior que 18 ou menor que 0
        if ($counter > 18) {
            $this->message = 'O valor não pode ser maior que 18.';
        } elseif ($counter < 0) {
            $this->message = 'O valor não pode ser menor que 0.';
        } else {
            $this->counter = $counter; // Se estiver dentro dos limites, atualiza o contador
        }
    }


    public function render()
    {
        return view('livewire.counter');
    }
}
