<?php

namespace WestmSchools\HelloWizardOfOz\Tests;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use WestmSchools\HelloWizardOfOz\Quotes;

class HelloWizardOfOzTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_quote_shows_on_pages_with_the_menu(): void
    {
        Setting::put(Quotes::KEY, 'Pay no attention <b>now</b>');

        $this->actingAs(User::factory()->create())->get('/dashboard')
            ->assertOk()
            ->assertSee('data-hello-wizard-of-oz', false)
            ->assertSee('Pay no attention &lt;b&gt;now&lt;/b&gt;', false);
    }

    public function test_the_quote_is_on_the_chat_page_too(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]))->get('/chat')
            ->assertOk()
            ->assertSee('data-hello-wizard-of-oz', false);
    }

    public function test_nothing_is_added_with_an_empty_list(): void
    {
        Setting::put(Quotes::KEY, '');

        $this->actingAs(User::factory()->create())->get('/dashboard')->assertDontSee('data-hello-wizard-of-oz', false);
    }

    public function test_admins_can_save_the_list(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->post('/administration/hello-wizard-of-oz', ['quotes' => "One\n\n  Two  \n"])->assertRedirect();
        $this->assertSame(['One', 'Two'], Quotes::all());

        $this->actingAs($admin)->get('/administration/hello-wizard-of-oz')->assertOk()->assertSee('Wizard of Oz quotes');
    }

    public function test_others_cannot_change_the_list(): void
    {
        $this->actingAs(User::factory()->create())->post('/administration/hello-wizard-of-oz', ['quotes' => 'x'])->assertForbidden();
    }

    public function test_the_original_quotes_can_be_restored(): void
    {
        Setting::put(Quotes::KEY, 'Only this');
        $this->actingAs(User::factory()->create(['is_admin' => true]))->post('/administration/hello-wizard-of-oz/reset');

        $this->assertSame(Quotes::DEFAULTS, Quotes::all());
    }
}
