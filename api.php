<?php
session_start();
require 'config.php';
header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

function sendResponse($success, $data = [], $message = '') {
    echo json_encode(['success' => $success, 'data' => $data, 'message' => $message]);
    exit;
}

if ($action == 'get_products') {
    try {
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        $limit = 10;
        $offset = $page * $limit;

        $query = "SELECT * FROM products WHERE 1=1";
        $params = [];
        if ($category && $category !== 'All') {
            $query .= " AND category = :category";
            $params[':category'] = $category;
        }
        if ($search) {
            $query .= " AND (name LIKE :search OR description LIKE :search)";
            $params[':search'] = "%$search%";
        }
        $query .= " LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse(true, $products);
    } catch (Exception $e) {
        error_log("Product fetch error: " . $e->getMessage());
        sendResponse(false, [], "Failed to fetch products: " . $e->getMessage());
    }
}

if ($action == 'get_categories') {
    $stmt = $conn->query("SELECT DISTINCT category FROM products");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    array_unshift($categories, 'All');
    sendResponse(true, $categories);
}

if ($action == 'add_to_cart') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login to add items to cart.');
    }
    $product_id = $_POST['product_id'];
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    if (isset($cart[$product_id])) {
        $cart[$product_id]++;
    } else {
        $cart[$product_id] = 1;
    }
    $_SESSION['cart'] = $cart;
    sendResponse(true, ['cart_count' => array_sum($cart)]);
}

if ($action == 'get_cart') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login to view cart.');
    }
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $items = [];
    $total = 0;
    foreach ($cart as $product_id => $qty) {
        $stmt = $conn->prepare("SELECT id, name, price, image FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $items[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => $qty,
                'total' => $product['price'] * $qty
            ];
            $total += $product['price'] * $qty;
        }
    }
    sendResponse(true, ['items' => $items, 'total' => $total]);
}

if ($action == 'remove_from_cart') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login to modify cart.');
    }
    $product_id = $_POST['product_id'];
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    unset($cart[$product_id]);
    $_SESSION['cart'] = $cart;
    sendResponse(true, ['cart_count' => array_sum($cart)]);
}

if ($action == 'place_order') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login to place an order.');
    }
    $user_id = $_SESSION['user_id'];
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    if (empty($cart)) {
        sendResponse(false, [], 'Cart is empty.');
    }

    $conn->beginTransaction();
    try {
        $total = 0;
        foreach ($cart as $product_id => $qty) {
            $stmt = $conn->prepare("SELECT price, stock FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product['stock'] < $qty) {
                throw new Exception("Insufficient stock for product ID $product_id");
            }
            $total += $product['price'] * $qty;
        }

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total, status) VALUES (?, ?, 'ordered')");
        $stmt->execute([$user_id, $total]);
        $order_id = $conn->lastInsertId();

        foreach ($cart as $product_id => $qty) {
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $price = $stmt->fetchColumn();
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $product_id, $qty, $price]);
            $order_item_id = $conn->lastInsertId();
            $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
            $stmt->execute([$qty, $product_id]);
            $stmt = $conn->prepare("INSERT INTO order_status_updates (order_item_id, status) VALUES (?, 'ordered')");
            $stmt->execute([$order_item_id]);
        }

        $_SESSION['cart'] = [];
        $conn->commit();
        sendResponse(true, ['order_id' => $order_id], 'Order placed successfully.');
    } catch (Exception $e) {
        $conn->rollBack();
        sendResponse(false, [], 'Failed to place order: ' . $e->getMessage());
    }
}

if ($action == 'add_product') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $seller_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    try {
        $stmt = $conn->prepare("INSERT INTO products (seller_id, name, description, price, category, image, stock) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $success = $stmt->execute([$seller_id, $name, $description, $price, $category, $image, $stock]);
        sendResponse($success, [], $success ? 'Product added successfully.' : 'Failed to add product.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to add product: ' . $e->getMessage());
    }
}

if ($action == 'get_seller_products') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $seller_id = $_SESSION['user_id'];
    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE seller_id = ?");
        $stmt->execute([$seller_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse(true, $products);
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to fetch products: ' . $e->getMessage());
    }
}

