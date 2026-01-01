# LogiVision

## Project Overview

LogiVision is a Laravel-based web application designed as an AI-powered logistics assistant. It utilizes the Google Gemini API to analyze photos of storage spaces (like shelves or warehouses) along with an inventory list. The application provides intelligent recommendations for item placement based on logic (e.g., heavy items on the bottom, fragile items on top) and safety.

The project features a modern dashboard interface, interactive visual overlays on the analyzed image, and the ability to export a professional PDF report of the analysis.

## Tech Stack

*   **Backend Framework:** Laravel 10 (PHP ^8.1)
*   **AI Model:** Google Gemini 1.5 Pro (via Google Generative Language API)
*   **Frontend:** Blade Templates, Tailwind CSS (CDN), JavaScript
*   **PDF Generation:** `html2canvas` and `jspdf` (Client-side)
*   **HTTP Client:** Guzzle (via Laravel HTTP wrapper)

## Key Files & Directories

*   **`app/Http/Controllers/InventoryController.php`**: The core controller.
    *   `index()`: Renders the main view.
    *   `analyze()`: Handles file upload, encodes the image to Base64, constructs the prompt, sends the request to the Gemini API, and returns the JSON analysis to the view.
*   **`resources/views/welcome.blade.php`**: The main application view.
    *   Contains the file upload form and inventory list text area.
    *   Implements the interactive "Visual Analysis" overlay system using absolute positioning and percentage-based coordinates.
    *   Includes the `exportPDF()` JavaScript function which clones the DOM to generate a print-friendly A4 PDF report.
*   **`routes/web.php`**: Defines the application routes.
    *   `GET /`: Homepage.
    *   `POST /analyze`: Triggers the analysis logic.
*   **`.env`**: Configuration file (requires `GEMINI_API_KEY`).

## Setup & Running

1.  **Dependencies**:
    ```bash
    composer install
    npm install
    ```

2.  **Environment**:
    *   Copy `.env.example` to `.env`.
    *   Set your Gemini API key: `GEMINI_API_KEY=your_key_here`.

3.  **Run Application**:
    ```bash
    php artisan key:generate
    php artisan serve
    ```
    Access at `http://127.0.0.1:8000`.

## Development Conventions

*   **Styling**: The project currently uses Tailwind CSS via CDN in `welcome.blade.php` for rapid prototyping.
*   **API Interaction**: Interactions with the Gemini API are handled directly in the controller using Laravel's `Http` facade.
*   **Client-Side Logic**: PDF generation and image preview logic are embedded in the `script` tags within the Blade view.
