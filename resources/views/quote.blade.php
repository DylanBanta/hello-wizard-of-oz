@if ($quote = \WestmSchools\HelloWizardOfOz\Quotes::random())
    <div class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700" data-hello-wizard-of-oz>
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 text-sm italic text-gray-600 dark:text-gray-400 sm:text-right">
            {{ $quote }}
        </div>
    </div>
@endif
