

@extends('main')
@section('title', 'Букмекерская компания')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <main class="main">
   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    .carousel-wrapper {
        margin: 20px auto;
        max-width: calc(100% - 40px);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .carousel-container {
        display: flex;
        height: 70vh;
        background: linear-gradient(97.86deg, rgb(4, 56, 67) -0.33%, rgb(0, 181, 161) 60.09%);
        position: relative;
    }

    .left-panel {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .carousel-text {
        max-width: 80%;
        color: #ffffff;
    }

    .carousel-text h2 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: #ffffff;
    }

    .carousel-text p {
        font-size: 1.4rem;
        line-height: 1.6;
    }

    .controls {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .counter {
        font-size: 1.2rem;
        font-weight: bold;
        color: #555;
    }

    .navigation {
        display: flex;
        gap: 12px;
    }

    .nav-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        background: #2c3e50;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .nav-btn:hover {
        background: #3498db;
        transform: scale(1.05);
    }

    .right-panel {
        flex: 1;
        position: relative;
        overflow: hidden;
    }

    .image-container {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .image-container {
        animation: fadeIn 0.7s ease;
    }

    @media (max-width: 768px) {
        .carousel-wrapper {
            border-radius: 16px;
            margin: 15px;
            max-width: calc(100% - 30px);
        }

        .carousel-container {
            flex-direction: column;
            height: auto;
            min-height: 0;
        }

        .left-panel {
            width: 100%;
            padding: 20px 15px;
            background: rgba(4, 56, 67, 0.95);
            z-index: 3;
            flex: 0 0 auto;
        }

        .carousel-text {
            max-width: 100%;
            margin-bottom: 0;
        }

        .carousel-text h2 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .carousel-text p {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .controls {
            display: none;
        }

        .right-panel {
            height: 40vh;
            min-height: 250px;
            width: 100%;
            z-index: 1;
            flex: 0 0 auto;
        }

        .image-container {
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }
    }

    @media (max-width: 480px) {
        .left-panel {
            padding: 15px 12px;
        }

        .carousel-text h2 {
            font-size: 1.3rem;
        }

        .carousel-text p {
            font-size: 0.8rem;
        }

        .right-panel {
            height: 35vh;
            min-height: 220px;
        }
    }
</style>

<div class="carousel-wrapper">
    <div class="carousel-container">
        <div class="left-panel">
            <div class="carousel-text">
                <h2>Заголовок изображения</h2>
                <p>Описание текущего изображения. Здесь может быть подробный текст о фотографии, проекте или продукте.</p>
            </div>
            
            <div class="controls">
                <div class="counter">
                    <span class="current">1</span>/<span class="total">4</span>
                </div>
                <div class="navigation">
                    <button class="nav-btn prev-btn">←</button>
                    <button class="nav-btn next-btn">→</button>
                </div>
            </div>
        </div>
        <div class="right-panel">
            <div class="image-container" style="background-image: url('https://origin.pb06e2-resources.com/ContentPB/Banners/Welcome/Wide_pari.webp')"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carouselData = [
            {
                title: "5 фрибетов по 1000 тенге",
                description: "всем новым клиентам",
                image: "https://origin.pb06e2-resources.com/ContentPB/Banners/Welcome/Wide_pari.webp"
            },
            {
                title: "Путь к TI 2025 открыт!",
                description: "Это не просто квалификации — это шанс вписать имя в историю!",
                image: "https://origin.pb06e2-resources.com/ContentPB/Banners/NewFeatures/TI_2025_-_1095h675_1.webp"
            },
            {
                title: "Новый сезон PARI PASS",
                description: "Выполняй задания и забирай фрибеты и скины",
                image: "https://origin.pb06e2-resources.com/ContentPB/Banners/NewFeatures/PARI_PASS-Pudgeq-1095h675.webp"
            }
        ];

        const titleElement = document.querySelector('.carousel-text h2');
        const descriptionElement = document.querySelector('.carousel-text p');
        const counterCurrent = document.querySelector('.counter .current');
        const counterTotal = document.querySelector('.counter .total');
        const imageContainer = document.querySelector('.image-container');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const carousel = document.querySelector('.carousel-container');

        let currentIndex = 0;
        counterTotal.textContent = carouselData.length;
        
        function updateContent(index) {
            const item = carouselData[index];
            titleElement.textContent = item.title;
            descriptionElement.textContent = item.description;
            imageContainer.style.backgroundImage = `url('${item.image}')`;
            counterCurrent.textContent = index + 1;
        }

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % carouselData.length;
            updateContent(currentIndex);
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + carouselData.length) % carouselData.length;
            updateContent(currentIndex);
        });

        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        carousel.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            const minSwipeDistance = 50;
            const swipeDistance = touchStartX - touchEndX;

            if (swipeDistance > minSwipeDistance) {
                currentIndex = (currentIndex + 1) % carouselData.length;
            } else if (swipeDistance < -minSwipeDistance) {
                currentIndex = (currentIndex - 1 + carouselData.length) % carouselData.length;
            }
            updateContent(currentIndex);
        }

        updateContent(currentIndex);
    });
