<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('administracion.usuarios.form',['profile'=>false])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg mr-2" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-lg btn-default">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
