$(document).ready(function(){

     $('form.php-email-form').on('submit', function(e){
         e.preventDefault();
        var url = $(this).attr('action');
        var type = $(this).attr('method');
            
        var data = new FormData(this);
        // var file = $('#file')[0].files[0];

        // data.append('file', file);
    
        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // alert('processing');
                // $('.alert').html('Processing...');
            },
            success: function(response) {
                alert('reponse');
                // $('.alert').html(response);
                // if(response === 'Congrats. You\'ve Updated your account'){
                //     window.location.href = "./editprofile_guaranter.php";
                // }
            }
        });
        
        });
    });
                
    