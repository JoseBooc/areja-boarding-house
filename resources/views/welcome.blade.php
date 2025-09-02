<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Test</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="p-6 max-w-sm mx-auto bg-white rounded-2xl shadow-lg flex items-center space-x-4">
        <div class="shrink-0">
            <svg class="h-12 w-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8-4a1 1 0 100 2 1 1 0 000-2zm1 9H9v-4h2v4z"/>
            </svg>
        </div>
        <div>
            <div class="text-xl font-medium text-black">Tailwind is Working 🎉</div>
            <p class="text-gray-500">If you see styles, setup is correct!</p>
        </div>
    </div>

</body>
</html>
