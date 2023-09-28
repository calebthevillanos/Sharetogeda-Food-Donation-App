/* HANDLING THE IFRAME */

const iFrame = document.getElementById("frame");

const features = document.getElementsByClassName("feature");

for(i = 0; i < features.length; i++) {
    features[i].addEventListener("click", (e) => {
        e.preventDefault();
        iFrame.src = e.target.href;
        
        removeActiveExcept(e.target, features);

    })
}

const removeActiveExcept = (element, features) => {
    for(i = 0; i < features.length; i++) {
        features[i] == element ? features[i].classList.add("active") : features[i].classList.remove("active");
    }
}

function listAllEventListeners() {
  const allElements = Array.prototype.slice.call(document.querySelectorAll('*'));
  allElements.push(document);
  allElements.push(window);

  const types = [];

  for (let ev in window) {
    if (/^on/.test(ev)) types[types.length] = ev;
  }

  let elements = [];
  for (let i = 0; i < allElements.length; i++) {
    const currentElement = allElements[i];
    for (let j = 0; j < types.length; j++) {
      if (typeof currentElement[types[j]] === 'function') {
        elements.push({
          "node": currentElement,
          "type": types[j],
          "func": currentElement[types[j]].toString(),
        });
      }
    }
  }

  return elements.sort(function(a,b) {
    return a.type.localeCompare(b.type);
  });
}

window.onmessage = (e) => {
  if(e.data.message === "history") {
    if(e.data.origin === "donor") {
      removeActiveExcept(features[2], features);
    }
    else if(e.data.origin === "receiver") {
      removeActiveExcept(features[1], features);
    }
  }
  if(e.data.target === "dashboard") {
    removeActiveExcept(features[0], features);
  }
}

// const observer = new MutationObserver((changes) => {
//   changes.forEach(change => {
//     console.log(change);
//       if(frame.contentWindow.location.href !== href){
//         console.dir(frame.contentWindow.location.href);
//       }
//       if(change.attributeName.includes(""));
//   });
// });
// observer.observe(frame.contentWindow.document.querySelector("body"), {attributes : true});