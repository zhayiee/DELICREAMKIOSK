<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cream Deli</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <!-- jsPDF libraries for record page PDF export -->
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
      justify-content: flex-start;
      align-items: flex-start;
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
    .low-stock {
      color: red;
      font-weight: bold;
    }
    .low-stock-row {
      background-color: #ffe6e6;
    }
    .action-buttons {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }
    .action-button {
      padding: 15px 25px;
      background: white;
      border: 2px solid #FF9EB5;
      border-radius: 8px;
      color: #FF6B8B;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }
    .action-button:hover {
      background-color: #fff0f3;
    }
    .action-button.active {
      background-color: #FF6B8B;
      color: white;
    }
    .forms-container {
      display: none;
      gap: 30px;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 20px;
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
    /* Additional styles for record page */
    .main-content {
      width: 100%;
      padding: 20px;
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
    
    /* Modal styles for low stock alert */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      animation: fadeIn 0.3s;
    }
    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #f44336;
      border-radius: 10px;
      width: 50%;
      max-width: 500px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      animation: slideIn 0.3s;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #f0f0f0;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .modal-title {
      color: #f44336;
      font-size: 20px;
      font-weight: bold;
      margin: 0;
    }
    .close {
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s;
    }
    .close:hover {
      color: #f44336;
    }
    .modal-body {
      margin-bottom: 20px;
    }
    .modal-footer {
      display: flex;
      justify-content: flex-end;
    }
    .modal-btn {
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
      margin-left: 10px;
    }
    .modal-btn-primary {
      background-color: #f44336;
      color: white;
    }
    .modal-btn-primary:hover {
      background-color: #d32f2f;
    }
    .modal-btn-secondary {
      background-color: #f1f1f1;
      color: #333;
    }
    .modal-btn-secondary:hover {
      background-color: #ddd;
    }
    .low-stock-list {
      list-style-type: none;
      padding: 0;
      margin: 10px 0;
    }
    .low-stock-list li {
      padding: 8px 0;
      border-bottom: 1px solid #f0f0f0;
    }
    .low-stock-list li:last-child {
      border-bottom: none;
    }
  </style>
</head>
<body>
  <!-- LOGIN FORM -->
  <div class="login-box" id="loginBox">
    <h2>Login to Cream Deli</h2>
    <input type="text" id="username" placeholder="Username"/>
    <input type="password" id="password" placeholder="Password"/>
    <button onclick="login()">Login</button>
  </div>
  <!-- DASHBOARD -->
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
  
  <!-- Low Stock Alert Modal -->
  <div id="lowStockModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">⚠️ LOW STOCK ALERT ⚠️</h3>
        <span class="close" onclick="closeLowStockModal()">&times;</span>
      </div>
      <div class="modal-body">
        <p>The following items need to be restocked immediately:</p>
        <ul id="lowStockList" class="low-stock-list"></ul>
      </div>
      <div class="modal-footer">
        <button class="modal-btn modal-btn-secondary" onclick="closeLowStockModal()">Close</button>
        <button class="modal-btn modal-btn-primary" onclick="restockItems()">Restock Items</button>
      </div>
    </div>
  </div>
  
  <!-- SCRIPT -->
  <script>
    function login() {
      const user = document.getElementById('username').value;
      const pass = document.getElementById('password').value;
      if ((user === 'admin' || user === 'staff') && pass === '1234') {
        document.getElementById('loginBox').classList.add('hidden');
        document.getElementById('dashboard').classList.remove('hidden');
        showPage("home");
      } else {
        alert('Invalid username or password');
      }
    }
    function logout() {
      document.getElementById('dashboard').classList.add('hidden');
      document.getElementById('loginBox').classList.remove('hidden');
      document.getElementById('username').value = '';
      document.getElementById('password').value = '';
    }
    function showPage(page) {
      const content = document.getElementById("content");
      let html = '';
      if (page === "inventory") {
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">INVENTORY</h1>
            
            <table class="inventory-table">
              <thead>
                <tr>
                  <th>PRODUCTNAME</th>
                  <th>TYPE</th>
                  <th>STOCK</th>
                  <th>PRICE</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody id="inventory-table-body">
                <tr><td>Vanilla Ice Cream</td><td>Ice Cream</td><td>3</td><td>4.50</td><td>In Stock</td></tr>
                <tr><td>Chocolate Cone</td><td>Ice Cream</td><td>10</td><td>3.00</td><td>In Stock</td></tr>
                <tr><td>Strawberry Scoop</td><td>Ice Cream</td><td>2</td><td>5.00</td><td>In Stock</td></tr>
                <tr><td>Mint Chips</td><td>Ice Cream</td><td>7</td><td>3.50</td><td>In Stock</td></tr>
              </tbody>
            </table>
            
            <div class="action-buttons">
              <button class="action-button" id="add-item-btn">ADD ITEM</button>
              <button class="action-button" id="delete-item-btn">DELETE ITEM</button>
              <button class="action-button" id="check-low-stock-btn">CHECK LOW STOCK</button>
            </div>
            
            <div class="forms-container" id="forms-container">
              <div class="form-card">
                <h3>ADD ITEM</h3>
                <form id="add-item-form">
                  <div class="form-group">
                    <label for="add-date">Date</label>
                    <input type="text" id="date">
                  </div>
                  <div class="form-group">
                    <label for="item-type">Item Type</label>
                    <input type="text" id="item-type">
                  </div>
                  <div class="form-group">
                    <label for="add-name">Item Name</label>
                    <input type="text" id="add-name">
                  </div>
                  <div class="form-group">
                    <label for="add-quantity">Quantity</label>
                    <input type="number" id="add-quantity" min="1">
                  </div>
                  <div class="form-group">
                    <label for="add-price">Price Per Item</label>
                    <input type="number" id="add-price" step="0.01" min="0">
                  </div>
                  <button type="submit" class="btn">Confirm</button>
                </form>
              </div>
              <div class="form-card">
                <h3>DELETE ITEM</h3>
                <form id="delete-item-form">
                  <div class="form-group">
                    <label for="delete-date">Date</label>
                    <input type="text" id="delete-date">
                  </div>
                  <div class="form-group">
                    <label for="delete-type">Item Type</label>
                    <input type="text" id="delete-type">
                  </div>
                  <div class="form-group">
                    <label for="delete-name">Item Name</label>
                    <input type="text" id="delete-name">
                  </div>
                  <button type="submit" class="btn">Confirm</button>
                </form>
              </div>
            </div>
          </div>
        `;
      } else if (page === "record") {
        // RECORD section HTML and JS integrated:
        html = `
          <div class="main-content">
            <h1 style="color:#FF6B8B; margin-bottom:15px; text-align:left;">RECORDS</h1>
            <div class="record-buttons" style="display:flex; gap:20px; margin-bottom:30px;">
              <button class="record-button" id="sales-history-btn" style="padding:15px 25px; background:#fff; border:2px solid #FF9EB5; border-radius:8px; color:#FF6B8B; font-weight:bold; cursor:pointer;">SALES HISTORY</button>
              <button class="record-button" id="item-history-btn" style="padding:15px 25px; background:#fff; border:2px solid #FF9EB5; border-radius:8px; color:#FF6B8B; font-weight:bold; cursor:pointer;">ITEM HISTORY</button>
            </div>
            <!-- SALES HISTORY -->
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
            <!-- ITEM HISTORY -->
            <div class="content-section" id="item-history-content" style="display:none;">
              <div class="no-data" style="text-align:center; padding:30px; color:#888;">Item history data will be displayed here</div>
            </div>
          </div>
        `;
        content.innerHTML = html;
        // --- JS for record section ---
        const recordButtons = content.querySelectorAll('.record-button');
        const salesHistoryBtn = content.querySelector('#sales-history-btn');
        const itemHistoryBtn = content.querySelector('#item-history-btn');
        const salesHistoryContent = content.querySelector('#sales-history-content');
        const itemHistoryContent = content.querySelector('#item-history-content');
        function resetRecordButtonStyles() {
          recordButtons.forEach(btn => {
            btn.style.background = '#fff';
            btn.style.color = '#FF6B8B';
          });
        }
        salesHistoryBtn.onclick = function() {
          resetRecordButtonStyles();
          salesHistoryBtn.style.background = '#FF6B8B';
          salesHistoryBtn.style.color = '#fff';
          salesHistoryContent.style.display = 'block';
          itemHistoryContent.style.display = 'none';
        };
        itemHistoryBtn.onclick = function() {
          resetRecordButtonStyles();
          itemHistoryBtn.style.background = '#FF6B8B';
          itemHistoryBtn.style.color = '#fff';
          salesHistoryContent.style.display = 'none';
          itemHistoryContent.style.display = 'block';
          
          // Generate Item History tables
          generateItemHistoryTables();
        };
        // Filter dropdown toggling
        const filterToggle = content.querySelector('#filter-toggle');
        const filterDropdown = content.querySelector('#filter-dropdown');
        filterToggle.onclick = function(e) {
          e.stopPropagation();
          filterDropdown.style.display = filterDropdown.style.display === 'block' ? 'none' : 'block';
        };
        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
          if (!filterToggle.contains(event.target) && !filterDropdown.contains(event.target)) {
            filterDropdown.style.display = 'none';
          }
        });
        // Filter option click events
        const filterOptions = content.querySelectorAll('.filter-option');
        const tableContainer = content.querySelector('#table-container');
        filterOptions.forEach(option => {
          option.onclick = function() {
            const filter = this.getAttribute('data-filter');
            filterToggle.innerHTML = `${this.textContent} <span>▼</span>`;
            filterDropdown.style.display = 'none';
            generateTable(filter);
          };
        });
        function generateTable(filter) {
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
          // Example placeholder data - you can replace or extend with real data
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
            <div class="table-actions" style="display:flex; justify-content:space-between; padding:15px; background:#f8f9fa;">
              <button class="total-button" id="calculate-total" style="padding:10px 20px; background:#FF9EB5; color:#fff; border:none; border-radius:6px; font-weight:bold; cursor:pointer;">CALCULATE TOTAL</button>
              <button class="pdf-button" id="convert-pdf" style="padding:10px 20px; background:#4CAF50; color:#fff; border:none; border-radius:6px; font-weight:bold; cursor:pointer;">CONVERT TO PDF</button>
            </div>
          `;
          tableContainer.innerHTML = tableHTML;
          // Calculate total button
          content.querySelector('#calculate-total').onclick = () => {
            const priceCells = tableContainer.querySelectorAll('.price-cell');
            let total = 0;
            priceCells.forEach(cell => {
              const val = parseFloat(cell.textContent) || 0;
              total += val;
            });
            tableContainer.querySelector('#total-price').textContent = total.toFixed(2);
          };
          // Convert to PDF button
          content.querySelector('#convert-pdf').onclick = () => {
            if (window.jspdf && window.jspdf.jsPDF) {
              const { jsPDF } = window.jspdf;
              const doc = new jsPDF();
              doc.setFontSize(18);
              doc.text(`Sales History - ${filter.toUpperCase()}`, 105, 15, { align: 'center' });
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
                headStyles: { fillColor: [255, 158, 181] },
                footStyles: { fillColor: [255, 240, 243] }
              });
              doc.save(`sales-history-${filter}.pdf`);
            } else {
              alert('jsPDF library not loaded.');
            }
          };
        }
        
        // Function to generate Item History tables
        function generateItemHistoryTables() {
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
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="price-cell-item"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="price-cell-item"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="price-cell-item"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="price-cell-item"></td>
                  </tr>
                  <tr class="total-row">
                    <td colspan="4">TOTAL</td>
                    <td id="total-price-item">0.00</td>
                  </tr>
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
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          `;
          
          itemHistoryContent.innerHTML = itemHistoryHTML;
          
          // Add event listeners for Item History buttons
          document.getElementById('calculate-total-item').onclick = function() {
            const priceCells = document.querySelectorAll('.price-cell-item');
            let total = 0;
            
            priceCells.forEach(cell => {
              const value = parseFloat(cell.textContent) || 0;
              total += value;
            });
            
            document.getElementById('total-price-item').textContent = total.toFixed(2);
          };
          
          document.getElementById('convert-pdf-item').onclick = function() {
            if (window.jspdf && window.jspdf.jsPDF) {
              const { jsPDF } = window.jspdf;
              const doc = new jsPDF();
              
              // Add title to PDF
              doc.setFontSize(18);
              doc.text('Item History', 105, 15, { align: 'center' });
              
              // Extract first table data
              const headers1 = [];
              const data1 = [];
              
              // Get headers for first table
              const headerCells1 = document.querySelectorAll('#item-history-content .data-table:first-child th');
              headerCells1.forEach(cell => {
                headers1.push(cell.textContent);
              });
              
              // Get data rows for first table (excluding the total row)
              const rows1 = document.querySelectorAll('#item-history-content .data-table:first-child tbody tr:not(.total-row)');
              rows1.forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                  rowData.push(cell.textContent);
                });
                data1.push(rowData);
              });
              
              // Add first table to PDF
              doc.autoTable({
                head: [headers1],
                body: data1,
                startY: 25,
                theme: 'grid',
                headStyles: { fillColor: [255, 158, 181] },
                footStyles: { fillColor: [255, 240, 243] }
              });
              
              // Add second table title
              doc.setFontSize(16);
              doc.text('Deleted History', 105, doc.lastAutoTable.finalY + 15, { align: 'center' });
              
              // Extract second table data
              const headers2 = [];
              const data2 = [];
              
              // Get headers for second table
              const headerCells2 = document.querySelectorAll('#item-history-content .data-table:last-child th');
              headerCells2.forEach(cell => {
                headers2.push(cell.textContent);
              });
              
              // Get data rows for second table
              const rows2 = document.querySelectorAll('#item-history-content .data-table:last-child tbody tr');
              rows2.forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                  rowData.push(cell.textContent);
                });
                data2.push(rowData);
              });
              
              // Add second table to PDF
              doc.autoTable({
                head: [headers2],
                body: data2,
                startY: doc.lastAutoTable.finalY + 20,
                theme: 'grid',
                headStyles: { fillColor: [255, 158, 181] },
                footStyles: { fillColor: [255, 240, 243] }
              });
              
              // Save PDF
              doc.save('item-history.pdf');
            } else {
              alert('jsPDF library not loaded.');
            }
          };
        }
      } else {
        html = `<h1>DELI</h1><h2>CREAM</h2><p>Ice cream, you scream!</p>`;
      }
      if(page !== "record"){ // if not record, insert html now
        content.classList.remove('fade');
        void content.offsetWidth;
        content.classList.add('fade');
        content.innerHTML = html;
      }
      // Note: for record, content.innerHTML is set inside that block because of async bindings
      // Reattach inventory form listeners, if on inventory page:
      if (page === "inventory") {
        // Add item button functionality
        const addItemBtn = document.getElementById('add-item-btn');
        const deleteItemBtn = document.getElementById('delete-item-btn');
        const checkLowStockBtn = document.getElementById('check-low-stock-btn');
        const formsContainer = document.getElementById('forms-container');
        
        addItemBtn.onclick = function() {
          // Reset button styles
          document.querySelectorAll('.action-button').forEach(btn => {
            btn.classList.remove('active');
          });
          this.classList.add('active');
          
          // Show forms container
          formsContainer.style.display = 'flex';
          
          // Hide delete form and show add form
          document.getElementById('add-item-form').parentElement.style.display = 'block';
          document.getElementById('delete-item-form').parentElement.style.display = 'none';
        };
        
        deleteItemBtn.onclick = function() {
          // Reset button styles
          document.querySelectorAll('.action-button').forEach(btn => {
            btn.classList.remove('active');
          });
          this.classList.add('active');
          
          // Show forms container
          formsContainer.style.display = 'flex';
          
          // Hide add form and show delete form
          document.getElementById('add-item-form').parentElement.style.display = 'none';
          document.getElementById('delete-item-form').parentElement.style.display = 'block';
        };
        
        // Check low stock button functionality
        checkLowStockBtn.onclick = function() {
          const table = document.getElementById('inventory-table-body');
          const rows = table.getElementsByTagName('tr');
          let lowStockItems = [];
          
          // Remove previous low stock row highlighting
          for (let i = 0; i < rows.length; i++) {
            rows[i].classList.remove('low-stock-row');
          }
          
          // Check each item's stock
          for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            if (cells.length >= 3) {
              const productName = cells[0].textContent;
              const stock = parseInt(cells[2].textContent);
              
              // Consider items with less than 5 units as low stock
              if (stock < 5) {
                lowStockItems.push(productName);
                // Update status to "Low Stock" and make it red
                cells[4].textContent = "Low Stock";
                cells[4].className = "low-stock";
                // Highlight the row with light red background
                rows[i].classList.add('low-stock-row');
              } else {
                // Update status to "In Stock"
                cells[4].textContent = "In Stock";
                cells[4].className = "";
              }
            }
          }
          
          // Show modal if there are low stock items
          if (lowStockItems.length > 0) {
            showLowStockModal(lowStockItems);
          } else {
            alert("✅ Good news! All items have sufficient stock. No restocking needed at this time.");
          }
        };
        
        // Form submission handlers
        const addItemForm = document.getElementById('add-item-form');
        const deleteItemForm = document.getElementById('delete-item-form');
        
        if (addItemForm) {
          addItemForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert("Item added (not yet functional)");
          });
        }
        
        if (deleteItemForm) {
          deleteItemForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert("Item deleted (not yet functional)");
          });
        }
      }
    }
    
    // Function to show low stock modal
    function showLowStockModal(lowStockItems) {
      const modal = document.getElementById('lowStockModal');
      const lowStockList = document.getElementById('lowStockList');
      
      // Clear previous list items
      lowStockList.innerHTML = '';
      
      // Add each low stock item to the list
      lowStockItems.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item;
        lowStockList.appendChild(li);
      });
      
      // Show the modal
      modal.style.display = 'block';
    }
    
    // Function to close low stock modal
    function closeLowStockModal() {
      const modal = document.getElementById('lowStockModal');
      modal.style.display = 'none';
    }
    
    // Function to handle restock button click
    function restockItems() {
      closeLowStockModal();
      // Here you would typically navigate to a restocking form or process
      alert("Restocking process would start here. This feature is not yet implemented.");
    }
    
    // Close the modal when clicking outside of it
    window.onclick = function(event) {
      const modal = document.getElementById('lowStockModal');
      if (event.target == modal) {
        closeLowStockModal();
      }
    }
  </script>
</body>
</html>