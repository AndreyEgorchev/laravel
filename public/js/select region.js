/**
 * Created by Andrey on 03.08.2016.
 */
$(document).ready(function() {
    $('#thumbs').delegate('img','click', function(){
        $('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
        $('#description').html($(this).attr('alt'));
    });
});


$(document).ready(function() {
    $(".special_select").select2({ width: '25%' });
});
$(document).ready(function() {
        $(".regionId_first").select2({ width: '100%',placeholder: "Select a state" });
    });

$(function() {
    var id = $(".regionId_first").val();

    $('.regionId_first').change(function () {
        var id = $(".regionId_first").val();
        var region_name = $(".region_ua").val();
        if(id==0){

        }
        $.ajax({
            type: "POST",
            url: './city_first' ,
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            data: {id_first: id},
            success: function (data) {
                $(".area_first").html(data);
                $(".area_first").select2({ width: '100%',   placeholder: "Select a city" });
                $("span.area_first").removeClass("select2-hidden-accessible");
            }
        });
    });

});

$(document).ready(function() {
        $(".regionId_second").select2({ width: '100%',placeholder: "Select a state" });
    });

$(function() {
    var id = $(".regionId_second").val();

    $('.regionId_second').change(function () {
        var id = $(".regionId_second").val();
        var region_name = $(".region_ua").val();
        if(id==0){

        }
        $.ajax({
            type: "POST",
            url: './city_second' ,
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            data: {id_second: id},
            success: function (data) {
                $(".area_second").html(data);
                $(".area_second").select2({ width: '100%',   placeholder: "Select a city" });
                $("span.area_second").removeClass("select2-hidden-accessible");
            }
        });
    });

});

$(document).ready(function() {
        $(".regionId_third").select2({ width: '100%',   placeholder: "Select a state" });
    });

$(function() {
    var id = $(".regionId_third").val();

    $('.regionId_third').change(function () {
        var id = $(".regionId_third").val();
        var region_name = $(".region_ua").val();
        if(id==0){

        }
        $.ajax({
            type: "POST",
            url: './city_third' ,
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            data: {id_third: id},
            success: function (data) {
                $(".area_third").html(data);
                $(".area_third").select2({ width: '100%',   placeholder: "Select a city" });
                $("span.area_third").removeClass("select2-hidden-accessible");
            }
        });
    });

});
$(document).ready(function() {
$('#hideImg1').on("click",function(){
    $('#hideImg').hide();
});
$('#showImg1').on("click",function(){
    $('#hideImg').show();
});
$('#hideImg2').on("click",function(){
    $('#hideImg22').hide();
});
$('#showImg2').on("click",function(){
    $('#hideImg22').show();
});
$('#hideImg3').on("click",function(){
    $('#hideImg33').hide();
});
$('#showImg3').on("click",function(){
    $('#hideImg33').show();
});
    });



