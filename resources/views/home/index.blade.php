<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-gray-50 py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">
            <!-- Left Content -->
            <div class="text-left">
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2 leading-tight">
                    Give a New Life to
                </h1>
                <h2 class="text-2xl lg:text-3xl font-bold text-violet-500 mb-6">
                    Furry Friends
                </h2>
                <p class="text-base text-gray-600 mb-8 leading-relaxed max-w-md">
                    Pet adoption and rehoming are both vital aspects of animal welfare, offering hope and a fresh start to pets in need. Open your heart and your home to a shelter pet.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('pets.index') }}" class="bg-violet-500 hover:bg-violet-600 text-white px-6 py-2.5 rounded-lg text-base font-semibold transition-all duration-300 text-center">
                        Adopt Now
                    </a>
                    <a href="{{ route('rehoming.index') }}" class="border-2 border-violet-500 text-violet-500 hover:bg-violet-500 hover:text-white px-6 py-2.5 rounded-lg text-base font-semibold transition-all duration-300 text-center">
                        Rehome Now
                    </a>
                </div>
            </div>
            
            <!-- Right Illustration -->
            <div class="relative flex justify-center lg:justify-end">
                <!-- Main purple oval background -->
                <div class="relative">
                    <!-- Main purple oval -->
                    <div class="w-100 h-100 lg:w-96 lg:h-96  from-violet-400 to-violet-500 rounded-full relative">
                        <!-- Hero pets image positioned within the circle -->
                        <div class="absolute inset-0 flex items-end justify-center">
                            <img src="{{ asset('images/hero2.png') }}" alt="Dog and Cat" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-[500px] lg:w-[600px] h-auto z-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Pets Section -->
<!-- Pets Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-10">Take a Look at Some of Our Pets</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            @foreach($pets as $pet)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1.5">
                <div class="relative h-36 bg-cover bg-center" style="background-image: url('{{ $pet->main_image_url }}')">
                    @if($pet->is_new)
                        <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            NEW
                        </div>
                    @endif
                    @if($pet->is_urgent)
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            URGENT
                        </div>
                    @endif
                    <button class="absolute top-2 right-2 bg-white hover:bg-violet-500 hover:text-white text-gray-600 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300">
                        <i class="far fa-heart text-sm"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-base font-bold text-gray-800 mb-1">{{ $pet->name }}</h3>
                    <div class="text-violet-500 mb-2 flex items-center gap-1">
                        <i class="fas fa-map-marker-alt text-xs"></i>
                        {{ $pet->location->city }}, {{ $pet->location->state }}
                    </div>
                    <div class="grid grid-cols-2 gap-1 mb-2">
                        <div><strong>Gender:</strong> {{ $pet->gender }}</div>
                        <div><strong>Breed:</strong> {{ $pet->breed->name }}</div>
                        <div><strong>Age:</strong> {{ $pet->age_display }}</div>
                        <div><strong>Size:</strong> {{ $pet->size }}</div>
                    </div>
                    <p class="text-gray-600 mb-3 leading-snug">{{ Str::limit($pet->description, 60) }}</p>
                    <button onclick="window.location.href='{{ route('adoption.show', $pet) }}'" class="w-full py-2 border-2 border-violet-500 text-violet-500 hover:bg-violet-500 hover:text-white rounded-full font-semibold transition-all duration-300">
                        More Info
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('adoption.index') }}" class="inline-block py-2 px-6 border-2 border-violet-500 text-violet-500 hover:bg-violet-500 hover:text-white rounded-full font-semibold transition-all duration-300">
                See More Pets
            </a>
        </div>
    </div>
</section>



