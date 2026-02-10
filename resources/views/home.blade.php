@extends('layouts.public')

@section('title', 'Home')

@section('content')
<img class="hero_img" src="{{ asset('images/DragonMorphsHeroBanner.png') }}" alt="DragonMorphs">

<div class="title_container">
    <div class="title_text">
        <h1><i class="fas fa-dragon"></i> Welcome to DragonMorphs</h1>
    </div>
</div>

<style>
.highlight {
    background: rgba(255, 255, 255, 0.95);
    color: #407200;
    padding: 0.15rem 0.5rem;
    border-radius: 4px;
    font-weight: 700;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.feature-box {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
    padding: 2rem;
    border-radius: 4px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 2px solid rgba(64, 114, 0, 0.1);
}

.feature-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 50px rgba(64, 114, 0, 0.25);
    border-color: rgba(64, 114, 0, 0.3);
}

.feature-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 8px 25px rgba(64, 114, 0, 0.3);
}

.feature-box h3 {
    color: #407200;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
}

.feature-box p {
    color: #555;
    line-height: 1.6;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(64, 114, 0, 0.4);
    transition: all 0.3s ease;
    margin: 2rem auto;
    text-align: center;
}

.cta-button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 12px 35px rgba(64, 114, 0, 0.5);
}

.cta-button i {
    font-size: 1.2rem;
}

.achievements-timeline {
    margin: 2rem 0;
    position: relative;
    padding-left: 1rem;
}

/* Single continuous line through all items */
.achievements-timeline::before {
    content: '';
    position: absolute;
    left: 214px;
    top: 27px;
    bottom: 60px;
    width: 2px;
    background: rgba(255, 255, 255, 0.3);
}

.timeline-item {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    margin-bottom: 3.5rem;
    position: relative;
}

.timeline-item:last-child {
    margin-bottom: 2rem;
}

.timeline-year {
    font-size: 3.5rem;
    font-weight: 800;
    color: rgba(255, 255, 255, 0.25);
    min-width: 150px;
    text-align: left;
    line-height: 1;
}

.timeline-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex: 1;
}

.timeline-dot {
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}

.timeline-text {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    line-height: 1.5;
}

/* Fix splide arrows */
.splide__arrow svg {
    fill: #ffffff !important;
}

.splide__arrow:hover {
    transform: scale(1.1) !important;
}
</style>

<div class="text_box_green">
    <p>We are dedicated breeders of bearded dragon colour morphs, we are working with all the major morphs including <span class="highlight">Translucents</span>, <span class="highlight">hypos</span>, <span class="highlight">leatherbacks</span> and <span class="highlight">Silkbacks</span>, as well as extreme <span class="highlight">reds</span> and <span class="highlight">yellows</span>. We are aiming to produce top quality dragons in various morphs, we have dragons from top breeders here in <span class="highlight">England</span> and also from major breeders in the <span class="highlight">USA</span> and <span class="highlight">Europe</span>.</p>
    
    <p>By sourcing our dragons from different bloodlines we can breed them together knowing that <span class="highlight">no inbreeding is taking place</span>. We will be crossing the different morphs to create stunning dragons, these dragons will be offered for sale on the available page the very best of these will be staying in our collection and can be viewed in the dragon gallery.</p>
    
    <p>Bearded dragons are becoming the <span class="highlight">most popular exotic pet</span> to have in the 21st century! They are very interactive and love attention from humans. Bearded dragons are great pets for adults or children, and are often used in schools as class pets. Have a look around and see what everyone is raving about!</p>
</div>

<div style="text-align: center;">
    <a href="{{ route('morphs') }}" class="cta-button">
        <i class="fas fa-shopping-cart"></i> View Available Dragons <i class="fas fa-arrow-right"></i>
    </a>
</div>

@if($featuredDragons->count() > 0)
<section class="splide" aria-label="Featured Dragons" id="splide01">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($featuredDragons as $dragon)
                <li class="splide__slide">
                    @if($dragon->primaryImage)
                        <img src="{{ asset('storage/' . $dragon->primaryImage->image_path) }}" alt="{{ $dragon->name ?? 'Dragon' }}">
                    @else
                        <img src="{{ asset('images/dragonSlideOne.jpg') }}" alt="Dragon">
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#splide01', {
            type: 'loop',
            perPage: 1,
            autoplay: true,
            interval: 3000,
        }).mount();
    });
</script>
@else
<!-- Fallback slider with static images when no dragons in database -->
<section class="splide" aria-label="Featured Dragons" id="splide01">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('images/dragonSlideOne.jpeg') }}" alt="Dragon"></li>
            <li class="splide__slide"><img src="{{ asset('images/dragonSlideTwo.jpg') }}" alt="Dragon"></li>
            <li class="splide__slide"><img src="{{ asset('images/dragonSlideThree.jpeg') }}" alt="Dragon"></li>
            <li class="splide__slide"><img src="{{ asset('images/dragonSlideFour.jpeg') }}" alt="Dragon"></li>
        </ul>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#splide01', {
            type: 'loop',
            perPage: 1,
            autoplay: true,
            interval: 3000,
        }).mount();
    });
