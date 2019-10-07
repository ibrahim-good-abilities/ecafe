/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
function notify(text)
{
    var toastHTML = `<span>${text}</span><button class="btn-flat toast-action">Close</button>`;
    M.toast({html: toastHTML});
}
$(document).ready(function() {


    $(document).on('click', '.delete-with-confirmation', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            icon: 'warning',
            buttons: {
                cancel: true,
                delete: 'Yes, Delete It'
            }
        }).then((willDelete) => {
            if (willDelete) {
                $(this).removeClass('delete-with-confirmation');
                window.location.href = href; //causes the browser to refresh and load the requested url
            }
        });

        $(document).on('click','.btn-flat.toast-action',function(){
            var toastElement = document.querySelector('.toast');
            var toastInstance = M.Toast.getInstance(toastElement);
            toastInstance.dismiss();
        });





    });

 
    $('.upload-preview').change(function(){
        document.getElementById('output').src = window.URL.createObjectURL(this.files[0])
    });


});
