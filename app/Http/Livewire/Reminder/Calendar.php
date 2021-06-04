<?php

namespace App\Http\Livewire\Reminder;

use Livewire\Component;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;


class Calendar extends LivewireCalendar
{
    public $isModalOpen = false;

    private function resetNewAppointment()
    {
        $this->newAppointment = [
            'title' => '',
            'notes' => '',
            'scheduled_at' => '',
            'priority' => 'normal',
        ];
    }
    public function onDayClick($year, $month, $day)
    {
        $this->isModalOpen = true;

        $this->resetNewAppointment();

        $this->newAppointment['scheduled_at'] = Carbon::today()
            ->setDate($year, $month, $day)
            ->format('Y-m-d');
    }
    public function events() : Collection
    {
        Carbon::setLocale('id');
        // dd(Carbon::now()->isoFormat('D MMMM Y'));

        return collect([
            [
                'id' => 1,
                'title' => 'Breakfast',
                'description' => 'Pancakes! 🥞',
                'date' => Carbon::today(),
            ],
            [
                'id' => 2,
                'title' => 'Meeting with Pamela',
                'description' => 'Work stuff',
                'date' => Carbon::today(),
            ],
        ]);
    }

    // public function render()
    // {
    //     return view('livewire.reminder.calendar');
    // }
}
