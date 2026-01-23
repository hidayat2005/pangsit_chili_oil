<script>
    $(document).ready(function() {
        // Shared lock to prevent concurrent requests for the same product
        let cartLocks = {};

        // Update cart count on page load
        function updateCartCount() {
            $.ajax({
                url: '{{ route("cart.count") }}',
                method: 'GET',
                success: function(response) {
                    if (response && response.count !== undefined) {
                        const cartCount = $('#cart-count');
                        cartCount.text(response.count);
                        if (response.count == 0) {
                            cartCount.addClass('d-none');
                        } else {
                            cartCount.removeClass('d-none');
                        }
                    }
                }
            });
        }
        
        // Initial update
        updateCartCount();
        
        // Add to cart function (global)
        window.addToCart = function(productId, quantity, shouldRedirect = false) {
            // Prevent duplicate requests
            if (cartLocks[productId]) return;
            cartLocks[productId] = true;

            // Set default quantity to 1 if not provided
            quantity = parseInt(quantity) || 1;
            
            // Visual feedback - handle both button types
            let cartBtn = $(`.cart-button[data-product-id="${productId}"]`);
            let buyBtn = $(`.buy-button[data-product-id="${productId}"]`);
            let originalCartHtml = cartBtn.html();
            let originalBuyHtml = buyBtn.html();
            
            if (shouldRedirect) {
                buyBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            } else {
                cartBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            }

            $.ajax({
                url: '{{ route("cart.add") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    updateCartCount();
                    
                    if (shouldRedirect) {
                        window.location.href = '{{ route("cart.index") }}';
                    } else if (response && response.message) {
                        showNotification(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Gagal menambahkan ke keranjang';
                    showNotification(errorMessage, 'danger');
                },
                complete: function() {
                    // Release lock
                    cartLocks[productId] = false;
                    cartBtn.prop('disabled', false).html(originalCartHtml);
                    buyBtn.prop('disabled', false).html(originalBuyHtml);
                }
            });
        };

        // Helper for notifications
        window.showNotification = function(message, type) {
            const container = $('#toast-container');
            if (!container.length) return;

            let icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            let title = type === 'success' ? 'Berhasil!' : 'Gagal!';
            
            let toast = `<div class="alert alert-${type} alert-dismissible fade show border-0 shadow-sm slide-in-left custom-toast" role="alert">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas ${icon} fa-2x text-${type}"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-${type}">${title}</h6>
                        <p class="mb-0 text-dark small">${message}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            
            container.append(toast);
        }

        // Centralized Event Listener for all "Add to Cart" buttons
        $(document).on('click', '.cart-button', function(e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            if (productId) {
                window.addToCart(productId, 1, false);
            }
        });

        // Centralized Event Listener for all "Buy Now" buttons
        $(document).on('click', '.buy-button', function(e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            if (productId) {
                window.addToCart(productId, 1, true);
            }
        });
    });
</script>