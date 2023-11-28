document.addEventListener('DOMContentLoaded', function () {
    loadSchedulingData();
});

function loadSchedulingData() {
    const schedulingList = document.getElementById('schedulingList');
    const storedScheduling = JSON.parse(localStorage.getItem('schedulingData')) || [];

    // Clear the scheduling list before loading
    schedulingList.innerHTML = '';

    storedScheduling.forEach(data => {
        const schedulingDiv = createSchedulingElement(data);
        schedulingList.appendChild(schedulingDiv);
    });
}

function addScheduling() {
    const tuitionClassSelect = document.getElementById('class');
    const tuitionClass = tuitionClassSelect.options[tuitionClassSelect.selectedIndex].value;
    const startTime = document.getElementById('startTime').value;
    const finishTime = document.getElementById('finishTime').value;
    const daysPerWeek = document.getElementById('daysPerWeek').value;

    // Check if all values are provided
    if (tuitionClass === "" || startTime === "" || finishTime === "" || daysPerWeek === "") {
        alert("Please fill in all fields before adding scheduling.");
        return;
    }

    const schedulingData = {
        tuitionClass,
        startTime,
        finishTime,
        daysPerWeek
    };

    // Save new scheduling data to localStorage
    saveSchedulingData(schedulingData);

    // Reload scheduling data after adding a new entry
    loadSchedulingData();
}

function createSchedulingElement(data) {
    const schedulingDiv = document.createElement('div');
    schedulingDiv.classList.add('scheduling');

    const startTimeObj = new Date(`1970-01-01T${data.startTime}`);
    const formattedStartTime = startTimeObj.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });

    const finishTimeObj = new Date(`1970-01-01T${data.finishTime}`);
    const formattedFinishTime = finishTimeObj.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });

    if (data.tuitionClass.toLowerCase() === 'admission') {
        schedulingDiv.innerHTML = `
            <p>Tuition Class: Admission</p>
            <p>Start Time: ${formattedStartTime}</p>
            <p>Finish Time: ${formattedFinishTime}</p>
            <p>In a Week: ${data.daysPerWeek} days</p>
            <button class="delete-btn" onclick="deleteScheduling(this)">Delete</button>
        `;
    } else {
        schedulingDiv.innerHTML = `
            <p>Tuition Class: ${data.tuitionClass}</p>
            <p>Start Time: ${formattedStartTime}</p>
            <p>Finish Time: ${formattedFinishTime}</p>
            <p>In a Week: ${data.daysPerWeek} days</p>
            <button class="delete-btn" onclick="deleteScheduling(this)">Delete</button>
        `;
    }

    return schedulingDiv;
}

function saveSchedulingData(data) {
    const storedScheduling = JSON.parse(localStorage.getItem('schedulingData')) || [];
    storedScheduling.push(data);
    localStorage.setItem('schedulingData', JSON.stringify(storedScheduling));
}

function deleteScheduling(deleteBtn) {
    const confirmDelete = confirm('Are you sure you want to delete this scheduling?');
    if (confirmDelete) {
        const schedulingDiv = deleteBtn.parentElement;

        // Remove deleted scheduling from localStorage
        removeSchedulingData(schedulingDiv);

        // Reload scheduling data after deleting an entry
        loadSchedulingData();
    }
}

function removeSchedulingData(deletedDiv) {
    const storedScheduling = JSON.parse(localStorage.getItem('schedulingData')) || [];
    const schedulingIndex = Array.from(deletedDiv.parentNode.children).indexOf(deletedDiv);

    if (schedulingIndex !== -1) {
        storedScheduling.splice(schedulingIndex, 1);
        localStorage.setItem('schedulingData', JSON.stringify(storedScheduling));
    }
}
