<?php
// File: about.blade.php
// Path: /resources/views/home/about.blade.php
?>

@extends('layouts.app')

@section('content')


    <section class="bg-gray-50  px-8 py-3 relative overflow-hidden">
    <!-- Hero Section with Cat Image and Mission Overlay -->
        <div class="relative h-screen">
            <!-- Cat Image -->
            <div class="h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2043&q=80');">
            </div>
                        
            <!-- Mission Statement Overlay at Bottom -->
            <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-95 backdrop-blur-sm border border-[##ddd] border-2">
                <div class="max-w-4xl mx-auto px-8 py-8 text-center">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Furry-Friends is a lifesaving nonprofit bringing pets and people together.<br>
                        We are here to create loving families.
                    </p>
                </div>
            </div>

        </div>
    </section>
        

    <!-- What We Do Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                <!-- Content -->
                <div class="lg:col-span-2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8">What We Do</h2>
                    
                    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
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
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600 mb-2">4.2 million</div>
                        <div class="text-gray-600">pets Rehomed</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-8 shadow-lg text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-green-600 mb-2">6.8 million</div>
                        <div class="text-gray-600">pets adopted</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dog and Human Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                         alt="Human with dog" 
                         class="w-full h-96 object-cover rounded-3xl shadow-2xl">
                </div>
                <div class="order-1 lg:order-2 text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Creating loving families through pet adoption</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        When a family adopts a pet, everything changes for the better. There's a connection that builds. Love fills the home. And every 
                        Petco Love Adopt's purpose is to help pets in need find their forever families and spread that special breed of love to as many 
                        homes as possible.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-16">Our Team</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b47c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Anika Septimus" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Anika Septimus</h3>
                    <p class="text-gray-600 text-sm">CEO</p>
                </div>

                <!-- Team Member 2 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                             alt="Alfonso Curtis" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Alfonso Curtis</h3>
                    <p class="text-gray-600 text-sm">Veterinarian</p>
                </div>

                <!-- Team Member 3 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Carter Baptista" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Carter Baptista</h3>
                    <p class="text-gray-600 text-sm">Senior Data Scientist</p>
                </div>

                <!-- Team Member 4 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                             alt="Leo Saris" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Leo Saris</h3>
                    <p class="text-gray-600 text-sm">Director of Engineering</p>
                </div>

                <!-- Team Member 5 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Alfredo Dokidis" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Alfredo Dokidis</h3>
                    <p class="text-gray-600 text-sm">Front End Developer</p>
                </div>

                <!-- Team Member 6 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80" 
                             alt="Tatiana Carder" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Tatiana Carder</h3>
                    <p class="text-gray-600 text-sm">Product Associate</p>
                </div>

                <!-- Team Member 7 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Madelyn Calzoni" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Madelyn Calzoni</h3>
                    <p class="text-gray-600 text-sm">Back End Developer</p>
                </div>

                <!-- Team Member 8 -->
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1171&q=80" 
                             alt="Ann Westervelt" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-gray-900">Ann Westervelt</h3>
                    <p class="text-gray-600 text-sm">Senior Data Scientist</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Section with Family -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Furry Friends</h2>
            <p class="text-2xl text-gray-600 mb-12">Brings happiness to your family</p>
            
            <div class="rounded-3xl overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                     alt="Family with pets" 
                     class="w-full h-96 object-cover">
            </div>
        </div>
    </div>

</div>
@endsection