<!-- Steps Section -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">
            Adopt or Rehome a pet in just
        </h2>
        <p class="text-xl text-teal-600 font-semibold mb-16">3 Easy Steps</p>
        
        <div class="relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative bg-white rounded-xl border border-gray-200 p-8">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-purple-200 text-purple-700 rounded-full flex items-center justify-center text-lg font-bold">
                        1
                    </div>
                    <div class="pt-4">
                        <div class="w-16 h-16 mx-auto mb-6 text-purple-600">
                            <svg fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                <path d="M19 13h2v2h-2zm0-2h2v2h-2zm-2 0h2v2h-2z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-800 font-medium">
                            Set up your profile (including photos) in minutes
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-white rounded-xl border border-gray-200 p-8">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-purple-200 text-purple-700 rounded-full flex items-center justify-center text-lg font-bold">
                        2
                    </div>
                    <div class="pt-4">
                        <div class="w-16 h-16 mx-auto mb-6 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8Zm-3-8H5v2h2Zm0-4H5v2h2Zm0-4H5v2h2Z"/>
                            </svg>

                        </div>
                        <p class="text-sm text-gray-800 font-medium">
                            Describe your home and routine so rehomers can see if it's right for their pet
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-white rounded-xl border border-gray-200 p-8">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-purple-200 text-purple-700 rounded-full flex items-center justify-center text-lg font-bold">
                        3
                    </div>
                    <div class="pt-4">
                        <div class="w-16 h-16 mx-auto mb-6 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                            <path d="M19.3 20.3 16.9 18q-.45.35-1 .525T15 18.7q-1.125 0-1.913-.788Q12.3 17.125 12.3 16q0-1.125.787-1.913.788-.787 1.913-.787t1.913.787Q17.7 14.875 17.7 16q0 .575-.175 1.125T17 18l2.3 2.3ZM15 17q.425 0 .713-.288Q16 16.425 16 16t-.287-.713Q15.425 15 15 15t-.712.287Q14 15.575 14 16t.288.712Q14.575 17 15 17ZM5 21q-.825 0-1.412-.587Q3 19.825 3 19V5q0-.825.588-1.412Q4.175 3 5 3h3.15q.275-.9 1.038-1.45Q10.95 1 12 1t1.813.55Q14.575 2.1 14.85 3H18q.825 0 1.413.588Q20 4.175 20 5v6.075q-.5-.25-1.037-.387Q18.425 10.55 17.85 10.5V5h-2.15q-.2.625-.713 1.062Q14.475 6.5 14 6.8q-.575.35-1.238.525Q11.1 7.5 10.5 7.5H5v11.5h6.075q.075.525.225 1.05.15.525.4.95Zm7-16q.425 0 .713-.287Q13 4.425 13 4t-.287-.712Q12.425 3 12 3t-.712.288Q11 3.575 11 4t.288.713Q11.575 5 12 5Z"/>
                            </svg>

                        </div>
                        <p class="text-sm text-gray-800 font-medium">
                            Start your search!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Curved Dashed Lines -->
            <div class="hidden md:block absolute top-1/2 left-0 right-0 transform -translate-y-1/2">
                <!-- Line 1 to 2 -->
                <div class="absolute left-1/4 w-1/4">
                    <svg viewBox="0 0 100 40" class="w-full h-10">
                        <path d="M0,20 Q50,0 100,20" stroke="#A855F7" stroke-width="2" stroke-dasharray="5,5" fill="none"/>
                    </svg>
                </div>
                <!-- Line 2 to 3 -->
                <div class="absolute right-1/4 w-1/4">
                    <svg viewBox="0 0 100 40" class="w-full h-10">
                        <path d="M0,20 Q50,0 100,20" stroke="#A855F7" stroke-width="2" stroke-dasharray="5,5" fill="none"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- News Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-10">Pet News</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($news as $article)
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1.5">
                    <div class="h-36 bg-cover bg-center" style="background-image: url('{{ $article->featured_image_url }}')"></div>
                    <div class="p-4">
                        <div class="flex items-center mb-1">
                            <span class="px-2 py-0.5 text-xs font-medium bg-violet-100 text-violet-600 rounded-full">
                                {{ ucfirst($article->category) }}
                            </span>
                            <span class="text-xs text-gray-500 ml-auto">
                                {{ $article->published_at->format('M d, Y') }}
                            </span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-800 mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 mb-3 leading-snug">{{ Str::limit($article->excerpt, 80) }}</p>
                        <a href="{{ route('news.show', $article->slug) }}" class="text-violet-500 font-medium hover:text-violet-600 transition-colors">
                            Read more
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">No news available at the moment.</p>
            @endforelse
        </div>

        <div class="flex gap-3 mt-6 justify-center">
            <a href="{{ route('news.index', ['category' => 'cat']) }}" class="px-4 py-1.5 bg-gray-100 border border-gray-200 rounded-full text-gray-600 font-medium hover:border-violet-500 hover:text-violet-500 transition-all duration-300">Cat News</a>
            <a href="{{ route('news.index', ['category' => 'dog']) }}" class="px-4 py-1.5 bg-gray-100 border border-gray-200 rounded-full text-gray-600 font-medium hover:border-violet-500 hover:text-violet-500 transition-all duration-300">Dog News</a>
        </div>
    </div>
