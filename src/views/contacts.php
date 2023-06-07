<!DOCTYPE html>
<html>
<head>
    <title>Contact List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Contact List</h1>
    <table class="w-full bg-white border border-gray-200">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Message</th>
            <th class="py-2 px-4 border-b">Created At</th>
            <th class="py-2 px-4 border-b">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td class="py-2 px-4 border-b"><?= $contact['id'] ?></td>
                <td class="py-2 px-4 border-b"><?= $contact['name'] ?></td>
                <td class="py-2 px-4 border-b"><?= $contact['email'] ?></td>
                <td class="py-2 px-4 border-b"><?= $contact['message'] ?></td>
                <td class="py-2 px-4 border-b"><?= $contact['created_at'] ?></td>
                <td class="py-2 px-4 border-b">
                    <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded" onclick="deleteContact(<?= $contact['id'] ?>)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function deleteContact(contactId) {
        if (confirm("Yakin ingin menghapus data ini?")) {

            fetch('http://127.0.0.1:8000/delete', {
                method: 'POST',
                body: JSON.stringify({ id: contactId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Handle response
                    alert("Contact berhasil dihapus.");
                    // Refresh the page or update the table using JavaScript as needed
                    location.reload();
                })
                .catch(error => {
                    // Handle error
                    console.log(error);
                    alert("An error occurred while deleting the contact.");
                });
        }
    }
</script>
</body>
</html>