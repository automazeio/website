/* eslint-disable no-empty */
/* eslint-disable no-unused-vars */
/* jshint esversion: 9 */

function zeroToDash(value) {
  if (parseFloat(value) === 0) {
    return '–';
  }
  return value;
}

function smallDecimals(number) {
  const parts = number.toString().split('.');
  return `${parts[0]}<small class="opacity-80">.${parts[1]}</small>`;
}

function toCamelCase(str) {
  return str.replace(/(?:^\w|[A-Z]|\b\w|\s+)/g, (match, index) => {
    if (+match === 0) return ''; // or if (/\s+/.test(match)) for white spaces
    return index === 0 ? match.toLowerCase() : match.toUpperCase();
  });
}

function toSnakeCase(str) {
  return str.toLowerCase().replaceAll(' ', '_');
}

function toTitleCase(str) {
  return str.replace(
    /\w\S*/g,
    (txt) => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
  );
}

function toParagraphCase(str) {
  const txt = []; let previousWordIsCaps = false; let
    previousWord = '';
  const seperators = ['-', '–', '—', ':', '›', '→', '/', '\\', '@', '&', '#'];
  str.split(' ').forEach((word, i) => {
    if (word === word.toUpperCase()) {
      txt.push(word);
      previousWordIsCaps = true;
      previousWord = word;
    } else {
      if (i === 0 || (i === 1 && previousWordIsCaps) || seperators.includes(previousWord)) {
        txt.push(word.charAt(0).toUpperCase() + word.substr(1).toLowerCase());
      } else {
        txt.push(word.toLowerCase());
      }
      previousWordIsCaps = false;
      previousWord = word;
    }
  });
  return txt.join(' ');
}