if ($action == 'get_user_orders') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login.');
    }
    $user_id = $_SESSION['user_id'];
    try {
        $stmt = $conn->prepare("SELECT o.id, o.total, o.created_at, oi.id AS order_item_id, oi.quantity, oi.price, p.name, p.image, osu.status, rr.status AS return_status
                                FROM orders o 
                                JOIN order_items oi ON o.id = oi.order_id 
                                JOIN products p ON oi.product_id = p.id 
                                JOIN order_status_updates osu ON oi.id = osu.order_item_id 
                                LEFT JOIN return_requests rr ON oi.id = rr.order_item_id
                                WHERE o.user_id = ? 
                                ORDER BY osu.updated_at DESC, rr.updated_at DESC");
        $stmt->execute([$user_id]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $uniqueOrders = [];
        foreach ($orders as $order) {
            if (!isset($uniqueOrders[$order['order_item_id']])) {
                $uniqueOrders[$order['order_item_id']] = $order;
            }
        }
        sendResponse(true, array_values($uniqueOrders));
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to fetch orders: ' . $e->getMessage());
    }
}

if ($action == 'get_order_status') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login.');
    }
    $order_item_id = $_POST['order_item_id'];
    try {
        // Fetch delivery status updates
        $stmt = $conn->prepare("SELECT osu.status, osu.updated_at 
                                FROM order_status_updates osu 
                                JOIN order_items oi ON osu.order_item_id = oi.id 
                                JOIN orders o ON oi.order_id = o.id 
                                WHERE osu.order_item_id = ? 
                                AND (o.user_id = ? OR ? IN (SELECT id FROM users WHERE role = 'seller' AND id = (SELECT seller_id FROM products WHERE id = oi.product_id)))
                                AND osu.status IN ('ordered', 'shipped', 'delivered')
                                ORDER BY osu.updated_at ASC");
        $stmt->execute([$order_item_id, $_SESSION['user_id'], $_SESSION['user_id']]);
        $delivery_updates = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // If no updates, assume the order starts at 'ordered'
        if (empty($delivery_updates)) {
            $delivery_updates = [['status' => 'ordered', 'updated_at' => date('Y-m-d H:i:s')]];
        }

        // Fetch return status updates, reason, and images
        $stmt = $conn->prepare("SELECT status, updated_at, reason, images FROM return_requests WHERE order_item_id = ? ORDER BY updated_at ASC");
        $stmt->execute([$order_item_id]);
        $return_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return_updates = array_map(function($row) {
            return ['status' => $row['status'], 'updated_at' => $row['updated_at']];
        }, $return_data);
        $return_reason = !empty($return_data) ? $return_data[0]['reason'] : null;
        $return_images = !empty($return_data) && $return_data[0]['images'] ? json_decode($return_data[0]['images'], true) : [];

        sendResponse(true, [
            'delivery_updates' => $delivery_updates,
            'return_updates' => $return_updates,
            'return_reason' => $return_reason,
            'return_images' => $return_images
        ]);
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to fetch order status: ' . $e->getMessage());
    }
}

if ($action == 'update_order_status') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
        sendResponse(false, [], 'Unauthorized.');
    }

    
    $order_item_id = $_POST['order_item_id'];
    $status = $_POST['status'];

    // Validate status to prevent invalid updates
    if (!in_array($status, ['ordered', 'shipped', 'delivered'])) {
        sendResponse(false, [], 'Invalid status.');
    }

    try {
        $stmt = $conn->prepare("SELECT p.seller_id FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.id = ?");
        $stmt->execute([$order_item_id]);
        $seller_id = $stmt->fetchColumn();
        if ($seller_id != $_SESSION['user_id']) {
            sendResponse(false, [], 'Unauthorized to update this order.');
        }

        // Check current status to prevent regression
        $stmt = $conn->prepare("SELECT status FROM order_status_updates WHERE order_item_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$order_item_id]);
        $current_status = $stmt->fetchColumn();
        $status_order = ['ordered' => 1, 'shipped' => 2, 'delivered' => 3];
        if ($status_order[$status] <= $status_order[$current_status]) {
            sendResponse(false, [], 'Cannot revert to a previous status.');
        }

        $stmt = $conn->prepare("INSERT INTO order_status_updates (order_item_id, status) VALUES (?, ?)");
        $success = $stmt->execute([$order_item_id, $status]);
        sendResponse($success, [], $success ? 'Status updated successfully.' : 'Failed to update status.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to update status: ' . $e->getMessage());
    }
}

