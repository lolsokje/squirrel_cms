document.addEventListener('DOMContentLoaded', () => {
    const inputs = ['text'];
    const selects = ['category', 'editor', 'status'];
    const articleFilters = document.getElementsByClassName('article-filter');
    const articleBody = document.querySelector('#articles');
    let debounceTimer = null;

    inputs.forEach((input) => {
        const element = document.getElementById(input);
        element.addEventListener('keyup', () =>  {
            debounceApplyFilter();
        });
    });

    selects.forEach((select) => {
        const element = document.getElementById(select);
        element.addEventListener('change', () =>  {
            debounceApplyFilter();
        });
    });

    function applyFilter() {
        const params = {};
        for (const filter of articleFilters) {
            const key = filter.getAttribute('name');
            const value = filter.value;

            if (value !== '') {
                params[key] = value;
            }
        }

        const queryParams = Object.keys(params).map(key => key + '=' + params[key]).join('&');

        const url = `filters/articles?${queryParams}`;

        fetch(url)
            .then(response => response.text())
            .then(res => {
                articleBody.innerHTML = res;
            });
    }

    function debounceApplyFilter() {
        if (debounceTimer !== null) {
            clearTimeout(debounceTimer);
        }
        debounceTimer = setTimeout(() => {
            applyFilter()
        }, 100);
    }
});
