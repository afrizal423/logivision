<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogiVision AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }
        @-webkit-keyframes spinner {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-indigo-600 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                </div>
                <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                    LogiVision <span class="text-slate-400 font-light">AI</span>
                </h1>
            </div>
            <div class="text-sm font-medium text-slate-500">
                Hackathon Build v1.0
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 h-full">
            
            <!-- Left Column: Input -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col h-fit">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-lg font-semibold text-slate-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Input Data
                    </h2>
                </div>
                
                <form action="{{ route('analyze') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" id="analysisForm">
                    @csrf
                    
                    <!-- Text Area -->
                    <div>
                        <label for="inventory_list" class="block text-sm font-medium text-slate-700 mb-2">Inventory List</label>
                        <textarea id="inventory_list" name="inventory_list" rows="6" 
                            class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-4 bg-slate-50 focus:bg-white transition-colors placeholder:text-slate-400"
                            placeholder="Example:
- 5 large boxes of books (Heavy)
- 1 glass vase (Fragile)
- 2 bags of clothes" required>{{ old('inventory_list', $inventory_list ?? '') }}</textarea>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Room Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-indigo-500 hover:bg-slate-50 transition-all cursor-pointer group relative">
                            <input id="room_image" name="room_image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewImage(event)" required>
                            <div class="space-y-1 text-center z-0">
                                <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <span class="font-medium text-indigo-600 group-hover:text-indigo-500">Upload a file</span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-slate-500">PNG, JPG, GIF up to 10MB</p>
                                <p id="file-name" class="text-sm font-semibold text-indigo-600 mt-2 h-5"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform active:scale-95">
                        <span id="btnText">Analyze Layout</span>
                        <div id="btnLoader" class="loader ease-linear rounded-full border-2 border-t-2 border-slate-200 h-5 w-5 ml-2 hidden"></div>
                    </button>
                </form>
            </div>

            <!-- Right Column: Result -->
            <div id="results-container" class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col h-[800px]"> <!-- Fixed height for layout -->
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center flex-shrink-0">
                    <h2 class="text-lg font-semibold text-slate-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.447-.894L15 7m0 13V7"></path></svg>
                        Visual Analysis
                    </h2>
                    <div class="flex items-center space-x-2">
                        @if(isset($recommendations))
                            <button onclick="exportPDF(this)" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-1.5 px-3 rounded-lg flex items-center transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Export PDF
                            </button>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span>
                                {{ count($recommendations) }} Items
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Search Bar -->
                @if(isset($recommendations) && count($recommendations) > 0)
                <div class="px-6 py-3 bg-white border-b border-slate-100">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" id="findItemInput" 
                            class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                            placeholder="Find item by name..." 
                            oninput="filterItems(this.value)">
                    </div>
                </div>
                @endif

                <div class="flex flex-col h-full overflow-hidden">
                    <!-- Image Area (Top Half) -->
                    <div class="flex-grow bg-slate-100 relative overflow-hidden flex items-center justify-center p-4">
                        @if(isset($image))
                            <div class="relative inline-block w-full h-auto max-h-[400px] shadow-lg rounded-lg overflow-hidden group">
                                <img src="data:{{ $mime_type }};base64,{{ $image }}" class="w-full h-full object-contain block bg-slate-200" alt="Room Analysis">
                                
                            <!-- Overlays -->
                            
                            <!-- Safety Hazards -->
                            @if(isset($hazards))
                                @foreach($hazards as $haz)
                                    @php
                                        $box = $haz['box_2d'];
                                        $top = ($box[0] / 1000) * 100;
                                        $left = ($box[1] / 1000) * 100;
                                        $height = (($box[2] - $box[0]) / 1000) * 100;
                                        $width = (($box[3] - $box[1]) / 1000) * 100;
                                    @endphp
                                    <div id="hazard-box-{{ $loop->index }}" 
                                         class="absolute border-2 border-dashed border-red-600 bg-red-500/10 hover:bg-red-500/40 animate-pulse z-20 cursor-help group/hazard"
                                         style="top: {{ $top }}%; left: {{ $left }}%; height: {{ $height }}%; width: {{ $width }}%;"
                                         onmouseenter="highlightHazard({{ $loop->index }})"
                                         onmouseleave="resetHazard({{ $loop->index }})">
                                        
                                        <!-- Warning Icon -->
                                        <div class="absolute -top-2.5 -left-2.5 bg-red-600 text-white rounded-full p-1 shadow-md">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Inventory Placements -->
                            @foreach($recommendations as $rec)
                                @php
                                    // Parse Reasoning for styling
                                    $reasoning = strtolower($rec['reasoning']);
                                    $borderColor = 'border-green-500';
                                    $bgColor = 'bg-green-500/20';
                                    $typeColor = 'bg-green-500';
                                    
                                    if (str_contains($reasoning, 'heavy') || str_contains($reasoning, 'bottom') || str_contains($reasoning, 'floor') || ($rec['type'] ?? '') === 'heavy') {
                                        $borderColor = 'border-red-500';
                                        $bgColor = 'bg-red-500/20';
                                        $typeColor = 'bg-red-500';
                                    } elseif (str_contains($reasoning, 'fragile') || str_contains($reasoning, 'glass') || ($rec['type'] ?? '') === 'fragile') {
                                        $borderColor = 'border-yellow-400';
                                        $bgColor = 'bg-yellow-400/20';
                                        $typeColor = 'bg-yellow-400';
                                    }
                                    
                                    // Coordinates
                                    $box = $rec['box_2d'];
                                    $top = ($box[0] / 1000) * 100;
                                    $left = ($box[1] / 1000) * 100;
                                    $height = (($box[2] - $box[0]) / 1000) * 100;
                                    $width = (($box[3] - $box[1]) / 1000) * 100;
                                @endphp

                                <div id="box-{{ $loop->index }}" 
                                     class="item-box absolute border-2 {{ $borderColor }} {{ $bgColor }} transition-all duration-300 cursor-pointer hover:bg-opacity-40 z-10"
                                     data-name="{{ strtolower($rec['item_name']) }}"
                                     style="top: {{ $top }}%; left: {{ $left }}%; height: {{ $height }}%; width: {{ $width }}%;"
                                     onmouseenter="highlightItem({{ $loop->index }})"
                                     onmouseleave="resetItem({{ $loop->index }})">
                                    
                                    <!-- Simple Number Label -->
                                    <span class="absolute top-0 left-0 {{ $typeColor }} text-white text-[10px] font-bold px-1.5 py-0.5 rounded-br-md shadow-sm">
                                        {{ $loop->iteration }}
                                    </span>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <div class="text-center text-slate-400">
                                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-lg font-medium">No analysis yet</p>
                            </div>
                        @endif
                    </div>

                    <!-- Details List Area (Bottom Half) -->
                    <div class="h-1/2 bg-white border-t border-slate-200 flex flex-col overflow-hidden">
                        <div class="overflow-y-auto flex-grow p-0 scroll-smooth" id="itemsList">
                            
                            <!-- Section: Safety Audit -->
                            @if(isset($hazards) && count($hazards) > 0)
                                <div class="p-3 bg-red-50 border-b border-red-100 text-[10px] font-bold text-red-600 uppercase tracking-widest flex items-center">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Safety Audit Findings
                                </div>
                                <ul class="divide-y divide-red-50 bg-red-50/30">
                                    @foreach($hazards as $index => $haz)
                                        <li id="hazard-item-{{ $index }}" 
                                            class="p-4 hover:bg-red-100 transition-colors cursor-pointer border-l-4 border-transparent"
                                            onmouseenter="highlightHazardBox({{ $index }})"
                                            onmouseleave="resetHazardBox({{ $index }})">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 w-6 h-6 rounded bg-red-600 text-white flex items-center justify-center text-[10px] font-bold">
                                                    !
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between mb-0.5">
                                                        <p class="text-xs font-bold text-red-900 uppercase">
                                                            {{ $haz['severity'] }} Severity
                                                        </p>
                                                    </div>
                                                    <p class="text-sm text-red-800 leading-relaxed">
                                                        {{ $haz['description'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="p-3 bg-slate-50 border-b border-slate-200 text-[10px] font-bold text-slate-500 uppercase tracking-widest flex items-center">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
                                Placement Recommendations
                            </div>
                            
                            @if(isset($recommendations))
                                <ul class="divide-y divide-slate-100">
                                    @foreach($recommendations as $index => $rec)
                                        @php
                                            $reasoning = strtolower($rec['reasoning']);
                                            $icon = '📦'; // Default
                                            $badgeClass = 'bg-green-100 text-green-800';
                                            
                                            if (str_contains($reasoning, 'heavy') || str_contains($reasoning, 'bottom')) {
                                                $icon = '🏋️';
                                                $badgeClass = 'bg-red-100 text-red-800';
                                            } elseif (str_contains($reasoning, 'fragile') || str_contains($reasoning, 'glass')) {
                                                $icon = '💎';
                                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                                            }

                                            // Utilization Score Logic
                                            $score = $rec['utilization_score'] ?? 0;
                                            $barColor = 'bg-green-500';
                                            $textColor = 'text-green-600';
                                            
                                            if ($score >= 80) {
                                                $barColor = 'bg-red-500';
                                                $textColor = 'text-red-600';
                                            } elseif ($score >= 50) {
                                                $barColor = 'bg-yellow-400';
                                                $textColor = 'text-yellow-600';
                                            }
                                        @endphp
                                        <li id="item-{{ $index }}" 
                                            class="p-4 hover:bg-slate-50 transition-colors cursor-pointer border-l-4 border-transparent"
                                            onmouseenter="highlightBox({{ $index }})"
                                            onmouseleave="resetBox({{ $index }})">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-600">
                                                    {{ $loop->iteration }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="text-sm font-bold text-slate-900 truncate">
                                                            {{ $icon }} {{ $rec['item_name'] }}
                                                        </p>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badgeClass }}">
                                                            {{ ucwords($rec['type'] ?? 'Standard') }}
                                                        </span>
                                                    </div>
                                                    
                                                    <!-- Space Utilization Bar -->
                                                    <div class="flex items-center space-x-2 mb-2 mt-1">
                                                        <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Density</span>
                                                        <div class="flex-grow h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                            <div class="h-full rounded-full {{ $barColor }}" style="width: {{ $score }}%"></div>
                                                        </div>
                                                        <span class="text-[10px] font-bold {{ $textColor }} density-score">{{ $score }}%</span>
                                                    </div>

                                                    <p class="text-sm text-slate-600 line-clamp-2">
                                                        {{ $rec['reasoning'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="p-8 text-center text-slate-500 text-sm">
                                    Upload data to see breakdown here.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Bidirectional Highlighting Logic for Items
                function highlightItem(index) {
                    const item = document.getElementById('item-' + index);
                    if (item) {
                        item.classList.add('bg-indigo-50', 'border-indigo-500');
                        item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                    const box = document.getElementById('box-' + index);
                    if (box) {
                        box.classList.add('z-50', 'ring-4', 'ring-indigo-400');
                    }
                }

                function resetItem(index) {
                    const item = document.getElementById('item-' + index);
                    if (item) {
                        item.classList.remove('bg-indigo-50', 'border-indigo-500');
                    }
                    const box = document.getElementById('box-' + index);
                    if (box) {
                        box.classList.remove('z-50', 'ring-4', 'ring-indigo-400');
                    }
                }

                function highlightBox(index) { highlightItem(index); }
                function resetBox(index) { resetItem(index); }

                // Bidirectional Highlighting Logic for Hazards
                function highlightHazard(index) {
                    const item = document.getElementById('hazard-item-' + index);
                    if (item) {
                        item.classList.add('bg-red-200', 'border-red-600');
                        item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                    const box = document.getElementById('hazard-box-' + index);
                    if (box) {
                        box.classList.add('z-50', 'ring-4', 'ring-red-400', 'animate-none');
                        box.classList.remove('animate-pulse');
                    }
                }

                function resetHazard(index) {
                    const item = document.getElementById('hazard-item-' + index);
                    if (item) {
                        item.classList.remove('bg-red-200', 'border-red-600');
                    }
                    const box = document.getElementById('hazard-box-' + index);
                    if (box) {
                        box.classList.remove('z-50', 'ring-4', 'ring-red-400', 'animate-none');
                        box.classList.add('animate-pulse');
                    }
                }

                function highlightHazardBox(index) { highlightHazard(index); }
                function resetHazardBox(index) { resetHazard(index); }

                // Find My Item Logic
                function filterItems(query) {
                    const term = query.toLowerCase().trim();
                    const boxes = document.querySelectorAll('.item-box');
                    
                    boxes.forEach(box => {
                        const name = box.getAttribute('data-name');
                        
                        if (term === '') {
                            // Reset to default state
                            box.style.opacity = '';
                            box.style.transform = '';
                            box.style.zIndex = '';
                            box.style.boxShadow = '';
                            // Re-enable hover effects via class if needed, strictly cleaning inline styles allows CSS hover to work again
                        } else if (name.includes(term)) {
                            // Match Found
                            box.style.opacity = '1';
                            box.style.transform = 'scale(1.05)';
                            box.style.zIndex = '50';
                            box.style.boxShadow = '0 0 20px rgba(255, 255, 255, 0.8), 0 0 4px currentColor'; // Glow effect
                            box.style.transition = 'all 0.3s ease';
                        } else {
                            // No Match - Dim it
                            box.style.opacity = '0.1';
                            box.style.transform = 'scale(1)';
                            box.style.zIndex = '0';
                            box.style.boxShadow = '';
                        }
                    });
                }
            </script>

        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-slate-400">
                &copy; {{ date('Y') }} LogiVision Hackathon. Powered by Gemini.
            </p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        async function exportPDF(btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<div class="loader ease-linear rounded-full border-2 border-t-2 border-white h-3 w-3 mr-2"></div> Generating...';
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btn.disabled = true;

            try {
                // 1. Get Visual Source
                const sourceVisual = document.querySelector('.relative.inline-block');
                if (!sourceVisual) throw new Error("No visual analysis found");
                
                // 2. Separate Data Sources
                const hazardItems = document.querySelectorAll('li[id^="hazard-item-"]');
                const placementItems = document.querySelectorAll('li[id^="item-"]');
                const totalItems = hazardItems.length + placementItems.length;

                // 3. Create Dedicated Print Container
                const printContainer = document.createElement('div');
                Object.assign(printContainer.style, {
                    position: 'absolute',
                    top: '-10000px',
                    left: '0',
                    width: '794px', // A4 Width
                    backgroundColor: '#ffffff',
                    fontFamily: '"Inter", sans-serif',
                    color: '#1e293b'
                });
                
                // 4. Build Hazards HTML
                let hazardsHtml = '';
                if (hazardItems.length > 0) {
                    let hazardListInner = '';
                    hazardItems.forEach((item, index) => {
                        const severityEl = item.querySelector('.text-red-900');
                        const descEl = item.querySelector('.text-red-800');
                        
                        const severity = severityEl ? severityEl.innerText : 'HAZARD';
                        const desc = descEl ? descEl.innerText : '';

                        hazardListInner += `
                            <div style="padding: 12px 20px; border-bottom: 1px solid #fee2e2; page-break-inside: avoid; display: flex; align-items: flex-start;">
                                <div style="width: 24px; height: 24px; background-color: #dc2626; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0; color: white; font-weight: bold; font-size: 14px;">!</div>
                                <div>
                                    <div style="font-size: 11px; font-weight: 800; color: #991b1b; text-transform: uppercase; margin-bottom: 2px;">${severity}</div>
                                    <p style="font-size: 12px; color: #7f1d1d; margin: 0; line-height: 1.4;">${desc}</p>
                                </div>
                            </div>
                        `;
                    });

                    hazardsHtml = `
                        <h3 style="font-size: 14px; font-weight: 700; margin-bottom: 10px; margin-top: 30px; color: #dc2626; text-transform: uppercase; display: flex; align-items: center;">
                            <span style="display: inline-block; width: 8px; height: 8px; background-color: #dc2626; border-radius: 50%; margin-right: 8px;"></span>
                            Safety Audit Findings
                        </h3>
                        <div style="border: 1px solid #fecaca; border-radius: 12px; background-color: #fef2f2; overflow: hidden; margin-bottom: 10px;">
                            ${hazardListInner}
                        </div>
                    `;
                }

                // 5. Build Placements HTML
                let placementsHtml = '';
                if (placementItems.length > 0) {
                    let placementListInner = '';
                    placementItems.forEach((item, index) => {
                       const titleEl = item.querySelector('p.text-slate-900');
                       const descEl = item.querySelector('p.text-slate-600');
                       const badgeEl = item.querySelector('.inline-flex');
                       const scoreEl = item.querySelector('.density-score'); // Updated specific selector

                       const rawText = titleEl ? titleEl.innerText : 'Unknown Item';
                       const iconMatch = rawText.match(/^(\P{L}+)\s+(.*)/u);
                       const icon = iconMatch ? iconMatch[1] : '📦';
                       const title = iconMatch ? iconMatch[2] : rawText;
                       
                       const desc = descEl ? descEl.innerText : '';
                       const badgeText = badgeEl ? badgeEl.innerText : 'Standard';
                       const score = scoreEl ? parseInt(scoreEl.innerText) : 0;

                       let badgeColor = '#22c55e'; 
                       let badgeBg = '#dcfce7';
                       let scoreColor = '#22c55e'; // Green

                       if(badgeText.toLowerCase().includes('heavy')) {
                           badgeColor = '#ef4444'; badgeBg = '#fee2e2';
                       } else if(badgeText.toLowerCase().includes('fragile')) {
                           badgeColor = '#eab308'; badgeBg = '#fef9c3';
                       }

                       if (score >= 80) scoreColor = '#ef4444';
                       else if (score >= 50) scoreColor = '#eab308';

                       placementListInner += `
                           <div style="padding: 15px 20px; border-bottom: 1px solid #f1f5f9; page-break-inside: avoid;">
                               <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 5px;">
                                   <div style="display: flex; align-items: center;">
                                       <div style="width: 24px; height: 24px; background-color: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800; color: #64748b; margin-right: 12px; flex-shrink: 0;">
                                           ${index + 1}
                                       </div>
                                       <span style="font-size: 18px; margin-right: 10px;">${icon}</span>
                                       <span style="font-weight: 700; font-size: 14px; color: #0f172a;">${title}</span>
                                   </div>
                                   <span style="background-color: ${badgeBg}; color: ${badgeColor}; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase;">${badgeText}</span>
                               </div>

                               <!-- PDF Density Bar -->
                               <div style="display: flex; align-items: center; margin-left: 66px; margin-bottom: 8px; margin-top: 2px;">
                                   <span style="font-size: 9px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-right: 10px;">Density</span>
                                   <div style="flex-grow: 1; height: 5px; background-color: #f1f5f9; border-radius: 10px; overflow: hidden; max-width: 150px;">
                                       <div style="height: 100%; width: ${score}%; background-color: ${scoreColor}; border-radius: 10px;"></div>
                                   </div>
                                   <span style="font-size: 10px; font-weight: 800; color: ${scoreColor}; margin-left: 8px;">${score}%</span>
                               </div>

                               <p style="font-size: 12px; color: #64748b; margin: 0; padding-left: 66px;">${desc}</p>
                           </div>
                       `;
                    });

                    placementsHtml = `
                        <h3 style="font-size: 14px; font-weight: 700; margin-bottom: 10px; margin-top: 30px; color: #334155; text-transform: uppercase; display: flex; align-items: center;">
                            <span style="display: inline-block; width: 8px; height: 8px; background-color: #3b82f6; border-radius: 50%; margin-right: 8px;"></span>
                            Placement Recommendations
                        </h3>
                        <div style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff;">
                            ${placementListInner}
                        </div>
                    `;
                }

                // 6. Clone Visual
                const visualClone = sourceVisual.cloneNode(true);
                visualClone.classList.remove('w-full', 'h-auto', 'shadow-2xl');
                Object.assign(visualClone.style, {
                    width: '100%',
                    height: 'auto',
                    borderRadius: '12px',
                    overflow: 'hidden',
                    border: '1px solid #e2e8f0',
                    display: 'block'
                });
                
                // Fix overlay styles in clone
                const boxes = visualClone.querySelectorAll('div.absolute');
                boxes.forEach(box => {
                    box.style.borderWidth = '2px';
                    box.style.opacity = '1';
                    // Remove animation classes from clone to static PDF
                    box.classList.remove('animate-pulse'); 
                    // Ensure dashed borders for hazards are visible
                    if(box.classList.contains('border-dashed')) {
                        box.style.borderStyle = 'dashed';
                    }
                });

                // 7. Construct Final DOM
                printContainer.innerHTML = `
                    <div style="padding: 40px;">
                        <div style="border-bottom: 2px solid #4f46e5; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
                            <div>
                                <h1 style="font-size: 28px; font-weight: 800; color: #1e1b4b; margin: 0;">LogiVision <span style="font-weight: 300; color: #6366f1;">Report</span></h1>
                                <p style="font-size: 12px; color: #64748b; margin-top: 5px;">Generated on ${new Date().toLocaleDateString()}</p>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-size: 32px; font-weight: 800; color: #4f46e5; line-height: 1;">${totalItems}</div>
                                <div style="font-size: 10px; font-weight: 600; text-transform: uppercase; color: #94a3b8;">Total Items</div>
                            </div>
                        </div>
                        
                        <div id="pdf-visual-container" style="margin-bottom: 20px;"></div>
                        
                        ${hazardsHtml}
                        ${placementsHtml}

                        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="font-size: 10px; color: #94a3b8;">LogiVision AI - Smart Inventory Placement System</p>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(printContainer);
                document.querySelector('#pdf-visual-container').appendChild(visualClone);

                await new Promise(resolve => setTimeout(resolve, 800));

                const canvas = await html2canvas(printContainer, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff'
                });

                const imgData = canvas.toDataURL('image/jpeg', 0.9);
                const pdf = new jsPDF('p', 'mm', 'a4');
                const pdfWidth = 210; 
                const pdfHeight = 297; 
                const imgProps = pdf.getImageProperties(imgData);
                const imgHeight = (imgProps.height * pdfWidth) / imgProps.width;
                
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'JPEG', 0, position, pdfWidth, imgHeight);
                heightLeft -= pdfHeight;

                while (heightLeft > 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'JPEG', 0, position, pdfWidth, imgHeight);
                    heightLeft -= pdfHeight;
                }

                pdf.save('LogiVision-Report.pdf');
                document.body.removeChild(printContainer);

            } catch (error) {
                console.error('Export Error:', error);
                alert('Could not generate PDF: ' + error.message);
            } finally {
                btn.innerHTML = originalText;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
                btn.disabled = false;
            }
        }

        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                document.getElementById('file-name').textContent = input.files[0].name;
            }
        }

        document.getElementById('analysisForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('btnLoader');
            const text = document.getElementById('btnText');
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            loader.classList.remove('hidden');
            text.textContent = 'Analyzing...';
        });
    </script>
</body>
</html>