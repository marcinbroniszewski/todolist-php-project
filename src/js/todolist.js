const removeTodoBtns = document.querySelectorAll('.remove-todo-btn');
const editTodoBtns = document.querySelectorAll('.edit-todo-btn');
const saveChangesBtn = document.querySelector('.save-changes');
const editTodoInput = document.querySelector('.edit-todo-input');
const editTodoDescription = document.querySelector('.edit-todo-description');
const checkboxes = document.querySelectorAll('.todo-checkbox');

let todoId = null;

const setTaskCounter = () => { 
	const todoItems = document.querySelectorAll('.todo')
	const taskCounter = document.querySelector('.task-counter')

	const tasksAmount = todoItems.length

	if (tasksAmount >= 2) {
		taskCounter.textContent = `Masz ${todoItems.length} zadania do zrobienia`
	} else if (tasksAmount === 1) {
		taskCounter.textContent = `Masz jedno zadanie do zrobienia`
	} else {
		taskCounter.textContent = 'Nie masz żadnych zadań do zrobienia'
	}

 }

setTaskCounter()

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
		setTaskCounter()
};


const updateTodo = (todoId, title = null, description = null) => {
	const modalElement = document.getElementById('editTodoModal');
	const modalBackdrop = document.querySelector('.modal-backdrop')
	const modal = new bootstrap.Modal(modalElement);
  
	if (!title && !description) {
	  modalElement.classList.remove('show');
	  modalElement.setAttribute('aria-hidden', 'true');
	  modalElement.setAttribute('style', 'display: none');
	  document.body.classList.remove('modal-open');
	  modalBackdrop.remove();
	  return;
	}
  

		const params = new URLSearchParams();
		params.append('id', todoId);
		params.append('title', title);
		params.append('description', description);

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
	todoId = e.target.getAttribute('data-todo-id');
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
saveChangesBtn.addEventListener('click', () => {
	if (todoId) {
		const title = editTodoInput.value;
		const description = editTodoDescription.value;
		updateTodo(todoId, title, description);
	}
});
