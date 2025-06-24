@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Progress Steps --}}
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    @php
                        $steps = ['Start', 'Address', 'Home', 'Images of Home', 'Roommate', 'Other Animals'];
                    @endphp

                    {{-- Completed steps --}}
                    @foreach($steps as $label)
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                                ✓
                            </div>
                            <span class="ml-2 text-sm font-medium text-purple-600">{{ $label }}</span>
                        </div>
                        <div class="w-8 h-0.5 bg-purple-600"></div>
                    @endforeach

                    {{-- Current step --}}
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-semibold">
                            7
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-500">Review&nbsp;&amp;&nbsp;Submit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">

            {{-- ------- Data helpers ------- --}}
            @php
                $app = $adoption->application_data ?? [];
                $s1 = $app['step1'] ?? [];
                $s2 = $app['step2'] ?? [];
                $s3 = $app['step3'] ?? [];
                $s4 = $app['step4'] ?? [];
                $s5 = $app['step5'] ?? [];
            @endphp

            {{-- Applicant Summary --}}
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Applicant Summary</h2>
            <div class="flex items-center mb-10">
                <div class="w-20 h-20 rounded-full overflow-hidden mr-6">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div class="text-gray-700">
                    <p class="mb-1"><span class="font-medium">Email:</span> {{ auth()->user()->email }}</p>
                    <p class="mb-1"><span class="font-medium">First&nbsp;Name:</span> {{ explode(' ', auth()->user()->name)[0] }}</p>
                    <p><span class="font-medium">Last&nbsp;Name:</span> {{ explode(' ', auth()->user()->name)[1] ?? '' }}</p>
                </div>
            </div>

            {{-- Application Details --}}
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Application Details</h2>
            <div class="space-y-8 text-gray-700 text-sm">

                {{-- Step 1 – Address  --}}
                <div>
                    <h3 class="font-semibold mb-2">Address</h3>
                    <p>{{ $s1['address_line_1'] ?? '' }}{{ $s1['address_line_2'] ? ', '.$s1['address_line_2'] : '' }}</p>
                    <p>{{ $s1['town'] ?? '' }}, {{ $s1['postcode'] ?? '' }}</p>
                    <p class="mt-1">Telephone: {{ $s1['telephone'] ?? '' }} | Mobile: {{ $s1['mobile'] ?? '' }}</p>
                </div>

                {{-- Step 2 – Home / Living  --}}
                <div>
                    <h3 class="font-semibold mb-2">Home &amp; Living Situation</h3>
                    <p><span class="font-medium">Garden:</span> {{ ucfirst($s2['has_garden'] ?? 'n/a') }}</p>
                    <p><span class="font-medium">Living Situation:</span> {{ str_replace('_',' ', $s2['living_situation'] ?? 'n/a') }}</p>
                    <p><span class="font-medium">Household Setting:</span> {{ str_replace('_',' ', $s2['household_setting'] ?? 'n/a') }}</p>
                    <p><span class="font-medium">Activity Level:</span> {{ str_replace('_',' ', $s2['activity_level'] ?? 'n/a') }}</p>
                </div>

                {{-- Step 3 – Images --}}
                <div>
                    <h3 class="font-semibold mb-2">Home Photos ({{ count($s3['home_images'] ?? []) }}/4)</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($s3['home_images'] ?? [] as $img)
                            <img src="{{ asset('storage/'.$img) }}" class="h-32 w-full object-cover rounded-lg border">
                        @endforeach
                    </div>
                </div>

                {{-- Step 4 – Household / Roommate --}}
                <div>
                    <h3 class="font-semibold mb-2">Household Members</h3>
                    <p>Adults: {{ $s4['number_of_adults'] ?? '0' }} | Children: {{ $s4['number_of_children'] ?? '0' }}</p>
                    @if(!empty($s4['age_of_youngest_children']))
                        <p>Age of Youngest Child: {{ $s4['age_of_youngest_children'] }}</p>
                    @endif
                    <p>Visiting Children: {{ ucfirst($s4['visiting_children'] ?? 'no') }}
                        @if(($s4['visiting_children'] ?? '') === 'yes' && !empty($s4['ages_of_visiting_children']))
                            (Ages: {{ $s4['ages_of_visiting_children'] }})
                        @endif
                    </p>
                    <p>Flatmates/Lodgers: {{ ucfirst($s4['flatmates_lodgers'] ?? 'no') }}</p>
                </div>

                {{-- Step 5 – Other Animals --}}
                <div>
                    <h3 class="font-semibold mb-2">Pets &amp; Allergies</h3>
                    <p>Household Pet Allergies: {{ ucfirst($s5['household_allergies'] ?? 'no') }}</p>
                    @if(($s5['household_allergies'] ?? '') === 'yes')
                        <p class="italic">Allergy Details: {{ $s5['allergy_details'] ?? 'n/a' }}</p>
                    @endif

                    <p class="mt-3">Other Animals at Home: {{ ucfirst($s5['other_animals'] ?? 'no') }}</p>
                    @if(($s5['other_animals'] ?? '') === 'yes')
                        <p>Details: {{ $s5['other_animals_details'] ?? 'n/a' }}</p>
                        <p>Neutered: {{ ucfirst($s5['animals_neutered'] ?? 'n/a') }} |
                           Vaccinated (last 12 mths): {{ ucfirst($s5['animals_vaccinated'] ?? 'n/a') }}</p>
                    @endif

                    @if(!empty($s5['previous_pet_experience']))
                        <p class="mt-3"><span class="font-medium">Previous Pet Experience &amp; Home Plan:</span><br>
                            {{ $s5['previous_pet_experience'] }}</p>
                    @endif
                </div>

            </div> {{-- end details --}}

            {{-- Review Instructions --}}
            <div class="mt-10 text-gray-700 text-sm">
                <p class="mb-2">
                    Please review the details above. If you need to make changes, you can return to the previous steps.
                    When everything looks correct, agree to the terms and submit your application.
                </p>
            </div>

            {{-- Form --}}
            <form action="{{ route('adoption.step6.store', $pet) }}" method="POST" class="mt-8">
                @csrf

                {{-- Terms Agreement --}}
                <div class="mb-6">
                    <label class="inline-flex items-start text-sm text-gray-700 leading-relaxed">
                        <input type="checkbox" id="terms_agreement" name="terms_agreement" value="1" class="mt-1 mr-3" required>
                        I confirm that all information provided is accurate and I agree to the
                        <a href="#" class="text-purple-600 underline">Terms of Service</a> and
                        <a href="#" class="text-purple-600 underline">Privacy&nbsp;Policy</a>.
                    </label>
                    @error('terms_agreement')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-between">
                    <a href="{{ route('adoption.step5', $pet) }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors">
                        ← Back
                    </a>
                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
