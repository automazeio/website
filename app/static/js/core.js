/* eslint-disable no-empty */
/* eslint-disable no-unused-vars */
/* jshint esversion: 9 */

function $(selector) {
  if (selector.startsWith('#') && selector.indexOf(' ') === -1) {
    return document.querySelector(selector);
  }
  return document.querySelectorAll(selector);
}

function onDocReady(callback, timeout = 0) {
  if (/complete|interactive|loaded/.test(document.readyState)) {
    setTimeout(callback, timeout);
  } else {
    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(callback, timeout);
    });
  }
}

function allowTab(element) {
  element.addEventListener('keydown', (e) => {
    if (e.keyCode === 9) {
      e.preventDefault();
      var start = element.selectionStart;
      var end = element.selectionEnd;
      element.value = element.value.substring(0, start) + "\t" + element.value.substring(end);
      element.selectionStart = element.selectionEnd = start + 1;
    }
  });
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function copyObject(obj) {
  return JSON.parse(JSON.stringify(obj));
}

function getRandomArbitrary(min, max) {
  return Math.random() * (max - min) + min;
}

function flattenObject(ob) {
  const toReturn = {};

  for (const i in ob) {
    if (!ob.hasOwnProperty(i)) continue;

    if ((typeof ob[i]) === 'object' && ob[i] !== null) {
      const flatObject = flattenObject(ob[i]);
      for (const x in flatObject) {
        if (!flatObject.hasOwnProperty(x)) continue;
        toReturn[`${i}.${x}`] = flatObject[x];
      }
    } else {
      toReturn[i] = ob[i];
    }
  }
  return toReturn;
}

function getCSRFToken() {
  return $('input[name="csrf_token"]')[0]?.value;
}
function withCSRFToken(data) {
  return { ...data, csrf_token: getCSRFToken() };
}
function isSameJSON(obj1, obj2) {
  return JSON.stringify(obj1) === JSON.stringify(obj2);
}

function linkify(text) {
  const urlRegex = /(?<=\s|^)(https?:\/\/)?[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,6}(?:\.[a-zA-Z0-9-]{2,6})?(?:\/\S*)?(?=[.,;:?!-]?(?:\s|$))/g;
  const usernameRegex = /@([a-zA-Z0-9_-]{3,30})/g;

  text = text.replace(urlRegex, match => {
    const url = match.startsWith('http') ? match : `https://${match}`;
    try {
      const parsedUrl = new URL(url);
      return `<a href="${url}" target="_blank">${parsedUrl.hostname}</a>`;
    } catch {
      return match;
    }
  });

  return text.replace(usernameRegex, '<a target="_blank" href="https://1big.link/$1">$&</a>');
}

function isEmpty(x) {
  if (x == null || x === '' || x === undefined) return true;
  if (Array.isArray(x) || typeof x === 'string') return x.length === 0;
  if (typeof x === 'object') return Object.keys(x).length === 0;
  return false;
}

function copyToClipboard(ele) {
  if (typeof ele == 'string') {
    navigator.clipboard.writeText(ele);
    return;
  }
  navigator.clipboard.writeText(ele.innerText || ele.value);
}

function copyToClipboardWithConfirmation(text, message, ele) {
  navigator.clipboard.writeText(text);
  const html = ele.innerHTML
  ele.innerHTML = message;
  setTimeout(() => { ele.innerHTML = html }, 750);
}

function addTextareaTab(textarea) {
  textarea.setRangeText('\t', textarea.selectionStart, textarea.selectionStart, 'end')
}

window.waitInterval = undefined;
async function waitUntil(callback, ms, triesLeft = 100) {
  return new Promise((resolve, reject) => {
    window.waitInterval = setInterval(async () => {
      if (await callback()) {
        clearInterval(window.waitInterval);
        resolve();
      } else if (triesLeft <= 1) {
        clearInterval(window.waitInterval);
        reject();
      }
      triesLeft--;
    }, ms);
  });
}

function setDefault(collection, key, fallback) {
  return (collection && key in collection && collection[key]) ? collection[key] : fallback;
}

function showLoading(ele) {
  const run = (element) => {
    element.setAttribute('disabled', true);
    element.setAttribute('aria-busy', true);
    element.classList.add('busy');
  }

  ele = ele || [...document.querySelectorAll('button[type="submit"]')];
  if (!ele) return;
  if (!Array.isArray(ele)) {
    run(ele);
    return;
  }
  // console.log(ele);
  ele.forEach((element) => {
    run(element);
  });

}

function hideLoading(ele) {
  if (ele) {
    ele.removeAttribute('disabled');
    ele.removeAttribute('aria-busy');
    // ele.classList.remove('busy');
  } else {
    const elems = document.querySelectorAll('.busy');
    elems.forEach((el) => {
      el.removeAttribute('disabled');
      el.removeAttribute('aria-busy');
      el.classList.remove('busy');
    });
  }
}

function selectAll(ele) {
  setTimeout(() => {
    let range; let
      selection;
    if (document.body.createTextRange) {
      range = document.body.createTextRange();
      range.moveToElementText(ele);
      range.select();
    } else if (window.getSelection) {
      selection = window.getSelection();
      range = document.createRange();
      range.selectNodeContents(ele);
      selection.removeAllRanges();
      selection.addRange(range);
    }
  }, 100);
}

function ditify(str) {
  return str.toLowerCase()
    .replace(/[^0-9a-z\s]/gi, '')
    .replace(/\s\s+/, ' ')
    .replace(/\s/g, '-')
    .replace(/s/, '-');
}

function getSelectedText() {
  let text = '';
  if (typeof window.getSelection !== 'undefined') {
    text = window.getSelection().toString();
  } else if (typeof document.selection !== 'undefined' && document.selection.type == 'Text') {
    text = document.selection.createRange().text;
  }
  return text;
}

function openDialogWindow(url, name, w, h) {
  w = Math.min(w, window.screen.width); // no bigger than the screen!
  h = Math.min(h, window.screen.height);
  const centerX = (window.outerWidth || window.screen.width) / 2 + window.screenX;
  const centerY = (window.outerHeight || window.screen.height) / 2 + window.screenY;
  const windowFeatures = `popup=1,left=${centerX - w / 2},top=${centerY - h / 2},width=${w},height=${h}`;
  const handle = window.open(url, name, windowFeatures);
  if (!handle) {
    window.location.href = url;
  }
}

// ------------------------------------------------------------
// alpine.js utils
// ------------------------------------------------------------
function dispatchOnNextPage(item, data) {
  localStorage.dispatch = JSON.stringify({
    item,
    data,
  });
}

function getStack(el) {
  if (typeof el === 'string') {
    if (document.getElementById(el)?._x_dataStack) {
      return document.getElementById(el)?._x_dataStack[0];
    }
    return {};
  }
  return el?._x_dataStack[0];
}

function get(url, targetAndSelect, select) {
  targetAndSelect = targetAndSelect || '#main';
  select = select || targetAndSelect;
  htmx.ajax('GET', url, {
      swap: 'outerHTML',
      target: targetAndSelect,
      select,
  })
}
