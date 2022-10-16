(function($){
    $(document).ready(function(){

        // csrf token will not show any error when we pass POST type data through ajax.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // product filtering system by laravel
        // $(document).on('change', '#sort', function(){
        //     this.form.submit();
        //     // alert()
        // });


        // product filtering system by ajax
        $(document).on('change', '#sort', function(){
            const sort = $(this).val();
            const url = $('#url').val();
            const fabric = get_filter('fabric');
            const sleeve = get_filter('sleeve');
            const fit = get_filter('fit');
            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve, fit},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });


        // filter by fabrics , sleeve 
        $(document).on('click', '.fabric', function(){
            const sort = $('#sort option:selected').val();
            const url = $('#url').val();
            const fabric = get_filter(this);
            const sleeve = get_filter('sleeve');
            const fit = get_filter('fit');
            // console.log(this);
            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve, fit},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });


        // filter by fabric, sleeve 
        $(document).on('click', '.sleeve', function(){
            const sort = $('#sort option:selected').val();
            const url = $('#url').val();
            const fabric = get_filter('fabric');
            const sleeve = get_filter('sleeve');
            const fit = get_filter('fit');
            // console.log(this);
            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve, fit},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });

        // filter by fabric, sleeve, fit
        $(document).on('click', '.fit', function(){
            const sort = $('#sort option:selected').val();
            const url = $('#url').val();
            const fabric = get_filter('fabric');
            const sleeve = get_filter('sleeve');
            const fit = get_filter('fit');
            // console.log(this);
            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve, fit},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });

        // function for filtering 
        function get_filter(cls_name){
            let filterArr = [];
            // console.log(`.${cls_name}:checked`);

            $('.'+cls_name+':checked').each(function(){
                filterArr.push($(this).val());
                // alert($(this).val());
            });

            return filterArr;
            // console.log(filterArr);
        }


        // get price product size wise
        $(document).on('change', '#getPrice', function(){
            const size = $(this).val();
            const product_id = $('#getPrice').attr('product_id');
            // alert(size + product_id);

            $.ajax({
                url : '/get-price-by-product-size',
                type : 'get',
                data : {size, product_id},
                success : function (data){
                    $('.getAttrPrice').html(`$${data.price}`);
                    // alert(data.price);
                }
            });
        });


    });
})(jQuery);