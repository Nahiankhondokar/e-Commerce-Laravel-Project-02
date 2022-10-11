


  
// sweet alert show befor delete
$(document).on('click', '#delete', function(e){
    e.preventDefault();

    let link = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
        })

});



// product all brand show
allProductBrand()
function allProductBrand(){
$.ajax({
    url : '/admin/product/all/brand',
    success : function (data){
    $('#allBrand').html(data);
    }
});
}


// all banner show
allBanner()
function allBanner(){
    $.ajax({
        url : '/admin/banner/all',
        success : function (data){
        $('#allBanner').html(data);
        }
    });
}


// img preview system
$('#image').change(function(e){
    // alert('helo');
    let reader = new FileReader();
    reader.onload = function(e){
        $('#imgPriview').attr('src', e.target.result);
    }

    reader.readAsDataURL(e.target.files[0]);
});


// edit page img preview system
$('#editImage').change(function(e){
    // alert('edit');
    let reader = new FileReader();
    reader.onload = function(e){
        $('#editImgPreview').attr('src', e.target.result);
    }

    reader.readAsDataURL(e.target.files[0]);
});
