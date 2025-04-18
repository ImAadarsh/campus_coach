<script>
$(document).ready(function() {
    // Search functionality
    let searchTimeout;
    const searchBox = $('#globalSearch');
    const resultsContainer = $('.search-results');
    const searchItems = $('.search-items');
    const searchLoading = $('.search-loading');

    searchBox.on('input', function() {
        const searchTerm = $(this).val().trim();
        
        if (searchTerm.length < 2) {
            resultsContainer.hide();
            return;
        }

        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(searchTerm);
        }, 300);
    });

    function performSearch(term) {
        searchLoading.show();
        searchItems.hide();
        resultsContainer.show();

        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { q: term },
            dataType: 'json',
            success: function(response) {
                searchLoading.hide();
                searchItems.show();
                
                if (response.error) {
                    searchItems.html('<div class="search-item text-center text-muted">' + response.error + '</div>');
                    return;
                }

                if (response.length === 0) {
                    searchItems.html('<div class="search-item text-center text-muted">No results found</div>');
                    return;
                }

                let html = '';
                response.forEach(item => {
                    html += `
                        <a href="${item.url}" class="search-item d-block text-decoration-none">
                            <div class="title">${item.title}</div>
                            <div class="subtitle">${item.subtitle}</div>
                            <div class="meta">
                                <span class="me-2">${item.date}</span>
                                <span class="me-2">${item.time}</span>
                                ${item.status ? `<span class="badge bg-${item.status === 'confirmed' ? 'success' : 'warning'}">${item.status}</span>` : ''}
                                ${item.payment_status ? `<span class="badge bg-${item.payment_status === 'completed' ? 'success' : 'warning'}">${item.payment_status}</span>` : ''}
                            </div>
                        </a>
                    `;
                });
                searchItems.html(html);
            },
            error: function() {
                searchLoading.hide();
                searchItems.show();
                searchItems.html('<div class="search-item text-center text-danger">Error occurred while searching</div>');
            }
        });
    }

    // Hide search results when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-form').length) {
            resultsContainer.hide();
        }
    });
});
</script>
