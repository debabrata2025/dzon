<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>D-zone - E-commerce Platform</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f8faff;
      color: #222;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      color: white;
      padding: clamp(0.5rem, 2vw, 0.8rem) clamp(0.8rem, 2.5vw, 1.5rem);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: clamp(0.4rem, 1.5vw, 0.6rem);
      flex: 0 0 auto;
    }

    .logo {
      font-weight: 700;
      font-size: clamp(1.4rem, 3.5vw, 1.8rem);
      letter-spacing: clamp(1px, 0.2vw, 2px);
      user-select: none;
      cursor: default;
    }

    .logo_img {
      width: clamp(60px, 15vw, 74px);
      height: clamp(40px, 10vw, 53px);
      overflow: hidden;
    }

    .logo_img img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      transform: scale(2.5);
    }

    .search-container {
      position: relative;
      flex: 1;
      max-width: clamp(200px, 35vw, 300px);
      margin: 0 clamp(0.5rem, 2vw, 1rem);
    }

    #searchInput {
      padding: clamp(0.3rem, 1vw, 0.4rem) clamp(2rem, 5vw, 2.5rem) clamp(0.3rem, 1vw, 0.4rem) clamp(0.8rem, 2vw, 1rem);
      border: none;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      width: 100%;
      border-radius: clamp(6px, 1.5vw, 8px);
      transition: width 0.3s ease, box-shadow 0.3s ease;
    }

    #searchInput:focus {
      outline: none;
      box-shadow: 0 0 5px #2575fcaa;
    }

    .search-icon {
      position: absolute;
      right: clamp(8px, 2vw, 10px);
      top: 50%;
      transform: translateY(-50%);
      color: #222;
    }

    #hamburgerBtn {
      display: none;
      background: none;
      border: none;
      color: white;
      font-size: clamp(1.4rem, 3.5vw, 1.8rem);
      cursor: pointer;
      padding: clamp(0.4rem, 1vw, 0.5rem);
      flex: 0 0 auto;
    }

    nav {
      display: flex;
      align-items: center;
      gap: clamp(0.8rem, 2vw, 1.5rem);
      background: none;
      transition: transform 0.3s ease;
    }

    nav a,
    nav button {
      color: white;
      text-decoration: none;
      font-weight: 600;
      cursor: pointer;
      background: none;
      border: none;
      font-family: inherit;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      transition: color 0.3s ease;
      padding: clamp(0.2rem, 0.8vw, 0.3rem) clamp(0.4rem, 1vw, 0.5rem);
      border-radius: clamp(4px, 1vw, 6px);
      display: flex;
      align-items: center;
      gap: clamp(0.4rem, 1vw, 0.5rem);
    }

    nav a:hover,
    nav button:hover {
      color: rgb(223, 224, 225);
    }

    .in_el {
      display: flex;
      align-items: center;
      gap: clamp(5px, 1.5vw, 7px);
    }

    .in_el .material-symbols-outlined {
      font-size: clamp(18px, 4.5vw, 25px);
    }

    .in_el .op_n {
      font-size: clamp(13px, 3.2vw, 17px);
      font-weight: 400;
    }

    #cartBadge {
      background: #ff4081;
      color: #fff;
      border-radius: 50%;
      font-size: clamp(0.65rem, 1.8vw, 0.7rem);
      position: absolute;
      top: -5px;
      right: -10px;
      display: none;
      width: 20px;
      height: 20px;
      text-align: center;
      line-height: 20px;
    }

    .profile-container {
      display: flex;
      align-items: center;
      gap: clamp(0.4rem, 1vw, 0.5rem);
    }

    .profile-image {
      width: clamp(30px, 7vw, 40px);
      height: clamp(30px, 7vw, 40px);
      border-radius: 50%;
      object-fit: cover;
      border: 0.5px solid #000;
    }

    .profile-username {
      font-weight: 600;
      color: white;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    main {
      max-width: clamp(90%, 95vw, 95%);
      margin: clamp(1rem, 3vw, 1.5rem) auto clamp(2rem, 5vw, 3rem);
      padding: 0 clamp(0.4rem, 1.5vw, 1rem) clamp(1.5rem, 3vw, 2rem);
      flex-grow: 1;
    }

    .section-title {
      font-weight: 700;
      font-size: clamp(1.4rem, 4vw, 2rem);
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      color: #432275;
    }

    #categoryFilter {
      display: flex;
      gap: clamp(0.7rem, 2vw, 0.9rem);
      margin-bottom: clamp(1.2rem, 3vw, 1.8rem);
      flex-wrap: wrap;
    }

    #categoryFilter button {
      background-color: #e0e5ff;
      border: none;
      padding: clamp(0.4rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1rem);
      border-radius: clamp(15px, 3vw, 20px);
      cursor: pointer;
      font-weight: 600;
      color: #432275;
      transition: background-color 0.3s ease;
      font-size: clamp(0.8rem, 2vw, 1rem);
    }

    #categoryFilter button.active,
    #categoryFilter button:hover {
      background-color: #6a11cb;
      color: white;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(clamp(150px, 20vw, 220px), 1fr));
      gap: clamp(0.8rem, 2.5vw, 2rem);
    }

    .product-card {
      background: white;
      border-radius: clamp(10px, 2.5vw, 15px);
      box-shadow: 0 6px 20px rgba(101, 65, 201, 0.15);
      padding: clamp(0.6rem, 1.5vw, 1rem);
      display: flex;
      flex-direction: column;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 35px rgba(101, 65, 201, 0.25);
    }

    .product-image {
      width: 100%;
      height: clamp(110px, 25vw, 180px);
      border-radius: clamp(8px, 2vw, 12px);
      object-fit: contain;
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      background-color: #ffffff;
    }

    .product-name {
      font-weight: 600;
      font-size: clamp(0.9rem, 2.2vw, 1.1rem);
      margin-bottom: clamp(0.2rem, 0.8vw, 0.3rem);
      color: #432275;
    }

    .product-price {
      font-weight: 700;
      color: #ff4081;
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      font-size: clamp(0.95rem, 2.2vw, 1.15rem);
    }

    .add-to-cart-btn {
      background-color: #6a11cb;
      color: white;
      border: none;
      padding: clamp(0.5rem, 1.5vw, 0.7rem);
      border-radius: clamp(20px, 4vw, 25px);
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease, transform 0.2s ease;
      font-size: clamp(0.8rem, 2vw, 1rem);
      margin-top: auto;
    }

    .add-to-cart-btn:hover {
      background-color: #4f0f9f;
      transform: scale(1.05);
    }

    #loadMoreIndicator {
      text-align: center;
      color: #666;
      padding: clamp(0.8rem, 2vw, 1rem) 0;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: rgba(0, 0, 0, 0.45);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1050;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-content {
      background: white;
      width: clamp(280px, 90vw, 750px);
      max-height: clamp(80vh, 90vh, 95vh);
      border-radius: clamp(10px, 2.5vw, 15px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
      overflow-y: auto;
    }

    .modal-content::-webkit-scrollbar {
      width: 0;
      display: none;
    }

    .modal-header {
      padding: clamp(0.6rem, 1.5vw, 1rem) clamp(0.8rem, 2vw, 1.5rem);
      background: #6a11cb;
      color: white;
      font-weight: 700;
      font-size: clamp(1.1rem, 2.5vw, 1.4rem);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .close-button {
      background: none;
      border: none;
      font-size: clamp(1.4rem, 3.5vw, 1.8rem);
      color: white;
      cursor: pointer;
    }

    .modal-body {
      padding: clamp(0.8rem, 2vw, 1.2rem) clamp(1rem, 2.5vw, 2rem) clamp(1.5rem, 3vw, 2rem);
      overflow-y: auto;
    }

    .modal-product-image {
      width: 100%;
      height: clamp(180px, 40vw, 280px);
      object-fit: contain;
      border-radius: clamp(8px, 2vw, 12px);
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      background-color: #ffffff;
    }

    .modal-product-description {
      color: #555;
      line-height: 1.4;
      margin-bottom: clamp(1rem, 2.5vw, 1.5rem);
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    .modal-product-price {
      color: #ff4081;
      font-weight: 700;
      font-size: clamp(1.1rem, 2.5vw, 1.5rem);
      margin-bottom: clamp(1rem, 2.5vw, 1.5rem);
    }

    .modal-add-to-cart {
      background-color: #6a11cb;
      color: white;
      border: none;
      padding: clamp(0.8rem, 2vw, 1rem);
      width: 100%;
      font-weight: 700;
      font-size: clamp(0.9rem, 2.2vw, 1.1rem);
      border-radius: clamp(25px, 5vw, 30px);
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .modal-add-to-cart:hover {
      background-color: #4f0f9f;
      transform: scale(1.05);
    }

    .cart-sidebar {
      position: fixed;
      top: 0;
      right: 0;
      height: 100vh;
      width: clamp(260px, 80vw, 320px);
      background: white;
      box-shadow: -5px 0 25px rgba(0, 0, 0, 0.2);
      transform: translateX(100%);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
      z-index: 1100;
    }

    .cart-sidebar.active {
      transform: translateX(0);
    }

    .cart-header {
      background: #6a11cb;
      color: white;
      font-weight: 700;
      font-size: clamp(1.1rem, 2.5vw, 1.5rem);
      padding: clamp(0.8rem, 2vw, 1.2rem) clamp(0.8rem, 2vw, 1rem);
      text-align: center;
      position: relative;
    }

    .cart-close-sidebar {
      position: absolute;
      right: clamp(10px, 2.5vw, 12px);
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: white;
      font-size: clamp(1.4rem, 3.5vw, 1.8rem);
      cursor: pointer;
    }

    .cart-items-container {
      flex-grow: 1;
      overflow-y: auto;
      padding: clamp(0.8rem, 2vw, 1rem);
    }

    .cart-item {
      display: flex;
      flex-direction: column;
      /* Stack content and button vertically */
      border-bottom: 1px solid #eee;
      padding: clamp(0.6rem, 1.5vw, 0.8rem) 0;
      margin-bottom: clamp(0.6rem, 1.5vw, 0.8rem);
      gap: clamp(0.4rem, 1vw, 0.6rem);
    }

    .cart-item-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    .cart-item-info {
      flex-grow: 1;
      flex-shrink: 1;
      max-width: 35%;
      /* Limit width to prevent overflow */
      margin-left: clamp(0.5rem, 1.5vw, 0.7rem);
      display: flex;
      flex-direction: column;
      gap: clamp(0.2rem, 0.5vw, 0.3rem);
    }

    .cart-item-name {
      font-weight: 600;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      color: #432275;
    }

    .cart-item-qty {
      font-size: clamp(0.75rem, 1.8vw, 0.85rem);
      color: #666;
    }

    .cart-item-price {
      font-weight: 700;
      color: #ff4081;
      margin-left: clamp(0.8rem, 2vw, 1rem);
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    .cart-item-remove-btn {
      width: clamp(80px, 25vw, 100px);
      /* Compact width */
      padding: clamp(0.4rem, 1vw, 0.5rem);
      background-color: transparent;
      border: 1px solid #ccc;
      color: #1d1d1d;
      font-weight: 600;
      font-size: clamp(0.8rem, 1.8vw, 0.9rem);
      border-radius: 25px;
      cursor: pointer;
      text-transform: capitalize;
      letter-spacing: 0.03em;
      transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      /* Space above button */
    }

    .cart-item-remove-btn:hover {
      background-color: #e73370;
      box-shadow: 0 clamp(2px, 0.5vw, 3px) clamp(3px, 0.8vw, 4px) rgba(0, 0, 0, 0.2);
      transform: translateY(-1px);
    }

    .cart-footer {
      padding: clamp(0.8rem, 2vw, 1rem);
      border-top: 1px solid #eee;
      font-weight: 700;
      font-size: clamp(0.95rem, 2.2vw, 1.2rem);
      color: #6a11cb;
      text-align: right;
    }

    .checkout-btn {
      width: 90%;
      /* Set width to 90% */
      margin: 0 auto;
      /* Fallback centering */
      margin-bottom: 10px;
      padding: clamp(0.8rem, 2vw, 1rem);
      background-color: #ff4081;
      border: none;
      color: white;
      font-weight: 700;
      font-size: clamp(0.95rem, 2.2vw, 1.2rem);
      border-radius: clamp(25px, 5vw, 30px);
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .checkout-btn:hover {
      background-color: #e73370;
      transform: scale(1.05);
    }

    .checkout-modal {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.55);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1200;
    }

    .checkout-modal.active {
      display: flex;
    }

    .checkout-content {
      background: white;
      width: clamp(280px, 90vw, 480px);
      border-radius: clamp(10px, 2.5vw, 15px);
      padding: clamp(1.2rem, 3vw, 2rem);
      position: relative;
    }

    .checkout-header {
      font-weight: 700;
      font-size: clamp(1.3rem, 3.5vw, 1.7rem);
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      color: #432275;
      text-align: center;
    }

    .checkout-close-btn {
      position: absolute;
      top: clamp(10px, 2.5vw, 12px);
      right: clamp(10px, 2.5vw, 12px);
      background: none;
      border: none;
      font-size: clamp(1.1rem, 2.5vw, 1.5rem);
      color: #432275;
      cursor: pointer;
    }

    .checkout-form {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin: clamp(0.6rem, 1.5vw, 0.8rem) 0 clamp(0.3rem, 0.8vw, 0.4rem);
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    input[type=text],
    input[type=email],
    input[type=tel],
    input[type=password],
    input[type=url] {
      padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(0.8rem, 2vw, 1rem);
      border-radius: clamp(6px, 1.5vw, 8px);
      border: 1px solid #ccc;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    input[type=text]:focus,
    input[type=email]:focus,
    input[type=tel]:focus,
    input[type=password]:focus,
    input[type=url]:focus {
      border-color: #6a11cb;
      box-shadow: 0 0 5px #6a11cbaa;
    }

    .submit-btn {
      margin-top: clamp(1rem, 2.5vw, 1.5rem);
      background-color: #6a11cb;
      color: white;
      border: none;
      padding: clamp(0.8rem, 2vw, 1rem);
      font-weight: 700;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      border-radius: clamp(25px, 5vw, 30px);
      cursor: pointer;
    }

    .form-error {
      color: #e04545;
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
      margin-top: clamp(0.2rem, 0.5vw, 0.3rem);
    }

    .confirmation-message {
      text-align: center;
      font-size: clamp(1rem, 2.5vw, 1.3rem);
      font-weight: 700;
      color: #2575fc;
      margin-top: clamp(0.8rem, 2vw, 1rem);
    }

    footer {
      background-color: #432275;
      color: white;
      text-align: center;
      padding: clamp(0.6rem, 1.5vw, 1rem) clamp(0.8rem, 2vw, 2rem);
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
    }

    .admin-orders-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: clamp(0.8rem, 2vw, 1rem);
    }

    .admin-order-card {
      background: white;
      border-radius: clamp(8px, 2vw, 10px);
      padding: clamp(0.6rem, 1.5vw, 1rem);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .admin-order-card h4 {
      margin: 0 0 clamp(0.4rem, 1vw, 0.5rem);
      color: #432275;
      font-size: clamp(0.95rem, 2.2vw, 1.2rem);
    }

    .admin-order-card p {
      margin: clamp(0.2rem, 0.5vw, 0.3rem) 0;
      color: #555;
      font-size: clamp(0.8rem, 1.8vw, 1rem);
    }

    .admin-status-select {
      padding: clamp(0.4rem, 1vw, 0.5rem);
      border-radius: clamp(6px, 1.5vw, 8px);
      border: 1px solid #ccc;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      width: 100%;
    }

    .admin-status-update-btn {
      background-color: #6a11cb;
      color: white;
      border: none;
      padding: clamp(0.4rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1rem);
      border-radius: clamp(20px, 4vw, 25px);
      cursor: pointer;
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      transition: background-color 0.3s ease;
      font-size: clamp(0.8rem, 2vw, 0.9rem);
    }

    .admin-status-update-btn:hover {
      background-color: #4f0f9f;
    }

    .admin-status-update-btn:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
    }

    .admin-error-message {
      color: #e04545;
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      display: none;
    }

    .progress-bar-container {
      margin: clamp(0.8rem, 2vw, 1rem) 0;
      width: 100%;
      max-width: clamp(280px, 90vw, 600px);
      padding: 0 clamp(0.4rem, 1.5vw, 1rem);
    }

    .progress-bar {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-bottom: clamp(0.8rem, 2vw, 1rem);
      width: 100%;
    }

    .progress-step {
      display: flex;
      flex-direction: column;
      align-items: center;
      flex: 1;
      text-align: center;
      z-index: 1;
      position: relative;
    }

    .progress-step.completed .progress-icon {
      background-color: #6a11cb;
      color: white;
    }

    .progress-step.active .progress-icon {
      background-color: #2575fc;
      color: white;
    }

    .progress-icon {
      width: clamp(28px, 7vw, 40px);
      height: clamp(28px, 7vw, 40px);
      border-radius: 50%;
      background-color: #e0e5ff;
      color: #432275;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: clamp(0.95rem, 2.2vw, 1.2rem);
      margin-bottom: clamp(0.4rem, 1vw, 0.5rem);
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .progress-label {
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
      color: #555;
      font-weight: 600;
    }

    .progress-connector {
      height: 4px;
      background-color: #e0e5ff;
      position: absolute;
      top: clamp(16px, 4vw, 18px);
      z-index: 0;
      margin: 0;
    }

    .progress-connector.completed {
      background-color: #6a11cb;
    }

    .progress-connector.active {
      background: linear-gradient(to right, #6a11cb 50%, #e0e5ff 50%);
    }

    .return-btn {
      background-color: #ff4081;
      color: white;
      border: none;
      padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(1rem, 2.5vw, 1.5rem);
      border-radius: clamp(20px, 4vw, 25px);
      cursor: pointer;
      font-weight: 600;
      margin-top: clamp(0.8rem, 2vw, 1rem);
      transition: background-color 0.3s ease;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
    }

    .return-btn:hover {
      background-color: #e73370;
    }

    .cancel-order-btn {
      background-color: #e04545;
      color: white;
      border: none;
      padding: clamp(0.5rem, 1.5vw, 0.7rem) clamp(1rem, 2.5vw, 1.5rem);
      border-radius: clamp(20px, 4vw, 25px);
      cursor: pointer;
      font-weight: 600;
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      transition: background-color 0.3s ease;
      font-size: clamp(0.8rem, 2vw, 0.9rem);
    }

    .cancel-order-btn:hover {
      background-color: #c03939;
    }

    .cancel-order-btn:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
    }

    .product-stock {
      font-weight: 600;
      font-size: clamp(0.8rem, 2vw, 0.95rem);
      margin-bottom: clamp(0.4rem, 1vw, 0.5rem);
    }

    .product-stock.in-stock {
      color: #28a745;
    }

    .product-stock.out-of-stock {
      color: #dc3545;
    }

    .edit-product-btn {
      background-color: #2575fc;
      color: white;
      border: none;
      padding: clamp(0.4rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1rem);
      border-radius: clamp(10px, 2vw, 12px);
      cursor: pointer;
      font-weight: 600;
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .edit-product-btn:hover {
      background-color: #1a5fd4;
      transform: scale(1.05);
    }

    .edit-product-btn:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
      transform: none;
    }

    .delete-product-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: clamp(0.4rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1rem);
      border-radius: clamp(10px, 2vw, 12px);
      cursor: pointer;
      font-weight: 600;
      font-size: clamp(0.75rem, 1.8vw, 0.9rem);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .delete-product-btn:hover {
      background-color: #c82333;
      transform: scale(1.05);
    }

    .delete-product-btn:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
      transform: none;
    }

    .product-card .button-container {
      display: flex;
      gap: clamp(0.4rem, 1vw, 0.5rem);
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
      justify-content: center;
    }

    .return-form {
      display: flex;
      flex-direction: column;
      margin-top: clamp(0.8rem, 2vw, 1rem);
    }

    .return-image-preview {
      display: flex;
      flex-wrap: wrap;
      gap: clamp(0.4rem, 1vw, 0.5rem);
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
    }

    .return-image-preview img {
      width: clamp(50px, 15vw, 80px);
      height: clamp(50px, 15vw, 80px);
      object-fit: contain;
      border-radius: clamp(6px, 1.5vw, 8px);
    }

    .return-reason {
      width: 100%;
      padding: clamp(0.5rem, 1.5vw, 0.7rem);
      border-radius: clamp(6px, 1.5vw, 8px);
      border: 1px solid #ccc;
      font-size: clamp(0.85rem, 2.2vw, 1rem);
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
    }

    .return-reason:focus {
      border-color: #6a11cb;
      box-shadow: 0 0 5px #6a11cbaa;
    }

    .return-image-upload {
      margin-top: clamp(0.4rem, 1vw, 0.5rem);
    }

    .nav-close-button {
      display: none;
      position: absolute;
      right: clamp(10px, 2.5vw, 12px);
      top: clamp(10px, 2.5vw, 12px);
      color: #432275;
      font-size: clamp(1.4rem, 3.5vw, 1.8rem);
      cursor: pointer;
      transition: opacity 0.3s ease;
      line-height: 1;
      user-select: none;
    }

    .nav-close-button:hover {
      opacity: 0.8;
    }

    /* Mobile View (≤ 600px) */
    @media (max-width: 600px) {
      header {
        flex-wrap: nowrap;
        align-items: center;
        padding: clamp(0.4rem, 1.5vw, 0.6rem) clamp(0.4rem, 1.5vw, 0.8rem);
        gap: clamp(0.4rem, 1.5vw, 0.8rem);
      }

      .logo-container {
        flex: 0 0 auto;
        min-width: clamp(50px, 15vw, 80px);
      }

      .search-container {
        flex: 1;
        max-width: none;
        margin: 0 clamp(0.4rem, 1.5vw, 0.8rem);
      }

      #searchInput {
        width: 100%;
      }

      #searchInput:focus {
        width: 100%;
        box-shadow: 0 0 5px #2575fcaa;
      }

      #hamburgerBtn {
        display: block;
        flex: 0 0 auto;
      }

      nav {
        position: fixed;
        top: 0;
        right: 0;
        height: 100vh;
        width: clamp(220px, 70vw, 300px);
        background: white;
        flex-direction: column;
        align-items: flex-start;
        padding: clamp(1.5rem, 5vw, 2rem) clamp(0.8rem, 2vw, 1rem);
        transform: translateX(100%);
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.2);
        z-index: 1100;
        transition: transform 0.3s ease;
      }

      nav.active {
        transform: translateX(0);
      }

      nav a,
      nav button {
        color: #432275;
        width: 100%;
        justify-content: flex-start;
        padding: clamp(0.6rem, 1.5vw, 0.75rem);
        margin-left: 0;
        font-size: clamp(0.95rem, 2.5vw, 1.1rem);
      }

      #cartBadge {
      font-size: 12px;
      position: absolute;
      top: 5px;
      left: 15px;
      width: 16px;
      height: 16px;
      line-height: 16px;
    }

      nav a:hover,
      nav button:hover {
        color: #6a11cb;
      }

      .profile-container {
        width: 100%;
        justify-content: flex-start;
        padding: clamp(0.6rem, 1.5vw, 0.75rem);
        border-top: 1px solid #eee;
      }

      .profile-username {
        color: #432275;
      }

      .nav-close-button {
        display: block;
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(clamp(120px, 30vw, 140px), 1fr));
        gap: clamp(0.6rem, 2vw, 1rem);
      }

      .product-card {
        padding: clamp(0.4rem, 1.5vw, 0.6rem);
      }

      .product-image {
        height: clamp(90px, 28vw, 140px);
      }

      .modal-product-image {
        height: clamp(160px, 38vw, 220px);
      }

      .cart-sidebar {
        width: 100%;
      }

      .cart-footer {
        text-align: left;
      }

      .progress-step {
        flex: 1;
      }

      .progress-icon {
        width: clamp(24px, 6vw, 30px);
        height: clamp(24px, 6vw, 30px);
        font-size: clamp(0.75rem, 1.8vw, 1rem);
      }

      .progress-label {
        font-size: clamp(0.65rem, 1.6vw, 0.8rem);
      }

      .modal-content {
        border-radius: 0;
        width: 100vw;
        min-height: 100vh;
      }

      .checkout-content {
        width: clamp(85vw, 90vw, 95vw);
        padding: clamp(1rem, 2.5vw, 1.5rem);
      }

      .admin-order-card {
        padding: clamp(0.5rem, 1.5vw, 0.8rem);
      }

      .progress-connector {
        top: 10px;
      }

      .search-icon {
        top: 64%;
      }

      .search-icon span {
        font-size: 20px;
      }
    }

    /* Medium Devices (Tablets, 601px to 900px) */
    @media (min-width: 601px) and (max-width: 900px) {
      header {
        padding: clamp(0.5rem, 1.5vw, 0.8rem) clamp(0.6rem, 2vw, 1.2rem);
      }

      .search-container {
        max-width: clamp(220px, 35vw, 280px);
        margin: 0 clamp(0.6rem, 1.5vw, 0.8rem);
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(clamp(160px, 25vw, 180px), 1fr));
        gap: clamp(0.8rem, 2vw, 1.5rem);
      }

      .product-card {
        padding: clamp(0.5rem, 1.5vw, 0.8rem);
      }

      .product-image {
        height: clamp(130px, 24vw, 160px);
      }

      .modal-product-image {
        height: clamp(200px, 34vw, 250px);
      }

      .cart-sidebar {
        width: clamp(280px, 45vw, 350px);
      }

      .modal-content {
        width: clamp(380px, 80vw, 600px);
      }

      .progress-icon {
        width: clamp(32px, 6vw, 38px);
        height: clamp(32px, 6vw, 38px);
      }

      .progress-label {
        font-size: clamp(0.8rem, 1.8vw, 0.9rem);
      }

      .sellerDashboardModal .modal-content,
      .ordersModal .modal-content {
        max-width: clamp(600px, 75vw, 800px);
      }

      .adminDashboardModal .modal-content {
        max-width: clamp(800px, 85vw, 1000px);
      }
    }

    /* Large Devices (Desktops, 901px and up) */
    @media (min-width: 901px) {
      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(clamp(180px, 20vw, 220px), 1fr));
      }

      .product-image {
        height: clamp(150px, 20vw, 180px);
      }

      .modal-product-image {
        height: clamp(240px, 30vw, 280px);
      }

      .cart-sidebar {
        width: clamp(280px, 25vw, 320px);
      }

      .modal-content {
        width: clamp(550px, 70vw, 750px);
      }

      .sellerDashboardModal .modal-content,
      .ordersModal .modal-content {
        max-width: clamp(650px, 60vw, 800px);
      }

      .adminDashboardModal .modal-content {
        max-width: clamp(850px, 80vw, 1000px);
      }
    }

    /* Extra Large Devices (Large Desktops, 1200px and up) */
    @media (min-width: 1200px) {
      .products-grid {
        grid-template-columns: repeat(5, minmax(clamp(190px, 18vw, 220px), 1fr));
      }

      main {
        max-width: clamp(900px, 90vw, 1200px);
      }

      .search-container {
        max-width: clamp(260px, 25vw, 300px);
      }

      #searchInput:focus {
        max-width: clamp(300px, 28vw, 350px);
      }
    }
  </style>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  <header role="banner">
    <div class="logo-container">
      <div class="logo" aria-label="D-zone logo">
        <div class="logo_img" style="width: clamp(60px, 15vw, 74px); height: clamp(40px, 10vw, 53px); overflow: hidden;">
          <img src="logo2.png" alt="" style="width: 100%; height: 100%; object-fit: contain; transform: scale(2.5);">
        </div>
      </div>
    </div>
    <div class="search-container" role="search">
      <input type="text" id="searchInput" aria-label="Search products" placeholder="Search products..." autocomplete="off" />
      <span class="search-icon" aria-hidden="true">
        <span class="material-symbols-outlined">search</span>
      </span>
    </div>
    <button id="hamburgerBtn" aria-label="Toggle navigation" aria-expanded="false">
      <span class="material-symbols-outlined">menu</span>
    </button>
    <nav role="navigation" aria-label="Primary navigation">
      <div id="closeNavBtn" class="nav-close-button" role="button" aria-label="Close navigation" tabindex="0">×</div>
      <a href="#products" tabindex="0">
        <div class="in_el">
          <span class="material-symbols-outlined">shopping_bag</span>
          <span class="op_n">Product</span>
        </div>
      </a>
      <button id="btnCart" aria-label="Open shopping cart" style="position: relative;">
        <div class="in_el">
          <span class="material-symbols-outlined">shopping_cart</span>
          <span class="op_n">Cart</span>
        </div>
        <sup id="cartBadge" style="background:#ff4081;color:#fff;border-radius:50%;padding:0 6px 2px 6px;display:none;font-size:0.7rem;position:absolute;top:1px;left:17px;">0</sup>
      </button>
      <button id="btnOrders" aria-label="View orders">
        <div class="in_el">
          <span class="material-symbols-outlined">featured_seasonal_and_gifts</span>
          <span class="op_n">Orders</span>
        </div>
      </button>
      <button id="btnSellerDashboard" aria-label="Seller dashboard" style="display:none;">
        <div class="in_el">
          <span class="material-symbols-outlined">storefront</span>
          <span class="op_n">Seller Dashboard</span>
        </div>
      </button>
      <button id="btnAdminDashboard" aria-label="Admin dashboard" style="display:none;">
        <div class="in_el">
          <span class="material-symbols-outlined">shield_person</span>
          <span class="op_n">Admin Dashboard</span>
        </div>
      </button>
      <button id="btnLogin" aria-label="Login">
        <div class="in_el">
          <span class="material-symbols-outlined">account_circle</span>
          <span class="op_n">Login</span>
        </div>
      </button>
      <button id="btnLogout" aria-label="Logout" style="display:none;">
        <div class="in_el">
          <span class="material-symbols-outlined">power_settings_new</span>
          <span class="op_n">Logout</span>
        </div>
      </button>
      <div class="profile-container" id="profileContainer" style="display:none;">
        <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="Profile Image" class="profile-image" id="profileImage" />
        <span class="profile-username" id="profileUsername"></span>
      </div>
    </nav>
  </header>

  <main role="main" aria-live="polite">
    <h1 class="section-title" id="productsTitle">Products</h1>
    <div id="categoryFilter" aria-label="Filter products by category" role="list"></div>
    <section id="products" class="products-grid" aria-labelledby="productsTitle"></section>
    <div id="loadMoreIndicator" aria-live="polite"></div>
    <p id="loadingMessage" style="margin-top: 2rem; text-align:center; color:#666;">Loading products...</p>
    <p id="errorMessage" style="margin-top: 2rem; text-align:center; color:#e04545; display:none;">Error loading products. Please refresh to try again.</p>
  </main>

  <!-- Product Detail Modal -->
  <div id="productModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content">
      <header class="modal-header">
        <h2 id="productModalTitle">Product Name</h2>
        <button class="close-button" id="closeProductModal" aria-label="Close product details">×</button>
      </header>
      <div class="modal-body">
        <img src="" alt="" class="modal-product-image" id="modalProductImage" />
        <p class="modal-product-description" id="productModalDesc">Product description goes here.</p>
        <div class="modal-product-price" id="modalProductPrice">$0.00</div>
        <button class="modal-add-to-cart" id="modalAddToCartBtn" aria-label="Add product to cart">Add to Cart</button>
      </div>
    </div>
  </div>

  <!-- Cart Sidebar -->
  <aside class="cart-sidebar" id="cartSidebar" aria-label="Shopping cart" role="region">
    <header class="cart-header">
      Your Cart
      <button class="cart-close-sidebar" id="closeCartBtn" aria-label="Close cart sidebar">×</button>
    </header>
    <div class="cart-items-container" id="cartItemsContainer" aria-live="polite"></div>
    <div class="cart-footer" id="cartTotalPrice">Total: $0.00</div>
    <button class="checkout-btn" id="checkoutBtn" aria-label="Proceed to checkout">Checkout</button>
  </aside>

  <!-- Checkout Modal -->
  <div id="checkoutModal" class="checkout-modal" role="dialog" aria-modal="true">
    <div class="checkout-content">
      <button class="checkout-close-btn" id="closeCheckoutModal" aria-label="Close checkout form">×</button>
      <h2 class="checkout-header" id="checkoutModalTitle">Checkout</h2>
      <form id="checkoutForm" class="checkout-form" novalidate>
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" placeholder="Your full name" required />
        <div class="form-error" id="errorFullName"></div>
        <label for="emailAddress">Email Address</label>
        <input type="email" id="emailAddress" name="emailAddress" placeholder="you@example.com" required />
        <div class="form-error" id="errorEmailAddress"></div>
        <label for="phoneNumber">Phone Number</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="+1 555 123 4567" />
        <div class="form-error" id="errorPhoneNumber"></div>
        <label for="address">Shipping Address</label>
        <input type="text" id="address" name="address" placeholder="123 Main St, City, Country" required />
        <div class="form-error" id="errorAddress"></div>
        <button type="submit" class="submit-btn" aria-label="Submit order">Place Order</button>
      </form>
      <p id="confirmationMessage" class="confirmation-message" style="display:none;"></p>
    </div>
  </div>

  <!-- Login Modal -->
  <div id="loginModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="checkout-content">
      <button class="checkout-close-btn" id="closeLoginModal" aria-label="Close login form">×</button>
      <h2 class="checkout-header">Login</h2>
      <form id="loginForm" class="checkout-form">
        <label for="loginUsername">Username</label>
        <input type="text" id="loginUsername" name="username" placeholder="Username" required />
        <div class="form-error" id="errorLoginUsername"></div>
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="password" placeholder="Password" required />
        <div class="form-error" id="errorLoginPassword"></div>
        <label for="loginRole">Role</label>
        <select id="loginRole" name="role">
          <option value="customer">Customer</option>
          <option value="seller">Seller</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit" class="submit-btn" aria-label="Login">Login</button>
        <p style="text-align:center; margin-top:1rem;"><a href="#" id="showRegister">Register instead</a></p>
      </form>
    </div>
  </div>

  <!-- Register Modal -->
  <div id="registerModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="checkout-content">
      <button class="checkout-close-btn" id="closeRegisterModal" aria-label="Close register form">×</button>
      <h2 class="checkout-header">Register</h2>
      <form id="registerForm" class="checkout-form">
        <label for="regUsername">Username</label>
        <input type="text" id="regUsername" name="username" placeholder="Username" required />
        <div class="form-error" id="errorRegUsername"></div>
        <label for="regEmail">Email</label>
        <input type="email" id="regEmail" name="email" placeholder="you@example.com" required />
        <div class="form-error" id="errorRegEmail"></div>
        <label for="regPassword">Password</label>
        <input type="password" id="regPassword" name="password" placeholder="Password" required />
        <div class="form-error" id="errorRegPassword"></div>
        <label for="regProfileImage">Profile Image URL (Optional)</label>
        <input type="url" id="regProfileImage" name="profile_image" placeholder="https://example.com/image.jpg" />
        <div class="form-error" id="errorRegProfileImage"></div>
        <label for="regRole">Role</label>
        <select id="regRole" name="role">
          <option value="customer">Customer</option>
          <option value="seller">Seller</option>
        </select>
        <button type="submit" class="submit-btn" aria-label="Register">Register</button>
      </form>
    </div>
  </div>

  <!-- Seller Dashboard Modal -->
  <div id="sellerDashboardModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content" style="max-width:800px;">
      <header class="modal-header">
        <h2>Seller Dashboard</h2>
        <button class="close-button" id="closeSellerDashboard" aria-label="Close seller dashboard">×</button>
      </header>
      <div class="modal-body">
        <h3>Add New Product</h3>
        <form id="addProductForm" class="checkout-form">
          <label for="productName">Product Name</label>
          <input type="text" id="productName" name="name" placeholder="Product Name" required />
          <label for="productDescription">Description</label>
          <textarea id="productDescription" name="description" placeholder="Product Description" rows="4"></textarea>
          <label for="productPrice">Price</label>
          <input type="number" id="productPrice" name="price" placeholder="Price" step="0.01" required />
          <label for="productCategory">Category</label>
          <input type="text" id="productCategory" name="category" placeholder="Category" required />
          <label for="productStock">Stock</label>
          <input type="number" id="productStock" name="stock" placeholder="Stock Quantity" required />
          <label for="productImage">Image URL</label>
          <input type="text" id="productImage" name="image" placeholder="Image URL" required />
          <button type="submit" class="submit-btn">Add Product</button>
        </form>
        <h3>Edit Product</h3>
        <form id="editProductForm" class="checkout-form" style="display:none;">
          <input type="hidden" id="editProductId" name="id" />
          <label for="editProductName">Product Name</label>
          <input type="text" id="editProductName" name="name" placeholder="Product Name" required />
          <label for="editProductDescription">Description</label>
          <textarea id="editProductDescription" name="description" placeholder="Product Description" rows="4"></textarea>
          <label for="editProductPrice">Price</label>
          <input type="number" id="editProductPrice" name="price" placeholder="Price" step="0.01" required />
          <label for="editProductCategory">Category</label>
          <input type="text" id="editProductCategory" name="category" placeholder="Category" required />
          <label for="editProductStock">Stock</label>
          <input type="number" id="editProductStock" name="stock" placeholder="Stock Quantity" required />
          <label for="editProductImage">Image URL</label>
          <input type="text" id="editProductImage" name="image" placeholder="Image URL" required />
          <button type="submit" class="submit-btn">Update Product</button>
        </form>
        <h3>Your Products</h3>
        <div id="sellerProducts" class="products-grid"></div>
      </div>
    </div>
  </div>

  <!-- Orders Modal -->
  <div id="ordersModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content" style="max-width:800px;">
      <header class="modal-header">
        <h2>Your Orders</h2>
        <button class="close-button" id="closeOrdersModal" aria-label="Close orders">×</button>
      </header>
      <div class="modal-body">
        <div id="ordersList"></div>
      </div>
    </div>
  </div>

  <!-- Order Status Modal -->
  <div id="orderStatusModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content">
      <header class="modal-header">
        <h2 id="orderStatusTitle">Order Status</h2>
        <button class="close-button" id="closeOrderStatusModal" aria-label="Close order status">×</button>
      </header>
      <div class="modal-body">
        <div class="progress-bar-container">
          <h3>Delivery Progress</h3>
          <div class="progress-bar" id="deliveryProgressBar"></div>
        </div>
        <div class="progress-bar-container" id="returnProgressContainer" style="display:none;">
          <h3>Return Progress</h3>
          <div class="progress-bar" id="returnProgressBar"></div>
        </div>
        <div id="orderStatusUpdates"></div>
        <div id="returnFormContainer" style="display:none;">
          <h3>Request Return</h3>
          <form id="returnForm" class="return-form">
            <label for="returnReason">Reason for Return</label>
            <textarea id="returnReason" name="reason" placeholder="Enter reason for return" required class="return-reason"></textarea>
            <div class="form-error" id="errorReturnReason"></div>
            <label for="returnImages">Upload Images (Optional)</label>
            <input type="file" id="returnImages" name="images[]" multiple accept="image/*" class="return-image-upload" />
            <div class="return-image-preview" id="returnImagePreview"></div>
            <button type="submit" class="submit-btn" id="submitReturnBtn">Submit Return Request</button>
          </form>
        </div>
        <button id="requestReturnBtn" class="return-btn" style="display:none;">Request Return</button>
        <div id="sellerUpdateForm" style="display:none;">
          <h3>Update Status</h3>
          <form id="updateStatusForm" class="checkout-form">
            <label for="statusSelect">Status</label>
            <select id="statusSelect" name="status">
              <option value="ordered">Ordered</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
            </select>
            <button type="submit" class="submit-btn">Update Status</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Admin Dashboard Modal -->
  <div id="adminDashboardModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content" style="max-width:1000px;">
      <header class="modal-header">
        <h2>Admin Dashboard</h2>
        <button class="close-button" id="closeAdminDashboard" aria-label="Close admin dashboard">×</button>
      </header>
      <div class="modal-body">
        <h3>All Orders</h3>
        <div id="adminOrdersList" class="admin-orders-grid"></div>
      </div>
    </div>
  </div>

  <footer role="contentinfo">
    © 2025 D-zone. All rights reserved.
  </footer>

  <script>
    (() => {
      const productsContainer = document.getElementById('products');
      const categoryFilter = document.getElementById('categoryFilter');
      const searchInput = document.getElementById('searchInput');
      const cartBadge = document.getElementById('cartBadge');
      const btnCart = document.getElementById('btnCart');
      const cartSidebar = document.getElementById('cartSidebar');
      const closeCartBtn = document.getElementById('closeCartBtn');
      const cartItemsContainer = document.getElementById('cartItemsContainer');
      const cartTotalPrice = document.getElementById('cartTotalPrice');
      const checkoutBtn = document.getElementById('checkoutBtn');
      const checkoutModal = document.getElementById('checkoutModal');
      const closeCheckoutModal = document.getElementById('closeCheckoutModal');
      const checkoutForm = document.getElementById('checkoutForm');
      const confirmationMessage = document.getElementById('confirmationMessage');
      const loadingMessage = document.getElementById('loadingMessage');
      const errorMessage = document.getElementById('errorMessage');
      const loadMoreIndicator = document.getElementById('loadMoreIndicator');
      const productModal = document.getElementById('productModal');
      const closeProductModal = document.getElementById('closeProductModal');
      const productModalTitle = document.getElementById('productModalTitle');
      const productModalDesc = document.getElementById('productModalDesc');
      const modalProductImage = document.getElementById('modalProductImage');
      const modalProductPrice = document.getElementById('modalProductPrice');
      const modalAddToCartBtn = document.getElementById('modalAddToCartBtn');
      const loginModal = document.getElementById('loginModal');
      const closeLoginModal = document.getElementById('closeLoginModal');
      const loginForm = document.getElementById('loginForm');
      const registerModal = document.getElementById('registerModal');
      const closeRegisterModal = document.getElementById('closeRegisterModal');
      const registerForm = document.getElementById('registerForm');
      const showRegister = document.getElementById('showRegister');
      const btnLogin = document.getElementById('btnLogin');
      const btnLogout = document.getElementById('btnLogout');
      const btnSellerDashboard = document.getElementById('btnSellerDashboard');
      const btnAdminDashboard = document.getElementById('btnAdminDashboard');
      const sellerDashboardModal = document.getElementById('sellerDashboardModal');
      const closeSellerDashboard = document.getElementById('closeSellerDashboard');
      const addProductForm = document.getElementById('addProductForm');
      const sellerProducts = document.getElementById('sellerProducts');
      const btnOrders = document.getElementById('btnOrders');
      const ordersModal = document.getElementById('ordersModal');
      const closeOrdersModal = document.getElementById('closeOrdersModal');
      const ordersList = document.getElementById('ordersList');
      const orderStatusModal = document.getElementById('orderStatusModal');
      const closeOrderStatusModal = document.getElementById('closeOrderStatusModal');
      const orderStatusUpdates = document.getElementById('orderStatusUpdates');
      const sellerUpdateForm = document.getElementById('sellerUpdateForm');
      const updateStatusForm = document.getElementById('updateStatusForm');
      const deliveryProgressBar = document.getElementById('deliveryProgressBar');
      const returnProgressContainer = document.getElementById('returnProgressContainer');
      const returnProgressBar = document.getElementById('returnProgressBar');
      const requestReturnBtn = document.getElementById('requestReturnBtn');
      const profileContainer = document.getElementById('profileContainer');
      const profileImage = document.getElementById('profileImage');
      const profileUsername = document.getElementById('profileUsername');
      const adminDashboardModal = document.getElementById('adminDashboardModal');
      const closeAdminDashboard = document.getElementById('closeAdminDashboard');
      const adminOrdersList = document.getElementById('adminOrdersList');

      const returnForm = document.getElementById('returnForm');
      const returnReason = document.getElementById('returnReason');
      const returnImages = document.getElementById('returnImages');
      const returnImagePreview = document.getElementById('returnImagePreview');
      const submitReturnBtn = document.getElementById('submitReturnBtn');
      const hamburgerBtn = document.getElementById('hamburgerBtn');
      const nav = document.querySelector('nav');

      let products = [];
      let categories = ["All"];
      let currentCategory = "All";
      let currentSearch = "";
      let currentModalProduct = null;
      let currentPage = 0;
      const productsPerPage = 10;
      let loadingMore = false;
      let hasMoreProducts = true;
      let currentOrderItemId = null;

      // Hamburger menu toggle
      hamburgerBtn.addEventListener('click', () => {
        const isExpanded = nav.classList.toggle('active');
        hamburgerBtn.setAttribute('aria-expanded', isExpanded);
        hamburgerBtn.querySelector('.material-symbols-outlined').textContent = isExpanded ? 'close' : 'menu';
      });

      // Close mobile nav when clicking a menu item
      nav.querySelectorAll('a, button').forEach(item => {
        item.addEventListener('click', () => {
          if (window.innerWidth <= 600) {
            nav.classList.remove('active');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
            hamburgerBtn.querySelector('.material-symbols-outlined').textContent = 'menu';
          }
        });
      });

      // Close mobile nav on Escape key press
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && nav.classList.contains('active')) {
          nav.classList.remove('active');
          hamburgerBtn.setAttribute('aria-expanded', 'false');
          hamburgerBtn.querySelector('.material-symbols-outlined').textContent = 'menu';
        }
      });

      // Close button for mobile navigation
      const closeNavBtn = document.getElementById('closeNavBtn');
      closeNavBtn.addEventListener('click', () => {
        nav.classList.remove('active');
        hamburgerBtn.setAttribute('aria-expanded', 'false');
        hamburgerBtn.querySelector('.material-symbols-outlined').textContent = 'menu';
      });

      // Debounce utility function
      function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
          const later = () => {
            clearTimeout(timeout);
            func(...args);
          };
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
        };
      }

      async function checkLoginState() {
        try {
          const response = await fetch('api.php?action=get_user_info');
          const result = await response.json();
          if (result.success) {
            btnLogin.style.display = 'none';
            btnLogout.style.display = 'inline-block';
            profileContainer.style.display = 'flex';
            profileUsername.textContent = result.data.username;
            profileImage.src = result.data.profile_image;
            if (result.data.role === 'seller') {
              btnSellerDashboard.style.display = 'inline-block';
            } else if (result.data.role === 'admin') {
              btnAdminDashboard.style.display = 'inline-block';
            }
            renderCartSidebar();
          } else {
            btnLogin.style.display = 'inline-block';
            btnLogout.style.display = 'none';
            profileContainer.style.display = 'none';
            btnSellerDashboard.style.display = 'none';
            btnAdminDashboard.style.display = 'none';
          }
        } catch (error) {
          console.error('Error checking login state:', error);
        }
      }

      async function fetchProducts(append = false) {
        if (loadingMore || !hasMoreProducts) return;
        try {
          loadingMore = true;
          loadingMessage.style.display = append ? 'none' : 'block';
          errorMessage.style.display = 'none';
          loadMoreIndicator.textContent = 'Loading more products...';
          const response = await fetch(`api.php?action=get_products&category=${encodeURIComponent(currentCategory)}&search=${encodeURIComponent(currentSearch)}&page=${currentPage}`);
          if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
          const result = await response.json();
          if (result.success) {
            const newProducts = result.data;
            if (newProducts.length < productsPerPage) {
              hasMoreProducts = false;
              loadMoreIndicator.textContent = 'No more products to load.';
            } else {
              loadMoreIndicator.textContent = '';
            }
            if (append) {
              products = [...products, ...newProducts];
            } else {
              products = newProducts;
            }
            renderProducts(products, append);
          } else {
            throw new Error(result.message || 'Failed to fetch products');
          }
        } catch (error) {
          loadingMessage.style.display = 'none';
          errorMessage.style.display = 'block';
          errorMessage.textContent = `Error loading products: ${error.message}. Please refresh to try again.`;
          console.error('Error fetching products:', error);
          loadMoreIndicator.textContent = '';
        } finally {
          loadingMore = false;
        }
      }

      async function fetchCategories() {
        const response = await fetch('api.php?action=get_categories');
        const result = await response.json();
        if (result.success) {
          categories = result.data;
          renderCategoryFilter();
        }
      }

      function renderCategoryFilter() {
        categoryFilter.innerHTML = '';
        categories.forEach(category => {
          const btn = document.createElement('button');
          btn.textContent = category;
          btn.classList.toggle('active', category === currentCategory);
          btn.addEventListener('click', () => {
            if (category !== currentCategory) {
              currentCategory = category;
              currentPage = 0;
              hasMoreProducts = true;
              renderCategoryFilter();
              fetchProducts();
            }
          });
          categoryFilter.appendChild(btn);
        });
      }

      function renderProducts(products, append = false) {
        if (!append) productsContainer.innerHTML = '';
        if (products.length === 0 && !append) {
          productsContainer.innerHTML = '<p style="grid-column: 1/-1; text-align:center; color:#777;">No products found.</p>';
          return;
        }
        const fragment = document.createDocumentFragment();
        products.slice(append ? -productsPerPage : 0).forEach(product => {
          const card = document.createElement('article');
          card.className = 'product-card';
          card.tabIndex = 0;
          const stockStatus = product.stock > 0 ? 'In Stock' : 'Out of Stock';
          const stockClass = product.stock > 0 ? 'in-stock' : 'out-of-stock';
          card.innerHTML = `
      <img src="${product.image}" alt="${product.name}" class="product-image" loading="lazy" />
      <div class="product-name">${product.name}</div>
      <div class="product-price">$${parseFloat(product.price).toFixed(2)}</div>
      <div class="product-stock ${stockClass}">${stockStatus}</div>
      <button class="add-to-cart-btn" data-id="${product.id}" ${product.stock === 0 ? 'disabled' : ''}>Add to Cart</button>
    `;
          card.addEventListener('click', (e) => {
            if (!e.target.classList.contains('add-to-cart-btn')) {
              openProductModal(product);
            }
          });
          fragment.appendChild(card);
        });
        productsContainer.appendChild(fragment);
        loadingMessage.style.display = 'none';
      }

      searchInput.addEventListener('input', e => {
        currentSearch = e.target.value.trim();
        currentPage = 0;
        hasMoreProducts = true;
        fetchProducts();
      });

      const handleScroll = debounce(() => {
        if (loadingMore || !hasMoreProducts) return;
        const scrollY = window.scrollY || window.pageYOffset;
        const visibleHeight = window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;
        if (scrollY + visibleHeight >= pageHeight - 150) {
          currentPage++;
          fetchProducts(true);
        }
      }, 200);

      window.addEventListener('scroll', handleScroll);

      function openProductModal(product) {
        currentModalProduct = product;
        productModalTitle.textContent = product.name;
        productModalDesc.textContent = product.description;
        modalProductImage.src = product.image;
        modalProductImage.alt = product.name;
        modalProductPrice.textContent = `$${parseFloat(product.price).toFixed(2)}`;

        // Remove any existing stock status elements
        const existingStock = productModal.querySelector('.product-stock');
        if (existingStock) {
          existingStock.remove();
        }

        // Add the new stock status
        const stockStatus = product.stock > 0 ? 'In Stock' : 'Out of Stock';
        const stockClass = product.stock > 0 ? 'in-stock' : 'out-of-stock';
        modalProductPrice.insertAdjacentHTML('afterend', `
    <div class="product-stock ${stockClass}">${stockStatus}</div>
  `);

        modalAddToCartBtn.disabled = product.stock === 0;
        productModal.classList.add('active');
      }

      closeProductModal.addEventListener('click', () => {
        productModal.classList.remove('active');
        currentModalProduct = null;
      });

      modalAddToCartBtn.addEventListener('click', async () => {
        if (currentModalProduct) {
          const response = await fetch('api.php?action=add_to_cart', {
            method: 'POST',
            body: new URLSearchParams({
              product_id: currentModalProduct.id
            })
          });
          const result = await response.json();
          if (result.success) {
            cartBadge.style.display = 'inline-block';
            cartBadge.textContent = result.data.cart_count;
            modalAddToCartBtn.textContent = 'Added!';
            setTimeout(() => modalAddToCartBtn.textContent = 'Add to Cart', 1200);
            renderCartSidebar();
          }
        }
      });

      productsContainer.addEventListener('click', async e => {
        if (e.target.classList.contains('add-to-cart-btn')) {
          const id = parseInt(e.target.getAttribute('data-id'));
          const response = await fetch('api.php?action=add_to_cart', {
            method: 'POST',
            body: new URLSearchParams({
              product_id: id
            })
          });
          const result = await response.json();
          if (result.success) {
            cartBadge.style.display = 'inline-block';
            cartBadge.textContent = result.data.cart_count;
            e.target.textContent = 'Added!';
            setTimeout(() => e.target.textContent = 'Add to Cart', 1200);
            renderCartSidebar();
          }
        }
      });

      async function renderCartSidebar() {
        const response = await fetch('api.php?action=get_cart');
        const result = await response.json();
        cartItemsContainer.innerHTML = '';
        if (result.success && result.data.items.length === 0) {
          cartItemsContainer.innerHTML = '<p style="color:#666; font-style: italic;">Your cart is empty.</p>';
          cartTotalPrice.textContent = 'Total: ₹ 0.00';
          checkoutBtn.disabled = true;
          return;
        }
        checkoutBtn.disabled = false;
        let total = result.data.total;
        result.data.items.forEach(item => {
          const itemEl = document.createElement('div');
          itemEl.className = 'cart-item';
          itemEl.innerHTML = `
            <div class="cart_as" style="display: flex;align-items: center; justify-content: space-between;">
              <img src="${item.image}" alt="${item.name}" style="width: 48px; height: 48px; border-radius: 8px; object-fit: contain;" />
              <div class="cart-item-info">
                  <div class="cart-item-name">${item.name}</div>
                  <div class="cart-item-qty">Quantity: ${item.qty}</div>
              </div>
              <div class="cart-item-price">₹ ${item.total.toFixed(2)}</div>
            </div>
            <button class="cart-item-remove-btn" data-id="${item.id}">Delete</button>
          `;
          cartItemsContainer.appendChild(itemEl);
        });
        cartTotalPrice.textContent = `Total: ₹ ${total.toFixed(2)}`;
        cartBadge.style.display = total > 0 ? 'inline-block' : 'none';
        cartBadge.textContent = result.data.items.reduce((sum, item) => sum + item.qty, 0);
      }

      cartItemsContainer.addEventListener('click', async e => {
        if (e.target.classList.contains('cart-item-remove-btn')) {
          const id = parseInt(e.target.getAttribute('data-id'));
          const response = await fetch('api.php?action=remove_from_cart', {
            method: 'POST',
            body: new URLSearchParams({
              product_id: id
            })
          });
          const result = await response.json();
          if (result.success) {
            cartBadge.textContent = result.data.cart_count;
            if (result.data.cart_count === 0) cartBadge.style.display = 'none';
            renderCartSidebar();
          }
        }
      });

      btnCart.addEventListener('click', () => {
        cartSidebar.classList.add('active');
        renderCartSidebar();
      });

      closeCartBtn.addEventListener('click', () => {
        cartSidebar.classList.remove('active');
      });

      checkoutBtn.addEventListener('click', () => {
        checkoutModal.classList.add('active');
        confirmationMessage.style.display = 'none';
        checkoutForm.style.display = 'block';
        checkoutForm.reset();
        clearFormErrors();
      });

      closeCheckoutModal.addEventListener('click', () => {
        checkoutModal.classList.remove('active');
      });

      function clearFormErrors() {
        ['FullName', 'EmailAddress', 'PhoneNumber', 'Address', 'LoginUsername', 'LoginPassword', 'RegUsername', 'RegEmail', 'RegPassword', 'RegProfileImage'].forEach(field => {
          document.getElementById('error' + field).textContent = '';
        });
      }

      checkoutForm.addEventListener('submit', async e => {
        e.preventDefault();
        clearFormErrors();
        let isValid = true;
        const fullName = checkoutForm.fullName.value.trim();
        const email = checkoutForm.emailAddress.value.trim();
        const phone = checkoutForm.phoneNumber.value.trim();
        const address = checkoutForm.address.value.trim();

        if (fullName.length < 3) {
          document.getElementById('errorFullName').textContent = 'Please enter your full name (min 3 characters).';
          isValid = false;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          document.getElementById('errorEmailAddress').textContent = 'Please enter a valid email.';
          isValid = false;
        }
        if (phone && !/^\+?[\d\s\-()]{6,20}$/.test(phone)) {
          document.getElementById('errorPhoneNumber').textContent = 'Please enter a valid phone number or leave empty.';
          isValid = false;
        }
        if (address.length < 5) {
          document.getElementById('errorAddress').textContent = 'Please enter your shipping address.';
          isValid = false;
        }
        if (!isValid) return;

        const response = await fetch('api.php?action=place_order', {
          method: 'POST'
        });
        const result = await response.json();
        if (result.success) {
          confirmationMessage.textContent = `Thank you ${fullName}! Your order #${result.data.order_id} has been placed successfully.`;
          confirmationMessage.style.display = 'block';
          checkoutForm.style.display = 'none';
          cartBadge.style.display = 'none';
          setTimeout(() => checkoutModal.classList.remove('active'), 4000);
          renderCartSidebar();
        } else {
          confirmationMessage.textContent = result.message;
          confirmationMessage.style.display = 'block';
        }
      });

      btnLogin.addEventListener('click', () => {
        loginModal.classList.add('active');
        clearFormErrors();
      });

      closeLoginModal.addEventListener('click', () => {
        loginModal.classList.remove('active');
      });

      showRegister.addEventListener('click', e => {
        e.preventDefault();
        loginModal.classList.remove('active');
        registerModal.classList.add('active');
        clearFormErrors();
      });

      loginForm.addEventListener('submit', async e => {
        e.preventDefault();
        clearFormErrors();
        const username = loginForm.username.value.trim();
        const password = loginForm.password.value;
        const role = loginForm.role.value;
        if (username.length < 3) {
          document.getElementById('errorLoginUsername').textContent = 'Username must be at least 3 characters.';
          return;
        }
        if (password.length < 6) {
          document.getElementById('errorLoginPassword').textContent = 'Password must be at least 6 characters.';
          return;
        }
        const response = await fetch('api.php?action=login', {
          method: 'POST',
          body: new URLSearchParams({
            username,
            password,
            role
          })
        });
        const result = await response.json();
        if (result.success) {
          loginModal.classList.remove('active');
          btnLogin.style.display = 'none';
          btnLogout.style.display = 'inline-block';
          profileContainer.style.display = 'flex';
          profileUsername.textContent = result.data.username;
          profileImage.src = result.data.profile_image;
          if (result.data.role === 'seller') {
            btnSellerDashboard.style.display = 'inline-block';
          } else if (result.data.role === 'admin') {
            btnAdminDashboard.style.display = 'inline-block';
          }
          renderCartSidebar();
        } else {
          document.getElementById('errorLoginUsername').textContent = result.message;
        }
      });

      closeRegisterModal.addEventListener('click', () => {
        registerModal.classList.remove('active');
      });

      registerForm.addEventListener('submit', async e => {
        e.preventDefault();
        clearFormErrors();
        const username = registerForm.username.value.trim();
        const email = registerForm.email.value.trim();
        const password = registerForm.password.value;
        const profileImage = registerForm.profile_image.value.trim();
        const role = registerForm.role.value;
        if (username.length < 3) {
          document.getElementById('errorRegUsername').textContent = 'Username must be at least 3 characters.';
          return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          document.getElementById('errorRegEmail').textContent = 'Please enter a valid email.';
          return;
        }
        if (password.length < 6) {
          document.getElementById('errorRegPassword').textContent = 'Password must be at least 6 characters.';
          return;
        }
        if (profileImage && !/^(https?:\/\/.*\.(?:png|jpg|jpeg|gif))$/i.test(profileImage)) {
          document.getElementById('errorRegProfileImage').textContent = 'Please enter a valid image URL (png, jpg, jpeg, gif) or leave empty.';
          return;
        }
        const response = await fetch('api.php?action=register', {
          method: 'POST',
          body: new URLSearchParams({
            username,
            email,
            password,
            profile_image: profileImage,
            role
          })
        });
        const result = await response.json();
        if (result.success) {
          registerModal.classList.remove('active');
          btnLogin.style.display = 'none';
          btnLogout.style.display = 'inline-block';
          profileContainer.style.display = 'flex';
          profileUsername.textContent = result.data.username;
          profileImage.src = result.data.profile_image;
          if (result.data.role === 'seller') {
            btnSellerDashboard.style.display = 'inline-block';
          } else if (result.data.role === 'admin') {
            btnAdminDashboard.style.display = 'inline-block';
          }
          renderCartSidebar();
        } else {
          document.getElementById('errorRegUsername').textContent = result.message;
        }
      });

      btnLogout.addEventListener('click', async () => {
        const response = await fetch('api.php?action=logout', {
          method: 'POST'
        });
        const result = await response.json();
        if (result.success) {
          btnLogin.style.display = 'inline-block';
          btnLogout.style.display = 'none';
          profileContainer.style.display = 'none';
          btnSellerDashboard.style.display = 'none';
          btnAdminDashboard.style.display = 'none';
          cartBadge.style.display = 'none';
          renderCartSidebar();
        }
      });

      btnSellerDashboard.addEventListener('click', () => {
        sellerDashboardModal.classList.add('active');
        document.getElementById('addProductForm').style.display = 'flex';
        document.getElementById('editProductForm').style.display = 'none';
        fetchSellerProducts();
      });

      // btnSellerDashboard.addEventListener('click', () => {
      //         sellerDashboardModal.classList.add('active');
      //         fetchSellerProducts();
      //       });

      closeSellerDashboard.addEventListener('click', () => {
        sellerDashboardModal.classList.remove('active');
      });

      addProductForm.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(addProductForm);
        const response = await fetch('api.php?action=add_product', {
          method: 'POST',
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          addProductForm.reset();
          fetchSellerProducts();
          fetchProducts();
          fetchCategories();
        }
        alert(result.message);
      });

      async function fetchSellerProducts() {
        const response = await fetch('api.php?action=get_seller_products');
        const result = await response.json();
        sellerProducts.innerHTML = '';
        if (result.success && result.data.length > 0) {
          result.data.forEach(product => {
            const card = document.createElement('article');
            card.className = 'product-card';
            card.innerHTML = `
        <img src="${product.image}" alt="${product.name}" class="product-image" />
        <div class="product-name">${product.name}</div>
        <div class="product-price">$${parseFloat(product.price).toFixed(2)}</div>
        <div>Stock: ${product.stock}</div>
        <div class="button-container">
          <button class="edit-product-btn" data-id="${product.id}">Edit</button>
          <button class="delete-product-btn" data-id="${product.id}">Delete</button>
        </div>
      `;
            sellerProducts.appendChild(card);
          });

          // Add event listeners for Edit buttons
          sellerProducts.querySelectorAll('.edit-product-btn').forEach(btn => {
            btn.addEventListener('click', () => {
              const productId = btn.getAttribute('data-id');
              const product = result.data.find(p => p.id == productId);
              if (product) {
                document.getElementById('editProductId').value = product.id;
                document.getElementById('editProductName').value = product.name;
                document.getElementById('editProductDescription').value = product.description || '';
                document.getElementById('editProductPrice').value = product.price;
                document.getElementById('editProductCategory').value = product.category;
                document.getElementById('editProductStock').value = product.stock;
                document.getElementById('editProductImage').value = product.image;
                document.getElementById('editProductForm').style.display = 'flex';
                document.getElementById('addProductForm').style.display = 'none';
              }
            });
          });

          // Add event listeners for Delete buttons
          sellerProducts.querySelectorAll('.delete-product-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
              const productId = btn.getAttribute('data-id');
              if (confirm('Are you sure you want to delete this product?')) {
                btn.disabled = true;
                btn.textContent = 'Deleting...';
                try {
                  const response = await fetch('api.php?action=delete_product', {
                    method: 'POST',
                    body: new URLSearchParams({
                      product_id: productId
                    })
                  });
                  const result = await response.json();
                  if (result.success) {
                    btn.textContent = 'Deleted!';
                    setTimeout(() => {
                      fetchSellerProducts();
                      fetchProducts();
                      fetchCategories();
                    }, 1200);
                  } else {
                    btn.disabled = false;
                    btn.textContent = 'Delete';
                    alert(result.message || 'Failed to delete product.');
                  }
                } catch (error) {
                  btn.disabled = false;
                  btn.textContent = 'Delete';
                  alert('Error deleting product: ' + error.message);
                }
              }
            });
          });
        } else {
          sellerProducts.innerHTML = '<p>No products added yet.</p>';
        }
      }


      editProductForm.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(editProductForm);
        const response = await fetch('api.php?action=update_product', {
          method: 'POST',
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          editProductForm.reset();
          editProductForm.style.display = 'none';
          addProductForm.style.display = 'flex';
          fetchSellerProducts();
          fetchProducts();
          fetchCategories();
        }
        alert(result.message);
      });

      btnOrders.addEventListener('click', () => {
        ordersModal.classList.add('active');
        fetchUserOrders();
      });

      closeOrdersModal.addEventListener('click', () => {
        ordersModal.classList.remove('active');
      });

      async function fetchUserOrders() {
        const response = await fetch('api.php?action=get_user_orders');
        const result = await response.json();
        ordersList.innerHTML = '';
        if (result.success && result.data.length > 0) {
          result.data.forEach(order => {
            const orderEl = document.createElement('div');
            orderEl.style.borderBottom = '1px solid #eee';
            orderEl.style.padding = '1rem 0';
            orderEl.style.display = 'flex';
            orderEl.style.alignItems = 'center';
            orderEl.innerHTML = `
        <img src="${order.image}" alt="${order.name}" style="width: 64px; height: 64px; border-radius: 8px; object-fit: contain; margin-right: 1rem;" />
        <div style="flex-grow: 1;">
          <div>Order #${order.id} - Total: $${parseFloat(order.total).toFixed(2)}</div>
          <div>Product: ${order.name}</div>
          <div>Quantity: ${order.quantity}</div>
          <div>Status: ${order.status}${order.return_status ? ' (Return: ' + order.return_status + ')' : ''}</div>
          <button class="submit-btn" data-order-item-id="${order.order_item_id}">View Status</button>
          ${order.status === 'ordered' ? `<button class="cancel-order-btn" data-order-item-id="${order.order_item_id}" style="margin-left: 1rem;">Cancel Order</button>` : ''}
        </div>
      `;
            ordersList.appendChild(orderEl);
          });
        } else {
          ordersList.innerHTML = '<p>No orders found.</p>';
        }
      }

      ordersList.addEventListener('click', async e => {
        if (e.target.tagName === 'BUTTON') {
          const orderItemId = e.target.getAttribute('data-order-item-id');
          if (e.target.classList.contains('cancel-order-btn')) {
            if (confirm('Are you sure you want to cancel this order?')) {
              e.target.disabled = true;
              e.target.textContent = 'Cancelling...';
              try {
                const response = await fetch('api.php?action=cancel_order', {
                  method: 'POST',
                  body: new URLSearchParams({
                    order_item_id: orderItemId
                  })
                });
                const result = await response.json();
                if (result.success) {
                  e.target.textContent = 'Cancelled!';
                  setTimeout(() => {
                    fetchUserOrders(); // Refresh the orders list
                  }, 1200);
                } else {
                  e.target.disabled = false;
                  e.target.textContent = 'Cancel Order';
                  alert(result.message || 'Failed to cancel order.');
                }
              } catch (error) {
                e.target.disabled = false;
                e.target.textContent = 'Cancel Order';
                alert('Error cancelling order: ' + error.message);
              }
            }
          } else if (e.target.classList.contains('submit-btn')) {
            currentOrderItemId = orderItemId;
            ordersModal.classList.remove('active');
            orderStatusModal.classList.add('active');
            fetchOrderStatus();
          }
        }
      });

      async function fetchOrderStatus() {
        const response = await fetch('api.php?action=get_order_status', {
          method: 'POST',
          body: new URLSearchParams({
            order_item_id: currentOrderItemId
          })
        });
        const result = await response.json();
        orderStatusUpdates.innerHTML = '';
        deliveryProgressBar.innerHTML = '';
        returnProgressBar.innerHTML = '';
        returnProgressContainer.style.display = 'none';
        returnFormContainer.style.display = 'none';
        requestReturnBtn.style.display = 'none';
        if (result.success) {
          const {
            delivery_updates,
            return_updates,
            return_reason,
            return_images
          } = result.data;
          const currentDeliveryStatus = delivery_updates.length > 0 ? delivery_updates[delivery_updates.length - 1].status : 'ordered';
          const currentReturnStatus = return_updates.length > 0 ? return_updates[return_updates.length - 1].status : null;

          renderDeliveryProgressBar(currentDeliveryStatus);
          if (currentDeliveryStatus === 'delivered' && !currentReturnStatus) {
            requestReturnBtn.style.display = 'block';
          }
          if (currentReturnStatus) {
            returnProgressContainer.style.display = 'block';
            renderReturnProgressBar(currentReturnStatus);
            if (return_reason) {
              const reasonEl = document.createElement('div');
              reasonEl.style.padding = '0.5rem 0';
              reasonEl.textContent = `Return Reason: ${return_reason}`;
              orderStatusUpdates.appendChild(reasonEl);
            }
            if (return_images && return_images.length > 0) {
              const imagesEl = document.createElement('div');
              imagesEl.style.padding = '0.5rem 0';
              imagesEl.innerHTML = '<strong>Return Images:</strong>';
              const preview = document.createElement('div');
              preview.className = 'return-image-preview';
              return_images.forEach(img => {
                const imgEl = document.createElement('img');
                imgEl.src = img;
                imgEl.alt = 'Return image';
                preview.appendChild(imgEl);
              });
              imagesEl.appendChild(preview);
              orderStatusUpdates.appendChild(imagesEl);
            }
          }

          delivery_updates.forEach(update => {
            const updateEl = document.createElement('div');
            updateEl.style.padding = '0.5rem 0';
            updateEl.textContent = `${update.status.charAt(0).toUpperCase() + update.status.slice(1)} - ${new Date(update.updated_at).toLocaleString()}`;
            orderStatusUpdates.appendChild(updateEl);
          });
          return_updates.forEach(update => {
            const updateEl = document.createElement('div');
            updateEl.style.padding = '0.5rem 0';
            updateEl.textContent = `Return: ${update.status.charAt(0).toUpperCase() + update.status.slice(1)} - ${new Date(update.updated_at).toLocaleString()}`;
            orderStatusUpdates.appendChild(updateEl);
          });

          sellerUpdateForm.style.display = btnSellerDashboard.style.display === 'inline-block' && currentDeliveryStatus !== 'delivered' ? 'block' : 'none';
        } else {
          orderStatusUpdates.innerHTML = '<p>No status updates available.</p>';
          renderDeliveryProgressBar('ordered');
        }
      }

      function renderDeliveryProgressBar(currentStatus) {
        const steps = [{
            status: 'ordered',
            label: 'Ordered',
            icon: '📝'
          },
          {
            status: 'shipped',
            label: 'Shipped',
            icon: '🚚'
          },
          {
            status: 'delivered',
            label: 'Delivered',
            icon: '📦'
          }
        ];
        let statusIndex = steps.findIndex(step => step.status === currentStatus);
        if (statusIndex === -1) {
          statusIndex = 0; // Default to 'ordered' if status is invalid
        }
        if (statusIndex > steps.length - 1) {
          statusIndex = steps.length - 1; // Cap at 'delivered'
        }

        // Calculate the width of each connector (between steps)
        const connectorWidth = 100 / (steps.length - 1); // e.g., 50% for 3 steps (2 connectors)

        deliveryProgressBar.innerHTML = steps.map((step, index) => {
          // Determine if the step is completed or active
          const isCompleted = index <= statusIndex;
          const isActive = index === statusIndex;

          // Connector is completed if the current step is completed and not the last step
          let connectorClass = '';
          if (index < steps.length - 1) {
            connectorClass = index < statusIndex ? 'completed' : (index === statusIndex && statusIndex >= 0 ? 'active' : '');
          }

          return `
      <div class="progress-step ${isCompleted ? 'completed' : ''} ${isActive ? 'active' : ''}">
        <div class="progress-icon">${step.icon}</div>
        <div class="progress-label">${step.label}</div>
      </div>
      ${index < steps.length - 1 ? `
        <div class="progress-connector ${connectorClass}" 
             style="width: ${connectorWidth}%; left: ${index * connectorWidth}%;"></div>
      ` : ''}
    `;
        }).join('');
      }


      function renderReturnProgressBar(currentStatus) {
        const steps = [{
            status: 'requested',
            label: 'Return Requested',
            icon: '📩'
          },
          {
            status: 'approved',
            label: 'Return Approved',
            icon: '✅'
          },
          {
            status: 'picked_up',
            label: 'Picked Up',
            icon: '🚛'
          },
          {
            status: 'refunded',
            label: 'Refunded',
            icon: '💸'
          },
          {
            status: 'rejected',
            label: 'Return Rejected',
            icon: '🚫'
          }
        ];
        let statusIndex = steps.findIndex(step => step.status === currentStatus);
        if (statusIndex === -1) {
          statusIndex = 0; // Default to 'requested' if status is invalid
        }

        // If rejected, show progress from requested to rejected
        if (currentStatus === 'rejected') {
          const rejectedSteps = [{
              status: 'requested',
              label: 'Return Requested',
              icon: '📩'
            },
            {
              status: 'rejected',
              label: 'Return Rejected',
              icon: '🚫'
            }
          ];
          const connectorWidth = 100; // Single connector between requested and rejected
          returnProgressBar.innerHTML = rejectedSteps.map((step, index) => {
            const isCompleted = true; // Both steps are completed for rejected
            const isActive = step.status === 'rejected';
            return `
                <div class="progress-step ${isCompleted ? 'completed' : ''} ${isActive ? 'active' : ''}">
                    <div class="progress-icon">${step.icon}</div>
                    <div class="progress-label">${step.label}</div>
                </div>
                ${index < rejectedSteps.length - 1 ? `
                    <div class="progress-connector completed" 
                         style="width: ${connectorWidth}%; left: 0%;"></div>
                ` : ''}
            `;
          }).join('');
          return;
        }

        // Calculate the width of each connector (between steps)
        const connectorWidth = 100 / (steps.length - 2); // Exclude 'rejected' for normal flow
        returnProgressBar.innerHTML = steps.slice(0, 4).map((step, index) => {
          // Determine if the step is completed or active
          const isCompleted = index <= statusIndex;
          const isActive = index === statusIndex;
          // Connector is completed if the current step is completed and not the last step
          let connectorClass = '';
          if (index < steps.length - 2) { // Exclude 'rejected' step
            connectorClass = index < statusIndex ? 'completed' : (index === statusIndex && statusIndex >= 0 ? 'active' : '');
          }
          return `
            <div class="progress-step ${isCompleted ? 'completed' : ''} ${isActive ? 'active' : ''}">
                <div class="progress-icon">${step.icon}</div>
                <div class="progress-label">${step.label}</div>
            </div>
            ${index < steps.length - 2 ? `
                <div class="progress-connector ${connectorClass}" 
                     style="width: ${connectorWidth}%; left: ${index * connectorWidth}%;"></div>
            ` : ''}
        `;
        }).join('');
      }


      requestReturnBtn.addEventListener('click', () => {
        returnFormContainer.style.display = 'block';
        requestReturnBtn.style.display = 'none';
        returnForm.reset();
        returnImagePreview.innerHTML = '';
        document.getElementById('errorReturnReason').textContent = '';
      });

      closeOrderStatusModal.addEventListener('click', () => {
        orderStatusModal.classList.remove('active');
        currentOrderItemId = null;
      });

      updateStatusForm.addEventListener('submit', async e => {
        e.preventDefault();
        const status = updateStatusForm.status.value;
        const response = await fetch('api.php?action=update_order_status', {
          method: 'POST',
          body: new URLSearchParams({
            order_item_id: currentOrderItemId,
            status
          })
        });
        const result = await response.json();
        if (result.success) {
          fetchOrderStatus();
        }
        alert(result.message);
      });

      returnForm.addEventListener('submit', async e => {
        e.preventDefault();
        const reason = returnReason.value.trim();
        const images = returnImages.files;
        document.getElementById('errorReturnReason').textContent = '';
        if (reason.length < 5) {
          document.getElementById('errorReturnReason').textContent = 'Please provide a reason (minimum 5 characters).';
          return;
        }
        const formData = new FormData();
        formData.append('order_item_id', currentOrderItemId);
        formData.append('reason', reason);
        for (let i = 0; i < images.length; i++) {
          formData.append('images[]', images[i]);
        }
        submitReturnBtn.disabled = true;
        submitReturnBtn.textContent = 'Submitting...';
        try {
          const response = await fetch('api.php?action=request_return', {
            method: 'POST',
            body: formData
          });
          const result = await response.json();
          submitReturnBtn.disabled = false;
          submitReturnBtn.textContent = 'Submit Return Request';
          if (result.success) {
            returnFormContainer.style.display = 'none';
            fetchOrderStatus();
          }
          alert(result.message);
        } catch (error) {
          submitReturnBtn.disabled = false;
          submitReturnBtn.textContent = 'Submit Return Request';
          alert('Error submitting return request: ' + error.message);
        }
      });

      btnAdminDashboard.addEventListener('click', () => {
        adminDashboardModal.classList.add('active');
        fetchAllOrders();
      });

      closeAdminDashboard.addEventListener('click', () => {
        adminDashboardModal.classList.remove('active');
      });

      // Update fetchAllOrders to include 'rejected' in the return status select
      async function fetchAllOrders() {
        try {
          const response = await fetch('api.php?action=get_all_orders');
          const result = await response.json();
          adminOrdersList.innerHTML = '';
          if (result.success && result.data.length > 0) {
            result.data.forEach(order => {
              const orderCard = document.createElement('div');
              orderCard.className = 'admin-order-card';
              orderCard.style.display = 'flex';
              orderCard.style.alignItems = 'center';
              orderCard.innerHTML = `
                    <img src="${order.image}" alt="${order.name}" style="width: 64px; height: 64px; border-radius: 8px; object-fit: contain; margin-right: 1rem;" />
                    <div style="flex-grow: 1;">
                        <h4>Order #${order.id} - ${order.username}</h4>
                        <p>Product: ${order.name}</p>
                        <p>Quantity: ${order.quantity}</p>
                        <p>Total: $${parseFloat(order.total).toFixed(2)}</p>
                        <p>Placed: ${new Date(order.created_at).toLocaleString()}</p>
                        <p>Delivery Status: ${order.status}</p>
                        <select class="admin-status-select" data-order-item-id="${order.order_item_id}">
                            <option value="ordered" ${order.status === 'ordered' ? 'selected' : ''}>Ordered</option>
                            <option value="shipped" ${order.status === 'shipped' ? 'selected' : ''}>Shipped</option>
                            <option value="delivered" ${order.status === 'delivered' ? 'selected' : ''}>Delivered</option>
                        </select>
                        <button class="admin-status-update-btn" data-order-item-id="${order.order_item_id}">Update Delivery Status</button>
                        ${order.return_status ? `
                            <p>Return Status: ${order.return_status}</p>
                            ${order.return_reason ? `<p>Return Reason: ${order.return_reason}</p>` : ''}
                            ${order.return_images && order.return_images.length > 0 ? `
                                <p>Return Images:</p>
                                <div class="return-image-preview">
                                    ${order.return_images.map(img => `<img src="${img}" alt="Return image" />`).join('')}
                                </div>
                            ` : ''}
                            <select class="admin-return-status-select" data-order-item-id="${order.order_item_id}">
                                <option value="requested" ${order.return_status === 'requested' ? 'selected' : ''}>Requested</option>
                                <option value="approved" ${order.return_status === 'approved' ? 'selected' : ''}>Approved</option>
                                <option value="picked_up" ${order.return_status === 'picked_up' ? 'selected' : ''}>Picked Up</option>
                                <option value="refunded" ${order.return_status === 'refunded' ? 'selected' : ''}>Refunded</option>
                                <option value="rejected" ${order.return_status === 'rejected' ? 'selected' : ''}>Rejected</option>
                            </select>
                            <button class="admin-return-status-update-btn" data-order-item-id="${order.order_item_id}">Update Return Status</button>
                        ` : ''}
                        <p class="admin-error-message" data-order-item-id="${order.order_item_id}"></p>
                    </div>
                `;
              adminOrdersList.appendChild(orderCard);
            });
          } else {
            adminOrdersList.innerHTML = '<p>No orders found.</p>';
          }
        } catch (error) {
          adminOrdersList.innerHTML = '<p>Error loading orders. Please try again.</p>';
          console.error('Error fetching orders:', error);
        }
      }

      // Update adminOrdersList event listener to include 'rejected' option
      adminOrdersList.addEventListener('click', async e => {
        if (e.target.classList.contains('admin-status-update-btn')) {
          const orderItemId = e.target.getAttribute('data-order-item-id');
          const select = adminOrdersList.querySelector(`select.admin-status-select[data-order-item-id="${orderItemId}"]`);
          const errorMessage = adminOrdersList.querySelector(`p.admin-error-message[data-order-item-id="${orderItemId}"]`);
          const status = select.value;

          e.target.disabled = true;
          e.target.textContent = 'Updating...';
          errorMessage.style.display = 'none';
          errorMessage.textContent = '';

          try {
            const response = await fetch('api.php?action=admin_update_order_status', {
              method: 'POST',
              body: new URLSearchParams({
                order_item_id: orderItemId,
                status
              })
            });
            const result = await response.json();
            if (result.success) {
              e.target.textContent = 'Updated!';
              setTimeout(() => {
                e.target.textContent = 'Update Delivery Status';
                e.target.disabled = false;
                fetchAllOrders();
              }, 1200);
            } else {
              errorMessage.textContent = result.message || 'Failed to update status.';
              errorMessage.style.display = 'block';
              e.target.disabled = false;
              e.target.textContent = 'Update Delivery Status';
            }
          } catch (error) {
            errorMessage.textContent = 'Error updating status. Please try again.';
            errorMessage.style.display = 'block';
            e.target.disabled = false;
            e.target.textContent = 'Update Delivery Status';
            console.error('Error updating order status:', error);
          }
        } else if (e.target.classList.contains('admin-return-status-update-btn')) {
          const orderItemId = e.target.getAttribute('data-order-item-id');
          const select = adminOrdersList.querySelector(`select.admin-return-status-select[data-order-item-id="${orderItemId}"]`);
          const errorMessage = adminOrdersList.querySelector(`p.admin-error-message[data-order-item-id="${orderItemId}"]`);
          const status = select.value;

          e.target.disabled = true;
          e.target.textContent = 'Updating...';
          errorMessage.style.display = 'none';
          errorMessage.textContent = '';

          try {
            const response = await fetch('api.php?action=admin_update_return_status', {
              method: 'POST',
              body: new URLSearchParams({
                order_item_id: orderItemId,
                status
              })
            });
            const result = await response.json();
            if (result.success) {
              e.target.textContent = 'Updated!';
              setTimeout(() => {
                e.target.textContent = 'Update Return Status';
                e.target.disabled = false;
                fetchAllOrders();
              }, 1200);
            } else {
              errorMessage.textContent = result.message || 'Failed to update return status.';
              errorMessage.style.display = 'block';
              e.target.disabled = false;
              e.target.textContent = 'Update Return Status';
            }
          } catch (error) {
            errorMessage.textContent = 'Error updating return status. Please try again.';
            errorMessage.style.display = 'block';
            e.target.disabled = false;
            e.target.textContent = 'Update Return Status';
            console.error('Error updating return status:', error);
          }
        }
      });

      returnImages.addEventListener('change', () => {
        returnImagePreview.innerHTML = '';
        const files = returnImages.files;
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.alt = 'Uploaded image preview';
              returnImagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
          }
        }
      });

      window.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
          [productModal, cartSidebar, checkoutModal, loginModal, registerModal, sellerDashboardModal, ordersModal, orderStatusModal, adminDashboardModal].forEach(modal => {
            modal.classList.remove('active');
          });
        }
      });

      // Initialize page
      checkLoginState();
      fetchCategories();
      fetchProducts();
    })();
  </script>
</body>

</html>