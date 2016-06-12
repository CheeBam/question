function isEmpty(str) {
    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
}

$(document).ready(function() {
    $(".formsubmitter").submit(function(e){
        e.preventDefault();
        var form = $(this);
        var error = false;
        var id;
        form.find('textarea').each( function(){
            if ($(this).val().length < 50) {
                alert('Question must contain more than 50 characters');
                error = true;
            }
            id = $(this).attr('id');
        });
        if (!error) {
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: '/submitform',
                data: data,
                beforeSend: function() {
                    form.find('input[type="submit"]').attr('disabled', 'disabled');
                },
                success: function(){
                    $('.modal-title').text('Question has been sent!').css('text-align', 'center');
                    $('#quest_form_' + id).text('');
                    setTimeout(function(){
                        $('.close').click();
                    }, 1300);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function(data) {
                    //form.find('input[type="submit"]').prop('disabled', false);
                }

            });
        }
        return false;
    });
});

$(document).ready(function() {
    var data;
    $(".formRadio").submit(function(e){
        e.preventDefault();
        var form = $(this);
        var error = true;
        form.find(':radio').each( function(){
            if ($(this).prop('checked')) {
                data =  {
                    'radio_value' : $(this).val(),
                    'question_id' : $(this).attr('name')
                };
                error = false;
            }
        });
        if(error){
            alert('First, select one of the items');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '/submitradio',
            data: data,
            beforeSend: function() {
                form.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(data){

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function() {
                //form.find('input[type="submit"]').prop('disabled', false);
            }
        });
        return false;
    });
});


$(document).ready(function() {
    $(".answer-form-js").submit(function(e){
        e.preventDefault();
        var form = $(this);
        if($('.answer-text').val().length < 5){
            alert('Question must have more than 5 characters!');
            return false;
        }
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: '/submitanswer',
            data: data,
            beforeSend: function() {
                form.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(data){
                $('.answer-div').html('<p>Thanks for the answer! </p><a href="/">Go Home</a>');
                $('.answer-text').attr('readonly', true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function() {
                //form.find('input[type="submit"]').prop('disabled', false);
            }
        });
        return false;
    });
});

$(document).ready(function() {
    $(".namechanger").submit(function(e){
        e.preventDefault();
        var form = $(this);
        if($('#name_changer_input').val().length < 3){
            alert('Name must have more than 3 characters!');
            return false;
        }
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: '/changename',
            data: data,
            beforeSend: function() {
                form.find('input[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(data){

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            complete: function() {
                //form.find('input[type="submit"]').prop('disabled', false);
            }
        });
        return false;
    });
});

$(document).ready(function() {
    $(".expecter").submit(function(e){
        e.preventDefault();
        var form = $(this);
        var error = false;
        form.find('textarea').each(function(){
            if($(this).val().length < 10) {
                alert('Fill the field ' + $(this).attr('name') + '[More than 10 characters]');
                error = true;
            }
        });
        if(!error) {
            var data = form.serialize();
            if(data.indexOf('category') === -1){
                alert('Choose category!');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/becomeexpert',
                data: data,
                beforeSend: function () {
                    form.find('input[type="submit"]').attr('disabled', 'disabled');
                },
                success: function (data) {
                    $('.collapse-button').click().text('Congratulation. You\'re a new Expert!').attr('disabled', 'disabled');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                    //form.find('input[type="submit"]').prop('disabled', false);
                }
            });
        }
        return false;
    });
});

$(document).ready(function() {
   $('.leave-experts').click(function(e){
       e.preventDefault();
       $('.leave-experts').text('Not today =)').attr('disabled', 'disabled');
   });
});

$(document).ready(function(){
    $('#namesearch').click(function(e){
        e.preventDefault();
        var input = $('#inputsearch').val().toLowerCase();
        var f = input.charAt(0).toUpperCase();
        input = f + input.substr(1, input.length-1);
        var found = false;
        $('#content').find('.exp-name').each(function(){
            if($(this).text() == input){
                $('.category-expert').each(function(){
                    $(this).hide();
                });
                $(this).closest('.category-expert').show();
                found = true;
                $('.not-found-expert').text('');
            }else if(isEmpty(input)) {
                $('.category-expert').each(function () {
                    $(this).show();
                });
                found = true;
                $('.not-found-expert').text('');
            }
        });
        if(!found){
            $('.category-expert').each(function(){
                $(this).hide();
            });
            $('.expert-content').prepend('<h3 class="text-center not-found-expert">This expert isn\'t found</h3>');
        }
    });
});

