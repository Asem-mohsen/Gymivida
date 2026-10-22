<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GymRegistrationFlowTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // phpunit.xml forces sqlite/:memory:; restore the real MySQL schema for these feature tests.
        config([
            'database.default' => 'mysql',
            'database.connections.mysql.database' => 'gymivida-marketing-pyraven',
            'services.gym_platform.url' => 'https://gym-platform.test',
            'services.gym_platform.api_key' => 'test-key',
        ]);
        DB::purge('mysql');
        DB::reconnect('mysql');
    }

    public function test_registration_page_renders_owner_password_fields(): void
    {
        $response = $this->get('/en/register?plan=professional&billing=yearly');

        $response->assertOk();
        $response->assertSee('name="owner_password"', false);
        $response->assertSee('name="owner_password_confirmation"', false);
    }

    public function test_registration_page_renders_in_arabic(): void
    {
        $response = $this->get('/ar/register');

        $response->assertOk();
        $response->assertSee('سجّل صالتك', false);
    }

    public function test_contact_form_does_not_accept_registration_link_flag(): void
    {
        $response = $this->postJson('/api/v1/contact', [
            'name' => 'Tester',
            'email' => 'tester-reg-flow@example.com',
            'message' => 'General inquiry about pricing.',
            'wants_registration_email' => true,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('contact_us', [
            'email' => 'tester-reg-flow@example.com',
            'wants_registration_email' => 0,
        ]);
    }

    public function test_start_proxies_to_gym_platform_with_api_key(): void
    {
        Http::fake([
            'gym-platform.test/api/v1/gym-registrations' => Http::response([
                'success' => true,
                'message' => 'ok',
                'data' => [
                    'reference' => str_repeat('z', 64),
                    'status' => 'draft',
                    'current_step' => 1,
                    'can_edit' => true,
                ],
            ], 201),
        ]);

        $response = $this->postJson('/api/v1/registration/start', [
            'external_plan_id' => '1',
            'billing_cycle' => 'monthly',
        ]);

        $response->assertOk()->assertJsonPath('success', true);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://gym-platform.test/api/v1/gym-registrations'
                && $request->hasHeader('X-Api-Key', 'test-key');
        });
    }

    public function test_success_page_renders(): void
    {
        $this->get('/en/register/success')->assertOk();
    }
}
