const CACHE_NAME = "pomodoro-cache-v1";
const urlsToCache = [
  "/",
  "/index.html",
  "/assets/js/pomodoro/sw.js",
  "/assets/js/pomodoro/worker.js",
  "/assets/css/style.css",
  "/assets/images/logo.png",
  // Añade más recursos aquí
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches
      .open(CACHE_NAME)
      .then((cache) => {
        console.log("Opened cache");
        return cache.addAll(
          urlsToCache.map((url) => new Request(url, { mode: "no-cors" }))
        );
      })
      .then(() => {
        console.log("All resources cached successfully");
      })
      .catch((error) => {
        console.error("Error during cache.addAll:", error);
      })
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      if (response) {
        return response;
      }
      return fetch(event.request);
    })
  );
});
