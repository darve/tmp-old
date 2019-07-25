$(window).load(function() {

    /*------------------------------------------*/
    /*  Navigation scroll function
    /*------------------------------------------*/

    $('.ques input').keypress('change', function() {
        var next = $(this).attr('data-src');
        if ($(this).attr("id") == "salary1") {
            if ($("#myself").val() == 'someoneelse') {
                var next = 'ques4-2';
            } else {
                $("#ques4-2").hide();
            }
        }
        $("#" + next).show();
        if ($(this).attr("id") == "cards") {
            var target_offset = $('#about-section').offset().top - 80;
            $('html, body').animate({
                scrollTop: target_offset
            }, 'slow');
        }
    });


    $('#ques1 input').change('change', function() {
        var val = $(this).val();
        $("#insertname").html(val);
    });

    $('.ques select').change('change', function() {
        var val = $(this).val();
        if ($(this).attr("id") == "offer") {
            var next = 'ques5-2';
            var hide = 'ques6';
            if (val == 'have') {
                $("#" + next).show();
                $("#" + hide).hide();
            } else {
                $("#" + next).hide();
                $("#" + hide).show();
            }
        } else {
            var next = $(this).attr('data-src');
            $("#" + next).show();
        }
    });

    function calc() {


        var persal = 0;
        var persalval = 0;
        var sal = parseFloat($('#salary1').val()) || 0;
        var twen = 0;
        var fourty = 0;
        var fourtyfive = 0;
        var exem = 8060;

        var ni = 0;

        var twelni = 0;

        var tottax = 0;



        var persal2 = 0;
        var persalval2 = 0;
        var sal2 = 0;

        if ($('#salary2').val() > 0 && $("#myself").val() == 'someoneelse') {

            sal2 = parseFloat($('#salary2').val()) || 0;
        }
        var twen2 = 0;
        var fourty2 = 0;
        var fourtyfive2 = 0;
        var ni2 = 0;
        var twelni2 = 0;
        var tottax2 = 0;


        // person 1 //
        if (sal < 100001) {
            persal = 11000;
        } else if (sal > 122000) {
            persal = 0;
        } else {
            persal = 11000 - ((sal - 100000) * 0.5);
        }

        if (sal > 11000) {
            persalval = sal - persal;

        }

        if (persalval > 32000) {
            twen = 32000 * 0.2;
        } else {
            twen = persalval * 0.2;
        }


        if (persalval > 150000) {
            fourty = 118000 * 0.4;
        } else if (persalval > 32000) {
            fourty = (persalval - 32000) * 0.4;
        }


        if (persalval > 150000) {
            fourtyfive = (persalval - 150000) * 0.45;
        }

        tottax = twen + fourty + fourtyfive;



        if (sal - exem > 0) {
            ni = sal - exem;
        }


        if (ni < 43001) {
            ni * 0.12;
        } else {
            (43000 - 8060) * 0.12;
        }




        if (ni < 43001) {
            twelni = ni * 0.12;
        } else {
            twelni = (43000 - 8060) * 0.12;
        }


        // person 2//
        if (sal2 < 100001) {
            persal2 = 11000;
        } else if (sal2 > 122000) {
            persal2 = 0;
        } else {
            persal2 = 11000 - ((sal2 - 100000) * 0.5);
        }

        if (sal2 > 11000) {
            persalval2 = sal2 - persal2;

        }

        if (persalval2 > 32000) {
            twen2 = 32000 * 0.2;
        } else {
            twen2 = persalval2 * 0.2;
        }


        if (persalval2 > 150000) {
            fourty2 = 118000 * 0.4;
        } else if (persalval2 > 32000) {
            fourty2 = (persalval2 - 32000) * 0.4;
        }


        if (persalval2 > 150000) {
            fourtyfive2 = (persalval2 - 150000) * 0.45;
        }

        tottax2 = twen2 + fourty2 + fourtyfive2;

        if (sal2 - exem > 0) {
            ni2 = sal2 - exem;
        }

        if (sal2 < 43001) {
            twelni2 = ni2 * 0.12;
        } else {
            twelni2 = (43000 - 8060) * 0.12;
        }
        var kids    = parseFloat($('#children').val()) || 0;
        var pension = parseFloat($('#pension').val()) || 0;
        var loan    = parseFloat($('#loan').val()) || 0;
        var credit  = parseFloat($('#cards').val()) || 0;
        var coffee  = parseFloat($("input[name=sub_drink]:checked").val()) || 0;
        var gym     = parseFloat($("input[name=sub_gym]:checked").val()) || 0;
        var child   = parseFloat($("input[name=sub_childcare]:checked").val()) || 0;
        var travel  = parseFloat($("input[name=sub_travel]:checked").val()) || 0;

        var val     = ((sal + sal2) - (tottax + tottax2 + twelni + twelni2 + ((pension + loan + gym + child + travel) * 12) + (sal * (kids * 10) / 100) + (credit * 0.03) + ((coffee)) * 12)) / 12 * 0.45;

        //var val = ((sal+sal2)-(tottax+tottax2+twelni+twelni2+((pension+loan+gym+child+travel)*12)));

        val = val.toFixed(0);
        if (val > 0) {
            $("#amount").html("&pound;" + val);
            return true;
        } else {
            alert("Please check the values you have entered");
            return false;
        }

    }


    $('#blog-section .flexslider').flexslider({
        controlsContainer: ".pagination-links",
        animation: "slide", //String: Select your animation type, "fade" or "slide"
        slideshow: false, //Boolean: Animate slider automatically
        directionNav: false
    });

    $('.sechide1 input').click('change', function() {
        $('.sechide2').show();
        var target_offset = $('.sechide2').offset().top - 80;
        $('html, body').animate({
            scrollTop: target_offset
        }, 'slow');
    });

    $('.sechide2 input').click('change', function() {
        $('.sechide3').show();
        var target_offset = $('.sechide3').offset().top - 80;
        $('html, body').animate({
            scrollTop: target_offset
        }, 'slow');
    });


    $('.sechide3 input').click('change', function() {

        if ($("#children").val() == '0') {
            $('.sechide5').show();
            var target_offset = $('.sechide5').offset().top - 80;
            $('html, body').animate({
                scrollTop: target_offset
            }, 'slow');

        } else {
            $('.sechide4').show();
            var target_offset = $('.sechide4').offset().top - 80;
            $('html, body').animate({
                scrollTop: target_offset
            }, 'slow');

        }
    });

    $('.sechide4 input').click('change', function() {
        $('.sechide5').show();
        var target_offset = $('.sechide5').offset().top - 80;
        $('html, body').animate({
            scrollTop: target_offset
        }, 'slow');

    });
    $('.sechide5 input').click('change', function() {
        // $('.sechide7').show();
        var target_offset = $('.sechide7').offset().top - 80;
        $('html, body').animate({
            scrollTop: target_offset
        }, 'slow');
        $('.mem-submit').show();
    });

    //
    // $('.sechide7 input').click('change', function() {
    // });




    // this is the id of the form
    $("#mortgageform").submit(function(e) {
        if (calc()) {
            var url = "/uploadform.php"; // the script where you handle the form input.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#mortgageform").serialize(), // serializes the form's elements.
                success: function(data) {
                    console.log(data); // show response from the php script.
                }
            });
            $('.sechide6').show();
            var target_offset = $('.sechide6').offset().top;
            $('html, body').animate({
                scrollTop: target_offset
            }, 600);
        }
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $('#menu a').click(function(e) {
        $('#header-nav a.active').removeClass("active");
        $(this).addClass('active');
        var target = $(this).attr("href");
        var target_offset = $(target).offset().top;
        $('html, body').animate({
            scrollTop: target_offset
        }, 600);
    });

    $('#menu a').on('change', function() {
        var value = $(this).val();
        var hash_index = value.indexOf('#');
        var target = value.substr(hash_index);

        var target_offset = $(target).offset().top;
        $('html, body').animate({
            scrollTop: target_offset
        }, 'slow');
    });


    $('.membership-list.gym li span').click(function() {
        $('.membership-list.gym li span').removeClass('selected');
        var $this = this;
        $(this).addClass('selected');
    });
    $('.membership-list.food li span').click(function() {
        $('.membership-list.food li span').removeClass('selected');
        var $this = this;
        $(this).addClass('selected');
    });
    $('.membership-list.drink li span').click(function() {
        $('.membership-list.drink li span').removeClass('selected');
        var $this = this;
        $(this).addClass('selected');
    });
    $('.membership-list.mobile li span').click(function() {
        $('.membership-list.mobile li span').removeClass('selected');
        var $this = this;
        $(this).addClass('selected');
    });
    $('.membership-list.wifi li span').click(function() {
        $('.membership-list.wifi li span').removeClass('selected');
        var $this = this;
        $(this).addClass('selected');
    });

    /*------------------------------------------*/
    /*  Scroll to top function
    /*------------------------------------------*/
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top').on('click', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        });
    });
});
$(document).ready(function() {
    function teamMasonry() {
        $('.team-members').masonry({
            itemSelector: '.col-sm-3',
            // percentPosition: true,
            layoutPriorities: {
                upperPosition: 1,
                shelfOrder: 1
            }
        });
    }
    teamMasonry();
    $(document).on('click', '.bio-text span', function() {
        var active = $('.bio-text.active span');
        var activeContainer = $(active).parent();
        var activeDataExerpt = $(activeContainer).attr('data-exerpt');
        $(active).html('Read More');
        $(activeContainer).removeClass('active').removeAttr('style').children('p').html(activeDataExerpt);

        var container = $(this).parent();
        var dataText = $(container).attr('data-text');
        var dataExerpt = $(container).attr('data-exerpt');
        $(this).html('Read Less');
        $(container).addClass('active').height('auto').css('padding', '0px 0px 20px 0px').children('p').html(dataText);
        $(container).animate({
            scrollTop: 0
        }, "fast");
        teamMasonry();
    });
    $(document).on('click', '.bio-text.active span', function(data) {
        console.log(data);
        $("#containerDiv").animate({
            scrollTop: 0
        }, "fast");
        var container = $(this).parent();
        var dataText = $(container).attr('data-text');
        var dataExerpt = $(container).attr('data-exerpt');
        $(this).html('Read More');
        $(container).removeClass('active').removeAttr('style').children('p').html(dataExerpt);
        $(container).animate({
            scrollTop: 0
        }, "fast");
        teamMasonry();
    });
    $('.video-toggle').on('click', function(event) {
        event.preventDefault();
        $('.job-interview-wrapper').fadeIn(500);
        return false;
    });
    $('.close').on('click', function(event) {
        event.preventDefault();
        $('.job-interview-wrapper').fadeOut(500);
        return false;
    });
});
