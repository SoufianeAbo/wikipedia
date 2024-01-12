const tagContainer = document.getElementById('tagContainer');

function handleCategoryChange(selectElement) {
    tagContainer.innerHTML = '';
}

document.addEventListener("DOMContentLoaded", function () {
    const tagCategorySelect = document.querySelector('select[name="tagCategory"]');
    const addBtn = document.getElementById('addBtn');

    let lastSelectedCategoryId = null;

    addBtn.addEventListener('click', function () {
        const selectedCategoryId = tagCategorySelect.value;

        if (!selectedCategoryId) {
            alert('Please select a category first.');
            return;
        }

        // Check if the category has changed
        if (selectedCategoryId !== lastSelectedCategoryId) {
            removeAllTagDropdowns();
            lastSelectedCategoryId = selectedCategoryId; // Update the last selected category
            fetchTags(selectedCategoryId);
        }
    });

    function fetchTags(categoryId) {
        const url = '../fetch_tags.php';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `categoryId=${categoryId}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    createTagDropdown(data.tags);
                }
            })
            .catch(error => {
                console.error('Error fetching tags:', error);
            });
    }

    function removeAllTagDropdowns() {
        const allTags = document.querySelectorAll(".nice");

        console.log("Number of elements with class 'nice':", allTags.length);
        allTags.forEach(tag => {
            tag.remove();
        });
    }

    function createTagDropdown(tags) {
        const newTagDropdown = createDropdown(tags);
        tagContainer.appendChild(newTagDropdown);
    }

    function createDropdown(options) {
        const dropdown = document.createElement('select');
        dropdown.classList.add("nice");
        options.forEach(option => {
            const tagOption = document.createElement('option');
            tagOption.value = option.id;
            tagOption.text = option.tag; // Use 'tag' instead of 'name'
            dropdown.appendChild(tagOption);
        });

        return dropdown;
    }
});
