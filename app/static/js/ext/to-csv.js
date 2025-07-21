
function convertToCSV(headers, items) {
  if (headers) {
    items.unshift(headers);
  }
  // var jsonObject = JSON.stringify(items);
  // var csv = convertToCSV(jsonObject);

  // var items = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
  var str = '';

  for (var i = 0; i < items.length; i++) {
      var line = '';
      for (var index in items[i]) {
        if (line != '') line += ','
        line += `\"${items[i][index]}\"`;
      }
      str += line + '\r\n';
  }
  return str;
}

function downloadBlob(content, filename='export.csv', contentType='text/csv;charset=utf-8') {
  var blob = new Blob([content], { type: 'text/csv;charset=utf-8;' });
  var link = document.createElement("a");
  if (link.download !== undefined) { // feature detection
      // Browsers that support HTML5 download attribute
      var url = URL.createObjectURL(blob);
      link.setAttribute("href", url);
      link.setAttribute("download", filename);
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
  }
}
