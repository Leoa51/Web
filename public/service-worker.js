self.addEventListener('fetch', function(event) {
    if (event.request.url.includes('site.stageHub.com')) {
        event.respondWith(
            caches.match(event.request).then(function (response) {
                return response || fetch(event.request).then(function (response) {
                    return caches.open('our-cache').then(function (cache) {
                        cache.put(event.request, response.clone());
                        return response;
                    });
                })
            })
        );
    }
})