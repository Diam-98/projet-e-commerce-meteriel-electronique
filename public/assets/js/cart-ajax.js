// var $container = $('.add_cart');
// var $counter = $('.cartCounter');

// const axios = require('axios').default;

function onclickBtnAddToCart(event){
    event.preventDefault();

    const url = this.href;
    console.log(url);
    const countProd = document.querySelector('.cartCounter small');
    console.log(countProd)

    axios.get(url).then(function (response){
        console.log(response.data.count);
        countProd.textContent = response.data.count;
    })
}

document.querySelectorAll('a.add_cart').forEach(function (link){
    link.addEventListener('click', onclickBtnAddToCart);
})


// $container.on('click', function(e) {
//     e.preventDefault();
//     // var $link = $(e.currentTarget);
//     // $.ajax({
//     //     url: '/count',
//     //     method: 'GET'
//     // }).then(function(response) {
//     //     console.log(response);
//     //     // $counter.text(response.count);
//     // });
//
//
// });