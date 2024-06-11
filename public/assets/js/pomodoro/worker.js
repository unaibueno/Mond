// worker.js
let timerInterval;
let isRunning = false;
let time = 0;

self.addEventListener("message", (e) => {
  const { type, maxDuration, t } = e.data;

  if (type === "start") {
    isRunning = true;
    time = t || 0;
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
      if (time < maxDuration) {
        time++;
        self.postMessage({ t: time, running: isRunning });
      } else {
        isRunning = false;
        clearInterval(timerInterval);
        self.postMessage({ t: time, running: isRunning });
      }
    }, 1000);
  } else if (type === "stop") {
    isRunning = false;
    clearInterval(timerInterval);
    self.postMessage({ t: time, running: isRunning });
  }
});
