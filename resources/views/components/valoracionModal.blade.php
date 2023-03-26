@props(['producto', 'user', 'valoraciones', 'usuarios'])

<div class="modal fade" id="valoracionModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="valoracionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content d-flex align-items-center bg-transparent border-0">
            <form class="formLogin cardLogin" style="width: 900px;" method="POST" action="{{ route('valoracion.add') }}">
                @csrf
                <div class="card_headerLogin d-flex justify-content-between">
                    <h1 class="form_headingLogin modal-title mx-3" id="loginModalLabel">Valoraciones de usuarios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="valoracionesUsuarios">
                        @foreach ($producto->valoraciones as $valoracion)
                        <div class="valoracion">
                            @foreach ($usuarios as $userTmp)
                                @if ($userTmp->id == $valoracion->user_id)
                                    <?php $nombreUsuario = $userTmp->name; ?>
                                    <p class="card-text"><strong>Opinion de {{ $nombreUsuario }}</strong></p>
                                @endif
                            @endforeach
                            <p class="card-text"><em>"{{ $valoracion->valoracion }}"</em></p>
                        </div>
                    @endforeach

                    </div>
                    <hr>
                    <h1 class="form_headingLogin modal-title text-start" id="loginModalLabel">Valora el producto</h1>
                    <div class="fieldLogin">
                        <textarea class="inputLogin form-control" name="valoracion" placeholder="Escribe tu valoración"
                            id="valoracion" rows="4" cols="50" maxlength="200"></textarea>
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="fieldLogin">
                        <button type="submit" class="btn btn-primary enviarResena">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
