<script>
    $(document).ready(function() {
        // Update cart count on page load
        function updateCartCount() {
            $.ajax({
                url: '{{ route("cart.count") }}',
                method: 'GET',
                success: function(response) {
                    if (response && response.count !== undefined) {
                        $('#cart-count').text(response.count);
                    }
                },
                error: function() {
                    $('#cart-count').text('0');
                }
            });
        }
        
        // Initial update
        updateCartCount();
        
        // Add to cart function (global)
        window.addToCart = function(productId, quantity) {
            // Set default quantity to 1 if not provided
            if (!quantity || quantity < 1) {
                quantity = 1;
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
                    
                    // Show success notification
                    if (response && response.message) {
                        var toast = '<div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">' +
                            '<i class="fas fa-check-circle me-2"></i>' + response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                            '</div>';
                        
                        $('body').append(toast);
                        
                        // Auto remove after 3 seconds
                        setTimeout(function() {
                            $('.alert').alert('close');
                        }, 3000);
                    }
                },
                error: function(xhr) {
                    var errorMessage = 'Gagal menambahkan ke keranjang';
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    // Show error notification
                    var toast = '<div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">' +
                        '<i class="fas fa-exclamation-circle me-2"></i>' + errorMessage +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>';
                    
                    $('body').append(toast);
                    
                    // Auto remove after 5 seconds
                    setTimeout(function() {
                        $('.alert').alert('close');
                    }, 5000);
                }
            });
        };
    });
</script>