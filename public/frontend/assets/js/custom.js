(function($){
    $(document).ready(function(){


        // product filtering system by laravel
        // $(document).on('change', '#sort', function(){
        //     this.form.submit();
        //     // alert()
        // });


        // // product filtering system by ajax
        $(document).on('change', '#sort', function(){
            const sort = $(this).val();
            const url = $('#url').val();
            // alert(url)

            $.ajax({
                url : url,
                data : {sort, url},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });




    });
})(jQuery);