//articles-carousel
$(document).ready(function() {
    $('.articles-carousel').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    })
});

$("#governorates").change(function() {
    var governorateId = $("#governorates").val();
    console.log("selected gov:" + governorateId);
    $("#cities").empty();
    var option = '<option value=""> المدينة </option>';
    $("#cities").append(option);
    $.ajax({
        url: 'https://cors-anywhere.herokuapp.com/https://ipda3-tech.com/blood-bank/api/v1/cities?governorate_id=' + governorateId,
        type: 'get',
        data: {},
        success: function(result) {
            console.log("success");



            $.each(result.data, function(index, city) {
                console.log(city);
                var option = '<option value="' + city.id + '">' + city.name + '</option>';
                $("#cities").append(option);
            });
        },

        error: function() {
            console.log("error");
        }
    });
});
