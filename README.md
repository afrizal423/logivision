# 📦 LogiVision AI - Smart Inventory Placement System

LogiVision is an AI-powered logistics assistant designed for Hackathons. It helps users organize their storage spaces by analyzing photos and inventory lists using the Gemini AI model, with a heavy focus on safety and spatial efficiency.

![LogiVision Dashboard](media/ss.png)

## 🚀 Key Features

- **Modern Landing Page**: A professional SaaS-style introduction page with feature highlights and a clear call-to-action.
- **Adaptive Image Rendering**: Smart aspect-ratio handling ensures portrait and landscape images are displayed correctly without distortion in both web and PDF views.
- **AI Room Analysis**: Automatically detects suitable placement spots for items in a room photo.
- **AI Safety Auditor (K3)**: 
    - Automatically detects potential hazards (e.g., blocked exits, liquids near electronics, precarious stacking).
    - Visualizes hazards with pulsing red overlays and warning icons.
- **Space Utilization Score**: 
    - AI-estimated shelf/area density score (0-100%).
    - Color-coded progress bars (Green: Low, Yellow: Medium, Red: High Density).
- **Find My Item (Smart Search)**: 
    - Real-time search bar to filter and highlight specific items on the map.
    - Dimming effect for non-matching items to improve focus.
- **Interactive Visual Overlays**: 
    - Bidirectional highlighting between image boxes and the detail list.
- **Professional PDF Report**: 
    - Generates a multi-page A4 document report.
    - Includes Safety Audit findings and Placement Recommendations with density metrics.

## Architectural diagram
<img width="2816" height="1536" alt="Gemini_Generated_Image_frtckgfrtckgfrtc" src="https://github.com/user-attachments/assets/cdb5014a-dd3d-4021-bb35-3c1e7b5506c3" />


## 🛠️ Tech Stack

- **Framework**: Laravel 10
- **AI Model**: Google Gemini 1.5 Pro
- **Frontend**: Tailwind CSS (CDN)
- **PDF Generation**: `html2canvas` & `jsPDF` (Client-side rendering)
- **API**: Google Generative Language API

## ⚙️ Installation

1. **Clone the repository**:
   ```bash
   git clone <your-repo-url>
   cd LogiVision
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and add your key: `GEMINI_API_KEY=your_api_key_here`.

4. **Run the Application**:
   ```bash
   php artisan key:generate
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000`.

## 💡 Usage

1. **Start**: Visit the landing page to learn about the features.
2. **Launch App**: Click "Try Demo Now" to enter the main application.
3. **Upload**: Take a photo of your storage space.
4. **List**: Type your inventory items.
5. **Analyze**: AI will suggest placements, score space density, and flag safety hazards.
6. **Search**: Use the "Find My Item" bar to locate specific goods instantly.
7. **Export**: Download the official PDF report for offline field use.
