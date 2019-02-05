                            {{-- Habiendo mensajes de acción :: INI --}}
                                @php
                                    /*$accion_datos = explode('_', $accion);
                                    switch ($accion_datos[0]) {
                                        case 'insertar':
                                            $modal_tit = 'Inserto satisfactorio';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue insertado correctamente.';
                                            break;

                                        case 'editar':
                                            $modal_tit = 'Edición satisfactoria';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue editado correctamente.';
                                            break;

                                        case 'borrar':
                                            $modal_tit = 'Borrado satisfactorio';
                                            $modal_msg = 'El post con ID ['.$accion_datos[1].'] fue borrado correctamente.';
                                            break;
                                    }*/
                                @endphp
                            <!-- Modal-acción -->
                            <div class="modal fade" id="accion-modal-cookie" tabindex="-1" role="dialog" aria-labelledby="accion-modal-cookieLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content bg-info text-white">

                                        <form action="{{ route('store_cookie') }}" method="post">
                                            @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="accion-modal-cookieLabel">Permitir COOKIEs</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chck_cookie_ok">Se avisa que para seguir navegando por el sitio, se pide aceptar el GUARDADO de una COOKIE en el navegador.
                                                </div>
                                            </div>

                                            <div class="col-xs|sm|md|lg|xl-1-12">
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success" role="button" title="Aceptar Cookie">Aceptar</button>
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Habiendo mensajes de acción :: INI --}}
