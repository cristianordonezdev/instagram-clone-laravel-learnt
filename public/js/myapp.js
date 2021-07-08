window.addEventListener('load', function () {
    var url = "http://127.0.0.1:8000/";
    $(".like").click(function () {

        if ($(this).hasClass('text-red-500')) {
            $(this).removeClass('text-red-500 fas fa-heart');
            $(this).addClass('far fa-heart');

            $.ajax({
                url: url + 'like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    console.log(response);
                }
            });

        } else {
            $(this).removeClass("far fa-heart");
            $(this).addClass('text-red-500 fas fa-heart');

            $.ajax({
                url: url + 'like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    console.log(response);
                }
            });
        }

    });

    $(".suscribe").click(function () {

        if ($(this).text() == "Suscribe") {
            $.ajax({
                url: url + 'suscribeAction/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    console.log(response);
                }
            });
            console.log('OYEEEE SI ESTOY ENTRANDO');
            //$(this).attr('value','Unsuscribe');
            $(this).text('Unsuscribe');

            $(this).removeClass("bg-blue-500 rounded-lg text-white font-bold");
            $(this).addClass("focus:outline-none border rounded-lg font-bold");


        } else {
            //$(this).attr('value','Unsuscribe');

            $.ajax({
                url: url + 'suscribeAction/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    console.log(response);
                }
            });
            $(this).text('Suscribe');
            $(this).addClass("bg-blue-500 rounded-lg text-white font-bold");
        }

    });
    $(".options").click(function () {
        console.log('You are clicking options');
        let background = $('.backgroundPop');
        background.css('display', 'block');
    });

    $('.backgroundPop').click(function () {
        $(this).css('display', 'none');
        console.log('FONDO');

    });

    $('.optionsBox').click(function(e){
        e.stopImmediatePropagation();

        console.log('CAJA BLANCA');
    });

    $('#formSearch').submit(function () {
        $(this).attr('action', url + 'search/' + $('#fieldSearch').val());
    })



    $('.followers').click(function () {
        console.log('IM CLICKING THE BOTTOM');
        $('.backgroundPop').css('display', 'block');
    });

    $('.following').click(function () {
        console.log('IM CLICKING THE BOTTOM');
        $('.backgroundPop2').css('display', 'block');
    });

    $('.backgroundPop2').click(function () {
        $(this).css('display', 'none');
    });
});










// function like(){
//     var like = document.getElementById('like');
//     like.style.color='red';
// }