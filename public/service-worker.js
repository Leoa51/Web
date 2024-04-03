// self.addEventListener('fetch', function(event) {
//     console.log('####')
//     event.respondWith(
//         caches.match(event.request).then(function(response) {
//             return response || fetch(event.request).then(function(response) {
//                 return caches.open('static').then(function(cache) {
//                     cache.put(event.request, response.clone());
//                     return response;
//                 });
//             })
//         })
//     );
// })