</section>




<!-- Human & Animals Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Title Aligned Left -->
        <div class="mb-10 px-16" >
            <h2 class="text-xl sm:text-xl font-semibold text-gray-800 mb-2">Peaceful Coexistence</h2>
            <h3 class="text-xl sm:text-xl font-bold text-emerald-700">Human & Animals</h3>
        </div>

        <!-- Image and Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Left Side Image -->
            <div>
                <img src="{{ asset('images/pawarfull.png') }}" alt="Human and Animals" class="w-full h-auto rounded-2xl">
            </div>

            <!-- Right Side Cards -->
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Card 1 -->
                    <div class="border rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-violet-300 text-xl">🐾</span>
                            <h4 class="text-emerald-700 font-semibold">Emotional relationship</h4>
                        </div>
                        <p class="text-gray-700 text-sm mb-2">The emotional bond between cats and humans is deeply rooted in felines’ unconditional love and companionship.</p>
                        <img src="{{ asset('images/image1.png') }}" alt="Cat Icon" class="w-6 h-6 mt-auto">
                    </div>

                    <!-- Card 2 -->
                    <div class="border rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-violet-300 text-xl">🐾</span>
                            <h4 class="text-emerald-700 font-semibold">Communication</h4>
                        </div>
                        <p class="text-gray-700 text-sm mb-2">Animals can communicate better with people in such conditions, as verbal communication is replaced by non-verbal.</p>
                        <img src="{{ asset('images/image2.png') }}" alt="Dog Icon" class="w-6 h-6 mt-auto">
                    </div>

                    <!-- Card 3 -->
                    <div class="border rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-violet-300 text-xl">🐾</span>
                            <h4 class="text-emerald-700 font-semibold">Children and pets</h4>
                        </div>
                        <p class="text-gray-700 text-sm mb-2">Pets establish emotional attachments to children, and the relationship turns out positive in terms of affective aspects, in reinforcement of the child’s personality.</p>
                        <img src="{{ asset('images/image3.png') }}" alt="Dog Running Icon" class="w-6 h-6 mt-auto">
                    </div>

                    <!-- Card 4 -->
                    <div class="border rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-violet-300 text-xl">🐾</span>
                            <h4 class="text-emerald-700 font-semibold">Health</h4>
                        </div>
                        <p class="text-gray-700 text-sm mb-2">Some studies suggest that owning a pet can lower blood pressure and improve heart health.</p>
                        <img src="{{ asset('images/image3.png') }}" alt="Cat Sitting Icon" class="w-6 h-6 mt-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






