<x-settings-card :title="__('Wizard of Oz quotes')" :saved="session('hello-wizard-of-oz.saved', false)">
    <p>{{ __('One quote is shown at random at the top of each page. Write one quote per line.') }}</p>
    <form method="POST" action="{{ route('hello-wizard-of-oz.update') }}" class="space-y-4">
        @csrf
        <textarea name="quotes" rows="12" class="block w-full text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('quotes', implode("\n", \WestmSchools\HelloWizardOfOz\Quotes::all())) }}</textarea>
        <x-input-error :messages="$errors->get('quotes')" />
        <div class="flex flex-wrap justify-end gap-3">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
    <form method="POST" action="{{ route('hello-wizard-of-oz.reset') }}" class="flex justify-end" onsubmit="return confirm(@js(__('Replace your list with the original quotes?')))">
        @csrf
        <x-secondary-button type="submit">{{ __('Restore the original quotes') }}</x-secondary-button>
    </form>
</x-settings-card>
