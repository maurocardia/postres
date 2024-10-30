document.addEventListener('DOMContentLoaded', function() {
    console.log("HOLA")
    const cartLink = document.getElementById('cart-link');
    const modal = document.getElementById('cart-modal');
    const closeBtn = document.querySelector('.close');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    let cart = [];

    // Función para formatear los precios a 4 cifras decimales
    
    function formatPrice(price) {
        
        return price.toFixed(3); // Formatea el precio a 4 cifras decimales
    }

    // Actualiza la interfaz del carrito
    function updateCartUI() {

        console.log("updateCartUI")
        cartItemsContainer.innerHTML = '';
        let total = 0;
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.innerHTML = `
                ${item.name} - $${formatPrice(item.price)}
                <button class="remove-item" data-index="${index}">&times;</button>
           ` ;
            cartItemsContainer.appendChild(li);
            total += item.price;
        });
        cartTotal.textContent = `Total: $${formatPrice(total)}`;
        // Guardar el carrito en localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        console.log("Carrito guardado en localStorage:", JSON.stringify(cart)); // Verificar el carrito guardado
        // Agregar eventos de eliminación a los botones
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.getAttribute('data-index');
                removeFromCart(index);
            });
        });
    }

    // Agregar un producto al carrito
    function addToCart(name, price) {
        console.log("addToCart")
        cart.push({ name, price });
        updateCartUI();
        modal.style.display = 'block'; // Mostrar el modal cuando se añade un producto
    }

    // Eliminar un producto del carrito
    function removeFromCart(index) {
        console.log("removeFromCart")
        cart.splice(index, 1); // Eliminar el producto del carrito
        updateCartUI(); // Actualizar la interfaz del carrito
    }

    // Mostrar el modal del carrito al hacer clic en el enlace del carrito
    cartLink.addEventListener('click', function(event) {
        
        event.preventDefault();
        modal.style.display = 'block';
    });

    // Cerrar el modal al hacer clic en el botón de cerrar
    closeBtn.addEventListener('click', function() {
        
        modal.style.display = 'none';
    });

    // Cerrar el modal si se hace clic fuera del modal
    window.addEventListener('click', function(event) {
        

        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Agregar productos al carrito desde los botones de añadir al carrito
    document.querySelectorAll('.add-cart').forEach(button => {
        
        button.addEventListener('click', function() {
           
            
            const productCard = this.closest('.card-product');
            const productName = productCard.querySelector('h3').textContent;
            const productPriceText = productCard.querySelector('.price').textContent;
            // Convierte el precio a número flotante
            const productPrice = parseFloat(productPriceText.replace(/[^0-9,.]/g, '').replace(',', '.'));
            addToCart(productName, productPrice);
        });
    });
});