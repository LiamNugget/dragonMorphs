@extends('layouts.public')

@section('title', 'Available Morphs')

@section('content')
<div class="title_text" style="margin-top: 2rem;">
    <h1><i class="fas fa-store"></i> Available Dragons</h1>
</div>

<div class="text_box_green" style="margin-top: 2rem;">
    <p style="text-align: center;">Browse our current selection of available bearded dragons. All dragons are healthy, well-socialized, and come from premium bloodlines. Click on any dragon to learn more about their morph, age, and genetics.</p>
</div>

<style>
.morph_section {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
    justify-items: center;
}

.stock_card {
    background: #ffffff;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0, 0, 0, 0.08);
    cursor: pointer;
    width: 100%;
    max-width: 400px;
}

.stock_card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(64, 114, 0, 0.2);
}

.card_image_container {
    position: relative;
    overflow: hidden;
    height: 280px;
    background: #f5f5f5;
}

.stock_card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.stock_card:hover img {
    transform: scale(1.08);
}

.stock_details {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.dragon_name {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.dragon_info_grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.info_item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info_label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #407200;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info_value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
}

.dragon_description {
    color: #666;
    line-height: 1.5;
    margin: 0.75rem 0;
    flex-grow: 1;
    font-size: 0.9rem;
}

.card_footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    margin-top: auto;
    border-top: 1px solid rgba(0, 0, 0, 0.06);
}

.morph_price {
    font-size: 1.75rem;
    font-weight: 800;
    color: #407200;
}

.status_badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status_badge i {
    font-size: 0.7rem;
}

.status_available {
    background: #4caf50;
    color: white;
}

.status_reserved {
    background: #ff9800;
    color: white;
}

.no_dragons {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, rgba(64, 114, 0, 0.9) 0%, rgba(94, 167, 0, 0.85) 100%);
    border-radius: 4px;
    box-shadow: 0 10px 40px rgba(64, 114, 0, 0.3);
}

.no_dragons p {
    color: white;
    font-size: 1.3rem;
    font-weight: 600;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.8);
    animation: fadeIn 0.3s;
}

.modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    margin: 2rem;
    border-radius: 4px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.modal-close {
    position: absolute;
    right: 1rem;
    top: 1rem;
    font-size: 2rem;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    z-index: 10;
    width: 40px;
    height: 40px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}

.modal-close:hover {
    background: rgba(0, 0, 0, 0.8);
}

.modal-slideshow {
    position: relative;
    width: 100%;
    height: 500px;
    background: #000;
    overflow: hidden;
}

.modal-slide {
    display: none;
    width: 100%;
    height: 100%;
    position: relative;
}

.modal-slide.active {
    display: block;
}

.slide-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    filter: blur(20px);
    transform: scale(1.1);
    opacity: 0.6;
}

.modal-slide img {
    position: relative;
    width: 100%;
    height: 100%;
    object-fit: contain;
    z-index: 1;
}

.slide-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.5rem;
    color: #407200;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 100;
}

.slide-nav:hover {
    background: #fff;
    transform: translateY(-50%) scale(1.1);
}

.slide-prev {
    left: 1rem;
    z-index: 100;
}

.slide-next {
    right: 1rem;
    z-index: 100;
}

.slide-indicators {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 100;
}

.slide-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background 0.3s;
}

.slide-indicator.active {
    background: #fff;
}

.modal-details {
    padding: 2rem;
}

.modal-header {
    margin-bottom: 2rem;
    text-align: center;
}

.modal-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.modal-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 2rem;
}

.modal-info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.modal-info-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: #407200;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modal-info-value {
    font-size: 1rem;
    font-weight: 600;
    color: #2c3e50;
}

.modal-price-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 0;
    border-top: 1px solid rgba(0, 0, 0, 0.06);
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    margin-bottom: 2rem;
}

.modal-price {
    font-size: 2rem;
    font-weight: 800;
    color: #407200;
}

.modal-description {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f9f9f9;
    border-radius: 4px;
    line-height: 1.6;
    color: #666;
}

.modal-parents {
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(33, 150, 243, 0.05);
    border-radius: 4px;
    border: 2px solid #2196F3;
    text-align: center;
}

.modal-parents-title {
    font-size: 0.8rem;
    font-weight: 700;
    color: #2196F3;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.parent-hint {
    font-size: 0.75rem;
    color: #666;
    font-style: italic;
    margin-bottom: 1rem;
}

.parent-links {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.parent-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #2196F3;
    text-decoration: none;
    font-weight: 600;
    padding: 0.5rem 1rem;
    background: rgba(33, 150, 243, 0.1);
    border-radius: 4px;
    transition: all 0.3s;
    position: relative;
}

