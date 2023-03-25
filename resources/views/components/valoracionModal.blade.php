<div class="modal fade" id="valoracionModal" tabindex="-1" aria-labelledby="valoracionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content d-flex align-items-center bg-transparent border-0">
            <form class="formLogin cardLogin" method="POST" action="">
                @csrf
                <div class="card_headerLogin d-flex justify-content-between">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor"
                            d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z">
                        </path>
                    </svg>
                    <h1 class="form_headingLogin modal-title" id="loginModalLabel">Iniciar sesión</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="fieldLogin">
                        <label for="email">E-mail</label>
                        <input class="inputLogin form-control" name="email" type="text" placeholder="E-mail"
                            id="email">
                    </div>
                    <div class="fieldLogin">
                        <label for="password">Password</label>
                        <input class="inputLogin form-control" name="password" type="password" placeholder="Password"
                            id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="fieldLogin">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
