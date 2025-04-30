### 🧩 Installation Guide

To install and run the point of sale -- POS system locally:

1. **Clone the Repository**  
   ```bash
   git clone https://github.com/ukamal/bhuiyanit
   cd bhuiyanit
   ```

2. **Install Dependencies**  
   Make sure you're using **PHP 8.0.2+**. Then run:
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment Setup**  
   Copy the `.env` file and configure your environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set Up Database**  
   Create a database and update your `.env` file. Then run:
   ```bash
   php artisan migrate
   ```

5. **Run the Application**  
   ```bash
   php artisan serve
   ```

---

### 🚀 Key Features (for Real-life Use)

- **Dashboard Overview**: Real-time summary of sales, stock, and activities.
- **Stock Management**: View and manage stock levels easily.
- **Purchases**: Add and track purchase entries with history logs.
- **Sales Module**: Create sales invoices, manage returns, and monitor sales data.
- **Quotations**: Generate and manage both item-based and service-based quotations.
- **Service Sales**: Track and manage service-related sales separately.
- **Banking**: Manage bank accounts and transactions.
- **Expense Tracking**: Add daily expenses and view historical reports.
- **Product Management**: Add new products, categories, and brands with ease.
- **Customer Management**: Maintain customer records, view order history, receive payments, and generate reports.
- **Supplier Management**: Track suppliers and related transactions efficiently.
- **And More...**
---


### ⚠️ **User Note**  
**If anyone wants to update the version or faces any issues while using it in real-life projects, feel free to reach out.**  
I’m happy to provide personal support to help you resolve any problems and ensure smooth implementation.  
Let’s build better, together. 🚀
