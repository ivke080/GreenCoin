$(document).ready(function(){
    
    $("#splashscreen, #splash-in").delay( 800 ).fadeOut("slow");
    
    $('.main-article-text').each(function() {
        // alert($(this).height());
        if($(this).height() < 44)
            $(this).children(".main-article-shadow").hide();
        
    })
        
    $('.price').keyup(function(e){
        if(isNaN(parseInt(String.fromCharCode( e.which ))))
            $('.price').val(
                function(index, value){
                    return value.substr(0, value.length - 1);
            })
    });

    
    var dole = true;
    $(".main-article-shadow").click(function(){
        if(dole == true){
            $(this).parent().css("max-height","200px");
            dole = false
             $(this).children('.glyphicon-chevron-down').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        } else {
            $(this).parent().css("max-height","65px");
            $(this).children('.glyphicon-chevron-up').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            dole = true;  
        }
    });

    var NewTrigger = false;
    $('.new-trigger').click(function() {
        if(NewTrigger == false){
            $('#new-post').slideDown("fast");
            $('.header-article').each(function(){
               $(this).addClass("header-deactive"); 
            });
            $(this).removeClass("header-deactive").addClass("header-active");
            if($(window).width() < 992)
                $(".input-group").fadeOut("fast");
            NewTrigger = true;
        } else {
            $('#new-post').slideUp("fast");
            $('.header-article').each(function(){
               $(this).removeClass("header-deactive"); 
            });
            $(this).removeClass("header-active");
            $(".input-group").fadeIn("fast");
            NewTrigger = false;
        }
    }) 
    
    function isScrolledIntoView(elem){
        var $elem = $(elem);
        var $window = $(window);
        
        var docViewTop = $window.scrollTop();
        var docViewBottom = docViewTop + window.innerHeight;

        
        var elemTop = $elem.offset().top;
        var elemBottom = elemTop + $elem.height();
        
        console.log("( "+elemBottom + " " + docViewBottom + " )" + " ( "+ elemTop + " " + docViewTop+" )");
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }
    $('.circle').each(function() {
            var id = $(this).attr('id');
            $(this).children(('.circle').concat(id)).circleProgress({ value: 0 });
        });
    $(window).on("load", function() {
        $('.circle').each(function() {
            if(isScrolledIntoView($(this)) && $(this).attr('loaded') == '0'){
                var id = $(this).attr('id');
                var vrednost = $(this).attr('percentage');
                $(this).attr('loaded','1');
                $(this).children(('.circle').concat(id)).circleProgress({
                    value: vrednost
                        }).on('circle-animation-progress', function(event, progress) {
                    $(this).find('strong').html(parseInt(100 * vrednost * progress) + '<i>%</i>');
                });
            }
        });
    });
    
    $( window ).scroll(function() {
        $('.circle').each(function() {
        if(isScrolledIntoView($(this))  && $(this).attr('loaded') == '0'){
            $(this).attr('loaded','1');
            var id = $(this).attr('id');
            var vrednost = $(this).attr('percentage');
            $(this).children(('.circle').concat(id)).circleProgress({
                value: vrednost
                    }).on('circle-animation-progress', function(event, progress) {
                $(this).find('strong').html(parseInt(100 * vrednost * progress) + '<i>%</i>');
            });
        }
    });
    });
    
    // var vrednost1 = 0.04;
    // $('.circle1').circleProgress({
    //     value: vrednost1
    //         }).on('circle-animation-progress', function(event, progress) {
    //     $(this).find('strong').html(parseInt(100 * vrednost1 * progress) + '<i>%</i>');
    // });
    
    // var vrednost2 = 0.4;
    // $('.circle2').circleProgress({
    //     value: vrednost2
    //         }).on('circle-animation-progress', function(event, progress) {
    //     $(this).find('strong').html(parseInt(100 * vrednost2 * progress) + '<i>%</i>');
    // });
    // do ovde
    
    function readURL(input,input_n) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            if(input_n == 0)
                reader.onload = function (e) {
                    $('#imgprev').attr('src', e.target.result);
                }
            else
                reader.onload = function (e) {
                    $('#imgprev2').attr('src', e.target.result);
                }
            
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this,0);
    });
    
    $("#profImg").change(function(){
        readURL(this,1);
    });

    
    $(window).resize(function(){
        if($(window).width() < 992)
            $('#main-right').hide();
        else
            $('#main-right').show();
    });
    
    $('.search-btn').click(function() {
        var text = $('.search-box').val().toLowerCase();
        if (text == 'long int dzo;')
            window.open("https://codebeyond-sevic6.c9users.io/easter.html", "_blank");
    
    });
    
    
    $('.remove-friend').on("click", function() {
        var id = $(this).attr("class").split(" ")[2];
        var str = "id=" + id;
        $.ajax({
            type: "POST",
            url: "unfriend.php",
            data: str,
            success: function(result) {
            }
        });
        var cls = '.' + id;
        $(cls).remove();
    });
    
})