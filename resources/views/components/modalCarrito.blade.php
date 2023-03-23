{{-- <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Carrito de compra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if (count(session('cart', [])) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart', []) as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['precio'] }}</td>
                            <td>{{ $producto['cantidad'] }}</td>
                            <td>{{ $producto['precio'] * $producto['cantidad'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>El carrito está vacío</p>
        @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Comprar</a>
        </div>
      </div>
    </div>
  </div> --}}


<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Cesta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count(session('cart', [])) > 0)
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th>Productos</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart', []) as $producto)
                            <tr>
                                <td class="w-25">
                                    <img src="{{ asset('storage/' . $producto['imagen']) }}" class="img-fluid img-thumbnail" alt="Sheep">
                                    {{ $producto['nombre'] }}
                                </td>
                                <td>{{ $producto['precio'] }} €</td>
                                <td class="qty"><input type="text" class="form-control" id="input1" value="{{ $producto['cantidad'] }}"></td>
                                <td>{{ $producto['precio'] * (int)$producto['cantidad'] }} €</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>Aún no ha añadido productos a la cesta.</p>
            @endif
                <div class="d-flex justify-content-end">
                    <h5>Total: <span class="price text-success">
                        @php $total = 0; @endphp
                        @foreach (session('cart', []) as $producto)
                            @php $total += $producto['precio'] * $producto['cantidad']; @endphp
                        @endforeach
                        {{ $total }}
                    </span></h5>
                </div>

            </div>
            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir comprando</button>
                <button type="button" class="btn btn-success" onclick="window.location='{{ route('cart.checkout') }}'">Comprar</button>
            </div>
        </div>
    </div>
</div>
