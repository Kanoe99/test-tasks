document.addEventListener('DOMContentLoaded', () => {
    const listDepthElement = document.getElementById('listDepth');
    const listDepth = listDepthElement ? parseInt(listDepthElement.getAttribute('data-depth')) : 0;

    document.querySelectorAll('.link').forEach(linkElement => {
        linkElement.addEventListener('click', event => {
            const parentItem = event.target.closest('li');
            const id = parentItem.querySelector('span').textContent.match(/id\s=\s(\d+)/)[1];

            // Check if already loaded
            if (parentItem.querySelector('ul')) {
                parentItem.querySelector('ul').remove(); // Toggle visibility
                return;
            }

            fetch(`fetch_groups.php?id_parent=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Create a nested list
                        const nestedList = document.createElement('ul');

                        data.data.forEach(item => {
                            const listItem = document.createElement('li');
                            listItem.innerHTML = `
                                <span class="link">
                                    ${item.name} <span>id = ${item.id}</span>
                                </span>
                            `;

                            // Add click listener for further nesting
                            if (listDepth > 1) {
                                listItem.querySelector('.link').addEventListener('click', event => {
                                    event.stopPropagation(); // Prevent parent list clicks
                                    loadNestedItems(listItem, item.id, listDepth - 1);
                                });
                            }

                            nestedList.appendChild(listItem);
                        });

                        parentItem.appendChild(nestedList);
                    } else {
                        console.error(data.message || 'Error loading data');
                    }
                })
                .catch(error => console.error('Error fetching group items:', error));
        });
    });

    function loadNestedItems(parentItem, id, remainingDepth) {
        if (remainingDepth === 0 || parentItem.querySelector('ul')) return;

        fetch(`fetch_groups.php?id_parent=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const nestedList = document.createElement('ul');

                    data.data.forEach(item => {
                        const listItem = document.createElement('li');
                        listItem.innerHTML = `
                            <span class="link">
                                ${item.name} <span>id = ${item.id}</span>
                            </span>
                        `;

                        // Add click listener for further nesting
                        if (remainingDepth > 1) {
                            listItem.querySelector('.link').addEventListener('click', event => {
                                event.stopPropagation();
                                loadNestedItems(listItem, item.id, remainingDepth - 1);
                            });
                        }

                        nestedList.appendChild(listItem);
                    });

                    parentItem.appendChild(nestedList);
                }
            })
            .catch(error => console.error(error));
    }
});