if ($action == 'admin_update_order_status') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $order_item_id = $_POST['order_item_id'];
    $status = $_POST['status'];

    // Validate status
    if (!in_array($status, ['ordered', 'shipped', 'delivered'])) {
        sendResponse(false, [], 'Invalid status.');
    }

    try {
        // Check current status to prevent regression
        $stmt = $conn->prepare("SELECT status FROM order_status_updates WHERE order_item_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$order_item_id]);
        $current_status = $stmt->fetchColumn();
        $status_order = ['ordered' => 1, 'shipped' => 2, 'delivered' => 3];
        if ($status_order[$status] <= $status_order[$current_status]) {
            sendResponse(false, [], 'Cannot revert to a previous status.');
        }

        $stmt = $conn->prepare("INSERT INTO order_status_updates (order_item_id, status) VALUES (?, ?)");
        $success = $stmt->execute([$order_item_id, $status]);
        sendResponse($success, [], $success ? 'Status updated successfully.' : 'Failed to update status.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to update status: ' . $e->getMessage());
    }
}

if ($action == 'request_return') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login.');
    }
    $order_item_id = $_POST['order_item_id'];
    $reason = $_POST['reason'];
    $images = isset($_FILES['images']) ? $_FILES['images'] : [];

    try {
        // Check if order is delivered
        $stmt = $conn->prepare("SELECT status FROM order_status_updates WHERE order_item_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$order_item_id]);
        $current_status = $stmt->fetchColumn();
        if ($current_status !== 'delivered') {
            sendResponse(false, [], 'Returns can only be requested for delivered orders.');
        }

        // Check if return request already exists
        $stmt = $conn->prepare("SELECT id FROM return_requests WHERE order_item_id = ?");
        $stmt->execute([$order_item_id]);
        if ($stmt->fetch()) {
            sendResponse(false, [], 'A return request for this item already exists.');
        }

        // Handle image uploads
        $upload_dir = 'uploads/returns/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $image_urls = [];
        if ($images['name'][0] !== '') {
            foreach ($images['name'] as $key => $name) {
                if ($images['error'][$key] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $ext;
                    $destination = $upload_dir . $filename;
                    if (move_uploaded_file($images['tmp_name'][$key], $destination)) {
                        $image_urls[] = $destination;
                    }
                }
            }
        }

        // Create return request
        $stmt = $conn->prepare("INSERT INTO return_requests (order_item_id, status, reason, images) VALUES (?, 'requested', ?, ?)");
        $success = $stmt->execute([$order_item_id, $reason, json_encode($image_urls)]);
        sendResponse($success, [], $success ? 'Return requested successfully.' : 'Failed to request return.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to request return: ' . $e->getMessage());
    }
}

if ($action == 'admin_update_return_status') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $order_item_id = $_POST['order_item_id'];
    $status = $_POST['status'];

    // Validate return status
    if (!in_array($status, ['requested', 'approved', 'picked_up', 'refunded', 'rejected'])) {
        sendResponse(false, [], 'Invalid return status.');
    }

    try {
        // Check current return status to prevent regression
        $stmt = $conn->prepare("SELECT status FROM return_requests WHERE order_item_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$order_item_id]);
        $current_status = $stmt->fetchColumn();
        $status_order = ['requested' => 1, 'approved' => 2, 'picked_up' => 3, 'refunded' => 4, 'rejected' => 0];
        if ($current_status && $status !== 'rejected' && $status_order[$status] <= $status_order[$current_status]) {
            sendResponse(false, [], 'Cannot revert to a previous return status.');
        }

        // If status is 'rejected', ensure it terminates the process
        if ($status === 'rejected') {
            $stmt = $conn->prepare("UPDATE return_requests SET status = ? WHERE order_item_id = ?");
            $success = $stmt->execute([$status, $order_item_id]);
            if ($success && $stmt->rowCount() == 0) {
                sendResponse(false, [], 'No return request found for this order item.');
            }
            sendResponse($success, [], $success ? 'Return status updated to rejected.' : 'Failed to update return status.');
        } else {
            $stmt = $conn->prepare("UPDATE return_requests SET status = ? WHERE order_item_id = ?");
            $success = $stmt->execute([$status, $order_item_id]);
            if ($success && $stmt->rowCount() == 0) {
                sendResponse(false, [], 'No return request found for this order item.');
            }
            sendResponse($success, [], $success ? 'Return status updated successfully.' : 'Failed to update return status.');
        }
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to update return status: ' . $e->getMessage());
    }
}

