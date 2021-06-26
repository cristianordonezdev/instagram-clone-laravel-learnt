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

    })

});






// function like(){
//     var like = document.getElementById('like');
//     like.style.color='red';
// }