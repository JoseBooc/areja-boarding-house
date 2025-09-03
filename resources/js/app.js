import './bootstrap';
import '../css/app.css';

const appRoot = document.getElementById('app');
if (appRoot) {
  appRoot.innerHTML = `
    <main class="min-h-screen flex items-center justify-center p-6">
      <section class="agoda-card w-full max-w-xl">
        <header class="agoda-header rounded-t-xl p-6">
          <h1 class="text-2xl font-semibold">Laravel Vite Frontend</h1>
          <p class="opacity-90">Dev server is running and Tailwind is active.</p>
        </header>
        <div class="p-6 space-y-4">
          <p class="text-gray-700">This preview is served directly by Vite. The PHP backend is not running in this environment, so links to Laravel routes are disabled here.</p>
          <div class="flex gap-3">
            <button class="agoda-btn-primary" id="check-axios">Test Axios</button>
            <a href="https://laravel.com/docs/vite" target="_blank" rel="noreferrer" class="agoda-btn-accent">Docs</a>
          </div>
          <pre class="bg-gray-50 border rounded-md p-3 text-sm overflow-auto" id="output">Click "Test Axios" to make a sample request.</pre>
        </div>
      </section>
    </main>
  `;

  const out = document.getElementById('output');
  const btn = document.getElementById('check-axios');
  if (btn && out) {
    btn.addEventListener('click', async () => {
      try {
        const res = await window.axios.get('https://httpbin.org/get');
        out.textContent = JSON.stringify({ status: res.status, url: res.config.url }, null, 2);
      } catch (err) {
        out.textContent = 'Request failed.';
      }
    });
  }
}
