<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Add Contact</h1>
    <form action="http://127.0.0.1:8000/create" method="POST">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-bold mb-2">Message:</label>
            <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500" required></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded">Add Contact</button>
        </div>
    </form>
</div>
</body>
</html>