if ($action == 'get_all_orders') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        sendResponse(false, [], 'Unauthorized.');
    }
    try {
        $stmt = $conn->prepare("SELECT o.id, o.total, o.created_at, oi.id AS order_item_id, oi.quantity, oi.price, p.name, p.image, u.username, osu.status, rr.status AS return_status, rr.reason AS return_reason, rr.images AS return_images
                                FROM orders o 
                                JOIN order_items oi ON o.id = oi.order_id 
                                JOIN products p ON oi.product_id = p.id 
                                JOIN users u ON o.user_id = u.id 
                                JOIN order_status_updates osu ON oi.id = osu.order_item_id 
                                LEFT JOIN return_requests rr ON oi.id = rr.order_item_id
                                ORDER BY osu.updated_at DESC, rr.updated_at DESC");
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $uniqueOrders = [];
        foreach ($orders as $order) {
            if (!isset($uniqueOrders[$order['order_item_id']])) {
                $order['return_images'] = $order['return_images'] ? json_decode($order['return_images'], true) : [];
                $uniqueOrders[$order['order_item_id']] = $order;
            }
        }
        sendResponse(true, array_values($uniqueOrders));
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to fetch orders: ' . $e->getMessage());
    }
}

if ($action == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    try {
        $stmt = $conn->prepare("SELECT id, username, password, role, profile_image FROM users WHERE username = ? AND role = ?");
        $stmt->execute([$username, $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            sendResponse(true, ['username' => $user['username'], 'role' => $user['role'], 'profile_image' => $user['profile_image'] ?: 'https://via.placeholder.com/40']);
        } else {
            sendResponse(false, [], 'Invalid credentials or role.');
        }
    } catch (Exception $e) {
        sendResponse(false, [], 'Login failed: ' . $e->getMessage());
    }
}

if ($action == 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image = $_POST['profile_image'] ?: 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740';
    $role = $_POST['role'];

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            sendResponse(false, [], 'Username or email already exists.');
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, profile_image) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([$username, $email, $hashed_password, $role, $profile_image]);
        if ($success) {
            $user_id = $conn->lastInsertId();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            sendResponse(true, ['username' => $username, 'role' => $role, 'profile_image' => $profile_image]);
        } else {
            sendResponse(false, [], 'Registration failed.');
        }
    } catch (Exception $e) {
        sendResponse(false, [], 'Registration failed: ' . $e->getMessage());
    }
}

if ($action == 'logout') {
    session_unset();
    session_destroy();
    sendResponse(true, [], 'Logged out successfully.');
}

if ($action == 'get_user_info') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Not logged in.');
    }
    try {
        $stmt = $conn->prepare("SELECT username, role, profile_image FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $user['profile_image'] = $user['profile_image'] ?: 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740';
            sendResponse(true, $user);
        } else {
            sendResponse(false, [], 'User not found.');
        }
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to fetch user info: ' . $e->getMessage());
    }
}

