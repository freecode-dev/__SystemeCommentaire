$(document).ready(function(){

  //start on website start
  console.log('Website start');
  update_devoir_time();

  setInterval(
      function()
      {
        update_devoir_time();
      }, 1000
    );
  function update_devoir_time(){
    $.ajax({
      url:'ajax/update_devoir_time.php',
      method:'POST',
      success: function(data){

      }
    })
  }
  var dataTable = $('#devoir_table').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"ajax/liste_devoir.php",
      type:"POST",
      data:{action:'fetch'}
    }
  });

      //Click sur les bouttons du tableau
      $(document).on('click', '.add_question', function(){
       var devoir_id = $(this).attr('id');
       $.ajax({
        url:'ajax/liste_devoir.php',
        method:'POST',
        data:{action:'fetch_dev_details_by_id', devoir_id:devoir_id},
        dataType:'json',
        success: function(data){
        //Show Modal
        $('#qcm_modal_title').text('Ajouter des questions a un examen');
        $('#qcm_modal_title').addClass('text text-primary');
        $('#cat_or_classe').val(data.class_libelle);
        $('.question_action').val('Add');
        $('#devoir_id').val(data.devoir_id);
        $('#date_devoir').val(data.devoir_date_time);
        $('#devoir_id').val(data.devoir_id);
        $('#libelle_devoir').val(data.devoir_libelle);

        console.log(data.devoir_id);
        $('#qcm_Modal').modal('show');


      }
    })
     });
      var date = new Date();

      date.setDate(date.getDate());
      $('#devoir_date_time').datetimepicker({

      });

      $('#add_button').on('click', function()
      {
       $('#modal_title').text('Détails du Devoir');
       $('#modal_title').addClass('text text-primary');
       $('#action').val('Add');
       $('#devoir_modal').modal('show');
     }
     );
      $('#coefficient_choice').on('change', function(){
       var coef = $('#coefficient_choice').val();
       $.ajax({
        url:"ajax/devoir_action.php",
        method:"POST",
        data:{action:'fetch_total', page:'devoir_en_ligne', coef:coef},
        success:function(data){
         $('#total_devoir').html(data);
       }
     })

     });
      $('#niveau_choice').on('change', function(){
        var niveau_id = $('#niveau_choice').val();

        $.ajax({
          url:"ajax/devoir_action.php",
          method:"POST",
          data:{action:'fetch_total', page:'devoir_en_ligne', niveau_id:niveau_id},
          success:function(data){
           $('#list_class_per_level').html(data);
         }
       })
        //list_class_per_level
      });
      $('#add_devoir_form').on('submit', function(event){
       event.preventDefault();
       $.ajax({
         url:'ajax/devoir_action.php',
         method:'POST',
         data:$(this).serialize(),
         dataType:"json",
         beforeSend: function(){
           $('#btn_action').attr('disabled', true);
           $('#btn_action').text('traitement...');


         },
         success: function(data){
           if(data.success){
             $('#general_error').html('');
             $('#btn_action').attr('disabled', false);
             $('#btn_action').addClass('btn-primary');
             $('#btn_action').removeClass('btn-warning');
             $('#btn_action').text('Enregistrer');
             $('#devoir_modal').modal('hide');
             $('#add_devoir_form')[0].reset();
             $('#action').val('Add');
             $('#success_message').html('<div class="alert alert-success">'+data.success+'</div>');
             dataTable.ajax.reload();
           }
           if(data.error){
            $('#btn_action').attr('disabled', false);
            $('#btn_action').removeClass('btn-primary');
            $('#btn_action').addClass('btn-warning');
            $('#btn_action').text('réessayer...');
            $('#general_error').html('<div class="alert alert-danger">'+data.error+'</div>');
          }
        }
      })
     });


  //display login popup
  $('#login_popup').on('click', function(){
    $('#login_modal').modal('show');
  });

  $('#Add_Qcm_question').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:'ajax/devoir_action.php',
      method:'POST',
      data:$(this).serialize(),
      dataType:'json',
      beforeSend: function(){

        $('#question_btn_action').attr('disabled', true);
        $('#question_btn_action').text('traitement...');
      },
      success: function(data){

        if (data.success) {
          //alert(data.success);
          $('#Add_Qcm_question')[0].reset();
          $('#success_message').html('<div class="alert alert-primary">'+data.success+'</div>');
          $('#qcm_Modal').modal('hide');
          dataTable.ajax.reload();
          location.reload();
        }
        if (data.error) {
         $('#question_btn_action').attr('disabled', false);
         $('#question_btn_action').text('reessayer...');
       }
     }
   });
  })
});