</script>
    </main>  

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.swiper-container', {
                loop: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>

    <section class="games-n">
        <div class="_container">
            <div class="games-n__c-box">
                <div class="games-n__top">
                    <div class="games-n__box-txt">
                        <h2 class="games-n__ttl">Спорт</h2>
                        <p class="games-n__sub-ttl">Профессиональная линия ставок</p>
                    </div>
                    <div class="games-n__decor"><picture><source srcset="img/games/decor.avif" type="image/avif"><source srcset="img/games/decor.webp" type="image/webp"><img class="p-img-c" src="img/games/decor.png" loading="lazy" width="100" height="100" alt="мячи"></picture></div>
                </div>
                <div class="box-nav-gm">
                    @foreach($sports as $sport)
                        <a class="card-ngm" href="/bets/{{$sport->id_api}}">
                            <div class="card-ngm__img">

                                <img class="p-img-c" src="{{$sport->img}}" loading="lazy" width="100" height="100" alt="{{$sport->title}}">

                            </div>
                            <span>{{$sport->title}}</span>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <section class="games-n leagues-div">
        <div class="_container">
            <div class="games-n__c-box">
                <div class="games-n__top">
                    <div class="games-n__box-txt">
                        <h2 class="games-n__ttl">ТОП лиги</h2>
                    </div>
                </div>
                <div class="box-nav-gm leagues--gm">
                    @foreach($data_leagues as $league)
                        <a class="card-ngm" href="{{ route('bets.tourn', ['idsport' => $league->sport_id, 'idtourn' => $league->id]) }}" style="text-align: center">
                            <div class="card-ngm__img">
                                <picture>
                                    <img class="p-img-c" src="{{ asset($league->image) }}" loading="lazy" width="100" height="100" alt="{{ $league->name }}">
                                </picture>
                            </div>
                            <div class="leagues_sport_name">
                                {{ $league->sport_name }}
                            </div>
                            <div class="leagues_name league-cont">
                                <span>{{ $league->name }}</span>
                            </div>

                        </a>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

    <style>
.match-li {
    display: block;
}

.match-li-mobile {
    display: none;
}

@media (max-width: 768px) {
    .match-li {
        display: none;
    }
    
    .match-li-mobile {
        display: block;
    }
    
    .sport-section {
        margin-bottom: 20px;
    }
    
    .event-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .event-teams {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin: 10px 0;
    }
    
    .team {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .event-odds {
        display: flex;
        gap: 10px;
    }
    
    .odd {
        flex: 1;
        text-align: center;
        padding: 8px;
        background: #f5f7fa;
        border-radius: 4px;
        cursor: pointer;
    }
}</style>
    <div class="container">
        
        <div class="match1-section"></div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/live1')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.match1-section').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading live data:', error);
                    document.querySelector('.match1-section').innerHTML = '<p>Не удалось загрузить данные</p>';
                });
                
        });
    </script>

@endsection
