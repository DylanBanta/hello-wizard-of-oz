<?php

namespace WestmSchools\HelloWizardOfOz\Http;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use WestmSchools\HelloWizardOfOz\Quotes;

class QuotesController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate(['quotes' => ['nullable', 'string', 'max:20000']]);
        Setting::put(Quotes::KEY, implode("\n", Quotes::parse($data['quotes'] ?? '')));

        return redirect('/administration/hello-wizard-of-oz')->with('hello-wizard-of-oz.saved', true);
    }

    public function reset(): RedirectResponse
    {
        Setting::put(Quotes::KEY, implode("\n", Quotes::DEFAULTS));

        return redirect('/administration/hello-wizard-of-oz')->with('hello-wizard-of-oz.saved', true);
    }
}
