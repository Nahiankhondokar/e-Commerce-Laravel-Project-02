(function($){
    $(document).ready(function(){

      
      //Initialize Select2 Elements
      $('.select2').select2()
      
      // Data Table js file
      $("#section").DataTable();
      $("#category").DataTable();
      $("#dataTable").DataTable();


      //===================== section Scripts =====================

      // section status active inactive update script
      $(document).on('click', '.sectionActiveInactive', function(){
        let text = $(this).text();
        let section_id = $(this).attr('section_id');

        $.ajax({
          url : '/admin/section/active-inactive',
          type : 'get',
          data : {text, section_id},
          success : function (data){
            if(data == 'active'){
              $('#section-'+section_id).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#active-btn'+section_id).hide();
            }else {
              $('#section-'+section_id).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#inactive-btn'+section_id).hide();
            }
          }
        });

      });


      //===================== Category level Scripts =====================

      // Category leve load automatically select on category section
      $(document).on('change', '#categorySection', function(){

        let section_id = $(this).val();
        // alert(section_id);
        
        $.ajax({
          url : '/admin/get/categroy/section/wise',
          type : 'get',
          data : {section_id},
          success : function(data){
            $('#appendCategoriesLavel').html(data);
          }
        });
      });

      
      // Edit Category leve load automatically select on category section
      $(document).on('change', '#editCategorySection', function(){

        let section_id = $(this).val();
        // alert(section_id);
        
        $.ajax({
          url : '/admin/get/edit/categroy/section/wise',
          type : 'get',
          data : {section_id},
          success : function(data){
            $('#editAppendCategoriesLavel').html(data);
          }
        });
      });


      // category status active inactive update script
      $(document).on('click', '.categoryActiveInactive', function(){
        let text = $(this).text();
        let category_id = $(this).attr('category_id');

        $.ajax({
          url : '/admin/category/active-inactive',
          type : 'get',
          data : {text, category_id},
          success : function (data){
            if(data == 'active'){
              $('#category-'+category_id).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#cat_active-btn'+category_id).hide();
            }else {
              $('#category-'+category_id).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#cat_inactive-btn'+category_id).hide();
            }
          }
        });

      });



      //===================== product video image sweet alert Scripts ======================

      // sweet alert show for product video or image delete
      $(document).on('click', '#video_img_delete', function(e){
          e.preventDefault();
  
          // user id
          let product_id = $(this).attr('product_id');
          let text = $(this).attr('text');

          // alert(text)
  
          // alert
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
                
                // delete image
                $.ajax({
                  url : '/admin/product/main_img/video/delete/ajax',
                  type : 'get',
                  data : {product_id, text},
                  success : function (data){
                    if(data == 'image'){
                      $('.product_edit_image').slideUp();
                      $('.old_image_hide').attr('value', '');
                    }else {
                      $('.product_video_edit').slideUp();
                      $('.old_video_hide').attr('value', '');
                    }
                  }
                });

              }
            })
  
      });
  
      // product status active inactive update script
      $(document).on('click', '.productActiveInactive', function(){
        let text = $(this).text();
        let product_id = $(this).attr('product_id');

        $.ajax({
          url : '/admin/product/active-inactive',
          type : 'get',
          data : {product_id},
          success : function (data){
            if(data == 'active'){
              $('#product-'+product_id).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#product_active-btn'+product_id).hide();
            }else {
              $('#product-'+product_id).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#product_inactive-btn'+product_id).hide();
            }
          }
        });

      });
      

      //===================== product attribute Scripts ======================

      // Add new field for product attribute
       // add row
      $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="size[]" class="form-control m-input" placeholder="Size" autocomplete="off">';
        html += '<input type="number" name="price[]" class="form-control m-input" placeholder="price" autocomplete="off">';
        html += '<input type="number" name="stock[]" class="form-control m-input" placeholder="stock" autocomplete="off">';
        html += '<input type="text" name="sku[]" class="form-control m-input" placeholder="SKU" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
      });
      // remove row
      $(document).on('click', '#removeRow', function () {
          $(this).closest('#inputFormRow').remove();
      });

      // product attribute status active inactive update script
      $(document).on('click', '.productAttrActiveInactive', function(){
        let text = $(this).text();
        let product_attr = $(this).attr('product_attr');

        $.ajax({
          url : '/admin/product/attr/active-inactive',
          type : 'get',
          data : {product_attr},
          success : function (data){
            if(data == 'active'){
              $('#product_attr-'+product_attr).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#product_attr_active-btn'+product_attr).hide();
            }else {
              $('#product_attr-'+product_attr).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#product_attr_inactive-btn'+product_attr).hide();
            }
          }
        });

      });


      //===================== product gallery Scripts ======================

      // product gallery status active inactive update script
      $(document).on('click', '.productGallActiveInactive', function(){
        
        let product_gall = $(this).attr('product_gall');

        $.ajax({
          url : '/admin/product/gallery/active-inactive',
          type : 'get',
          data : {product_gall},
          success : function (data){
            if(data == 'active'){
              $('#product_gall-'+product_gall).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#product_gall_active-btn'+product_gall).hide();
            }else {
              $('#product_gall-'+product_gall).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#product_gall_inactive-btn'+product_gall).hide();
            }
          }
        });

      });



      //===================== Product Barnd Scripts ======================

      //product brand add 
      $(document).on('submit', '#productBrandAdd', function(e){
        e.preventDefault();

        let brand = $('#brand_name').val();

        $.ajax({
          url : '/admin/product/brand/add/edit/',
          method : 'POST',
          data : new FormData(this),
          contentType : false,
          processData : false,
          success : function (d){
            allProductBrand();
            $('#productBrandAdd').modal('hide');

          }
        });
        
      });

      // product Brand status active inactive update script
      $(document).on('click', '.brandActiveInactive', function(){
  
        let brand_id = $(this).attr('brand_id');
        // alert(brand_id);

        $.ajax({
          url : '/admin/product/brand/active-inactive',
          type : 'get',
          data : {brand_id},
          success : function (data){
            if(data == 'active'){
              $('#brand-'+brand_id).html('<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>');
              $('#brand_active-btn'+brand_id).hide();
            }else {
              $('#brand-'+brand_id).html('<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>')
              $('#brand_inactive-btn'+brand_id).hide();
            }
          }
        });

      });

      // product brand edit
      $(document).on('click', '#productBrandEditBtn', function(e){
        e.preventDefault();

        let brand_id = $(this).attr('edit_id');
        // alert(brand_id);

        $.ajax({
          url : '/admin/product/brand/single/edit/'+brand_id,
          success : function (data){
            $('#productBrandEdit').modal('show');
            $('#productBrandEdit #brand_name').val(data.name);
            $('#productBrandEdit #edit_id').val(data.id);
            // alert(d.name);

          }
        });
        
      });
      

      // product brand update
      $(document).on('submit', '#productBrandUpdate', function(e){
        e.preventDefault();

        // let brand_name = $('#brand_name').val();
        let brand_id = $(this).attr('edit_id');

        // alert(brand_name - brand_id);

        $.ajax({
          url : '/admin/product/brand/add/edit/'+brand_id,
          method : 'POST',
          data : new FormData(this),
          contentType : false,
          processData : false,
          success : function (d){
            allProductBrand();
            $('#productBrandEdit').modal('hide');
            // alert(d);

          }
        });
        
      });
      
      // product brand delete sweet alert 
      $(document).on('click', '#deleteBrand', function(e){
          e.preventDefault();
  
          let delete_id = $(this).attr('delete_id');
  
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
                
                $.ajax({
                  url : '/admin/product/brand/delete/'+delete_id,
                  success : function (data){
                    allProductBrand();
                  }
                });

              }
            })
  
      });
  

      //===================== Banner Scripts ======================

      // Banner add 
      $(document).on('submit', '#bannerStore', function(e){
        e.preventDefault();
        // Swal('all fields are require');

        let tittle = $('#tittle').val();
        let image = $('#image').val();

        // alert(image);

        // validation 
        if(!image || !tittle){
          $.ajax({
            url : '/admin/banner/add/edit/',
            method : 'POST',
            data : new FormData(this),
            contentType : false,
            processData : false,
            success : function (d){
              allBanner()
              $('#bannerAdd').modal('hide');
              e.target.reset();
              $('#imgPriview').attr('src', ' ');
  
            }
          });
        }else {
          Swal.fire('Title & Image are required');
        }


        
      });
  
      // Banner status active inactive update script
      $(document).on('click', '.bannerActiveInactive', function(){

        let banner_id = $(this).attr('banner_id');
        // alert(banner_id);

        $.ajax({
          url : '/admin/banner/active-inactive',
          type : 'get',
          data : {banner_id},
          success : function (data){
            // alert(data);
            if(data == 'active'){
              $('#banner-'+banner_id).html('<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>');
              $('#banner_active-btn'+banner_id).hide();
            }else {
              $('#banner-'+banner_id).html('<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>')
              $('#banner_inactive-btn'+banner_id).hide();
            }
          }
        });

      });


      // Banner edit
      $(document).on('click', '#bannerEditBtn', function(e){
        e.preventDefault();

        let banner_id = $(this).attr('edit_id');
        // alert(brand_id);

        $.ajax({
          url : '/admin/banner/single/edit/'+banner_id,
          success : function (data){
            $('#BannerEdit').modal('show');
            $('form input#update_id').val(data.id);
            $('form input#link').val(data.link);
            $('form input#alt').val(data.alt);
            $('form input#tittle').val(data.title);
            $('form input#old_image').val(data.image);
            $('img#editImgPreview').attr('src',  `http://127.0.0.1:8000/media/backend/banner/${data.image}`);
            // alert(d.name);
          }
        });
        
      });

      // Banner update
      $(document).on('submit', '#BannerUpdate', function(e){
        e.preventDefault();

        $.ajax({
          url : '/admin/banner/add/edit/',
          method : 'POST',
          data : new FormData(this),
          contentType : false,
          processData : false,
          success : function (res){
            allBanner();
            $('#BannerEdit').modal('hide');
            e.target.reset();
            // alert(d);

          }
        });
        
      });


      // product brand delete sweet alert 
      $(document).on('click', '#deleteBanner', function(e){
          e.preventDefault();
  
          let delete_id = $(this).attr('delete_id');
  
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
                
                $.ajax({
                  url : '/admin/banner/delete/'+delete_id,
                  success : function (data){
                    allBanner();
                  }
                });

              }
            })
  
      });
      


      //===================== Coupon Status UPdate Scripts ======================
      $(document).on('click', '.couponActiveInactive', function(){

        let coupon_id = $(this).attr('coupon_id');
        // alert(coupon_id); return false;

        $.ajax({
          url : '/admin/coupon/active-inactive',
          type : 'get',
          data : {coupon_id},
          success : function (data){
            // alert(data);
            if(data == 'active'){
              $('#coupon-'+coupon_id).html('<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>');
              $('#coupon_active-btn'+coupon_id).hide();
            }else {
              $('#coupon-'+coupon_id).html('<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>')
              $('#coupon_inactive-btn'+coupon_id).hide();
            }
          }
        });

      });


      //===================== Coupon input feild show ======================
      $(document).on('click', '#Manual', function(){
        $('#couponFeild').css('display', 'block');
      });

      $(document).on('click', '#Automatic', function(){
        $('#couponFeild').css('display', 'none');
      });
      

      //===================== Datemask dd/mm/yyyy======================
      $("#datemask").inputmask("dd/mm/yyyy", { placeholder: "dd/mm/yyyy" });
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm/dd/yyyy", { placeholder: "mm/dd/yyyy" });
      //Money Euro
      $("[data-mask]").inputmask();


      // =========== order Curiere or Traking NO show/hide ============
      $(document).on('change', '#order_status', function(){
        // alert();
        const status = $(this).val();
        if(status == 'Shipped'){
          $('#courier_name').css({'display' : 'block'});
          $('#traking_number').css({'display' : 'block'});
        } else {
          $('#courier_name').css({'display' : 'none'});
          $('#traking_number').css({'display' : 'none'});
        }
      });


      //===================== section Scripts =====================
      $(document).on('click', '.shippeActiveInactive', function(){
        let text = $(this).text();
        let shippe_id = $(this).attr('shippe_id');

        $.ajax({
          url : '/admin/shippe/active-inactive',
          type : 'get',
          data : {text, shippe_id},
          success : function (data){
            if(data == 'active'){
              $('#shippe-'+shippe_id).html('<a class="badge badge-success"  href="javascript:void(0)">Active</a>');
              $('#active-btn'+shippe_id).hide();
            }else {
              $('#shippe-'+shippe_id).html('<a class="badge badge-danger" href="javascript:void(0)">Inactive</a>')
              $('#inactive-btn'+shippe_id).hide();
            }
          }
        });

      });
    

      //===================== User Status UPdate Scripts ======================
      $(document).on('click', '.userActiveInactive', function(){

        let user_id = $(this).attr('user_id');
        // alert(user_id); return false;

        $.ajax({
          url : '/admin/active-inactive',
          type : 'get',
          data : {user_id},
          success : function (data){
            // alert(data);
            if(data == 'active'){
              $('#user-'+user_id).html('<a class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>');
              $('#user_active-btn'+user_id).hide();
            }else {
              $('#user-'+user_id).html('<a class="badge badge-danger" href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>')
              $('#user_inactive-btn'+user_id).hide();
            }
          }
        });

      });
      


    //   // Add extra item in fee category amount page
    //   $(document).on('click', '.addEventMore', function(e){
    //     e.preventDefault();
  
    //     let add_extra_item = $('#Whole_extra_item_add').html();
    //     $('.add_item').append(add_extra_item);
  
  
    //   });
  
  
    //   $(document).on('click', '.removeEvent', function (e){
    //     e.preventDefault();
    //     /**
    //      * where i am clicking, most closest .delete_whole_extra_itme_add will be deleted.
    //      * although the other classes are same.
    //      * closest will work only where i am clicking, exactly this class will remove
    //      */
    //     $(this).closest('.delete_whole_extra_item_add').remove();
        
    //   });
  
      
    //   $('.removeEvent').click(function(e){
    //     e.preventDefault();
    //     $(this).closest('.delete_whole_extra_item_add').remove();
    //   });
  
  
    //   /**
    //    * student roll generate script
    //    */
    //   $(document).on('click', '#roleSearch', function(e){
    //     e.preventDefault();
  
    //     let year_id = $('#year').val();
    //     let class_id = $('#class').val();
        
    //     // alert(year_id + - + class_id);
  
    //     $.ajax({
    //       url : "/students/roll/getstudent",
    //       type : 'GET',
    //       data : {'year' : year_id, 'class' : class_id}, 
    //       success : function(data){
    //         // alert(data);
  
    //         $('#role-generate').removeClass('d-none');
    //         let table_body = '';
  
    //         $.each(data, function(key, value){
    //           $.each(value, function(k, v){
  
    //             table_body += `
    //               <tr>
    //                 <td>${v.student.id_no} <input class="form-control" type="hidden" name="student_id[]" placeholder="roll" value="${v.student_id}"></td>
    //                 <td>${v.student.name}</td>
    //                 <td>${v.student.f_name}</td>
    //                 <td>${v.student.gender}</td>
    //                 <td><input class="form-control" type="text" name="roll[]" placeholder="roll" value="${v.roll} "></td>
    //               </tr>
    //               `;
  
    //           });
    //         });
  
  
  
    //         $('#role-generate-body').html(table_body);
  
    //       }
    //     });
  
    //   });
  
  
    //   /**
    //    * student Registration fee script
    //    */
    //   $(document).on('click', '#regFeeSearch', function(e){
    //     // e.preventDefault();
  
    //     let year_id = $('#year').val();
    //     let class_id = $('#class').val();
        
    //     // alert(year_id + - + class_id);
  
    //     $.ajax({
    //       url : "/students/registration/fee/class/data",
    //       type : "get",
    //       data : {'year' : year_id, 'class' : class_id}, 
    //       beforeSend : function(){
  
    //       },
    //       success : function(data){
    //         // alert(data);
    //         let source = $('#document_template').html();
    //         let template = Handlebars.compile(source);
    //         let html = template(data);
    //         $('#DocumentResults').html(html);
    //         $('[data-toggle="tooltip"]').tooltip();
    //       }
    //     });
        
    //   });
  
  
    //   /**
    //  * student Monthly fee script
    //  */
    //   $(document).on('click', '#monthlyFeeSearch', function(e){
    //     // e.preventDefault();
  
    //     let year_id = $('#year').val();
    //     let class_id = $('#class').val();
    //     let month = $('#month').val();
        
    //     // alert(year_id + - + class_id);
  
    //     $.ajax({
    //       url : "/students/monthly/fee/class/data",
    //       type : "get",
    //       data : {'year' : year_id, 'class' : class_id, 'month': month}, 
    //       beforeSend : function(){
  
    //       },
    //       success : function(data){
    //         // alert(data);
    //         let source = $('#document_template').html();
    //         let template = Handlebars.compile(source);
    //         let html = template(data);
    //         $('#DocumentResults').html(html);
    //         $('[data-toggle="tooltip"]').tooltip();
    //       }
    //     });
        
    //   });
  
  
  
  
  
    //   /**
    //  * student exam fee script
    //  */
    //    $(document).on('click', '#examFeeSearch', function(e){
    //     // e.preventDefault();
  
    //     let year_id = $('#year').val();
    //     let class_id = $('#class').val();
    //     let exam_type_id = $('#exam_type_id').val();
        
    //     // alert(year_id + - + class_id);
  
    //     $.ajax({
    //       url : "/students/exam/fee/class/data",
    //       type : "get",
    //       data : {'year' : year_id, 'class' : class_id, 'exam_type_id': exam_type_id}, 
    //       beforeSend : function(){
  
    //       },
    //       success : function(data){
    //         // alert(data);
    //         let source = $('#document_template').html();
    //         let template = Handlebars.compile(source);
    //         let html = template(data);
    //         $('#DocumentResults').html(html);
    //         $('[data-toggle="tooltip"]').tooltip();
    //       }
    //     });
        
    //   });
      
  
    //   /**
    //    *  employee leave purpose
    //    */
    //    $(document).on('click', '#leave_purpose', function(e){
    //     // e.preventDefault();
  
    //     let new_purpose = $(this).val();
    //     if(new_purpose == 0){
    //       $('#new_purpose').slideDown();
    //     }else {
    //       $('#new_purpose').slideUp();
    //     }
      
        
    //   });
  
  
  
    //   /**
    //    *  employee monthly salary
    //    */
    //   $(document).on('click', '#empy_salary', function(e){
    //     e.preventDefault();
  
    //     const slry_date = $('#date').val();
    //     // alert(slry_date);
  
    //     $.ajax({
    //       url : '/employee/monthly/salary/get',
    //       type : 'get',
    //       data : { slry_date : slry_date },
    //       beforeSend : function(){
  
    //       },
    //       success : function(data){
    
    //         // console.log(data);
    //         $('#monthly_sly_div').removeClass('d-none')
    //         $('#emply_table_body').html(data);
  
    //       }
    //     });
  
    //   });
      
  
  
    //   /**
    //  *  Student mark page
    //  *  class select, the subject will be selected automatically
    //  */
    // $(document).on('change', '#class_select', function(){
      
    //   let class_id = $(this).val();
    //   // alert(class_id);
  
    //   $.ajax({
    //     url : '/marks/student/subject-load/' + class_id,
    //     type : 'get',
    //     success : function (data){
    //       // alert(data);
    //       // console.log(data);
  
    //       let html_tag = '';
    //       $.each(data, function(key, value){
    //         // console.log(value.school_subject.name);
    //         html_tag += `
    //           <option value="${value.school_subject.id}">${ value.school_subject.name }</option>
    //         `;
    //       });
  
    //       $('#subjec_load').html(html_tag);
    //     }
    //   });
  
  
    // });
  
  
  
    //   /**
    //   * student Mark generate script
    //   */
    //   $(document).on('click', '#markSearch', function(e){
    //     e.preventDefault();
  
    //     let year_id = $('#year').val();
    //     let class_id = $('#class_select').val();
    //     let exam_id = $('#exam').val();
    //     let subject_id = $('#subjec_load').val();
        
    //     // alert(year_id + - + class_id);
  
    //     $.ajax({
    //       url : "/marks/student/getmark",
    //       type : 'GET',
    //       data : { year_id, class_id, exam_id, subject_id}, 
    //       success : function(data){
    //         // alert(data);
    //         // console.log(data);
  
    //         $('#stu-mark-generate').removeClass('d-none');
    //         let table_body = '';
  
    //         $.each(data, function(key, v){
    //           // console.log(v.student.name);
    //           table_body += `
    //               <tr>
    //                 <td>${v.student.id_no} <input class="form-control" type="hidden" name="student_id[]"  value="${v.student_id}"></td>
    //                 <td>${v.student.name}</td>
    //                 <td>${v.student.f_name}</td>
    //                 <td>${v.student.gender}</td>
    //                 <td>
    //                 <input class="form-control" type="text" name="marks[]" placeholder="marks" value="">
    //                 <input class="form-control" type="hidden" name="id_no[]" placeholder="marks" value="${v.student.id_no}">
    //                 </td>
    //               </tr>
    //               `;
    //         });
  
  
  
    //         $('#stu-mark-generate-body').html(table_body);
  
    //       }
    //     });
  
    //   });
    
  
  
    // /**
    // * student Mark Edit script
    // */
    // $(document).on('click', '#markEditSearch', function(e){
    //   e.preventDefault();
  
    //   let year_id = $('#year').val();
    //   let class_id = $('#class_select').val();
    //   let exam_id = $('#exam').val();
    //   let subject_id = $('#subjec_load').val();
      
    //   // alert(year_id + - + class_id);
  
    //   $.ajax({
    //     url : "/marks/edit/getstudent",
    //     type : 'GET',
    //     data : { year_id, class_id, exam_id, subject_id}, 
    //     success : function(data){
    //       // alert(data);
    //       // console.log(data);
  
    //       $('#stu-mark-generate').removeClass('d-none');
    //       let table_body = '';
  
    //       $.each(data, function(key, v){
    //         // console.log(v.student.name);
    //         table_body += `
    //             <tr>
    //               <td>${v.student.id_no} <input class="form-control" type="hidden" name="student_id[]"  value="${v.student_id}"></td>
    //               <td>${v.student.name}</td>
    //               <td>${v.student.f_name}</td>
    //               <td>${v.student.gender}</td>
    //               <td>
    //               <input class="form-control" type="text" name="marks[]" placeholder="marks" value="${v.marks}">
    //               <input class="form-control" type="hidden" name="id_no[]" placeholder="marks" value="${v.student.id_no}">
    //               </td>
    //             </tr>
    //             `;
    //       });
  
    //       $('#stu-mark-generate-body').html(table_body);
  
    //     }
    //   });
  
    // });
  
  
  
    // /**
    // *  student account fee getStudent script
    // */
    // $(document).on('click', '#StuFeeSearch', function(e){
    //   e.preventDefault();
  
    //   const year_id = $('#year').val();
    //   const class_id = $('#class').val();
    //   const fee_cat_id = $('#fee_category').val();
    //   const date = $('#date').val();
    //   // alert(fee_cat_id);
  
    //   $.ajax({
    //     url : '/account/fee/getstudent',
    //     type : 'get',
    //     data : { year_id, class_id, fee_cat_id, date },
    //     beforeSend : function(){
    //     },
    //     success : function(data){
    //       // alert(data);
    //       // console.log(data);
    //       $('#stu-mark-generate').removeClass('d-none')
    //       $('#stu-mark-generate-body').html(data);
  
    //     }
    //   });
  
    // });
        
  
  
    
    // /**
    //  *  employee monthly salary
    //  */
    // $(document).on('click', '#accEplySearch', function(e){
    //   e.preventDefault();
  
    //   const slry_date = $('#date').val();
    //   // alert(slry_date);
  
    //   $.ajax({
    //     url : '/account/employee/monthly/salary/get',
    //     type : 'get',
    //     data : { slry_date : slry_date },
    //     beforeSend : function(){
  
    //     },
    //     success : function(data){
    //       // alert(data);
    //       // console.log(data);
    //       $('#monthly_sly_div').removeClass('d-none')
    //       $('#emply_table_body').html(data);
  
    //     }
    //   });
  
    // });
        
  
  
    // /**
    //  *  Report monthly profit script
    //  */
    //    $(document).on('click', '#profitSearch', function(e){
    //     e.preventDefault();
    
    //     const start_date = $('#start_date').val();
    //     const end_date = $('#end_date').val();
    //     // alert(slry_date);
    
    //     $.ajax({
    //       url : '/report/profit/date-wise/get',
    //       type : 'get',
    //       data : { start_date, end_date },
    //       beforeSend : function(){
    
    //       },
    //       success : function(data){
    //         // alert(data);
    //         // // console.log(data);
    //         $('#monthly_sly_div').removeClass('d-none')
    //         $('#emply_table_body').html(data);
    
    //       }
    //     });
    
    //   });
          
  
  
  
        
    });
  })(jQuery);