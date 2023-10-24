const monthYearDate = document.querySelector('.month-year');
const numericDays = document.querySelector('.numeric-days');
const prevMonthBtn = document.querySelector('.prev-month-btn')
const nextMonthBtn = document.querySelector('.next-month-btn')

const fullDate = new Date();

let selectedMonth = fullDate.getMonth();
let selectedYear = fullDate.getFullYear();


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

const createCalendar = (selectedMonth, selectedYear) => {
	setMonthYearDate(selectedMonth, selectedYear);
	let firstDay = new Date(selectedYear, selectedMonth, 1).getDay();
	firstDay === 0 && (firstDay = 7);
	const lastDay = new Date(selectedYear, selectedMonth + 1, 0).getDate();
	const lastDayOfLastMonth = new Date(selectedYear, selectedMonth, 0).getDate();

	let tableHTML = '<tr>';

	startPrevMonthDay = lastDayOfLastMonth - firstDay + 2;

	let dayCounter = 0;
    //Dodawanie dni z poprzedniego miesiąca
	for (let i = startPrevMonthDay; i <= lastDayOfLastMonth; i++) {
		if (dayCounter === 7) {
			tableHTML += '</tr><tr>';

			dayCounter = 0;
		}
		tableHTML += `<td class="prev-month-day">${i}</td>`;
		dayCounter++;
	}
//Dodawanie dni z aktualnego miesiąca
	for (let i = 1; i <= lastDay; i++) {
		if (dayCounter === 7) {
			tableHTML += '</tr><tr>';

			dayCounter = 0;
		}

		tableHTML += `<td>${i}</td>`;
		dayCounter++;
	}
//Dodawanie dni z nastepnego miesiąca
	if (dayCounter !== 0) {
		const leftDays = 7 - dayCounter;

		for (let i = 1; i <= leftDays; i++) {
			tableHTML += `<td class="next-month-day">${i}</td>`;
			dayCounter++;
		}
		dayCounter = 0;
	}

	tableHTML += '</tr>';

	tableHTML += '</tr></tbody></table>';
	numericDays.innerHTML = tableHTML;
};

const setPrevMonth = () => { 
	if (selectedMonth === 0) {
		selectedMonth = 12
		selectedYear--
	}
	selectedMonth--
   createCalendar(selectedMonth, selectedYear);
 }


const setNextMonth = () => { 
	selectedMonth++
	if (selectedMonth === 12) {
		selectedMonth = 0
		selectedYear++
	}
	createCalendar(selectedMonth, selectedYear);
 }


createCalendar(selectedMonth, selectedYear);


prevMonthBtn.addEventListener('click', setPrevMonth)
nextMonthBtn.addEventListener('click', setNextMonth)