<!-- Testimonials Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-10">What People Say About Us</h2>

        @if($testimonials->count() > 0)
            <div class="relative overflow-hidden">
                <div class="testimonials-container">
                    <div class="testimonials-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="testimonialsGrid">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-card bg-white p-4 rounded-xl shadow-md text-center">
                                <div class="w-16 h-16 rounded-full bg-gray-200 mx-auto mb-3 bg-cover bg-center" 
                                     style="background-image: url('{{ $testimonial->avatar_url }}')"></div>
                                <div class="text-yellow-400 mb-2 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                                <h4 class="text-sm font-semibold text-gray-800 mb-1">{{ $testimonial->name }}</h4>
                                <p class="text-gray-600 leading-snug mb-2">
                                    {{ Str::limit($testimonial->testimonial, 120) }}
                                </p>
                                @if($testimonial->pet)
                                    <div class="text-xs text-violet-500">
                                        <i class="fas fa-paw"></i> About {{ $testimonial->pet->name }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($testimonials->count() > 4)
                    <div class="flex justify-center gap-3 mt-6">
                        <button onclick="previousTestimonial()" class="w-9 h-9 rounded-full bg-violet-500 hover:bg-violet-600 text-white flex items-center justify-center transition duration-300">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>
                        <button onclick="nextTestimonial()" class="w-9 h-9 rounded-full bg-violet-500 hover:bg-violet-600 text-white flex items-center justify-center transition duration-300">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3 text-3xl text-gray-400">
                    <i class="fas fa-quote-right"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-600 mb-1">No testimonials yet</h3>
                <p class="text-gray-500">Be the first to share your experience with us!</p>
            </div>
        @endif
    </div>
</section>


<!-- FAQ Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-2xl font-bold text-gray-800 mb-12">Frequently Asked Questions</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pet Adopters -->
            <div class="border rounded-xl p-8 text-center">
                <div class="w-16 h-16 mx-auto mb-4 text-violet-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 2H4a2 2 0 0 0-2 2v20l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM6 12h12v2H6v-2zm8-3H6v-2h8v2z"/>
                    </svg>
                </div>
                <h3 class="text-violet-600 text-lg font-semibold mb-2">FAQ's for Pet Adopters</h3>
                <p class="text-gray-700 text-sm leading-relaxed">
                    If you are thinking about adopting a pet, we know you'll have lots of things to consider. Click here to see some of the most frequently asked questions.
                </p>
            </div>

            <!-- Pet Rehomers -->
            <div class="border rounded-xl p-8 text-center">
                <div class="w-16 h-16 mx-auto mb-4 text-violet-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 2H4a2 2 0 0 0-2 2v20l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM6 12h12v2H6v-2zm8-3H6v-2h8v2z"/>
                    </svg>
                </div>
                <h3 class="text-violet-600 text-lg font-semibold mb-2">FAQ's for Pet Rehomers</h3>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Finding a new home for your pet doesn't need to be a daunting task.
                </p>
            </div>
        </div>
    </div>
</section>


<script>
    let currentTestimonial = 0;
    const testimonials = document.querySelectorAll('.testimonial-card');
    
    function showTestimonial(index) {
        testimonials.forEach((card, i) => {
            card.style.display = i >= index && i < index + 4 ? 'block' : 'none';
        });
    }
    
    function nextTestimonial() {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    }
    
    function previousTestimonial() {
        currentTestimonial = currentTestimonial === 0 ? testimonials.length - 1 : currentTestimonial - 1;
        showTestimonial(currentTestimonial);
    }
    
    // Initialize
    showTestimonial(0);
</script>


<script>
@if($testimonials->count() > 4)
    let currentTestimonialIndex = 0;
    const testimonials = document.querySelectorAll('.testimonial-card');
    const testimonialsPerView = window.innerWidth >= 1024 ? 4 : (window.innerWidth >= 768 ? 2 : 1);
    const maxIndex = Math.max(0, testimonials.length - testimonialsPerView);
    
    function showTestimonials(startIndex) {
        testimonials.forEach((card, i) => {
            if (i >= startIndex && i < startIndex + testimonialsPerView) {
                card.style.display = 'block';
                card.style.opacity = '1';
                card.style.transform = 'translateX(0)';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    function nextTestimonial() {
        currentTestimonialIndex = Math.min(currentTestimonialIndex + testimonialsPerView, maxIndex);
        showTestimonials(currentTestimonialIndex);
    }
    
    function previousTestimonial() {
        currentTestimonialIndex = Math.max(currentTestimonialIndex - testimonialsPerView, 0);
        showTestimonials(currentTestimonialIndex);
    }
    
    // Initialize
    showTestimonials(0);
    
    // Auto-rotate testimonials every 5 seconds
    setInterval(() => {
        if (currentTestimonialIndex >= maxIndex) {
            currentTestimonialIndex = 0;
        } else {
            currentTestimonialIndex += testimonialsPerView;
        }
        showTestimonials(currentTestimonialIndex);
    }, 5000);
@endif
</script>


@endsection