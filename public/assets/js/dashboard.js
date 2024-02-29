const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});





const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})


/* filter */

document.addEventListener('DOMContentLoaded', function () {
    const filterDropdown = document.getElementById('filterDropdown');
    const searchInput = document.getElementById('searchInput');

    // Event listener for changes in dropdown or search input
    function handleSearchAndFilter() {
        const selectedOption = filterDropdown.value;
        const searchText = searchInput.value.toLowerCase();

        // Your logic for searching and filtering goes here
        // Example: Change H3 text based on the selected option
        const h3Element = document.querySelector('.user-list h3');
        h3Element.textContent = `List of ${selectedOption.charAt(0).toUpperCase() + selectedOption.slice(1)}`;

        // Example: Filter table rows based on search text
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const userText = row.querySelector('td p').textContent.toLowerCase();
            row.style.display = userText.includes(searchText) ? 'table-row' : 'none';
        });
    }

    // Attach the event listener to the dropdown and search input
    filterDropdown.addEventListener('change', handleSearchAndFilter);
    searchInput.addEventListener('input', handleSearchAndFilter);
});

    // Event listener for the filter dropdown
    const filterDropdown = document.getElementById('filterDropdown');
    filterDropdown.addEventListener('change', function () {
        const selectedOption = filterDropdown.value;
        const searchText = document.getElementById('searchInput').value;
        searchAndFilter(selectedOption, searchText);
    });

    // Event listener for the search icon
    const searchIcon = document.querySelector('.search-icon');
    searchIcon.addEventListener('click', function () {
        const selectedOption = filterDropdown.value;
        const searchText = document.getElementById('searchInput').value;
        searchAndFilter(selectedOption, searchText);
    });


/* TODO LIST */
// public/js/todo.js

document.addEventListener('DOMContentLoaded', function () {
    const todoForm = document.getElementById('todoForm');
    const todoList = document.querySelector('.todo-list');

    // Function to add a new todo
    const addTodo = async (text) => {
        try {
            const response = await fetch('/todos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ text }),
            });

            if (response.ok) {
                const todo = await response.json();
                displayTodo(todo);
            } else {
                console.error('Failed to add todo');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    // Function to display a todo in the list
    const displayTodo = (todo) => {
        const li = document.createElement('li');
        li.textContent = todo.text;

        const dotsIcon = document.createElement('i');
        dotsIcon.className = 'bx bx-dots-vertical-rounded';

        li.appendChild(dotsIcon);
        todoList.appendChild(li);
    };

    // Event listener for form submission
    todoForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        const textInput = this.querySelector('input[name="text"]');
        const text = textInput.value.trim();

        if (text) {
            addTodo(text);
            textInput.value = '';
        }
    });

    // Fetch existing todos on page load
    const fetchTodos = async () => {
        try {
            const response = await fetch('/todos');
            if (response.ok) {
                const todos = await response.json();
                todos.forEach(todo => displayTodo(todo));
            } else {
                console.error('Failed to fetch todos');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    fetchTodos();
});