if ($action == 'cancel_order') {
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, [], 'Please login.');
    }
    $order_item_id = $_POST['order_item_id'];
    $user_id = $_SESSION['user_id'];

    try {
        $conn->beginTransaction();

        // Verify the order item belongs to the user and is in 'ordered' status
        $stmt = $conn->prepare("SELECT oi.order_id, oi.product_id, oi.quantity, osu.status 
                                FROM order_items oi 
                                JOIN orders o ON oi.order_id = o.id 
                                JOIN order_status_updates osu ON oi.id = osu.order_item_id 
                                WHERE oi.id = ? AND o.user_id = ? 
                                ORDER BY osu.updated_at DESC LIMIT 1");
        $stmt->execute([$order_item_id, $user_id]);
        $order_item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order_item) {
            $conn->rollBack();
            sendResponse(false, [], 'Order item not found or unauthorized.');
        }
        if ($order_item['status'] !== 'ordered') {
            $conn->rollBack();
            sendResponse(false, [], 'Only orders in "ordered" status can be cancelled.');
        }

        // Restore stock for the product
        $stmt = $conn->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
        $stmt->execute([$order_item['quantity'], $order_item['product_id']]);

        // Delete order status updates
        $stmt = $conn->prepare("DELETE FROM order_status_updates WHERE order_item_id = ?");
        $stmt->execute([$order_item_id]);

        // Delete the order item
        $stmt = $conn->prepare("DELETE FROM order_items WHERE id = ?");
        $stmt->execute([$order_item_id]);

        // Check if the order has other items
        $stmt = $conn->prepare("SELECT COUNT(*) FROM order_items WHERE order_id = ?");
        $stmt->execute([$order_item['order_id']]);
        $item_count = $stmt->fetchColumn();

        if ($item_count == 0) {
            // Delete the order if no items remain
            $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
            $stmt->execute([$order_item['order_id']]);
        } else {
            // Update the order total
            $stmt = $conn->prepare("SELECT SUM(price * quantity) as total FROM order_items WHERE order_id = ?");
            $stmt->execute([$order_item['order_id']]);
            $new_total = $stmt->fetchColumn();
            $stmt = $conn->prepare("UPDATE orders SET total = ? WHERE id = ?");
            $stmt->execute([$new_total, $order_item['order_id']]);
        }

        $conn->commit();
        sendResponse(true, [], 'Order cancelled successfully.');
    } catch (Exception $e) {
        $conn->rollBack();
        sendResponse(false, [], 'Failed to cancel order: ' . $e->getMessage());
    }
}

if ($action == 'update_product') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $seller_id = $_SESSION['user_id'];
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    try {
        // Verify the product belongs to the seller
        $stmt = $conn->prepare("SELECT id FROM products WHERE id = ? AND seller_id = ?");
        $stmt->execute([$product_id, $seller_id]);
        if (!$stmt->fetch()) {
            sendResponse(false, [], 'Product not found or unauthorized.');
        }

        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, stock = ?, image = ? WHERE id = ? AND seller_id = ?");
        $success = $stmt->execute([$name, $description, $price, $category, $stock, $image, $product_id, $seller_id]);
        sendResponse($success, [], $success ? 'Product updated successfully.' : 'Failed to update product.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to update product: ' . $e->getMessage());
    }
}

if ($action == 'delete_product') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
        sendResponse(false, [], 'Unauthorized.');
    }
    $seller_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    try {
        // Verify the product belongs to the seller
        $stmt = $conn->prepare("SELECT id FROM products WHERE id = ? AND seller_id = ?");
        $stmt->execute([$product_id, $seller_id]);
        if (!$stmt->fetch()) {
            sendResponse(false, [], 'Product not found or unauthorized.');
        }

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ? AND seller_id = ?");
        $success = $stmt->execute([$product_id, $seller_id]);
        sendResponse($success, [], $success ? 'Product deleted successfully.' : 'Failed to delete product.');
    } catch (Exception $e) {
        sendResponse(false, [], 'Failed to delete product: ' . $e->getMessage());
    }
}
if ($action == 'register_admin') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        sendResponse(false, [], 'Unauthorized. Only admins can register new admins.');
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image = $_POST['profile_image'] ?: 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740';

    // Server-side validation
    if (strlen($username) < 3 || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        sendResponse(false, [], 'Username must be 3+ characters and contain only letters, numbers, or underscores.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendResponse(false, [], 'Invalid email format.');
    }
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        sendResponse(false, [], 'Password must be 8+ characters with at least one uppercase letter and one number.');
    }
    if ($profile_image && !preg_match('/^(https?:\/\/.*\.(?:png|jpg|jpeg|gif))$/i', $profile_image)) {
        sendResponse(false, [], 'Invalid image URL (must be png, jpg, jpeg, or gif).');
    }

    try {
        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            sendResponse(false, [], 'Username or email already exists.');
        }

        // Hash password and insert new admin
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, profile_image) VALUES (?, ?, ?, 'admin', ?)");
        $success = $stmt->execute([$username, $email, $hashed_password, $profile_image]);
        if ($success) {
            sendResponse(true, ['username' => $username], 'Admin registered successfully.');
        } else {
            sendResponse(false, [], 'Failed to register admin.');
        }
    } catch (Exception $e) {
        sendResponse(false, [], 'Registration failed: ' . $e->getMessage());
    }
}




sendResponse(false, [], 'Invalid action.');
?>