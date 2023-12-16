const monthYearDate = document.querySelector('.month-year');
const numericDays = document.querySelector('.numeric-days');
const prevMonthBtn = document.querySelector('.prev-month-btn');
const nextMonthBtn = document.querySelector('.next-month-btn');

const fullDate = new Date();

let currentDay = fullDate.getDate();
let month = fullDate.getMonth();
let year = fullDate.getFullYear();

const setMonthYearDate = (month, year) => {
	const monthNames = [
		'Styczeń',
		'Luty',
		'Marzec',
		'Kwiecień',
		'Maj',
		'Czerwiec',
		'Lipiec',
		'Sierpień',
		'Wrzesień',
		'Październik',
		'Listopad',
		'Grudzień',
	];
	const monthName = monthNames[month];
	monthYearDate.innerHTML = `${monthName} ${year}`;
};

const createCalendar = (year, month, selectedDay = null) => {
	setMonthYearDate(month, year);

	let firstDay = new Date(year, month, 1).getDay();
	firstDay === 0 && (firstDay = 7);
	const lastDay = new Date(year, month + 1, 0).getDate();
	const lastDayOfLastMonth = new Date(year, month, 0).getDate();

	let tableHTML = '<tr>';

	const startPrevMonthDay = lastDayOfLastMonth - firstDay + 2;

	let dayCounter = 0;
	//Dodawanie dni z poprzedniego miesiąca
	for (let i = startPrevMonthDay; i <= lastDayOfLastMonth; i++) {
		if (dayCounter === 7) {
			tableHTML += '</tr><tr>';

			dayCounter = 0;
		}

		tableHTML += `<td class="prev-month-day date">${i}</td>`;

		dayCounter++;
	}
	//Dodawanie dni z aktualnego miesiąca
	for (let i = 1; i <= lastDay; i++) {
		if (dayCounter === 7) {
			tableHTML += '</tr><tr>';

			dayCounter = 0;
		}

		if (i === selectedDay) {
			tableHTML += `<td class="date active">${i}</td>`;
		} else if (i === selectedDay){
			tableHTML += `<td class="date active">${i}</td>`;
		} else {
			tableHTML += `<td class="date">${i}</td>`;
		}
		dayCounter++;
	}
	//Dodawanie dni z nastepnego miesiąca
	if (dayCounter !== 0) {
		const leftDays = 7 - dayCounter;

		for (let i = 1; i <= leftDays; i++) {
			tableHTML += `<td class="next-month-day date">${i}</td>`;

			dayCounter++;
		}
		dayCounter = 0;
	}

	tableHTML += '</tr></tbody></table>';
	numericDays.innerHTML = tableHTML;

	//Ustawianie listenerów na daty
	const tdElements = document.querySelectorAll('.date');
	tdElements.forEach(td => td.addEventListener('click', selectDate));

	// localStorage.removeItem('storedDate')
};

//Wybieranie innych miesięcy
const selectPrevMonth = () => {
	let storedDate = JSON.parse(localStorage.getItem('storedDate')) || { year, month };
const selectedDate = JSON.parse(localStorage.getItem('selectedDate'))
	if (storedDate.month === 0) {
		storedDate.month = 11;
		storedDate.year--;
	} else {
		storedDate.month--;
	}

	localStorage.setItem('storedDate', JSON.stringify(storedDate));
	createCalendar(storedDate.year, storedDate.month);

	if (storedDate.month === selectedDate.month) {
		setActiveDate(selectedDate.day);
	}
};

const selectNextMonth = () => {
	let storedDate = JSON.parse(localStorage.getItem('storedDate')) || { year, month };
const selectedDate = JSON.parse(localStorage.getItem('selectedDate'))
	if (storedDate.month === 11) {
		storedDate.month = 0;
		storedDate.year++;
	} else {
		storedDate.month++;
	}

	localStorage.setItem('storedDate', JSON.stringify(storedDate));
	createCalendar(storedDate.year, storedDate.month);

	if (storedDate.month === selectedDate.month) {
		setActiveDate(selectedDate.day);
	}
};

// Ustawienie aktywnej daty jeśli wybrany miesiąc jest równy aktualnemu
const setActiveDate = (selectedDay) => {

	const tdElements = document.querySelectorAll('.date');
	const tdArray = Array.from(tdElements);

	const tdActive = tdArray.find(
		td =>
			td.textContent === selectedDay.toString() &&
			!td.classList.contains('prev-month-day') &&
			!td.classList.contains('next-month-day')
	);

	if (tdActive) {
		tdActive.classList.add('active');
	}
};

//Wybieranie zadań z innej daty
const selectDate = e => {
	let day = Number(e.target.textContent);
	let storedDate = JSON.parse(localStorage.getItem('storedDate')) || { year, month };

	if (e.target.classList.contains('next-month-day') && storedDate.month === 11) {
		storedDate.month = 0;
		storedDate.year++;
	} else if (e.target.classList.contains('next-month-day')) {
		storedDate.month++;
	} else if (e.target.classList.contains('prev-month-day') && storedDate.month === 0) {
		storedDate.month = 11;
		storedDate.year--;
	} else if (e.target.classList.contains('prev-month-day')) {
		storedDate.month--;
	}

	const date = `${storedDate.year}-${storedDate.month + 1}-${day}`;

	sendDateData(date);
};

//Wysyłanie danych
const sendDateData = date => {
	fetch('../app/includes/selected_date.inc.php', {
		method: 'POST',
		headers: {
			'Content-type': 'application/x-www-form-urlencoded',
		},
		body: 'date=' + date,
	})
		.then(response => response.json())
		.then(data => {
			// Ustawienie danych w localStorage
			const dateArray = data.split('-');
			const year = Number(dateArray[0]);
			const month = Number(dateArray[1]) - 1;
			const day = Number(dateArray[2]);

			localStorage.setItem('selectedDate', JSON.stringify({ year, month, day }));

			localStorage.setItem('storedDate', JSON.stringify({ year, month }));
		})
		.then(() => location.reload())
		.catch(error => {
			console.error('Wystąpił błąd:', error);
		});
};

// Pobieranie wybranej daty z LocalStorage
const selectedDate = JSON.parse(localStorage.getItem('selectedDate'));

const storedDate = JSON.parse(localStorage.getItem('storedDate'));

// Tworzenie kalendarza zależnie czy została wybrana data
if (selectedDate && storedDate) {
	createCalendar(selectedDate.year, selectedDate.month, selectedDate.day);
}  else {
	localStorage.setItem('selectedDate', JSON.stringify({ year, month, day: currentDay }));
	localStorage.setItem('storedDate', JSON.stringify({ year, month }));
	createCalendar(year, month, currentDay);
}

//addEventListener'y
prevMonthBtn.addEventListener('click', selectPrevMonth);
nextMonthBtn.addEventListener('click', selectNextMonth);
