


    <!-- Modal -->
    <div class="modal fade" id="modal-delete-{{ $venta->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <form method="POST" style="display: inline" action="{{ route('ventas.destroy', $venta->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title">Anular Venta: {{ $venta->nombre }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <p>Confirme si desea eliminar esta venta</p>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>


         

