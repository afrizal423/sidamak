<?php

namespace Tests\Feature;

use App\Http\Livewire\Table\Divisi;
use App\Models\DivisiModels;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MasterDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    function test_divisi()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Divisi::class,['divisis' => DivisiModels::all()])
            ->set('nama_divisi', 'foo')
            ->call('store');
        // dd(Livewire::test(Divisi::class));
        // // $this->assertTrue(DivisiModels::whereStore('foo')->exists());
        // $this->get('/divisi')->assertSeeLivewire('table.divisi');
    }
}
