<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_returns_ok(): void
    {
        $this->getJson('/api/health')->assertOk()->assertJson(['status' => 'ok']);
    }

    public function test_can_create_and_list_tasks(): void
    {
        $this->postJson('/api/tasks', ['title' => 'Prepare client proposal', 'description' => 'Outline scope and delivery milestones.', 'status' => 'in_progress', 'due_date' => '2026-12-10'])
            ->assertCreated()->assertJsonPath('data.title', 'Prepare client proposal');

        $this->getJson('/api/tasks')->assertOk()->assertJsonPath('total', 1);
    }

    public function test_invalid_payload_is_rejected(): void
    {
        $this->postJson('/api/tasks', [])->assertUnprocessable();
    }
}
