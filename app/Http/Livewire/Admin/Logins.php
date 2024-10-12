<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\UserActivity;
use Carbon\Carbon;
use App\Models\User;

class Logins extends Component
{
    public $timeline = "today";
    public $labels;
    public $data = array();
    public $date;

    public function mount()
    {
        $this->labels = array('8am','9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm','4pm','5pm');
        $this->date = Carbon::parse('today 09am');
        foreach($this->labels as $label)
        {
            $from = Carbon::parse($this->timeline.' '.$label);
            $to = Carbon::parse($this->timeline.' '.$label)->addHours('1');
            $this->data[] = UserActivity::where('activity','login')
                ->whereBetween('created_at',[$from,$to])
                ->count();
        }
    }

    public function updatedTimeline($value)
    {
        $this->reset('data');
        
        $this->labels = match ($value) {
            'today','yesterday' =>  array('8am','9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm','4pm','5pm'),
            'this week' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
        };

        foreach($this->labels as $label)
        {
            $from = Carbon::parse($this->timeline.' '.$label);
            $to = match ($this->timeline) {
                'today','yesterday' =>  Carbon::parse($this->timeline.' '.$label)->addHours('1'),
                'this week' => Carbon::parse($this->timeline.' '.$label)->addDays('1'),
            };
            $this->data[] = UserActivity::where('activity','login')
                ->whereBetween('created_at',[$from,$to])
                ->count();
        }
        $this->dispatchBrowserEvent('reloadChart',['labels' => $this->labels,'data'=>$this->data]);
    }

    public function render()
    {   
        return view('livewire.admin.logins');
    }
}
