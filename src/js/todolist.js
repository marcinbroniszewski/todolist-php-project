const removeTodoBtns = document.querySelectorAll('.remove-todo-btn');
const editTodoBtns = document.querySelectorAll('.edit-todo-btn');
const editTodoPanel = document.querySelector('.edit-todo-panel');
const closeTodoPanelBtn = document.querySelector('.close-todo-panel');
const saveChangesBtn = document.querySelector('.save-changes');
const editTodoInput = document.querySelector('.edit-todo-input');
const checkboxes = document.querySelectorAll('.todo-checkbox');

let todoId = null;

const removeTodo = e => {
	const parentDiv = e.target.parentElement;
	const id = parentDiv.id;

	fetch('../app/includes/remove_todo.inc.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: 'id=' + id,
	})
		.then(parentDiv.remove())
		.catch(error => {
			console.error('Wystąpił błąd:', error);
		});
};

const isEditInputValid = () => {
	if (editTodoInput.value !== '') {
		return true;
	} else {
		editTodoInput.classList.add('error');
		editTodoInput.placeholder = 'Podaj prawidłową nazwę zadania';
		return false;
	}
};

const updateTodo = (todoId, title) => {
	if (isEditInputValid()) {
		const params = new URLSearchParams();
		params.append('id', todoId);
		params.append('title', title);

		fetch('../app/includes/edit_todo.inc.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: params,
		})
			.then(() => location.reload())
			.catch(error => {
				console.error('Wystąpił błąd:', error);
			});
	}
};

const toggleCompleteTodo = e => {
	const id = e.target.getAttribute('data-todo-id');

	fetch('../app/includes/complete_todo.inc.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: 'id=' + id,
	}).catch(error => {
		console.error('Wystąpił błąd:', error);
	});
};

const openEditTodoPanel = e => {
	editTodoPanel.classList.add('visible');
	todoId = e.target.getAttribute('data-todo-id');
};

const closeEditTodoPanel = () => {
	editTodoPanel.classList.remove('visible');
	editTodoInput.classList.remove('error');
	editTodoInput.placeholder = 'Podaj nową nazwę zadania';
	todoId = null;
};

removeTodoBtns.forEach(btn => {
	btn.addEventListener('click', removeTodo);
});
editTodoBtns.forEach(btn => {
	btn.addEventListener('click', openEditTodoPanel);
});
checkboxes.forEach(checkbox => {
	checkbox.addEventListener('click', toggleCompleteTodo)
})
closeTodoPanelBtn.addEventListener('click', closeEditTodoPanel);
saveChangesBtn.addEventListener('click', () => {
	if (todoId) {
		const title = editTodoInput.value;
		updateTodo(todoId, title);
	}
});
