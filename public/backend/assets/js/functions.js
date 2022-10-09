
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
