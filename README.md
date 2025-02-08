# **Dynamic Image Gallery Web Application**

This project is a **Dynamic Image Gallery Web Application** developed as part of my **Web Development Internship at CodeClause**. The application allows users to upload, view, filter, and explore images with an interactive and responsive design.

## **Features**
- 🖼️ **Image Upload:** Users can upload images directly from their local devices.  
- 🔍 **Filter Options:** Filter images by category and tags for better searchability.  
- 🏞️ **Gallery View:** Images are displayed in a modern grid layout.  
- 🖥️ **Interactive Modal Viewer:** View images in full-screen mode with navigation controls.  
- 🎨 **Stylish UI:** Smooth animations and vibrant color transitions for a beautiful user experience.  

---

## **Technologies Used**
- **Frontend:**  
  - HTML  
  - CSS (with animations)  
  - JavaScript  
  - jQuery  
- **Backend:**  
  - PHP  
  - MySQL  
- **AJAX:** For dynamic content loading without refreshing the page  

---

## **Getting Started**

### **Prerequisites**
- A local server environment like **XAMPP** or **WAMP**  
- PHP 7.4 or higher  
- MySQL database  

### **Installation**
1. Clone this repository:  
   ```bash
   git clone https://github.com/piyushL337/Image-Gallery/
   ```
2. Navigate to the project directory:  
   ```bash
   cd Image-Gallery
   ```
3. Start your local server and create a database named `gallery_db`.  

4. Import the provided SQL file (`DB.sql`) into your database.  

5. Update the `db.php` file with your database credentials:  
   ```php
   $host = 'localhost';
   $dbname = 'gallery_db';
   $username = 'your_db_username';
   $password = 'your_db_password';
   ```

6. Start your server and open `index.php` in your browser.

---

## **Usage Instructions**
- **Upload Images:** Click the **Upload Button** to upload images.  
- **View Images:** Click on any image to view it in full-screen modal mode.  
- **Filter Images:** Use the dropdown filters for category and tag-based searches.  

---

## **Project Structure**
```
/assets  
    ├── /css (Stylesheets)  
    ├── /images (Uploaded Images)  
    └── /js (Scripts)  
/db.php (Database connection)  
/fetch_images.php (Fetch images for dynamic gallery)  
/index.php (Main gallery page)  
/upload.php (Image upload logic)  
```

---

## **Future Enhancements**
- 🔐 User Authentication  
- ⭐ Favorites and Image Rating Feature  
- 📁 Categorization Improvements  
- 📱 PWA (Progressive Web App) Support  

---

## **Contact**
If you have any questions or suggestions, feel free to reach out!  

**Piyush Joshi**  
[LinkedIn](https://www.linkedin.com/in/piyushjoshi-mh)  
