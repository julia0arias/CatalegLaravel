<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Carrito
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (count(session('cart', [])) > 0)
                    <form method="POST" action="">
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

                            @foreach (session('cart', []) as $producto)
                                <tr data-product-id="{{ $producto['id'] }}">
                                <tr>
                                    <td class="w-25">
                                        <img src="{{ asset('storage/' . $producto['imagen']) }}"
                                            class="img-fluid img-thumbnail" alt="Sheep">
                                        {{ $producto['nombre'] }}
                                    </td>
                                    <td class="precio-producto">{{ $producto['precio'] }}</td>
                                    <td>
                                        <div class="input-group w-5">
                                            <button onclick="decrementAmount(this)" type="button"
                                                class="btn btn-outline-secondary decrement-btn"
                                                data-id="{{ $producto['id'] }}">-</button>
                                            <input type="text" class="form-control qty-input"
                                                id="qty-input_{{ $producto['id'] }}"
                                                name="qty-input_{{ $producto['id'] }}"
                                                value="{{ $producto['cantidad'] }}" readonly>
                                            <button onclick="incrementAmount(this)" type="button"
                                                class="btn btn-outline-secondary increment-btn"
                                                data-id="{{ $producto['id'] }}">+</button>
                                        </div>
                                    </td>
                                    <td class="total-product">{{ $producto['precio'] * $producto['cantidad'] }}</td>
                                    <td><a><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Aún no ha añadido productos a la cesta.</p>
                @endif
                <div class="d-flex justify-content-end">
                    <h5>Total: <span class="price text-success" id="totalPrice">
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
                <button type="button" class="btn btn-success"
                    onclick="window.location='{{ route('cart.checkout') }}'">Comprar</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script defer>
    function incrementAmount(button) {
        var productId = button.getAttribute('data-id');
        var input = document.getElementById('qty-input_' + productId);
        input.value = parseInt(input.value) + 1;

        let tr = button.closest('tr');
        let totalProduct = tr.querySelector('.total-product');
        let price = parseFloat(tr.querySelector('.precio-producto').textContent);
        totalProduct.textContent = (price * input.value).toFixed(2);

        let numCart = document.getElementById('lblCartCount');
        numCart.innerHTML = parseInt(numCart.innerHTML) + 1;

        //actualizamos la sesion
        updateCart(productId, input.value);

        updateTotalPrice();
    }

    //TODO en vez de quitarlo por aqui, hacer un link que cuando se clicke cada cosa vaya a la una ruta get y vaya al back y se modifique ahí
    function updateCart(productId, quantity) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let existingProduct = cart.find(product => product.id == productId);
        if (existingProduct) {
            existingProduct.quantity = quantity;
        } else {
            cart.push({
                id: productId,
                quantity: quantity
            });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function decrementAmount(button) {
        var productId = button.getAttribute('data-id');
        var input = document.getElementById('qty-input_' + productId);
        var newValue = parseInt(input.value) - 1;
        input.value = newValue >= 1 ? newValue : 1;

        if (input.value != 1) {

            let numCart = document.getElementById('lblCartCount');
            numCart.innerHTML = parseInt(numCart.innerHTML) == 0 ? 0 : parseInt(numCart.innerHTML) - 1;

        }

        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id == productId) {
                cart[i].quantity = input.value;
                break;
            }
        }

    localStorage.setItem('cart', JSON.stringify(cart));

        let tr = button.closest('tr');
        let totalProduct = tr.querySelector('.total-product');
        let price = parseFloat(tr.querySelector('.precio-producto').textContent);
        totalProduct.textContent = (price * input.value).toFixed(2);

        updateTotalPrice();
    }

    document.querySelectorAll('.fa-trash').forEach(function(icon) {
        icon.addEventListener('click', function() {
            var productId = this.closest('tr').getAttribute('data-product-id');
            this.closest('tr').remove();
            removeFromCart(productId);
            updateTotalPrice();
        });
    });

    function removeFromCart(productId) {
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(function(item) {
        return item.id != productId;
    });
    localStorage.setItem('cart', JSON.stringify(cart));
}

    function updateTotalPrice() {
        let totalPrice = document.getElementById('totalPrice');
        let products = document.querySelectorAll('.total-product');
        let total = 0;
        for (let i = 0; i < products.length; i++) {
            total += parseFloat(products[i].textContent);
        }
        totalPrice.textContent = total.toFixed(2);
    }
</script>
