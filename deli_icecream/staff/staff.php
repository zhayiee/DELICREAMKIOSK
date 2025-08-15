<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Cream Deli</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #ffe4ec;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box, .main-content {
      animation: fadeIn 1s ease-in-out;
    }
    .login-box {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
      width: 300px;
    }
    .login-box h2 {
      margin-bottom: 20px;
      font-family: 'Dancing Script', cursive;
    }
    .login-box input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .login-box button {
      padding: 10px 20px;
      background: #f5a9c0;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
    }
    .login-box button:hover {
      background: #ff2e72;
      color: white;
    }
    .container {
      display: flex;
      height: 100vh;
      width: 100vw;
    }
    .sidebar {
      width: 200px;
      background-color: #f5a9c0;
      color: black;
      padding: 20px;
      animation: slideIn 1s ease-out;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar h2 {
      font-size: 20px;
      margin-top: 0;
      margin-bottom: 30px;
      font-weight: bold;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
    }
    .sidebar ul li {
      margin-bottom: 15px;
    }
    .sidebar ul li a {
      color: black;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s, transform 0.2s;
    }
    .sidebar ul li a:hover {
      color: #ff2e72;
      transform: translateX(5px);
    }
    .logout-btn {
      margin-top: 20px;
      padding: 10px;
      background-color: #ff2e72;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .logout-btn:hover {
      background-color: #cc1f59;
    }
    .main {
      flex: 1;
      background-color: #ffe4ec;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      padding: 20px;
      animation: fadeIn 1s ease-in;
      overflow-y: auto;
    }
    .main h1, .main h2 {
      font-family: 'Dancing Script', cursive;
    }
    .main h1 {
      font-size: 48px;
      margin: 0;
    }
    .main h2 {
      font-size: 30px;
      margin: 10px 0;
    }
    .main p {
      font-size: 16px;
      color: #555;
    }
    .inventory-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .inventory-table th, .inventory-table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    .forms-container {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      justify-content: center;
    }
    .form-card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-group {
      margin-bottom: 15px;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      width: 100%;
      padding: 10px;
      background-color: #f5a9c0;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #ff2e72;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
      from { transform: translateX(-100%); }
      to   { transform: translateX(0); }
    }
    .hidden {
      display: none;
    }
    .fade {
      animation: fadeIn 0.5s ease;
    }
    .main-content h1 {
      color: #FF6B8B;
      margin-bottom: 15px;
      text-align: left;
    }
    .record-buttons {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }
    .record-button {
      padding: 15px 25px;
      background: white;
      border: 2px solid #FF9EB5;
      border-radius: 8px;
      color: #FF6B8B;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }
    .record-button:hover {
      background-color: #fff0f3;
    }
    .record-button.active {
      background-color: #FF6B8B;
      color: white;
    }
    .filter-container {
      position: relative;
      margin-bottom: 20px;
      width: 200px;
    }
    .filter-button {
      width: 100%;
      padding: 12px 15px;
      background: white;
      border: 1px solid #FF9EB5;
      border-radius: 6px;
      color: #FF6B8B;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background-color 0.3s;
    }
    .filter-button:hover {
      background-color: #fff0f3;
    }
    .filter-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background-color: white;
      border: 1px solid #FF9EB5;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      z-index: 10;
      display: none;
      margin-top: 5px;
    }
    .filter-option {
      padding: 12px 15px;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .filter-option:hover {
      background-color: #fff0f3;
    }
    .filter-option:first-child {
      border-radius: 6px 6px 0 0;
    }
    .filter-option:last-child {
      border-radius: 0 0 6px 6px;
    }
    .table-container {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
    }
    .data-table th {
      background-color: #FF9EB5;
      color: white;
      padding: 15px;
      text-align: left;
    }
    .data-table td {
      padding: 12px 15px;
      border-bottom: 1px solid #f0f0f0;
    }
    .data-table tr:last-child td {
      border-bottom: none;
    }
    .total-row {
      background-color: #FFF0F3;
      font-weight: bold;
    }
    .table-actions {
      display: flex;
      justify-content: space-between;
      padding: 15px;
      background-color: #f8f9fa;
    }
    .total-button, .pdf-button {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .total-button {
      background-color: #FF9EB5;
      color: white;
    }
    .total-button:hover {
      background-color: #FF6B8B;
    }
    .pdf-button {
      background-color: #4CAF50;
      color: white;
    }
    .pdf-button:hover {
      background-color: #45a049;
    }
    .no-data {
      text-align: center;
      padding: 30px;
      color: #888;
    }
    .section-title {
      font-size: 20px;
      color: #ff6b8b;
      margin-bottom: 15px;
      font-weight: bold;
    }
    .action-btn {
      padding: 5px 10px;
      margin: 0 2px;
      background-color: #f5a9c0;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 12px;
    }
    .action-btn:hover {
      background-color: #ff2e72;
    }
    .action-btn.delete {
      background-color: #ff6b6b;
    }
    .action-btn.delete:hover {
      background-color: #ff5252;
    }
    .inventory-actions {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
    }
    .inventory-action-btn {
      padding: 12px 25px;
      background: white;
      border: 2px solid #FF9EB5;
      border-radius: 8px;
      color: #FF6B8B;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }
    .inventory-action-btn:hover {
      background-color: #fff0f3;
    }
  </style>
</head>
<body>
  <div class="login-box" id="loginBox">
    <h2>Login to Deli Cream</h2>
    <input type="text" id="username" placeholder="Username"/>
    <input type="password" id="password" placeholder="Password"/>
    <button onclick="login()">Login</button>
  </div>
  <div class="container hidden" id="dashboard">
    <div class="sidebar">
      <div>
        <h2>DASHBOARD</h2>
        <ul>
          <li><a onclick="showPage('home')">HOME</a></li>
          <li><a onclick="showPage('inventory')">INVENTORY</a></li>
          <li><a onclick="showPage('record')">RECORD</a></li>
        </ul>
      </div>
      <button class="logout-btn" onclick="logout()">Logout</button>
    </div>
    <div class="main" id="content">
      <h1>DELI</h1>
      <h2>CREAM</h2>
      <p>Ice cream, you scream!</p>
    </div>
  </div>
  <script>
    let currentUserRole = null;
    function login() {
      const user = document.getElementById('username').value.trim();
      const pass = document.getElementById('password').value;
      if ((user === 'admin' || user === 'staff') && pass === '1234') {
        currentUserRole = user;
        document.getElementById('loginBox').classList.add('hidden');
        document.getElementById('dashboard').classList.remove('hidden');
        showPage('home');
      } else {
        alert('Invalid username or password');
      }
    }
    function logout() {
      currentUserRole = null;
      document.getElementById('dashboard').classList.add('hidden');
      document.getElementById('loginBox').classList.remove('hidden');
      document.getElementById('username').value = '';
      document.getElementById('password').value = '';
      document.getElementById('content').innerHTML = `<h1>DELI</h1><h2>CREAM</h2><p>Ice cream, you scream!</p>`;
    }
    function showPage(page) {
      const content = document.getElementById('content');
      let html = '';
      if (page === 'inventory') {
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">INVENTORY</h1>
            <div class="table-container">
              <table class="inventory-table">
                <thead>
                  <tr>
                    <th>PRODNAME</th>
                    <th>TYPE</th>
                    <th>STOCK</th>
                    <th>PRICE</th>
                    <th>STATUS</th>
                    <th>DATE ADDED</th>
                    ${currentUserRole === 'admin' ? `<th>ACTIONS</th>` : ''}
                  </tr>
                </thead>
                <tbody id="inventory-table-body">
                  <tr>
                    <td>Vanilla Cone</td>
                    <td>Cone</td>
                    <td>10</td>
                    <td>1.50</td>
                    <td>Available</td>
                    <td>2025-07-15</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="editItem(1)">Edit</button> <button class="action-btn delete" onclick="deleteItem(1)">Delete</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Chocolate Scoop</td>
                    <td>Scoop</td>
                    <td>5</td>
                    <td>1.25</td>
                    <td>Available</td>
                    <td>2025-07-18</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="editItem(2)">Edit</button> <button class="action-btn delete" onclick="deleteItem(2)">Delete</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Strawberry Bowl</td>
                    <td>Bowl</td>
                    <td>7</td>
                    <td>2.00</td>
                    <td>Available</td>
                    <td>2025-07-20</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="editItem(3)">Edit</button> <button class="action-btn delete" onclick="deleteItem(3)">Delete</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Mint Chips</td>
                    <td>Scoop</td>
                    <td>0</td>
                    <td>1.75</td>
                    <td>Out of Stock</td>
                    <td>2025-07-10</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="editItem(4)">Edit</button> <button class="action-btn delete" onclick="deleteItem(4)">Delete</button></td>' : ''}
                  </tr>
                </tbody>
              </table>
            </div>
            
            ${currentUserRole === 'staff' ? `
            <div class="inventory-actions">
              <button class="inventory-action-btn" onclick="showPage('transaction')">TRANSACTION</button>
              <button class="inventory-action-btn" onclick="showPage('incoming')">INCOMING ITEMS</button>
            </div>` : ''}
            
            ${currentUserRole === 'admin' ? `
            <div class="forms-container">
              <div class="form-card">
                <h3>ADD ITEM</h3>
                <form id="add-item-form">
                  <div class="form-group">
                    <label for="add-date">Date</label>
                    <input type="date" id="add-date" required>
                  </div>
                  <div class="form-group">
                    <label for="item-type">Item Type</label>
                    <input type="text" id="item-type" required>
                  </div>
                  <div class="form-group">
                    <label for="add-name">Item Name</label>
                    <input type="text" id="add-name" required>
                  </div>
                  <div class="form-group">
                    <label for="add-quantity">Quantity</label>
                    <input type="number" id="add-quantity" min="1" required>
                  </div>
                  <div class="form-group">
                    <label for="add-price">Price Per Item</label>
                    <input type="number" id="add-price" step="0.01" min="0" required>
                  </div>
                  <div class="form-group">
                    <label for="add-supplier">Supplier</label>
                    <input type="text" id="add-supplier" required>
                  </div>
                  <button type="submit" class="btn">Confirm</button>
                </form>
              </div>
              <div class="form-card">
                <h3>DELETE ITEM</h3>
                <form id="delete-item-form">
                  <div class="form-group">
                    <label for="delete-date">Date</label>
                    <input type="date" id="delete-date" required>
                  </div>
                  <div class="form-group">
                    <label for="delete-type">Item Type</label>
                    <input type="text" id="delete-type" required>
                  </div>
                  <div class="form-group">
                    <label for="delete-name">Item Name</label>
                    <input type="text" id="delete-name" required>
                  </div>
                  <button type="submit" class="btn">Confirm</button>
                </form>
              </div>
            </div>` : ''}
          </div>
        `;
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
        if(currentUserRole === 'admin') {
          const addItemForm = document.getElementById('add-item-form');
          const deleteItemForm = document.getElementById('delete-item-form');
          if (addItemForm) {
            addItemForm.addEventListener('submit', e => {
              e.preventDefault();
              alert("Item added (not yet functional)");
              addItemForm.reset();
            });
          }
          if (deleteItemForm) {
            deleteItemForm.addEventListener('submit', e => {
              e.preventDefault();
              alert("Item deleted (not yet functional)");
              deleteItemForm.reset();
            });
          }
        }
      }
      else if (page === 'transaction') {
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">TRANSACTIONS</h1>
            <div class="table-container">
              <table class="data-table">
                <thead>
                  <tr>
                    <th>DATE</th>
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>TOTAL PRICE</th>
                    <th>STATUS</th>
                    ${currentUserRole === 'admin' ? `<th>ACTIONS</th>` : ''}
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2025-07-25</td>
                    <td>Vanilla Cone</td>
                    <td>2</td>
                    <td>3.00</td>
                    <td>Completed</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="viewTransaction(1)">View</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>2025-07-24</td>
                    <td>Chocolate Scoop</td>
                    <td>3</td>
                    <td>3.75</td>
                    <td>Completed</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="viewTransaction(2)">View</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>2025-07-23</td>
                    <td>Strawberry Bowl</td>
                    <td>1</td>
                    <td>2.00</td>
                    <td>Completed</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="viewTransaction(3)">View</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>2025-07-22</td>
                    <td>Mint Chips</td>
                    <td>4</td>
                    <td>7.00</td>
                    <td>Pending</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="viewTransaction(4)">View</button></td>' : ''}
                  </tr>
                </tbody>
              </table>
            </div>
            ${currentUserRole === 'staff' ? `
            <div class="inventory-actions">
              <button class="inventory-action-btn" onclick="showPage('inventory')">BACK TO INVENTORY</button>
            </div>` : ''}
          </div>
        `;
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
      }
      else if (page === 'incoming') {
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">INCOMING ITEMS</h1>
            <div class="table-container">
              <table class="data-table">
                <thead>
                  <tr>
                    <th>ITEM NAME</th>
                    <th>TYPE</th>
                    <th>QUANTITY</th>
                    <th>DATE RECEIVED</th>
                    <th>STATUS</th>
                    ${currentUserRole === 'admin' ? `<th>ACTIONS</th>` : ''}
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Vanilla Mix</td>
                    <td>Ingredient</td>
                    <td>20kg</td>
                    <td>2025-07-25</td>
                    <td>Received</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="processItem(1)">Process</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Chocolate Chips</td>
                    <td>Topping</td>
                    <td>5kg</td>
                    <td>2025-07-24</td>
                    <td>Received</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="processItem(2)">Process</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Sugar Cones</td>
                    <td>Packaging</td>
                    <td>200 units</td>
                    <td>2025-07-23</td>
                    <td>Pending</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="processItem(3)">Process</button></td>' : ''}
                  </tr>
                  <tr>
                    <td>Strawberry Puree</td>
                    <td>Ingredient</td>
                    <td>10L</td>
                    <td>2025-07-22</td>
                    <td>In Transit</td>
                    ${currentUserRole === 'admin' ? '<td><button class="action-btn" onclick="processItem(4)">Process</button></td>' : ''}
                  </tr>
                </tbody>
              </table>
            </div>
            ${currentUserRole === 'staff' ? `
            <div class="inventory-actions">
              <button class="inventory-action-btn" onclick="showPage('inventory')">BACK TO INVENTORY</button>
            </div>` : ''}
            
            ${currentUserRole === 'admin' ? `
            <div class="forms-container">
              <div class="form-card">
                <h3>ADD INCOMING ITEM</h3>
                <form id="add-incoming-form">
                  <div class="form-group">
                    <label for="incoming-date">Date</label>
                    <input type="date" id="incoming-date" required>
                  </div>
                  <div class="form-group">
                    <label for="incoming-type">Item Type</label>
                    <input type="text" id="incoming-type" required>
                  </div>
                  <div class="form-group">
                    <label for="incoming-name">Item Name</label>
                    <input type="text" id="incoming-name" required>
                  </div>
                  <div class="form-group">
                    <label for="incoming-quantity">Quantity</label>
                    <input type="text" id="incoming-quantity" required>
                  </div>
                  <div class="form-group">
                    <label for="incoming-status">Status</label>
                    <select id="incoming-status" required>
                      <option value="In Transit">In Transit</option>
                      <option value="Received">Received</option>
                      <option value="Pending">Pending</option>
                    </select>
                  </div>
                  <button type="submit" class="btn">Confirm</button>
                </form>
              </div>
            </div>` : ''}
          </div>
        `;
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
        
        if(currentUserRole === 'admin') {
          const addIncomingForm = document.getElementById('add-incoming-form');
          if (addIncomingForm) {
            addIncomingForm.addEventListener('submit', e => {
              e.preventDefault();
              alert("Incoming item added (not yet functional)");
              addIncomingForm.reset();
            });
          }
        }
      }
      else if (page === 'record') {
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">RECORDS</h1>
            <div class="record-buttons" style="display:flex; gap:20px; margin-bottom:30px;">
              <button class="record-button" id="sales-history-btn" style="padding:15px 25px; background:#fff; border:2px solid #FF9EB5; border-radius:8px; color:#FF6B8B; font-weight:bold; cursor:pointer;">SALES HISTORY</button>
              <button class="record-button" id="item-history-btn" style="padding:15px 25px; background:#fff; border:2px solid #FF9EB5; border-radius:8px; color:#FF6B8B; font-weight:bold; cursor:pointer;">ITEM HISTORY</button>
            </div>
            <div class="content-section" id="sales-history-content" style="display:none;">
              <div class="filter-container" style="margin-bottom:20px; position: relative;">
                <button class="filter-button" id="filter-toggle" style="width:200px; padding:12px 15px; background:#fff; border:1px solid #FF9EB5; border-radius:6px; color:#FF6B8B; font-weight:bold; cursor:pointer; display:flex; justify-content:space-between; align-items:center;">
                  FILTER <span>▼</span>
                </button>
                <div class="filter-dropdown" id="filter-dropdown" style="position:absolute; left:0; right:0; background:#fff; border:1px solid #FF9EB5; border-radius:6px; box-shadow:0 4px 8px rgba(0,0,0,0.1); z-index:10; display:none; margin-top:5px;">
                  <div class="filter-option" data-filter="recent" style="padding:12px 15px; cursor:pointer;">RECENT</div>
                  <div class="filter-option" data-filter="weekly" style="padding:12px 15px; cursor:pointer;">WEEKLY</div>
                  <div class="filter-option" data-filter="monthly" style="padding:12px 15px; cursor:pointer;">MONTHLY</div>
                  <div class="filter-option" data-filter="annual" style="padding:12px 15px; cursor:pointer;">ANNUAL</div>
                </div>
              </div>
              <div class="table-container" id="table-container">
                <div class="no-data" style="text-align:center; padding:30px; color:#888;">
                  Select a filter to view sales history
                </div>
              </div>
            </div>
            <div class="content-section" id="item-history-content" style="display:none;">
              <div class="no-data" style="text-align:center; padding:30px; color:#888;">Item history data will be displayed here</div>
            </div>
          </div>
        `;
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
        const salesHistoryBtn = content.querySelector('#sales-history-btn');
        const itemHistoryBtn = content.querySelector('#item-history-btn');
        const salesHistoryContent = content.querySelector('#sales-history-content');
        const itemHistoryContent = content.querySelector('#item-history-content');
        const filterToggle = content.querySelector('#filter-toggle');
        const filterDropdown = content.querySelector('#filter-dropdown');
        const tableContainer = content.querySelector('#table-container');
        const totalButton = content.querySelector('#calculate-total');
        const pdfButton = content.querySelector('#convert-pdf');
        function resetRecordButtonStyles() {
          [salesHistoryBtn, itemHistoryBtn].forEach(btn => {
            btn.style.background = '#fff';
            btn.style.color = '#FF6B8B';
          });
        }
        salesHistoryBtn.onclick = () => {
          resetRecordButtonStyles();
          salesHistoryBtn.style.background = '#FF6B8B';
          salesHistoryBtn.style.color = '#fff';
          salesHistoryContent.style.display = 'block';
          itemHistoryContent.style.display = 'none';
          if (currentUserRole === 'staff') {
            if(filterToggle) filterToggle.style.display = 'none';
            if(filterDropdown) filterDropdown.style.display = 'none';
            if(totalButton) totalButton.style.display = 'none';
            if(pdfButton) pdfButton.style.display = 'none';
            generateTable('recent');
          } else {
            if(filterToggle) filterToggle.style.display = 'flex';
            if(totalButton) totalButton.style.display = 'inline-block';
            if(pdfButton) pdfButton.style.display = 'inline-block';
            tableContainer.innerHTML = `<div class="no-data" style="text-align:center; padding:30px; color:#888;">Select a filter to view sales history</div>`;
          }
        };
        itemHistoryBtn.onclick = () => {
          resetRecordButtonStyles();
          itemHistoryBtn.style.background = '#FF6B8B';
          itemHistoryBtn.style.color = '#fff';
          salesHistoryBtn.style.background = '#fff';
          salesHistoryBtn.style.color = '#FF6B8B';
          salesHistoryContent.style.display = 'none';
          if (currentUserRole === 'staff') {
            itemHistoryContent.innerHTML = `<div class="no-data" style="text-align:center; padding:30px; color:#888;">Access restricted</div>`;
            itemHistoryContent.style.display = 'block';
          } else {
            itemHistoryContent.style.display = 'block';
            generateItemHistoryTables();
          }
        };
        if (filterToggle) {
          filterToggle.onclick = (e) => {
            if(currentUserRole !== 'staff') {
              e.stopPropagation();
              filterDropdown.style.display = (filterDropdown.style.display === 'block' ? 'none' : 'block');
            }
          };
        }
        document.addEventListener('click', (event) => {
          if (!filterToggle?.contains(event.target) && !filterDropdown?.contains(event.target)) {
            if(filterDropdown) filterDropdown.style.display = 'none';
          }
        });
        if(currentUserRole !== 'staff') {
          const filterOptions = content.querySelectorAll('.filter-option');
          filterOptions.forEach(option => {
            option.onclick = function() {
              const filter = this.getAttribute('data-filter');
              filterToggle.innerHTML = `${this.textContent} <span>▼</span>`;
              filterDropdown.style.display = 'none';
              generateTable(filter);
            };
          });
        }
        salesHistoryBtn.click();
      }
      else {
        html = `<h1>DELI</h1><h2>CREAM</h2><p>Ice cream, you scream!</p>`;
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
      }
    }
    
    // Helper functions for the new pages
    function editItem(id) {
      alert(`Edit item with ID: ${id} (not yet functional)`);
    }
    
    function deleteItem(id) {
      if(confirm(`Are you sure you want to delete item with ID: ${id}?`)) {
        alert(`Item with ID: ${id} deleted (not yet functional)`);
      }
    }
    
    function viewTransaction(id) {
      alert(`View transaction with ID: ${id} (not yet functional)`);
    }
    
    function processItem(id) {
      alert(`Process item with ID: ${id} (not yet functional)`);
    }
    
    // Existing functions remain the same
    function generateTable(filter) {
      const content = document.getElementById('content');
      const tableContainer = content.querySelector('#table-container');
      if(!tableContainer) return;
      let tableHTML = `
      <table class="data-table" style="width:100%; border-collapse:collapse;">
          <thead>
          <tr>
            <th style="background:#FF9EB5; color:#fff; padding:15px; text-align:left;">NO. ORDER</th>
            <th style="background:#FF9EB5; color:#fff; padding:15px; text-align:left;">DATE</th>
            <th style="background:#FF9EB5; color:#fff; padding:15px; text-align:left;">ITEM</th>
            <th style="background:#FF9EB5; color:#fff; padding:15px; text-align:left;">QUANTITY</th>
            <th style="background:#FF9EB5; color:#fff; padding:15px; text-align:left;">PRICE</th>
          </tr>
          </thead>
          <tbody>
      `;
      const exampleData = [
        { order: '001', date: '2025-08-10', item: 'Vanilla Ice Cream', quantity: 3, price: 4.50 },
        { order: '002', date: '2025-08-09', item: 'Chocolate Cone', quantity: 2, price: 3.00 },
        { order: '003', date: '2025-08-08', item: 'Strawberry Scoop', quantity: 5, price: 7.25 },
        { order: '004', date: '2025-08-07', item: 'Mint Chips', quantity: 1, price: 1.50 },
      ];
      exampleData.forEach(row => {
        tableHTML += `
          <tr>
            <td>${row.order}</td>
            <td>${row.date}</td>
            <td>${row.item}</td>
            <td>${row.quantity}</td>
            <td class="price-cell">${row.price.toFixed(2)}</td>
          </tr>
        `;
      });
      tableHTML += `
          <tr class="total-row" style="background:#FFF0F3; font-weight:bold;">
            <td colspan="4">TOTAL</td>
            <td id="total-price">0.00</td>
          </tr>
          </tbody>
        </table>
      `;
      if(currentUserRole === 'admin') {
        tableHTML += `
          <div class="table-actions" style="display:flex; justify-content:space-between; padding:15px; background:#f8f9fa;">
          <button class="total-button" id="calculate-total">CALCULATE TOTAL</button>
          <button class="pdf-button" id="convert-pdf">CONVERT TO PDF</button>
          </div>
        `;
      }
      tableContainer.innerHTML = tableHTML;
      if(currentUserRole === 'admin') {
        content.querySelector('#calculate-total').onclick = () => {
          const priceCells = tableContainer.querySelectorAll('.price-cell');
          let total = 0;
          priceCells.forEach(cell => {
            const val = parseFloat(cell.textContent) || 0;
            total += val;
          });
          tableContainer.querySelector('#total-price').textContent = total.toFixed(2);
        };
        content.querySelector('#convert-pdf').onclick = () => {
          if(window.jspdf && window.jspdf.jsPDF) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.setFontSize(18);
            doc.text(`Sales History - ${filter.toUpperCase()}`, 105, 15, {align: 'center'});
            const headers = [];
            tableContainer.querySelectorAll('.data-table th').forEach(th => headers.push(th.textContent));
            const data = [];
            tableContainer.querySelectorAll('.data-table tbody tr:not(.total-row)').forEach(tr => {
              const row = [];
              tr.querySelectorAll('td').forEach(td => row.push(td.textContent));
              data.push(row);
            });
            doc.autoTable({
              head: [headers],
              body: data,
              startY: 25,
              theme: 'grid',
              headStyles: {fillColor: [255, 158, 181]},
              footStyles: {fillColor: [255, 240, 243]}
            });
            doc.save(`sales-history-${filter}.pdf`);
          } else {
            alert('jsPDF library not loaded.');
          }
        };
      }
    }
    function generateItemHistoryTables() {
      const content = document.getElementById('content');
      const itemHistoryContent = content.querySelector('#item-history-content');
      if(!itemHistoryContent) return;
      let itemHistoryHTML = `
      <div class="section-title">Item History</div>
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>NO. ORDER</th>
              <th>DATE</th>
              <th>ITEM</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>001</td><td>2025-08-10</td><td>Vanilla Cone</td><td>3</td><td class="price-cell-item">4.50</td></tr>
            <tr><td>002</td><td>2025-08-09</td><td>Chocolate Scoop</td><td>2</td><td class="price-cell-item">3.00</td></tr>
            <tr><td>003</td><td>2025-08-08</td><td>Strawberry Bowl</td><td>5</td><td class="price-cell-item">7.25</td></tr>
            <tr><td>004</td><td>2025-08-07</td><td>Mint Chips</td><td>1</td><td class="price-cell-item">1.75</td></tr>
            <tr class="total-row"><td colspan="4">TOTAL</td><td id="total-price-item">0.00</td></tr>
          </tbody>
        </table>
        <div class="table-actions">
          <button class="total-button" id="calculate-total-item">CALCULATE TOTAL</button>
          <button class="pdf-button" id="convert-pdf-item">CONVERT TO PDF</button>
        </div>
      </div>
      <div class="section-title">Deleted History</div>
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>DATE</th>
              <th>ITEM TYPE</th>
              <th>ITEM</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>2025-08-05</td><td>Cone</td><td>Vanilla Cone</td></tr>
            <tr><td>2025-08-04</td><td>Scoop</td><td>Chocolate Scoop</td></tr>
            <tr><td>2025-08-03</td><td>Bowl</td><td>Strawberry Bowl</td></tr>
            <tr><td>2025-08-02</td><td>Scoop</td><td>Mint Chips</td></tr>
          </tbody>
        </table>
      </div>
      `;
      itemHistoryContent.innerHTML = itemHistoryHTML;
      document.getElementById('calculate-total-item').onclick = () => {
        const priceCells = itemHistoryContent.querySelectorAll('.price-cell-item');
        let total = 0;
        priceCells.forEach(cell => {
          const val = parseFloat(cell.textContent) || 0;
          total += val;
        });
        document.getElementById('total-price-item').textContent = total.toFixed(2);
      };
      document.getElementById('convert-pdf-item').onclick = () => {
        if(window.jspdf && window.jspdf.jsPDF) {
          const { jsPDF } = window.jspdf;
          const doc = new jsPDF();
          doc.setFontSize(18);
          doc.text('Item History', 105, 15, {align:'center'});
          const headers1 = ['NO. ORDER', 'DATE', 'ITEM', 'QUANTITY', 'PRICE'];
          const data1 = [];
          const tableRows1 = itemHistoryContent.querySelectorAll('.table-container:nth-child(2) tbody tr:not(.total-row)');
          tableRows1.forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach(td => rowData.push(td.textContent));
            data1.push(rowData);
          });
          doc.autoTable({
            head: [headers1],
            body: data1,
            startY: 25,
            theme: 'grid',
            headStyles: {fillColor: [255, 158, 181]},
            footStyles: {fillColor: [255, 240, 243]}
          });
          doc.setFontSize(16);
          doc.text('Deleted History', 105, doc.lastAutoTable.finalY + 15, {align:'center'});
          const headers2 = ['DATE', 'ITEM TYPE', 'ITEM'];
          const data2 = [];
          const tableRows2 = itemHistoryContent.querySelectorAll('.table-container:last-child tbody tr');
          tableRows2.forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach(td => rowData.push(td.textContent));
            data2.push(rowData);
          });
          doc.autoTable({
            head: [headers2],
            body: data2,
            startY: doc.lastAutoTable.finalY + 20,
            theme: 'grid',
            headStyles: {fillColor: [255, 158, 181]},
            footStyles: {fillColor: [255, 240, 243]}
          });
          doc.save('item-history.pdf');
        } else {
          alert('jsPDF library not loaded.');
        }
      };
    }
  </script>
</body>
</html>