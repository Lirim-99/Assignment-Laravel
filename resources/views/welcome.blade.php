<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Employee CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <h1 class="text-3xl font-bold">Laravel Employee CRUD</h1>
                    </div>
                </header>

                <!-- Notifications -->
                <div id="notification" class="hidden fixed top-4 right-4 text-white p-4 rounded">
                    <span id="notification-message"></span>
                </div>

                <main class="mt-6">
                    <!-- Create Employee Form Toggle Button -->
                    <div class="flex justify-end mb-4">
                        <button onclick="document.getElementById('create-employee-form').classList.toggle('hidden')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Create Employee</button>
                    </div>

                    <!-- Create Employee Form -->
                    <div id="create-employee-form" class="hidden w-full max-w-md mx-auto mb-6">
                        <form action="{{ route('employees.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First Name</label>
                                <input type="text" name="first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                                <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                            </div>
                        </form>
                    </div>

                    <!-- Employee Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow-md rounded">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">First Name</th>
                                    <th class="py-2 px-4 border-b text-left">Last Name</th>
                                    <th class="py-2 px-4 border-b text-left">Email</th>
                                    <th class="py-2 px-4 border-b text-left">Phone Number</th>
                                    <th class="py-2 px-4 border-b text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr id="employee-{{ $employee->id }}" class="hover:bg-gray-100">
                                        <td class="py-2 px-4 border-b">{{ $employee->first_name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $employee->last_name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $employee->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $employee->phone_number }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <button onclick="document.getElementById('edit-employee-form-{{ $employee->id }}').classList.toggle('hidden')" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">Edit</button>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block delete-form" data-id="{{ $employee->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Employee Form -->
                                    <tr id="edit-employee-form-{{ $employee->id }}" class="hidden">
                                        <td colspan="5">
                                            <form action="{{ route('employees.update', $employee) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First Name</label>
                                                    <input type="text" name="first_name" value="{{ $employee->first_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" value="{{ $employee->last_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                                                    <input type="email" name="email" value="{{ $employee->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                                                    <input type="text" name="phone_number" value="{{ $employee->phone_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                                                    <button type="button" onclick="document.getElementById('edit-employee-form-{{ $employee->id }}').classList.add('hidden')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Employee Management Task
                </footer>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle delete form submission
            $('.delete-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var id = form.data('id');

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        $('#employee-' + id).remove();
                        showNotification('Employee deleted successfully.', 'success');
                    },
                    error: function(response) {
                        showNotification('An error occurred while deleting the employee.', 'error');
                    }
                });
            });

            // Show notification
            function showNotification(message, type = 'success') {
                var notification = $('#notification');
                var messageSpan = $('#notification-message');
                messageSpan.text(message);
                notification.removeClass('bg-green-500 bg-red-500').addClass(type === 'success' ? 'bg-green-500' : 'bg-red-500');
                notification.fadeIn();

                setTimeout(function() {
                    notification.fadeOut();
                }, 3000);
            }

            // Show success message if present in session
            @if (session('success'))
                showNotification("{{ session('success') }}");
            @endif
        });
    </script>
</body>
</html>
