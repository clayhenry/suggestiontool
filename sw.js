var CACHE_NAME = 'my-site-cache-v1';
var urlsToCache = [
    '/',
    '/assets/styles.css',
    '/App/Services/domdataservice.js',
    '/App/Services/eventhandlerservice.js',
    '/App/Services/httprequestservice.js'
];

self.addEventListener('install', function(event) {
    // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', function(event) {});




