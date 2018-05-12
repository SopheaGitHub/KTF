<h4>Project</h4>
<div class="row">
			<div class="col-md-2">
				<input type="text" id="project_id" class="form-control input-sm" style="margin-bottom:5px;" placeholder="Project ID"
                       value="<?php if(isset($data->data_project_id)){ echo $data->data_project_id; } ?>"/>
			</div>
			<div class="col-md-2">
				<input type="text" id="project_name" class="form-control input-sm" style="margin-bottom:5px;" placeholder="Project Name"
                       value="<?php if(isset($data->data_project_name)){ echo $data->data_project_name; } ?>"/>
			</div>

	        <div class="col-md-2" style="margin-bottom:5px;">
					<?php if(isset($data->data_status_selected)){ ?>
					<input type="hidden" value="<?php echo $data->data_status_selected; ?>" id="status_id"/>
					<?php } ?>
					<select class="form-control input-sm" id="status" name="status" onchange="loadingListProjectSearch()">
						<option value="">-- Status --</option>
						<?php
						foreach ($data->data_status as $key => $value) { ?>
						<option value="<?php echo $value->status_id; ?>"><?php echo $value->status_name; ?></option>
						<?php } ?>
					</select>
			</div>

			<div class="col-md-2">
				<button type="submit" class="btn btn-sm btn-default" onclick="loadingListProjectSearch()"> <i class="fa fa-search"></i> Search</button>
			</div>


</div>
<br />
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Posted Date</th>
			<th>Status</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>

    <?php
    foreach ($data->data_project_list as $key => $items) { ?>
		<tr>
					<td>K<?php echo $items->id; ?> </td>
					<td><?php echo $items->name; ?></td>
					<td><?php echo $items->created_at; ?></td>
					<?php if($items->status=="open"){ ?>
							<td><a href="#" class="btn btn-xs alert-info" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }else if($items->status=="offered"){  ?>
						   <td><a href="#" class="btn btn-xs alert-warning" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }else {  ?>
						   <td><a href="#" class="btn btn-xs alert-danger" style="width:100%;"><?php echo $items->status; ?></a></td>
					<?php }  ?>
					<td class="text-center">

                        <?php if($items->status=="open"){ ?>
							<a href="/freelancer/post_project_form/edit/<?php echo $items->id; ?>" class="btn btn-xs btn-success" > Edit </a>
                        <?php }else{  ?>
							<a disabled href="#" class="btn btn-xs btn-success" > Edit </a>
                        <?php }   ?>



						<a href="#" class="btn btn-xs btn-success">View</a>
					</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>



<script type="text/javascript">


    $("a").on("click", function(event){
        if ($(this).is("[disabled]")) {
            event.preventDefault();
        }
    });

	function loadingListProjectSearch() {
			var id = $('#project_id').val();
			var name = $('#project_name').val();
			var status = $( "#status option:selected" ).val();
			$.ajax({
				type: "GET",
				url: "/load-project-list?id="+id+"&project_name="+name+"&status="+status,
				beforeSend:function() {
				console.log('beforeSend');
					$('#block-loader').show();
				},
				complete:function() {
					console.log('complete');
				$('#block-loader').hide();
				},
				success:function(html) {
					$('#load-page').html(html).show();

                    var stataus_value = $('#status_id').val();
                    $("#status option[value="+stataus_value+"]").attr('selected',true);
                    var budget_id_value = $('#budget_id').val();
                    var str = budget_id_value.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');

                    $("#"+str+"").prop('selected',true);

					},
				error:function(request, status, error) {
					$('#load-page').html('').show();
				}
			});
			return false;
	}





</script>