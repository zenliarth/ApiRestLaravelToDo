<?php

namespace Tests\Feature\Livewire\Dashboard\Tasks;

use App\Http\Livewire\Dashboard\Tasks\Manage;
use Livewire\Livewire;
use Tests\TestCase;

class ManageTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Manage::class);

        $component->assertStatus(200);
    }
}