.parent-link:hover {
    background: rgba(33, 150, 243, 0.2);
    transform: translateY(-2px);
}

.parent-link i {
    font-size: 1rem;
}

.parent-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 0.75rem;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
    z-index: 10;
    min-width: 250px;
}

.parent-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 8px solid transparent;
    border-top-color: #fff;
}

.parent-link:hover .parent-tooltip {
    opacity: 1;
}

.tooltip-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 4px 4px 0 0;
    background: #f5f5f5;
}

.tooltip-content {
    padding: 1rem;
}

.tooltip-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.tooltip-info {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.5;
}

.parent-card {
    padding: 1rem;
    background: rgba(33, 150, 243, 0.05);
    border-radius: 4px;
    border-left: 3px solid #2196F3;
}

@media (max-width: 768px) {
    .morph_section {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .card_image_container {
        height: 220px;
    }

    .dragon_info_grid {
        grid-template-columns: 1fr;
    }

    .modal-content {
        margin: 0;
        max-height: 100vh;
        border-radius: 0;
    }

    .modal-slideshow {
        height: 300px;
    }

    .modal-details {
        padding: 1.5rem;
    }

    .modal-info-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .modal-price-section {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .parent-links {
        flex-direction: column;
    }

    .parent-link {
        width: 100%;
    }
}

.modal-slide img {
    cursor: zoom-in;
}

.modal-slide::after {
    content: '\f065';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 0.4rem 0.6rem;
    border-radius: 4px;
    font-size: 0.85rem;
    z-index: 10;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.3s;
}

.modal-slide:hover::after {
    opacity: 1;
}

.lightbox {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    align-items: center;
    justify-content: center;
    cursor: zoom-out;
}

.lightbox.active {
    display: flex;
    animation: fadeIn 0.2s;
}

.lightbox-img {
    max-width: 95vw;
    max-height: 95vh;
    object-fit: contain;
    cursor: default;
    user-select: none;
}

.lightbox-close {
    position: absolute;
    right: 1.5rem;
    top: 1.5rem;
    font-size: 2rem;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    z-index: 10;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
    line-height: 1;
}

.lightbox-close:hover {
    background: rgba(255, 255, 255, 0.35);
}
</style>

@if($dragons->count() > 0)
    <div class="morph_section">
        @foreach($dragons as $dragon)
            <div class="stock_card" onclick="openModal({{ $dragon->id }})">
                <div class="card_image_container">
                    @if($dragon->primaryImage)
                        <img src="{{ asset('storage/' . $dragon->primaryImage->image_path) }}" alt="{{ $dragon->name ?? 'Dragon' }}">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 1.2rem;">
                            <i class="fas fa-dragon" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                </div>
                
                <div class="stock_details">
                    <h2 class="dragon_name">{{ $dragon->name ?? 'Unnamed Dragon' }}</h2>
                    
                    <div class="dragon_info_grid">
                        <div class="info_item">
                            <span class="info_label">Morph</span>
                            <span class="info_value">{{ $dragon->morph }}</span>
                        </div>
                        <div class="info_item">
                            <span class="info_label">Sex</span>
                            <span class="info_value">{{ ucfirst($dragon->sex) }}</span>
                        </div>
                        <div class="info_item">
                            <span class="info_label">Age</span>
                            <span class="info_value">{{ $dragon->age }}</span>
                        </div>
                        @if($dragon->weight)
                            <div class="info_item">
                                <span class="info_label">Weight</span>
                                <span class="info_value">{{ $dragon->weight }}g</span>
                            </div>
                        @endif
                    </div>
                    
                    @if($dragon->description)
                        <p class="dragon_description">{{ Str::limit($dragon->description, 100) }}</p>
                    @endif
                    
                    <div class="card_footer">
                        @if($dragon->price)
                            <span class="morph_price">£{{ number_format($dragon->price, 2) }}</span>
                        @else
                            <span></span>
                        @endif
                        
                        @if($dragon->status === 'reserved')
                            <span class="status_badge status_reserved">
                                <i class="fas fa-clock"></i> Reserved
                            </span>
                        @elseif($dragon->status === 'available')
                            <span class="status_badge status_available">
                                <i class="fas fa-check-circle"></i> Available
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal for this dragon -->
            <div id="modal-{{ $dragon->id }}" class="modal" onclick="closeModalOnOutsideClick(event, {{ $dragon->id }})">
                <div class="modal-content" onclick="event.stopPropagation()">
                    <span class="modal-close" onclick="closeModal({{ $dragon->id }})">&times;</span>
                    
                    @if($dragon->images->count() > 0)
                        <div class="modal-slideshow">
                            @foreach($dragon->images as $index => $image)
                                <div class="modal-slide {{ $index === 0 ? 'active' : '' }}">
                                    <div class="slide-background" style="background-image: url('{{ asset('storage/' . $image->image_path) }}');"></div>
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $dragon->name }}" onclick="event.stopPropagation(); openLightbox(this.src, this.alt);">
                                </div>
                            @endforeach
                            
                            @if($dragon->images->count() > 1)
                                <button class="slide-nav slide-prev" onclick="event.stopPropagation(); changeSlide({{ $dragon->id }}, -1);">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="slide-nav slide-next" onclick="event.stopPropagation(); changeSlide({{ $dragon->id }}, 1);">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                
                                <div class="slide-indicators">
                                    @foreach($dragon->images as $index => $image)
                                        <span class="slide-indicator {{ $index === 0 ? 'active' : '' }}" 
                                              onclick="event.stopPropagation(); goToSlide({{ $dragon->id }}, {{ $index }});"></span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <div class="modal-details">
                        <div class="modal-header">
                            <h2 class="modal-title">{{ $dragon->name ?? 'Unnamed Dragon' }}</h2>
                            
                            <div class="modal-info-grid">
                                <div class="modal-info-item">
                                    <span class="modal-info-label">Morph</span>
                                    <span class="modal-info-value">{{ $dragon->morph }}</span>
                                </div>
                                <div class="modal-info-item">
                                    <span class="modal-info-label">Sex</span>
                                    <span class="modal-info-value">{{ ucfirst($dragon->sex) }}</span>
                                </div>
                                <div class="modal-info-item">
                                    <span class="modal-info-label">Age</span>
                                    <span class="modal-info-value">{{ $dragon->age }}</span>
                                </div>
                                @if($dragon->weight)
                                    <div class="modal-info-item">
                                        <span class="modal-info-label">Weight</span>
                                        <span class="modal-info-value">{{ $dragon->weight }}g</span>
                                    </div>
                                @endif
                                <div class="modal-info-item">
                                    <span class="modal-info-label">Status</span>
                                    <span class="modal-info-value">{{ ucfirst(str_replace('_', ' ', $dragon->status)) }}</span>
                                </div>
                                @if($dragon->clutch_id)
                                    <div class="modal-info-item">
                                        <span class="modal-info-label">Clutch ID</span>
                                        <span class="modal-info-value">{{ $dragon->clutch_id }}</span>
                                    </div>
                                @endif
                                @if($dragon->dob)
                                    <div class="modal-info-item">
                                        <span class="modal-info-label">Date of Birth</span>
                                        <span class="modal-info-value">{{ \Carbon\Carbon::parse($dragon->dob)->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if($dragon->date_listed)
                                    <div class="modal-info-item">
                                        <span class="modal-info-label">Listed</span>
                                        <span class="modal-info-value">{{ \Carbon\Carbon::parse($dragon->date_listed)->format('M d, Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($dragon->description)
                            <div class="modal-description">
                                {{ $dragon->description }}
                            </div>
                        @endif
                        
                        <div class="modal-price-section">
                            @if($dragon->price)
                                <div class="modal-price">£{{ number_format($dragon->price, 2) }}</div>
                            @endif
                            
                            @if($dragon->status === 'reserved')
                                <span class="status_badge status_reserved">
                                    <i class="fas fa-clock"></i> Reserved
                                </span>
                            @elseif($dragon->status === 'available')
                                <span class="status_badge status_available">
                                    <i class="fas fa-check-circle"></i> Available
                                </span>
                            @endif
                        </div>
                        
                        @if($dragon->parentMale || $dragon->parentFemale)
                            <div class="modal-parents">
                                <div class="modal-parents-title"><i class="fas fa-dna"></i> Genetics</div>
                                <div class="parent-hint">Hover over parent names to see details and photos</div>
                                <div class="parent-links">
                                    @if($dragon->parentMale)
                                        <a href="#" class="parent-link" onclick="event.preventDefault();">
                                            <i class="fas fa-mars"></i>
                                            <span>Sire: {{ $dragon->parentMale->name ?? 'Unnamed' }}</span>
                                            <div class="parent-tooltip">
                                                @if($dragon->parentMale->primaryImage)
                                                    <img class="tooltip-image" src="{{ asset('storage/' . $dragon->parentMale->primaryImage->image_path) }}" alt="{{ $dragon->parentMale->name }}">
                                                @else
                                                    <div class="tooltip-image" style="display: flex; align-items: center; justify-content: center; color: #ccc;">
                                                        <i class="fas fa-dragon" style="font-size: 3rem;"></i>
                                                    </div>
                                                @endif
                                                <div class="tooltip-content">
                                                    <div class="tooltip-name">{{ $dragon->parentMale->name ?? 'Unnamed' }}</div>
                                                    <div class="tooltip-info">
                                                        <strong>Morph:</strong> {{ $dragon->parentMale->morph }}<br>
                                                        <strong>Sex:</strong> {{ ucfirst($dragon->parentMale->sex) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    @if($dragon->parentFemale)
                                        <a href="#" class="parent-link" onclick="event.preventDefault();">
                                            <i class="fas fa-venus"></i>
                                            <span>Dam: {{ $dragon->parentFemale->name ?? 'Unnamed' }}</span>
                                            <div class="parent-tooltip">
                                                @if($dragon->parentFemale->primaryImage)
                                                    <img class="tooltip-image" src="{{ asset('storage/' . $dragon->parentFemale->primaryImage->image_path) }}" alt="{{ $dragon->parentFemale->name }}">
                                                @else
                                                    <div class="tooltip-image" style="display: flex; align-items: center; justify-content: center; color: #ccc;">
                                                        <i class="fas fa-dragon" style="font-size: 3rem;"></i>
                                                    </div>
                                                @endif
                                                <div class="tooltip-content">
                                                    <div class="tooltip-name">{{ $dragon->parentFemale->name ?? 'Unnamed' }}</div>
                                                    <div class="tooltip-info">
                                                        <strong>Morph:</strong> {{ $dragon->parentFemale->morph }}<br>
                                                        <strong>Sex:</strong> {{ ucfirst($dragon->parentFemale->sex) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Fullscreen image lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close" onclick="event.stopPropagation(); closeLightbox()">&times;</span>
        <img class="lightbox-img" id="lightbox-img" src="" alt="" onclick="event.stopPropagation()">
    </div>

    <script>
        let currentSlides = {};

        function openModal(dragonId) {
            document.getElementById('modal-' + dragonId).classList.add('active');
            document.body.style.overflow = 'hidden';
            if (!currentSlides[dragonId]) {
                currentSlides[dragonId] = 0;
            }
        }

        function closeModal(dragonId) {
            document.getElementById('modal-' + dragonId).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function closeModalOnOutsideClick(event, dragonId) {
            if (event.target.classList.contains('modal')) {
                closeModal(dragonId);
            }
        }

        function changeSlide(dragonId, direction) {
            const slides = document.querySelectorAll(`#modal-${dragonId} .modal-slide`);
            const indicators = document.querySelectorAll(`#modal-${dragonId} .slide-indicator`);
            
            slides[currentSlides[dragonId]].classList.remove('active');
            indicators[currentSlides[dragonId]].classList.remove('active');
            
            currentSlides[dragonId] += direction;
            
            if (currentSlides[dragonId] >= slides.length) {
                currentSlides[dragonId] = 0;
            }
            if (currentSlides[dragonId] < 0) {
                currentSlides[dragonId] = slides.length - 1;
            }
            
            slides[currentSlides[dragonId]].classList.add('active');
            indicators[currentSlides[dragonId]].classList.add('active');
        }

        function goToSlide(dragonId, index) {
            const slides = document.querySelectorAll(`#modal-${dragonId} .modal-slide`);
            const indicators = document.querySelectorAll(`#modal-${dragonId} .slide-indicator`);
            
            slides[currentSlides[dragonId]].classList.remove('active');
            indicators[currentSlides[dragonId]].classList.remove('active');
            
            currentSlides[dragonId] = index;
            
            slides[currentSlides[dragonId]].classList.add('active');
            indicators[currentSlides[dragonId]].classList.add('active');
        }

        // Lightbox functions
        function openLightbox(src, alt) {
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = src;
            lightboxImg.alt = alt || '';
            document.getElementById('lightbox').classList.add('active');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        // Close modal or lightbox on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const lightbox = document.getElementById('lightbox');
                if (lightbox && lightbox.classList.contains('active')) {
                    closeLightbox();
                    return;
                }
                document.querySelectorAll('.modal.active').forEach(modal => {
                    const dragonId = modal.id.replace('modal-', '');
                    closeModal(dragonId);
                });
            }
        });
    </script>
@else
    <div class="no_dragons">
        <p><i class="fas fa-info-circle" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i> No dragons currently available. Please check back soon!</p>
    </div>
@endif
@endsection