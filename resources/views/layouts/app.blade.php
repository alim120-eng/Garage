<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Fair Wind Garage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Initialization to prevent FOUC -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <!-- Inline style for the loader to ensure it displays correctly -->
    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.1);
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-950">

<!-- LOADER -->
<div id="loader">
    <div class="spinner"></div>
</div>

<!-- NAVBAR -->
@include('layouts.navigation')

<!-- PAGE CONTENT -->
<main>
    {{ $slot }}
</main>

<!-- LIGHTBOX MODAL FOR MULTIPLE IMAGES -->
<div id="global-lightbox" class="fixed inset-0 bg-black/90 backdrop-blur-md z-[9999] hidden flex-col justify-center items-center opacity-0 transition-opacity duration-300">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white text-3xl focus:outline-none transition z-[10000] p-2 hover:scale-110">
        ✕
    </button>
    
    <button id="lightbox-prev" onclick="prevLightboxImage()" class="absolute left-6 text-white/70 hover:text-white hover:bg-white/10 p-3 rounded-full text-3xl focus:outline-none transition z-[10000]">
        ❮
    </button>
    
    <div class="relative max-w-4xl max-h-[80vh] w-full flex items-center justify-center p-4">
        <img id="lightbox-image" src="" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl object-contain border border-gray-800 transition-all duration-300 transform scale-95 opacity-0">
    </div>
    
    <button id="lightbox-next" onclick="nextLightboxImage()" class="absolute right-6 text-white/70 hover:text-white hover:bg-white/10 p-3 rounded-full text-3xl focus:outline-none transition z-[10000]">
        ❯
    </button>

    <div id="lightbox-counter" class="mt-4 text-xs font-bold text-gray-400 tracking-wider">
        0 / 0
    </div>
    
    <div id="lightbox-thumbnails" class="mt-4 flex gap-2 overflow-x-auto max-w-xl px-4 py-2">
        <!-- populated dynamically -->
    </div>
</div>

<script>
    window.addEventListener("load", () => {
        const loader = document.getElementById("loader");
        if (loader) {
            loader.style.transition = "opacity 0.3s ease";
            loader.style.opacity = "0";
            setTimeout(() => {
                loader.style.display = "none";
            }, 300);
        }
    });

    // LIGHTBOX SCRIPT
    let lightboxImages = [];
    let currentLightboxIndex = 0;

    function openLightbox(imagesJsonStr, startIndex = 0) {
        try {
            // Unescape or clean JSON if needed, handle array decoding
            let images = [];
            if (typeof imagesJsonStr === 'string') {
                images = JSON.parse(imagesJsonStr);
            } else if (Array.isArray(imagesJsonStr)) {
                images = imagesJsonStr;
            }
            
            if (!Array.isArray(images) || images.length === 0) return;
            
            lightboxImages = images;
            currentLightboxIndex = startIndex;
            const lightbox = document.getElementById('global-lightbox');
            
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
            
            updateLightboxImage();
        } catch(e) {
            console.error("Failed to parse lightbox images", e);
        }
    }

    function closeLightbox() {
        const lightbox = document.getElementById('global-lightbox');
        const img = document.getElementById('lightbox-image');
        
        lightbox.classList.add('opacity-0');
        img.classList.add('opacity-0', 'scale-95');
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }, 300);
    }

    function updateLightboxImage() {
        if (lightboxImages.length === 0) return;
        if (currentLightboxIndex < 0) currentLightboxIndex = lightboxImages.length - 1;
        if (currentLightboxIndex >= lightboxImages.length) currentLightboxIndex = 0;
        
        const img = document.getElementById('lightbox-image');
        img.classList.add('opacity-0', 'scale-95');
        
        setTimeout(() => {
            img.src = lightboxImages[currentLightboxIndex];
            img.onload = () => {
                img.classList.remove('opacity-0', 'scale-95');
            };
        }, 150);
        
        document.getElementById('lightbox-counter').innerText = `${currentLightboxIndex + 1} / ${lightboxImages.length}`;
        
        const thumbsContainer = document.getElementById('lightbox-thumbnails');
        thumbsContainer.innerHTML = '';
        
        if (lightboxImages.length > 1) {
            lightboxImages.forEach((src, idx) => {
                const thumb = document.createElement('div');
                thumb.className = `w-12 h-12 rounded-lg overflow-hidden border-2 cursor-pointer transition ${idx === currentLightboxIndex ? 'border-blue-500 scale-105' : 'border-transparent opacity-60 hover:opacity-100'}`;
                thumb.innerHTML = `<img src="${src}" class="w-full h-full object-cover">`;
                thumb.onclick = () => {
                    currentLightboxIndex = idx;
                    updateLightboxImage();
                };
                thumbsContainer.appendChild(thumb);
            });
        }
    }

    function nextLightboxImage() {
        currentLightboxIndex++;
        updateLightboxImage();
    }

    function prevLightboxImage() {
        currentLightboxIndex--;
        updateLightboxImage();
    }

    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('global-lightbox');
        if (lightbox && !lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextLightboxImage();
            if (e.key === 'ArrowLeft') prevLightboxImage();
        }
    });
</script>

</body>
</html>