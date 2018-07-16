<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title" style="color:#297f54;">Remover material</h3>
			</div>
			<div class="modal-body">
				<p style="margin: 0px"><strong style="color:#297f54;margin:0px;">Tem certeza que deseja remover este material?</strong></p><br>
				<p style="margin: 0px">Esta ação não poderá ser desfeita depois</p>
				<div class="table-responsive">
					<table class="table" id="tbprimary">
						<thead>
							<tr>
								<th scope="col" style="text-align:left;padding-left:70px">Material</th>
								<th scope="col" style="text-align:right;padding-right:70px">Detalhes</th>
					
							</tr>
						</thead>
						
						<tbody>
							<td>
								<p><?php echo $materialDados['nm_material_apoio'];?></p>
							</td>
							<td class="text-right">
								<p><?php echo $materialDados['ds_material_apoio'];?></p>
							</td>
						</tbody>
					</table>
				</div>
				
				<div class="modal-footer row">
					<div class="col-md-6 text-right">
						<a href="<?php echo site_url('a/material')?>"><button type="button" class="btn btn-default" style="padding: 3% 14%;margin-bottom: 0px">Cancelar</button></a>
					</div>
					<form method="post">
						<div class="col-md-6 text-left">
							<input type="submit" class="btn btn-danger" name="material" style="padding: 3% 14%;margin: 0px" value="Remover"/>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>