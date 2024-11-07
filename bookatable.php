<?php
require 'components/session.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <script src="booking.js" defer></script>
</head>
<body class="bg-gray-100">
  <div class="max-w-md mx-auto my-10 bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6">Book a Table</h1>

    <form id="booking-form" class="space-y-4">
      <div>
        <label for="date" class="block font-medium text-gray-700 mb-1">Date</label>
        <input type="date" id="date" name="date" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
      </div>

      <div>
        <label for="time" class="block font-medium text-gray-700 mb-1">Time</label>
        <select id="time" name="time" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
          <option value="">Select a time</option>
        </select>
      </div>

      <div>
        <label for="name" class="block font-medium text-gray-700 mb-1">Name</label>
        <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
      </div>

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-300">Book Now</button>
    </form>
  </div>
</body>
</html>

