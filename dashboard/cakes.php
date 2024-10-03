<?php
require_once '../core/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Cakes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Uploaded Cakes</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table id="cakesTable" class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be populated dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cakesTable').DataTable({
                ajax: {
                    url: 'get_cakes.php',
                    dataSrc: ''
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { 
                        data: 'price', 
                        render: function(data) { 
                            return '$' + parseFloat(data).toFixed(2); 
                        } 
                    },
                    { data: 'category' },
                    { 
                        data: 'image',
                        render: function(data, type, row) {
                            return '<img src="../' + data + '" alt="' + row.name + '" class="w-20 h-20 object-cover rounded">';
                        }
                    },
                    { 
                        data: 'description',
                        render: function(data) {
                            return '<div class="max-w-xs overflow-hidden">' + data.substring(0, 100) + (data.length > 100 ? '...' : '') + '</div>';
                        }
                    }
                ],
                drawCallback: function() {
                    $('table').addClass('w-full');
                    $('th, td').addClass('px-4 py-2 text-left');
                    $('.dataTables_wrapper').addClass('bg-white shadow-md rounded-lg overflow-hidden');
                    $('.dataTables_filter input').addClass('border border-gray-300 rounded px-2 py-1');
                    $('.dataTables_length select').addClass('border border-gray-300 rounded px-2 py-1');
                    $('.paginate_button').addClass('px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300');
                    $('.paginate_button.current').addClass('bg-blue-500 text-white');
                }
            });
        });
    </script>
</body>
</html>
