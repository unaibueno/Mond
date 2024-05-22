let minCount;
let count;
onmessage = function (e) {
  if (e.data.action === "start") {
    minCount = e.data.minCount;
    count = e.data.count;
    startTimer();
  }
};

function startTimer() {
  setInterval(() => {
    count--;
    if (count == 0) {
      if (minCount != 0) {
        minCount--;
        count = 60;
      } else {
        postMessage({ action: "complete" });
        close();
      }
    }
    postMessage({
      action: "tick",
      minCount: minCount,
      count: count,
    });
  }, 1000);
}