</script>
@endif

<div class="title_container" style="padding-top: 2rem;">
    <div class="title_text">
        <h1><i class="fas fa-info-circle"></i> What is DragonMorphs?</h1>
    </div>
</div>

<div class="features-grid">
    <div class="feature-box">
        <div class="feature-icon">
            <i class="fas fa-clock"></i>
        </div>
        <h3>30+ Years Experience</h3>
        <p>Over three decades of expertise in breeding bearded dragons</p>
    </div>
    
    <div class="feature-box">
        <div class="feature-icon">
            <i class="fas fa-award"></i>
        </div>
        <h3>Premium Genetics</h3>
        <p>Top quality bloodlines from UK, USA, and European breeders</p>
    </div>
    
    <div class="feature-box">
        <div class="feature-icon">
            <i class="fas fa-heart-pulse"></i>
        </div>
        <h3>Healthy Dragons</h3>
        <p>Well-socialized, healthy dragons with excellent structure</p>
    </div>
    
    <div class="feature-box">
        <div class="feature-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h3>Direct from Breeder</h3>
        <p>Buy directly from experienced breeders, not retailers</p>
    </div>
</div>

<div class="landing_info">
    <div class="info_img">
        <img src="{{ asset('images/twoHeadedDragon.png') }}" alt="Two headed dragon">
    </div>
    <div class="info_desc">
        <p>We are private breeders and have over <span class="highlight">30 years of experience</span> in keeping and breeding bearded dragons. We have <span class="highlight">2 dedicated rooms</span> that house our extensive collection. Choosing to buy directly from a breeder assures you get a top quality, healthy, high colour bearded dragon. We work with most of the major morphs and colours of bearded dragons including <span class="highlight">hypos, translucent, leatherback, silkback, dunners, genetic stripe, witblits, zeros and weros</span>.</p>
        
        <p>Get ready for a new generation of bearded dragons in the U.K. We are excited to offer bearded dragon babies for sale for everyone, from <span class="highlight">first-time dragon owners</span> to breeders who want a dragon that will <span class="highlight">elevate their breeding program</span>. As soon as babies hatch, we will start posting pictures and the date on which each clutch will be ready for sale.</p>
        
        <div class="achievements-timeline">
            <div class="timeline-item">
                <div class="timeline-year">2011</div>
                <div class="timeline-content">
                    <div class="timeline-dot"></div>
                    <div class="timeline-text">First Hypo Trans Silkback in England</div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2013</div>
                <div class="timeline-content">
                    <div class="timeline-dot"></div>
                    <div class="timeline-text">First Hypo Leather Dunner in UK</div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2017</div>
                <div class="timeline-content">
                    <div class="timeline-dot"></div>
                    <div class="timeline-text">First Hypo Trans Genetic Stripe Dunner UK</div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2019</div>
                <div class="timeline-content">
                    <div class="timeline-dot"></div>
                    <div class="timeline-text">First Hypo Wero in UK</div>
                </div>
            </div>
        </div>
        
        <p>Our <span class="highlight">two headed dragon</span> is one of 4 that we know of ever in the world, read up on them <a href="https://www.liverpoolecho.co.uk/news/liverpool-news/two-headed-lizard-born-on-wirral-9529122" style="color: white; text-decoration: underline;">here!</a></p>
    </div>
</div>

<div class="title_container">
    <div class="title_text">
        <h1><i class="fas fa-book"></i> What are Bearded Dragons?</h1>
    </div>
</div>

<div class="landing_gallery">
    <img src="{{ asset('images/dragonOne.jpeg') }}" alt="Bearded Dragon">
    <img src="{{ asset('images/dragonTwo.jpeg') }}" alt="Bearded Dragon">
    <img src="{{ asset('images/dragonThree.jpeg') }}" alt="Bearded Dragon">
    <img src="{{ asset('images/dragonFour.jpeg') }}" alt="Bearded Dragon">
</div>

<div class="info_desc">
    <p>Bearded dragons are <span class="highlight">very successful in captivity</span> and are one of the favourites among hobbyists and experts alike. They have a <span class="highlight">very friendly nature</span> towards people, and are very calm when they grow into adults. Juveniles are generally very active but still very friendly, and even make good pets for children.</p>
    
    <p>Pogona have an average life span of <span class="highlight">10–20 years</span>, although some have been known to live longer. Pogona are <span class="highlight">very good pets for new reptile owners</span> because of their hardiness and also they <span class="highlight">do not bite humans</span>. The genus is in the subfamily Agaminae of the family Agamidae. Their characteristics include spiny scales arranged in rows and clusters. These are found on the throat, which can be expanded when threatened, and at the back of the head. The species also displays a hand-waving gesture, thought to draw an attack from any predator that may be in the area, however this can also be used as a form of communication between the species.</p>
</div>

<div style="text-align: center; margin-top: 3rem;">
    <a href="{{ route('morphs') }}" class="cta-button">
        <i class="fas fa-search"></i> Browse Available Dragons <i class="fas fa-arrow-right"></i>
    </a>
</div>
@endsection