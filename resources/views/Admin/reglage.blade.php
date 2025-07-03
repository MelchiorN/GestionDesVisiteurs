@extends('layouts.admin') {{-- Indique que cette vue hérite du layout admin --}}

@section('title', 'Paramètres de l\'Immeuble') {{-- Définit le titre spécifique de cette page --}}

@section('content') {{-- Début de la section content définie dans le layout --}}
    <div class="container mx-auto px-4 py-8 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-6 drop-shadow-sm">
            <i class="fas fa-building text-indigo-600 mr-3"></i> Gestion des Paramètres de l'Immeuble
        </h1>
        <p class="text-center text-gray-600 text-lg mb-10">
            Configurez les informations essentielles, la géolocalisation et les services de votre immeuble.
        </p>

        {{-- Messages de succès ou d'erreur --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-md animate__animated animate__fadeInDown" role="alert">
                <strong class="font-bold"><i class="fas fa-check-circle mr-2"></i> Succès !</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';"><title>Fermer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697L11.819 10l3.029 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md animate__animated animate__shakeX" role="alert">
                <strong class="font-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Erreur de validation !</strong>
                <span class="block sm:inline">Veuillez corriger les erreurs suivantes :</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';"><title>Fermer</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697L11.819 10l3.029 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        <form action="{{ route('admin.parametre.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf {{-- Protection CSRF --}}
            @method('PUT') {{-- Pour une requête PUT/PATCH --}}

            <!-- Section Informations Générales -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200 animate__animated animate__fadeInUp">
                <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                    <i class="fas fa-info-circle text-2xl text-indigo-500 mr-3"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Informations Générales de l'Immeuble</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="building_name" class="block text-gray-700 text-sm font-medium mb-2">Nom de l'immeuble <span class="text-red-500">*</span></label>
                        <input type="text" id="building_name" name="building_name" value="{{ old('building_name', $building->name ?? '') }}" placeholder="Nom de votre immeuble" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 shadow-sm">
                        @error('building_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700 text-sm font-medium mb-2">Adresse physique <span class="text-red-500">*</span></label>
                        <input type="text" id="address" name="address" value="{{ old('address', $building->address ?? '') }}" placeholder="Adresse complète de l'immeuble" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 shadow-sm">
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Description de l'immeuble</label>
                    <textarea id="description" name="description" rows="5" placeholder="Décrivez votre immeuble, ses caractéristiques, etc."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 shadow-sm">{{ old('description', $building->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="main_photo" class="block text-gray-700 text-sm font-medium mb-2">Logo/Photo principale de l'immeuble</label>
                    <input type="file" id="main_photo" name="main_photo" accept="image/*"
                           class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    @error('main_photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if(isset($building->main_photo_path) && $building->main_photo_path)
                        <div class="mt-4 text-center">
                            <img src="{{ asset('storage/' . $building->main_photo_path) }}" alt="Photo principale actuelle" class="max-w-xs h-auto rounded-lg border-2 border-indigo-500 shadow-md mx-auto object-cover">
                            <p class="text-gray-500 text-sm mt-2">Photo principale actuelle</p>
                        </div>
                    @else
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mt-4 text-center">
                            <i class="fas fa-exclamation-circle mr-2"></i> Aucune photo principale n'est définie.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section Géolocalisation -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200 animate__animated animate__fadeInUp animate__delay-0-2s">
                <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                    <i class="fas fa-map-marker-alt text-2xl text-purple-500 mr-3"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Géolocalisation</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="latitude" class="block text-gray-700 text-sm font-medium mb-2">Latitude</label>
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $building->latitude ?? '') }}" placeholder="Ex: 6.1306"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 shadow-sm">
                        @error('latitude')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-gray-700 text-sm font-medium mb-2">Longitude</label>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $building->longitude ?? '') }}" placeholder="Ex: 1.2238"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-200 shadow-sm">
                        @error('longitude')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-center mt-6">
                    <button type="button" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-lg hover:bg-purple-700 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50" id="locateOnMap">
                        <i class="fas fa-crosshairs mr-2"></i> Localiser sur la carte
                    </button>
                </div>
                <div id="map" class="mt-8 h-96 w-full rounded-lg shadow-md border border-gray-300 overflow-hidden">
                    {{-- Placeholder pour la carte (vous pouvez remplacer ceci par une véritable API de carte) --}}
                    <iframe
                        src="https://www.openstreetmap.org/export/embed.html?bbox=2.0641%2C6.1159%2C2.1041%2C6.1559&amp;layer=mapnik"
                        class="w-full h-full border-0"
                        allowfullscreen
                        loading="lazy"
                        title="Carte de Lomé"
                    ></iframe>
                </div>
            </div>

            <!-- Section Photos Supplémentaires -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200 animate__animated animate__fadeInUp animate__delay-0-4s">
                <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                    <i class="fas fa-images text-2xl text-green-500 mr-3"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Photos Supplémentaires de l'Immeuble</h2>
                </div>
                <div class="mb-6">
                    <label for="additional_photos" class="block text-gray-700 text-sm font-medium mb-2">Ajouter d'autres photos</label>
                    <input type="file" id="additional_photos" name="additional_photos[]" multiple accept="image/*"
                           class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                    <p class="text-gray-500 text-sm mt-2">Sélectionnez plusieurs images pour enrichir la galerie de votre immeuble.</p>
                    @error('additional_photos')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4" id="additional-photos-preview">
                    {{-- Cette section est un placeholder. La logique pour afficher et supprimer les photos existantes doit être implémentée côté serveur et client. --}}
                    {{-- Exemple si $building->images est une collection d'objets avec une propriété 'path' : --}}
                    {{-- @if(isset($building->images) && $building->images->count() > 0)
                        @foreach($building->images as $photo)
                            <div class="relative group rounded-lg overflow-hidden shadow-sm border border-gray-200">
                                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-32 object-cover" alt="Photo additionnelle">
                                <button type="button" class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300" title="Supprimer cette photo">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full bg-gray-50 border border-gray-200 text-gray-600 px-4 py-3 rounded-lg text-center">
                            <i class="fas fa-camera mr-2"></i> Aucune photo supplémentaire n'est encore ajoutée.
                        </div>
                    @endif --}}
                    <div class="col-span-full bg-gray-50 border border-gray-200 text-gray-600 px-4 py-3 rounded-lg text-center">
                        <i class="fas fa-camera mr-2"></i> Les photos supplémentaires seront affichées ici après le développement de la logique de stockage et d'affichage.
                    </div>
                </div>
            </div>

            <!-- Section Contact Principal -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200 animate__animated animate__fadeInUp animate__delay-0-6s">
                <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                    <i class="fas fa-headset text-2xl text-orange-500 mr-3"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Contact Principal</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="contact_name" class="block text-gray-700 text-sm font-medium mb-2">Nom du contact</label>
                        <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name', $building->contact_name ?? '') }}" placeholder="Nom complet de la personne de contact"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 transition duration-200 shadow-sm">
                        @error('contact_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-gray-700 text-sm font-medium mb-2">Numéro de téléphone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $building->contact_phone ?? '') }}" placeholder="Ex: +228 90 12 34 56"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 transition duration-200 shadow-sm">
                        @error('contact_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_email" class="block text-gray-700 text-sm font-medium mb-2">Adresse e-mail</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $building->contact_email ?? '') }}" placeholder="contact@votreimmeuble.com"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 transition duration-200 shadow-sm">
                        @error('contact_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section Autres Paramètres -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200 animate__animated animate__fadeInUp animate__delay-0-8s">
                <div class="flex items-center mb-6 pb-4 border-b border-gray-200">
                    <i class="fas fa-cogs text-2xl text-teal-500 mr-3"></i>
                    <h2 class="text-2xl font-semibold text-gray-800">Autres Paramètres</h2>
                </div>
                <div class="mb-6">
                    <label for="opening_hours" class="block text-gray-700 text-sm font-medium mb-2">Jours et heures d'ouverture/accès</label>
                    <textarea id="opening_hours" name="opening_hours" rows="3" placeholder="Ex: Du Lundi au Vendredi, 8h - 18h ; Samedi, 9h - 13h"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 transition duration-200 shadow-sm">{{ old('opening_hours', $building->opening_hours ?? '') }}</textarea>
                    <p class="text-gray-500 text-sm mt-2">Indiquez les plages horaires d'accès à l'immeuble.</p>
                    @error('opening_hours')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="available_services" class="block text-gray-700 text-sm font-medium mb-2">Services disponibles (séparés par des virgules)</label>
                    <input type="text" id="available_services" name="available_services" value="{{ old('available_services', $building->available_services ?? '') }}" placeholder="Ex: Parking, Wi-Fi, Salle de réunion, Sécurité 24/7"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 transition duration-200 shadow-sm">
                    <p class="text-gray-500 text-sm mt-2">Liste des commodités offertes par l'immeuble.</p>
                    @error('available_services')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="building_policies" class="block text-gray-700 text-sm font-medium mb-2">Politiques de l'immeuble</label>
                    <textarea id="building_policies" name="building_policies" rows="5" placeholder="Règles de vie, politiques de recyclage, règles concernant les animaux, etc."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 transition duration-200 shadow-sm">{{ old('building_policies', $building->building_policies ?? '') }}</textarea>
                    <p class="text-gray-500 text-sm mt-2">Informations importantes pour les résidents et visiteurs.</p>
                    @error('building_policies')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-center gap-6 mt-10 mb-10 animate__animated animate__fadeInUp animate__delay-1s">
                <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                    <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('admin.accueil') }}" class="px-8 py-3 bg-gray-300 text-gray-800 font-bold rounded-full shadow-lg hover:bg-gray-400 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300 focus:ring-opacity-50">
                    <i class="fas fa-times-circle mr-2"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection {{-- Fin de la section content --}}

@push('styles')
    {{-- Font Awesome pour les icônes --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" xintegrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoIF2w/F0Z5wQ/h4FwA+0Fh4f2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Animate.css pour les animations (optionnel mais sympa) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@push('scripts')
    {{-- Script pour la validation Bootstrap (si vous l'utilisez toujours pour la validation côté client) --}}
    
@endpush
