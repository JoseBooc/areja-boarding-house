import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { readFile } from 'fs/promises';

const serveRootIndex = {
    name: 'serve-root-index',
    apply: 'serve',
    configureServer(server) {
        server.middlewares.use(async (req, res, next) => {
            if (req.url === '/' || req.url === '/index.html') {
                try {
                    const html = await readFile('index.html', 'utf-8');
                    const transformed = await server.transformIndexHtml('/', html);
                    res.setHeader('Content-Type', 'text/html');
                    res.end(transformed);
                    return;
                } catch (e) {
                    // fallthrough
                }
            }
            next();
        });
    },
};

export default defineConfig({
    plugins: [
        serveRootIndex,
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
