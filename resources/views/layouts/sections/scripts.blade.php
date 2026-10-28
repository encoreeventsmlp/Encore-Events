
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')

<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

@stack('pricing-script')

@yield('page-script')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('global-search');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    if (searchInput && searchResults) {

        function showResults() {
            searchResults.style.display = 'block';
        }

        function hideResults() {
            setTimeout(() => {
                searchResults.style.display = 'none';
            }, 200);
        }

        function performSearch(query) {
            if (query.length < 2) {
                searchResults.innerHTML = '';
                hideResults();
                return;
            }

            fetch(`{{ route('admin.search') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displayResults(data.results);
                    showResults();
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchResults.innerHTML = '<div class="p-3 text-muted">Search error occurred</div>';
                    showResults();
                });
        }

        function displayResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = '<div class="p-3 text-muted">No results found</div>';
                return;
            }

            let html = '';
            results.forEach(result => {
                html += `
                    <a href="${result.url}" class="d-block p-3 text-decoration-none border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <span class="badge bg-label-${result.color} rounded-circle p-2">
                                    <i class="${result.icon}"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark">${result.title}</h6>
                                <small class="text-muted">${result.type}</small>
                                <div class="text-muted small">${result.description}</div>
                            </div>
                        </div>
                    </a>
                `;
            });

            searchResults.innerHTML = html;
        }

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });

        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 2) {
                showResults();
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                hideResults();
            }
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideResults();
                this.blur();
            }
        });
    }
});
</script>
