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
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Take a Look at Some of Our Pets</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-8">
            @foreach($pets as $pet)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 bg-cover bg-center" style="background-image: url('{{ $pet->main_image_url }}')">
                    <!-- Badges -->
                     
                  @if($pet->is_new)
                    <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                       NEW
                    </div>
                 @endif
                 @if($pet->is_urgent)
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                       URGENT
                    </div>
                 @endif
                    <button class="absolute top-3 right-3 bg-white hover:bg-violet-500 hover:text-white text-gray-600 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-300">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $pet->name }}</h3>
                    <div class="text-violet-500 text-sm mb-4 flex items-center gap-1">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $pet->location->city }}, {{ $pet->location->state }}
                    </div>
                    <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                        <div><strong>Gender:</strong> {{ $pet->gender }}</div>
                        <div><strong>Breed:</strong> {{ $pet->breed->name }}</div>
                        <div><strong>Age:</strong> {{ $pet->age_display }}</div>
                        <div><strong>Size:</strong> {{ $pet->size }}</div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($pet->description, 100) }}</p>
                    <button onclick="window.location.href='{{ route('adoption.show', $pet) }}'" class="w-full py-3 border-2 border-violet-500 text-violet-500 hover:bg-violet-500 hover:text-white rounded-full font-semibold transition-all duration-300">
                        More Info
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('adoption.index') }}" class="inline-block py-3 px-8 border-2 border-violet-500 text-violet-500 hover:bg-violet-500 hover:text-white rounded-full font-semibold transition-all duration-300">
                See more
            </a>
        </div>
    </div>
</section>



<!-- Steps Section -->
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">
            Adopt or Rehome a pet in just<br>3 Easy Steps
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <div class="relative p-8">
                <div class="w-15 h-15 bg-violet-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    1
                </div>
                <div class="w-20 h-20 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl text-violet-500">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="text-xl text-gray-800 mb-4">Set up your profile, including important preferences</h3>
                <p class="text-gray-600 leading-relaxed">Create your account and tell us about your preferences for the perfect pet match.</p>
                <!-- Connection line -->
                <div class="hidden md:block absolute top-8 -right-1/2 w-full h-0.5 bg-violet-500 opacity-30 z-0"></div>
            </div>
            <div class="relative p-8">
                <div class="w-15 h-15 bg-violet-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    2
                </div>
                <div class="w-20 h-20 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl text-violet-500">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="text-xl text-gray-800 mb-4">Describe your home and living environment situation</h3>
                <p class="text-gray-600 leading-relaxed">Help us understand your living situation to find the best companion for your home.</p>
                <!-- Connection line -->
                <div class="hidden md:block absolute top-8 -right-1/2 w-full h-0.5 bg-violet-500 opacity-30 z-0"></div>
            </div>
            <div class="relative p-8">
                <div class="w-15 h-15 bg-violet-500 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    3
                </div>
                <div class="w-20 h-20 bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl text-violet-500">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="text-xl text-gray-800 mb-4">Start your search!</h3>
                <p class="text-gray-600 leading-relaxed">Browse our available pets and start your journey to finding your new best friend.</p>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Pet News</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="h-44 bg-cover bg-center" style="background-image: url('/images/news/dog-breeds.jpg')"></div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dog Breeds</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">The group of dogs of the original dog includes hunting dogs, guard breeds, shepherd dogs and crossbreeds of sled dogs.</p>
                    <a href="#" class="text-violet-500 font-semibold hover:text-violet-600 transition-colors">Read more</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="h-44 bg-cover bg-center" style="background-image: url('/images/news/training-cats.jpg')"></div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Training cats</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">The process of training the animal is to be gradual, start from the initial commands and gradually move to the next step.</p>
                    <a href="#" class="text-violet-500 font-semibold hover:text-violet-600 transition-colors">Read more</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="h-44 bg-cover bg-center" style="background-image: url('/images/news/nutrition-dogs.jpg')"></div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Nutrition of dogs</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">Food moderations for animals are a common problem. Dogs and cats can get liver and kidney problems.</p>
                    <a href="#" class="text-violet-500 font-semibold hover:text-violet-600 transition-colors">Read more</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="h-44 bg-cover bg-center" style="background-image: url('/images/news/cat-behavior.jpg')"></div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Cat behavior</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">Cats communicate with each other and with humans through behavioral signals, vocalizations and scent.</p>
                    <a href="#" class="text-violet-500 font-semibold hover:text-violet-600 transition-colors">Read more</a>
                </div>
            </div>
        </div>
        <div class="flex gap-4 mt-8 justify-center">
            <a href="#" class="px-5 py-2 bg-gray-100 border-2 border-gray-200 rounded-full text-gray-600 font-medium hover:border-violet-500 hover:text-violet-500 transition-all duration-300">Cat News</a>
            <a href="#" class="px-5 py-2 bg-gray-100 border-2 border-gray-200 rounded-full text-gray-600 font-medium hover:border-violet-500 hover:text-violet-500 transition-all duration-300">Dog News</a>
        </div>
    </div>
