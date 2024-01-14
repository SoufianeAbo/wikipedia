const tagContainer = document.getElementById('tagContainer');
let dropdowns = [];

function handleCategoryChange(selectElement) {
    removeAllTagDropdowns();
}

function removeAllTagDropdowns() {
    tagContainer.innerHTML = '';
    dropdowns = [];
    updateSelectedTagsValue();
}

function updateSelectedTagsValue() {
    const selectedTagsInput = document.getElementById('selected_tag_id');
    selectedTagsInput.value = dropdowns.map(dropdown => dropdown.value).join(',');
    console.log(selectedTagsInput.value);
}

document.addEventListener("DOMContentLoaded", function () {
    const tagCategorySelect = document.querySelector('select[name="tagCategory"]');
    const addBtn = document.getElementById('addBtn');
    const form = document.getElementById("selectForm");

    addBtn.addEventListener('click', function () {
        const selectedCategoryId = tagCategorySelect.value;

        if (!selectedCategoryId) {
            alert('Please select a category first.');
            return;
        }

        fetchTags(selectedCategoryId);
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

    function createTagDropdown(tags) {
        const newTagDropdown = createDropdown(tags);
        tagContainer.appendChild(newTagDropdown);

        const removeButton = document.createElement('button');
        removeButton.innerText = 'X';
        removeButton.className = "bg-red-500 px-2 text-black ml-2 rounded";
        removeButton.addEventListener('click', function () {
            tagContainer.removeChild(newTagDropdown);
            tagContainer.removeChild(removeButton);

            // Remove the tag from the selectedTags array
            const index = dropdowns.indexOf(newTagDropdown);

            if (index !== -1) {
                dropdowns.splice(index, 1);
            }

            updateSelectedTagsValue(); // Update the input value
        });

        tagContainer.appendChild(removeButton);

        dropdowns.push(newTagDropdown);

        const defaultSelectedOption = newTagDropdown.options[newTagDropdown.selectedIndex];
        const dropdownId = parseInt(defaultSelectedOption.value);
        updateSelectedTagsValue(); 

        newTagDropdown.addEventListener('change', function () {
            updateSelectedTagsValue(); 
        });

        tagCategorySelect.addEventListener('change', function () {
            dropdowns = []; // Clear dropdowns when a new category is selected
            updateSelectedTagsValue(); // Update the input value
        });
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

    function sendTagsToServer() {
        const selectedTagsString = dropdowns.map(dropdown => dropdown.value).join(',');
        console.log('Selected Tags:', selectedTagsString);

        const serverUrl = '../add_tags.php';

        fetch(serverUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `tags=${selectedTagsString}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server Response:', data);
        })
        .catch(error => {
            console.error('Error sending tags to server:', error);
        });
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        sendTagsToServer();

        form.submit();
    });
});

$(document).ready(function () {
    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'your_search_endpoint.php',
            data: { searchTerm: searchTerm },
            success: function (response) {
                $('#searchResults').html(response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});
