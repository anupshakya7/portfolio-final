function toggleMenu(type){
    const menu = document.querySelector('.menu-links');
    const icon = document.querySelector('.hamburger-icon');
    menu.classList.toggle("open");
    icon.classList.toggle("open");
   
    if(type == 'parent'){
        const audio = new Audio();
        audio.src = './audio/menu.mp3';
        audio.play();
    }
}

const typed = new Typed('.input',{
    strings:["Full Stack Developer","Laravel Developer","Vue Developer","React Developer","Wordpress Developer"],
    typedSpeed:200,
    backSpeed:100,
    loop:true
});

//Top Progress Bar
const filled = document.querySelector('.filled');

function update(){
    filled.style.width = `${((window.scrollY)/(document.body.scrollHeight - window.innerHeight) * 100)}%`;
    requestAnimationFrame(update);
}

update();


//Initialize Swiper
var swiper = new Swiper('.swiper-container',{
    loop:true,
    spaceBetween:20,
    navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
     pagination: {
            el: '.swiper-pagination',  // Pagination
            clickable: true,  // Allow clicking pagination
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        }
});

// Slider for Experience Section
var swiperExperience = new Swiper('.swiper-experience-container',{
    loop:true,
    spaceBetween:20,
    navigation:{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination:{
        el: '.swiper-pagination',
        clickable:true
    },
    breakpoints:{
        768:{
            slidesPerView: 1,
        },
        1024:{
            slidesPerView:2,
        }
    }
});
