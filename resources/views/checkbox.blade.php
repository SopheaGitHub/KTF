@extends('layouts.k_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>


                <form method="POST" id="frm_submit"  action="<?php echo $data->url_store; ?>"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}" > 
                     <div class="row"> 
                    
                            <div class="checkbox">
                                <label>
                                  <input type="checkbox"  id="number" name="number[]" value="number 1" > number 1
                                </label>
                            </div>

                           <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="number" name="number[]" value="number 2">  number 2
                                </label>
                            </div>

                             <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="number"  name="number[]" value="number 3"
                                  > number 3
                                </label>
                            </div>

                                <div class="col-md-4">
                                    <div class="category-box" data-toggle="modal" id="click" data-target="#myModal3"> 
                                        <i style="font-size:30px;" class="zmdi zmdi-camera"></i><br />Photography</div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="category-box" data-toggle="modal" id="click" data-target="#myModal4"> 
                                        <i style="font-size:30px;" class="zmdi zmdi-camera"></i><br />Love</div>
                                </div>

                          </div>

                          <button class="btn btn-info" id="submit">Save</button>
                    </form>






                </div>
            </div>
        </div>
    </div>







   <!-- modal -->


<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-camera"></i> My Number list</h4>
      </div>
      <div class="modal-body">
                        
                        <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number[]" value="number 1" > number 1
                                </label>
                            </div>

                           <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number[]" value="number 2">  number 2
                                </label>
                            </div>

                             <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number[]" value="number 3"
                                  > number 3
                                </label>
                            </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-success" class="close" data-dismiss="modal" aria-label="Close" id="btnDoneData">Done</button>
      </div>
    </div>
  </div>
</div>

  <!-- modal -->





  <!-- modal -->


<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="zmdi zmdi-camera"></i> My love list</h4>
      </div>
      <div class="modal-body">
                        
                        <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number1[]" value="love 1" > love 1
                                </label>
                            </div>

                           <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number1[]" value="love 2">  love 2
                                </label>
                            </div>

                             <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="arrnumber" name="number1[]" value="love 3"
                                  > love 3
                                </label>
                            </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-success" class="close" data-dismiss="modal" aria-label="Close" id="btnDoneLove">Done</button>
      </div>
    </div>
  </div>
</div>

  <!-- modal -->





<script type="text/javascript">
         $(document).ready(function() {

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

          var data_checkbox;
          var love_checkbox;





           $('#btnDoneLove').click(function() {
              event.preventDefault();
               love_checkbox = $('input:checked').map(function(){
                return $(this).val();
              }).get(); 
              console.log(love_checkbox);
          });



           $('#btnDoneData').click(function() {
              event.preventDefault();
               data_checkbox = $('input:checked').map(function(){
                return $(this).val();
              }).get(); 
              console.log(data_checkbox);
          });





      $(document).on('submit', '#frm_submit', function(e) {
            e.preventDefault();
            var currency = "dsfd";
            var url  = $(this).attr('action');
            var post = $(this).attr('method');
        $.ajax({
            type: post,
            url: url,
            data: {"currency":currency},
            cache: false,
            beforeSend: function () {
              // before send
            },
            complete: function () {
                // completed
            },
            success: function (html) {
              console.log(html);
            },
            error: function (request, status, error) {
                var msg = '';
                msg += '<div class="alert alert-warning" id="warning">';
                msg += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    msg += '<b><i class="fa fa-info-circle"></i> '+error+' </b><br />';
                msg += '</div>';
                $('#curency_range').html(msg).show();
            }
        });

    });

             // $('#frm_submit').on('submit', function(e) {
             //   e.preventDefault(); 
             //   var data = $('#number').serialize();
             //   var url  = $(this).attr('action');
             //   var post = $(this).attr('method');
             //   console.log(data);
             //   $.ajax({
             //      type : post,
             //      url  : url,
             //      dataType:"jsonp",
             //      data : data,
             //      success:function(data){
             //        alert(data)
             //      },
             //      error: function(e){
             //        console.log(e.responseText);
             //      }

             //   })

             //  });

        });

 </script>

@endsection




