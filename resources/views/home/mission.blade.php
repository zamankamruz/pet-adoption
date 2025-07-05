<?php
// File: about.blade.php
// Path: /resources/views/home/mission.blade.php
?>

@extends('layouts.app')

@section('content')

<section class="bg-gray-50 px-8 relative overflow-hidden">
  <!-- Hero Section with Cat Image and Mission Overlay -->
  <div class="relative h-screen">
    
    <!-- Cat Image -->
    <div class="h-full bg-cover bg-center">
      <img src="{{ asset('images/mission.jpeg') }}" 
           alt="Woman with pets" 
           class="w-full object-cover">
    </div>
    
    <!-- Mission Statement Overlay at Bottom -->
    <div class="absolute bottom-16 left-0 right-0 bg-white bg-opacity-95 backdrop-blur-sm border border-[#ddd] border-2">
      <div class="max-w-4xl mx-auto py-2 text-center">
        <h1 class="text-xl font-semibold text-gray-800 mb-3">Our Mission</h1>
        <p class="text-sm text-gray-600 leading-relaxed">
          Furry-Friends is a lifesaving nonprofit bringing pets and people together.<br>
          We are here to create loving families.
        </p>
      </div>
    </div>

  </div>
</section>

        

    <!-- What We Do Section -->
<section class="bg-gray-50 px-8 relative overflow-hidden">
  <div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
        
        <!-- Content -->
        <div class="lg:col-span-2">
          <h2 class="text-2xl font-semibold text-gray-900 mb-6">What We Do</h2>
          
          <div class="space-y-4 text-base text-gray-700 leading-relaxed">
            <p>
              We're a safer, more professional and ethical alternative to sites like 
              Facebook, Preloved, Pets4Homes and Gumtree.
            </p>
            <p>
              Our platform connects potential adopters with people who need to rehome 
              their pets, dogs and cats. This makes it easier for good people to adopt the 
              right pet whilst maximizing the chance of pets finding their forever home.
            </p>
            <p>
              We offer a non-judgemental service to rehomers and give them full control of 
              the process. We're also helping to reduce the number of animals going into 
              rescue shelters, many of which are full to capacity. Pets that would have been 
              abandoned, need immediate help or specialist care.
            </p>
          </div>
        </div>

        <!-- Statistics -->
        <div class="space-y-6">
          <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div class="text-xl font-bold text-purple-600 mb-1">4.2 million</div>
            <div class="text-gray-600 text-sm">pets Rehomed</div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg text-center">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
              </svg>
            </div>
            <div class="text-xl font-bold text-green-600 mb-1">6.8 million</div>
            <div class="text-gray-600 text-sm">pets adopted</div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>



<!-- Dog and Human Section -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
      
      <!-- Image -->
      <div class="order-2 lg:order-1">
        <img 
          src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
          alt="Human with dog" 
          class="w-full h-80 object-cover rounded-2xl shadow-xl"
        >
      </div>
      
      <!-- Content -->
      <div class="order-1 lg:order-2 text-center lg:text-left">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 leading-snug">
          Creating loving families through pet adoption
        </h2>
        <p class="text-sm text-gray-700 leading-relaxed">
          When a family adopts a pet, everything changes for the better. There's a connection that builds. Love fills the home.
          Petco Love Adopt's purpose is to help pets in need find their forever families and spread that special breed of love to as many homes as possible.
        </p>
      </div>
      
    </div>
  </div>
</section>



<!-- Our Team Section -->
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-semibold text-center text-gray-900 mb-12">Our Team</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

      <!-- Team Member 1 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Doe" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">John Doe</h3>
        <p class="text-xs text-gray-600">CEO</p>
      </div>

      <!-- Team Member 2 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Michael Smith" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Michael Smith</h3>
        <p class="text-xs text-gray-600">Veterinarian</p>
      </div>

      <!-- Team Member 3 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="David Carter" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">David Carter</h3>
        <p class="text-xs text-gray-600">Senior Data Scientist</p>
      </div>

      <!-- Team Member 4 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/66.jpg" alt="Leo Saris" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Leo Saris</h3>
        <p class="text-xs text-gray-600">Director of Engineering</p>
      </div>

      <!-- Team Member 5 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/35.jpg" alt="Alfredo Dokidis" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Alfredo Dokidis</h3>
        <p class="text-xs text-gray-600">Front End Developer</p>
      </div>

      <!-- Team Member 6 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/10.jpg" alt="Thomas Carder" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Thomas Carder</h3>
        <p class="text-xs text-gray-600">Product Associate</p>
      </div>

      <!-- Team Member 7 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Madelyn Calzoni" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Madelyn Calzoni</h3>
        <p class="text-xs text-gray-600">Back End Developer</p>
      </div>

      <!-- Team Member 8 -->
      <div class="text-center group transition-all duration-300 hover:scale-[1.02]">
        <div class="w-28 h-28 mx-auto mb-3 rounded-full overflow-hidden shadow-md">
          <img src="https://randomuser.me/api/portraits/men/28.jpg" alt="Ann Westervelt" class="w-full h-full object-cover" />
        </div>
        <h3 class="text-base font-medium text-gray-800">Ann Westervelt</h3>
        <p class="text-xs text-gray-600">Senior Data Scientist</p>
      </div>

    </div>
  </div>
</section>




<!-- Final Section with Family -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 text-center">
    
    <h2 class="text-2xl font-semibold text-gray-900 mb-2">
      Furry Friends
    </h2>
    
    <p class="text-sm text-gray-600 mb-8">
      Brings happiness to your family
    </p>

    <div class="rounded-2xl overflow-hidden shadow-lg ring-1 ring-gray-100">
      <img 
        src="{{ asset('images/cat.jpg') }}" 
        alt="Family with pets" 
        class="w-full h-80 object-cover"
      >
    </div>

  </div>
</section>


</div>
@endsection