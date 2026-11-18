<?php

namespace WestmSchools\HelloWizardOfOz;

use App\Administration\Administration;
use App\Layout\Footer;
use Illuminate\Support\ServiceProvider;

class HelloWizardOfOzServiceProvider extends ServiceProvider
{
    public function boot(Administration $administration, Footer $footer): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hello-wizard-of-oz');
        $this->loadRoutesFrom(__DIR__.'/../routes/hello-wizard-of-oz.php');

        $footer->add('hello-wizard-of-oz::quote', order: 50);

        $administration->tab('hello-wizard-of-oz', __('Wizard of Oz'), order: 70);
        $administration->card('hello-wizard-of-oz::administration-card', tab: 'hello-wizard-of-oz');
    }
}
