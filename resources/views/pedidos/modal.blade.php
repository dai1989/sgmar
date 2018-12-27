<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ven->id}}" >
{{Form::Open(array('action'=>array('PedidoController@destroy',$ped->id),'method'=>'delete'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Cancelar Pedido</h4>
		</div>
		<div class="modal-body">
			<p>Corfirme si desea cancelar el pedido {{$ped->id}}</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Confirmar</button>
		</div>
	</div>
</div>

{{Form::Close()}}
	
</div>
