<?php

namespace App\Http\Livewire\Reminder;

use App\Models\Reminder;
use Livewire\Component;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;


class Calendar extends LivewireCalendar
{
    public $isModalOpen = false;
    public $newReminder, $isUpdate;
    public $selectedReminder = null;

    public function events() : Collection
    {
        Carbon::setLocale('id');
        // dd(Carbon::now()->isoFormat('D MMMM Y'));
        return Reminder::query()
            ->whereDate('tgl_kegiatan', '>=', $this->gridStartsAt)
            ->whereDate('tgl_kegiatan', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Reminder $appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->nama_kegiatan,
                    'description' => $appointment->keterangan,
                    'date' => $appointment->tgl_kegiatan,
                ];
        });
    }

    public function unscheduledEvents() : Collection
    {
        return Reminder::query()
            ->whereNull('tgl_kegiatan')
            ->get();
    }

    public function onDayClick($year, $month, $day)
    {
        $this->isModalOpen = true;

        $this->resetNewAppointment();

        $this->newReminder['tgl_kegiatan'] = Carbon::today()
            ->setDate($year, $month, $day)
            ->format('Y-m-d');

        $this->newReminder['waktu_kegiatan'] = Carbon::today()
            ->format('H:i');
    }

    public function saveReminder()
    {
        Reminder::create($this->newReminder);
        // dd($this->newReminder);
        $this->isModalOpen = false;
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        // dd($eventId);
        $appointment = Reminder::find($eventId);
        $appointment->tgl_kegiatan = Carbon::today()->setDate($year, $month, $day);
        $appointment->save();
    }

    private function resetNewAppointment()
    {
        $this->newReminder = [
            'nama_kegiatan' => '',
            'tempat_acara' => '',
            'keterangan' => '',
            'tgl_kegiatan' => '',
            'waktu_kegiatan' => '',
            'priority' => 'normal',
        ];
    }


    public function onEventClick($eventId)
    {
        $this->selectedReminder = Reminder::find($eventId);
    }

    public function unscheduleAppointment()
    {
        $appointment = Reminder::find($this->selectedReminder['id']);
        $appointment->tgl_kegiatan = null;
        $appointment->save();

        $this->selectedReminder = null;
    }

    public function closeAppointmentDetailsModal()
    {
        $this->selectedReminder = null;
    }

    public function deleteEvent($eventId)
    {
        $appointment = Reminder::find($eventId);
        $appointment->delete();
    }

    public function render()
    {
        return parent::render()->with([
            'unscheduledEvents' => $this->unscheduledEvents()
        ]);
    }

    // public function render()
    // {
    //     return view('livewire.reminder.calendar');
    // }
}
