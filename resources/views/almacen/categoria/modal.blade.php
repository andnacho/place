


    <!-- Modal -->
    <div class="modal fade" id="modal-delete-{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <form method="POST" style="display: inline" action="{{ route('categoria.destroy', $cat->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title">Eliminar Categoria: {{ $cat->nombre }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <p>Confirme si desea eliminar esta categoría</p>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>


         

