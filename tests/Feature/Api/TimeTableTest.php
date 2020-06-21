<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Model\TimeTable;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_time_table_required_start_date()
    {

        $this->signIn();

        $timeTable = make(TimeTable::class);
        $data = $timeTable->toArray();
        $data['start_date'] = '';

        $this->jsonPost($data, route('api.time_table.store'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['start_date' => []]
            ]);
    }

    /** @test */
    public function a_time_table_required_end_date()
    {
        $this->signIn();

        $timeTable = make(TimeTable::class);
        $data = $timeTable->toArray();
        $data['end_date'] = '';
        $this->jsonPost($data, route('api.time_table.store'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_date' => []]
            ]);
    }

    /** @test */
    public function time_table_end_date_must_be_greater_than_start_date()
    {
        $this->signIn();
        $date = \Carbon\Carbon::now();
        $timeTable = make(TimeTable::class, [
            'end_date' => $date->format('Y-m-d'),
            'start_date' => $date->addDays(15)->format('Y-m-d'),
        ]);

        $this->jsonPost($timeTable->toArray(), route('api.time_table.store'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'errors' => ['end_date' => []]
            ]);
    }

    /** @test */
    public function authorized_user_can_create_a_time_table()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $timeTable = make(TimeTable::class);

        $this->jsonPost($timeTable->toArray(), route('api.time_table.store'))
            ->assertStatus(Response::HTTP_OK);
    }
}