</section>

<!-- Human & Animals Section -->
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-8 leading-tight">
                    Peaceful Coexistence<br>Human & Animals
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-violet-500 to-violet-400 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4 class="text-lg text-gray-800 mb-2 font-semibold">Emotional relationship</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">The emotional bond between pets and humans is deeply rooted in human unconditional love and care.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-violet-500 to-violet-400 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4 class="text-lg text-gray-800 mb-2 font-semibold">Communication</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Animals can communicate better with people in such conditions, as verbal communication is replaced with non-verbal.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-violet-500 to-violet-400 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4 class="text-lg text-gray-800 mb-2 font-semibold">Children and pets</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Pets establish emotional attachments to children and this often goes on well. Being around children to enhance social skills contributes to improved heart health.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-violet-500 to-violet-400 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl">
                            <i class="fas fa-plus-square"></i>
                        </div>
                        <h4 class="text-lg text-gray-800 mb-2 font-semibold">Health</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">Some studies suggest that owning a pet can reduce stress levels, lower blood pressure and even help to improve heart health.</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center text-6xl text-violet-500">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">What People say about us</h2>
        <div class="relative overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto mb-4 bg-cover bg-center" style="background-image: url('/images/testimonials/angela.jpg')"></div>
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Angela Hernandez</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">I want to thank everyone who worked and was involved in my pet's shelter process. I learned a lot and was educated at every step of the process. I was especially grateful that there was a trainer...</p>
                </div>
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto mb-4 bg-cover bg-center" style="background-image: url('/images/testimonials/carl.jpg')"></div>
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Carl Bryson</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">My wife and I want to thank FurryFriends for their wonderful service. When I was looking to get a dog my sister reached out to the staff. I asked them about specific...</p>
                </div>
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto mb-4 bg-cover bg-center" style="background-image: url('/images/testimonials/ana.jpg')"></div>
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Ana Jonson</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">We got our sweet rabbit Rex from this place. We did our research and found this highly rated no-kill shelter. We want to find a young rabbit and they were...</p>
                </div>
                <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mx-auto mb-4 bg-cover bg-center" style="background-image: url('/images/testimonials/javier.jpg')"></div>
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2">Javier Dino Martinez</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">Best pet rescue center in the city. We got our rescued lovely dogs from this location. The staff was very friendly and helpful...</p>
                </div>
            </div>
            <div class="flex justify-center gap-4 mt-8">
                <button onclick="previousTestimonial()" class="w-10 h-10 rounded-full bg-violet-500 hover:bg-violet-600 text-white border-none cursor-pointer flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button onclick="nextTestimonial()" class="w-10 h-10 rounded-full bg-violet-500 hover:bg-violet-600 text-white border-none cursor-pointer flex items-center justify-center transition-all duration-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">Frequently Asked Questions</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                <div class="w-20 h-20 bg-violet-500 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-3xl">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">FAQ's for Pet Adopters</h3>
                <p class="text-gray-600 leading-relaxed">If you are thinking about adopting a pet, we know you have tons of questions. And that's one of the most frequently asked questions.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                <div class="w-20 h-20 bg-violet-500 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white text-3xl">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">FAQ's for Pet Rehomers</h3>
                <p class="text-gray-600 leading-relaxed">Finding a new home for your pet doesn't need to be a daunting task.</p>
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
@endsection