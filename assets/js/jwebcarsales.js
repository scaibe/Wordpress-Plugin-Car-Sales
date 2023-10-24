/* Splide Init
---------------------------------------------------*/

document.addEventListener( 'DOMContentLoaded', function() {

    const splideElement = document.querySelector('.splide');

    if(splideElement) {
        var splide = new Splide( '.splide' , {
            type   : 'loop',
            perPage: 3,
        });
        splide.mount();
    }
});

/* Click on filter brand
---------------------------------------------------*/

const brand = document.querySelectorAll(".widget-list-brand .item-brand");
const archive = document.querySelectorAll('#archive-container article.auto');

if(brand) {
    brand.forEach(function(item) {
        item.addEventListener('click', function() {
            brand.forEach((e) => e.classList.remove('select'));
            this.classList.add('select');
            const className = "auto-brand-" + this.dataset.autobrand;
            console.log(className); 
            archive.forEach((item) => {
                item.classList.contains(className) ? item.classList.remove('hide') : item.classList.add('hide');
            });
        })
    })
}