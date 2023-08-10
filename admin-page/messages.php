<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cc.css">
    <style>
      body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
}

.container {
    max-width: 1200px;
}



.order-table {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

.delete-message {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.delete-message:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}


.pagination .page-link {
    color: #4a4a4a;
}

.pagination .page-link:hover {
    background-color: #f8f9fa;
}

.pagination .active .page-link {
    background-color: #4a4a4a;
    border-color: #4a4a4a;
}
    </style>
    
</head>
<body>
    
<?php include 'admin.html' ?>
<section class="home-section">
<h1 class="mb-4">Contact Messages</h1>
<div class="container mt-5">
        
        <div id="message-section">
            <!-- The messages will be loaded here using AJAX -->
        
<?php
require_once 'config.php';

// Pagination and search parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Calculate the offset for the LIMIT clause
$limit = 10;
$offset = ($page - 1) * $limit;

// Query messages from the database
$search_sql ='';
$search ? "WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR message LIKE '%$search%'" : "";
$sql = "SELECT * FROM contact_form $search_sql ORDER BY timestamp DESC LIMIT $offset, $limit";
$result = $conn->query($sql);

// Count total messages for pagination
$count_sql = "SELECT COUNT(*) FROM contact_form $search_sql";
$count_result = $conn->query($count_sql);
$total_messages = $count_result->fetch_row()[0];
$total_pages = ceil($total_messages / $limit);

// Display messages and search bar


if ($result->num_rows > 0) {

    // Display messages
    
    echo ' <div class="order-table">
    <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['message']) . '</td>
                <td>' . date('Y-m-d', strtotime($row['timestamp'])) . '</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-message" data-id="' . $row['id'] . '">Delete</button>
                </td>
              </tr>';
    }

    echo '</tbody>
        </table>
        </div>';

   

    

    echo '  </ul>
          </nav>';
} else {
    echo '<p>No messages found.</p>';
}

$conn->close();
?>
</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
    loadMessages(1, '');

    // Handle pagination click
    $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();
        var page = $(this).attr('data-page');
        var search = $('#search-input').val();
        loadMessages(page, search);
    });

    // Handle search input
    $('#search-input').on('input', function () {
        var search = $(this).val();
        loadMessages(1, search);
    });

    // Handle delete message
    $(document).on('click', '.delete-message', function () {
        var messageId = $(this).attr('data-id');
        if (confirm('Are you sure you want to delete this message?')) {
            deleteMessage(messageId);
            location.reload();
        }
    });
});

function loadMessages(page, search) {
    $.ajax({
        url: 'load_messages.php',
        type: 'GET',
        data: {
            page: page,
            search: search
        },
        success: function (data) {
            $('#message-section').html(data);
        }
    });
}

function deleteMessage(messageId) {
    $.ajax({
        url: 'delete_message.php',
        type: 'POST',
        data: {
            id: messageId
        },
        success: function (data) {
            if (data === 'success') {
                var currentPage = $('.pagination .active').text();
                var search = $('#search-input').val();
                loadMessages(currentPage, search);
            } else {
                alert('Error deleting message.');
            }
        }
    });
}
</script>
</section>
</body>
</html>