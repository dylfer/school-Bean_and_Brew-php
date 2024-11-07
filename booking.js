// Get the necessary elements
const dateInput = document.getElementById("date");
const timeSelect = document.getElementById("time");
const tableSelect = document.getElementById("table");

// Fetch available time slots for a given date
function fetchAvailableTimes(date) {
  return fetch(`/api/available-times?date=${date}`)
    .then((response) => response.json())
    .then((times) => times)
    .catch((error) => {
      console.error("Error fetching available times:", error);
      return [];
    });
}

// Populate the time select options
async function populateTimeOptions() {
  const selectedDate = dateInput.value;
  const availableTimes = await fetchAvailableTimes(selectedDate);

  // Clear existing options
  timeSelect.innerHTML = '<option value="">Select a time</option>';

  // Add new options
  availableTimes.forEach((time) => {
    const option = document.createElement("option");
    option.value = time;
    option.text = time;
    timeSelect.add(option);
  });
}

// Handle date change to update available time slots
dateInput.addEventListener("change", populateTimeOptions);

// Handle form submission
document.getElementById("booking-form").addEventListener("submit", (event) => {
  event.preventDefault();

  // Get form data
  const formData = new FormData(event.target);

  // Send booking request to the server (without a PHP backend)
  // You would normally use an HTTP request library like Fetch or Axios
  // But for the sake of this example, we'll just log the form data
  console.log("Booking request:", Object.fromEntries(formData));

  // Reset the form
  event.target.reset();
});

// Populate table and time options when the page loads
populateTableOptions();
populateTimeOptions();
