<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Log in</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="fieldLogin">
                <label for="username">Username</label>
                <input class="inputLogin form-control" name="name" type="text" placeholder="Username" id="username">
              </div>
              <div class="fieldLogin">
                <label for="password">Password</label>
                <input class="inputLogin form-control" name="password" type="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
