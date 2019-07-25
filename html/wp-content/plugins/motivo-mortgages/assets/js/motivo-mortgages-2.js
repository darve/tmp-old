function ucfirst(str) {
  var text = str;
  var parts = text.split(' '),
  len = parts.length,
  i, words = [];
  for (i = 0; i < len; i++) {
    var part = parts[i];
    var first = part[0].toUpperCase();
    var rest = part.substring(1, part.length);
    var word = first + rest;
    words.push(word);
  }
  return words.join(' ');
}
$(document).ready(function(){
  $('input[name="existing"]').on('change', function(){
    if($(this).prop('checked')){
      console.log('true');
      $('#disclamer').parent().parent().fadeOut(500);
      $('.applicant_page').fadeIn(500);

    } else{
      console.log('false');
      $('#disclamer').parent().parent().fadeIn(500);
      $('.applicant_page').fadeOut(500);
    }
  });
});
$(document).ready(function(){

  $('html,body').animate({scrollTop: 0},500);

  $('form.mortgage-apply-form').on('submit', function(event){
    event.preventDefault();
    return false;
  });

  $('form').on('submit', function(event){
    event.preventDefault();

    return false;
  });
  $('.dropdown ul li').on('click', function(){
    var that = $(this);
    var value = $(that).attr('data-value');
    var text = $(that).html();
    var currentSpan = $(that).parent().parent().children('span').children('span');
    var currentInput = $(that).parent().parent().children().children('input');
    $(currentSpan).html('');
    $(currentInput).val(text);
  });

  $('.dropdown input').on('keydown keypress keyup change focus active', function(){
    var userString = ucfirst($(this).val());
    var item = $(this)
    var itemUL = $(this).parent().parent().children('ul');

    $(item).parent().children('span').html('');
    $(itemUL).show();

    $('.dropdown ul li:not(:contains('+ userString +'))').fadeOut(500);
    $('.dropdown ul li:contains('+ userString +')').fadeIn(500);
  }).on('focusout', function() {
    $('.dropdown ul').hide();
    $('.dropdown ul li').show();
  });

  $('.dropdown span:hover').mouseover(function(){
    console.log('here');
  }).mouseout(function(){
    console.log('Not here');
  });

  $('.dropdown span').on('mouseover', function(){
    $(this).children('ul').show();
    $(this).children('ul').children('li').on('click', function(){
      $(this).parent().hide();
    });
  }).on('mouseleave', function(){
    $(this).children('ul').hide();
  })

  $('.housing_association select[name="housing_association"], .housing_association select[name="existing_housing_association"]').on('change', function(){
    var item_id = $(this).val();
    var data_id = $('.housing_association select[name="housing_association"] option[value="'+ item_id +'"]').attr('data-id');
    console.log('/wp-content/plugins/motivo-mortgages/assets/ajax/baseCRM-2.php?action=get_development&id=' + data_id);
    $.get('/wp-content/plugins/motivo-mortgages/assets/ajax/baseCRM-2.php?action=get_development&id=' + data_id, function(data){
      data = $.parseJSON(data);
      var option = document.createElement('option');
      $('.site_development select[name="site_development"], .site_development select[name="existing_site_development"]').html('');
      $(option).attr('value', 0);
      $(option).attr('data-association', 0);
      $('.site_development select[name="site_development"], .site_development select[name="existing_site_development"]').append(option);
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement('option');
        console.log(data[i]);
        $(option).attr('value', data[i].name).html(data[i].name);
        $(option).attr('data-association', item_id);
        $('.site_development select[name="site_development"], .site_development select[name="existing_site_development"]').append(option);
      }
      console.log(data);
    });
  });


  $('input[name="disclamer"]').on('change', function(){
      $('.stage[data-id="1"] .form-type').toggle();
  });


  $('select[name="application_type"]').on('change', function(){
    var that = $(this);
    var value = $(that).val();

    $('.applicant_one').show();
    $('.applicant_one .stage[data-id="2"]').fadeIn(500, function(){
      itemTop = $('.applicant_one .stage[data-id="2"]').offset().top - $('header').height();
      $('html,body').animate({scrollTop: itemTop},500);
    });

    if(value == 'joint'){

      $('.applicant_two').addClass('show_on_form');
      $('.applicant_two').show();
      $('.is-applicant-2').attr('data-next', 7);

    } else {

      $('.applicant_two').removeClass('show_on_form');
      $('.applicant_two').hide();
      $('.is-applicant-2').attr('data-next', 6);

    }
  });

  $('.required_home').hide();

  $('select[name="purchase_type"]').on('change', function(){
    var itemValue = $(this).val();
    console.log(itemValue);
    switch (itemValue) {
      case 'Purchase':
        $('.required_home').fadeIn(500);
      break;
      case 'Remortgage':
        $('.required_home').fadeIn(500);
      break;
      case 'Staircasing':
        $('.required_home').fadeIn(500);
      break;
    }

  });
  $('select[name="self_employed"]').on('change', function(){
    var itemValue = $(this).val();
    var text = '';
    switch (itemValue) {
      case 'Yes':
        text = 'Net Profit (Recent Year)';
        text2 = 'Net Profit (Last Year)';
        input2 = 'year_2';
      break;
      case 'No':
        text = 'Basic Salary (Annual)';
        text2 = '<span class="motivo-tooltip">Please complete with 0 if not applicable to you</span>Overtime (Monthly) <i class="fa fa-question-circle"></i>';
        input2 = 'overtime';
      break;
    }
    $('.basic_salary label').html(text);
    $('.overtime label').html(text2);
    $('.overtime input').attr('name', input2);
  });
  $('select[name="applicant_2_self_employed"]').on('change', function(){
    var itemValue = $(this).val();
    var text = '';
    switch (itemValue) {
      case 'Yes':
        text = 'Net Profit (Recent Year)';
        text2 = 'Net Profit (Last Year)';
        input2 = 'applicant_2_year_2';
      break;
      case 'No':
        text = 'Basic Salary (Annual)';
        text2 = '<span class="motivo-tooltip">Please complete with 0 if not applicable to you</span>Overtime (Monthly) <i class="fa fa-question-circle"></i>';
        input2 = 'applicant_2_overtime';
      break;
    }
    $('.applicant_2_basic_salary label').html(text);
    $('.applicant_2_overtime label').html(text2);
    $('.applicant_2_overtime input').attr('name', input2);
  });

  $('.motivo-proceed').on('click', function(){
    var next = $(this).attr('data-next');
    $('.stage[data-id="'+ next +'"]').fadeIn(500, function(){
      itemTop = $(' .stage[data-id="'+ next +'"]').offset().top - $('header').height();
      $('html,body').animate({
        scrollTop: itemTop
      },500);
    });
  });

  $('button.morgform').on('click', function(event){ // User Submition
    event.preventDefault()
    var formDATA = $('form').serialize();
    var submitted = $('form').attr('data-submitted');
    if(submitted == 'false'){ // Check for previous submition
      $('form').attr('data-submitted', 'true'); // set the submition
      $('.diologe-wrapper').remove();
      var diologe_wrapper = document.createElement('div');
      var diologe_container = document.createElement('div');
      var diologe_h1 = document.createElement('h1');
      var diologe_loader = document.createElement('div');
      var diologe_h2 = document.createElement('h2');

      $(diologe_wrapper).addClass('diologe-wrapper');
      $(diologe_container).addClass('diologe-container');
      $(diologe_loader).addClass('loader');
      $(diologe_h1).html('Please Wait');
      $(diologe_h2).html('While we process your information');

      $(diologe_container).append(diologe_h1).append(diologe_loader).append(diologe_h2);
      $(diologe_wrapper).append(diologe_container);
      $('body').append(diologe_wrapper);

      $('html,body').animate({
        scrollTop: 0,
      }, 500);

      $.post('/wp-content/plugins/motivo-mortgages/assets/ajax/baseCRM-2.php?action=post_to_wp', formDATA,function(data){
        console.log(data);
        data = $.parseJSON(data);
        console.log(data);
        if(data.status == 'Success'){
          $('form').attr('data-submitted', 'true'); // leave the submition
          $('.thankyou h1.title').html('Thank you');
          $('.thankyou p').html('<h1 class="title">Thank you</h1><p>A member of our team will be in touch with you shortly.</p>');
          $('form').hide();
          $('.thankyou').show();
          $('.diologe-wrapper').fadeOut(500, function(){
            $(this).remove();
          });
        } else {
          $('form').attr('data-submitted', 'false'); // remove submition
          if(data.data.errors){
            alert('Please fill in the email field');
          } else {
            var string = '';
            for (var i = 0; i < data.data.length; i++) {
              var string = string + data.data[i] + '\r\n';
            }
            alert(string);
          }
          $('.diologe-wrapper').fadeOut(500, function(){
            $(this).remove();
          });
        }
      });
    } else {

    }
    return false;
  });

  $('button.userForm').on('click', function(event){ // User Submition
    event.preventDefault()
    var formDATA = $('form').serialize();
    var submitted = $('form').attr('data-submitted');
    if(submitted == 'false'){ // Check for previous submition
      $('form').attr('data-submitted', 'true'); // set the submition
      $('.diologe-wrapper').remove();
      var diologe_wrapper = document.createElement('div');
      var diologe_container = document.createElement('div');
      var diologe_h1 = document.createElement('h1');
      var diologe_loader = document.createElement('div');
      var diologe_h2 = document.createElement('h2');

      $(diologe_wrapper).addClass('diologe-wrapper');
      $(diologe_container).addClass('diologe-container');
      $(diologe_loader).addClass('loader');
      $(diologe_h1).html('Please Wait');
      $(diologe_h2).html('While we process your information');

      $(diologe_container).append(diologe_h1).append(diologe_loader).append(diologe_h2);
      $(diologe_wrapper).append(diologe_container);
      $('body').append(diologe_wrapper);

      $('html,body').animate({
        scrollTop: 0,
      }, 500);

      $.post('/wp-content/plugins/motivo-mortgages/assets/ajax/baseCRM-2.php?action=send_to_tmp', formDATA,function(data){
        data = $.parseJSON(data);
        console.log(data);
        if(data.status == 'Success'){
          $('form').attr('data-submitted', 'true'); // leave the submition
          $('.thankyou h1.title').html('Thank you');
          $('.thankyou p').html('<h1 class="title">Thank you</h1><p>A member of our team will be in touch with you shortly.</p>');
          $('form').hide();
          $('.thankyou').show();
          $('.diologe-wrapper').fadeOut(500, function(){
            $(this).remove();
          });
        } else {
          $('form').attr('data-submitted', 'false'); // remove submition
          if(data.data.errors){
            alert('Please fill in the email field');
          } else {
            var string = '';
            for (var i = 0; i < data.data.length; i++) {
              var string = string + data.data[i] + '\r\n';
            }
            alert(string);
          }
          $('.diologe-wrapper').fadeOut(500, function(){
            $(this).remove();
          });
        }
      });
    } else {

    }
    return false;
  });
});
