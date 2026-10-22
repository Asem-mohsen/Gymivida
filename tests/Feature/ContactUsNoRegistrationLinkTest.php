<?php

namespace Tests\Feature;

use App\Mail\CompleteRegistrationMail;
use App\Mail\NewContactSubmissionMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactUsNoRegistrationLinkTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'mysql',
            'database.connections.mysql.database' => 'gymivida-marketing-pyraven',
        ]);
        DB::purge('mysql');
        DB::reconnect('mysql');
    }

    public function test_contact_submission_never_sends_registration_email(): void
    {
        Mail::fake();

        $this->postJson('/api/v1/contact', [
            'name' => 'Owner',
            'email' => 'owner-no-reg-link@example.com',
            'message' => 'I have a question about integrations.',
            'wants_registration_email' => 1,
        ])->assertCreated();

        Mail::assertSent(NewContactSubmissionMail::class);
        Mail::assertNotSent(CompleteRegistrationMail::class);
    }
}
